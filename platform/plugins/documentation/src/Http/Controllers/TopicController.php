<?php

namespace Botble\Documentation\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Documentation\Http\Requests\DocumentationRequest;
use Botble\Documentation\Models\Documentation;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Contact\Enums\ContactStatusEnum;
use Botble\Documentation\Tables\TopicTable;
use Botble\Documentation\Forms\TopicForm;
use Botble\Documentation\Http\Requests\TopicRequest;
use Botble\Documentation\Models\Topic;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TopicController extends BaseController
{
    public function __construct()
    {
        // $this
        //     ->breadcrumb()
        //     ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'));
    }

    private function setTopicBreadcrumb($documentation_id)
    {
        $this->breadcrumb()
            ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'))
             ->add(trans('plugins/documentation::topic.name'),route('documentation.topics.index', ['documentation_id' => $documentation_id])
        );
    }
    public function index($documentation_id,TopicTable $table) 
    { 
        $this->breadcrumb()
        ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'));
        $this->pageTitle(trans('plugins/documentation::topic.name'));
    
        $table->addHeaderAction(
            // New custom action
            CreateHeaderAction::make()
           ->route('documentation.topics.create',['documentation_id'=> $documentation_id])  // Dynamically pass the row's ID
        );
         
        $table->queryUsing(function (Builder $query) use ($documentation_id){
            $query->select([
                'id',
                'order',
                'name',
                'status'
            ])->where('documentation_id',$documentation_id); 
        });

        return $table->renderTable();
    }

    public function create($documentation_id)
    { 
        $this->setTopicBreadcrumb($documentation_id);
        $this->pageTitle(trans('plugins/documentation::topic.create')); 
        $topic = new Topic();
        $topic->documentation_id = $documentation_id;
        $maxOrder = Topic::max('order') ?? 0;
        $topic->order = $maxOrder + 1;
        return TopicForm::createFromModel($topic)->renderForm();
    }

    public function store(TopicRequest $request)
    { 
        $form = TopicForm::create()->setRequest($request);
        $form->save();
        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.topics.index',['documentation_id' =>  $form->getModel()->documentation_id]))
            ->setNextUrl(route('documentation.topics.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Topic $topic)
    {
        $this->setTopicBreadcrumb($topic->documentation_id);
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $topic->name]));
        return TopicForm::createFromModel($topic)->renderForm();
    }

    public function update(Topic $topic, TopicRequest $request)
    {
        TopicForm::createFromModel($topic)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.topics.index',['documentation_id'=>$topic->documentation->id]))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Topic $topic)
    {
        return DeleteResourceAction::make($topic);
    }
    
    public function updateOrder(Request $request)
    {
        // return response()->json(['success' => true]);
        $item = Topic::findOrFail($request->id);
        $item->order = $request->order;
        $item->save();

        return response()->json(['success' => true]);
    }


}
