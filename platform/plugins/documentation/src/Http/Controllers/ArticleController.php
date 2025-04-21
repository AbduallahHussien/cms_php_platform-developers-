<?php

namespace Botble\Documentation\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Documentation\Http\Requests\DocumentationRequest;
use Botble\Documentation\Models\Documentation;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Documentation\Tables\ArticleTable;
use Botble\Documentation\Forms\ArticleForm;
use Botble\Documentation\Http\Requests\ArticleRequest;
use Botble\Documentation\Models\Article;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArticleController extends BaseController
{
    public function __construct()
    {
        // $this
        //     ->breadcrumb()
        //     ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'));
    }

    public function index($documentation_id,ArticleTable $table) 
    { 
        $this->pageTitle(trans('plugins/documentation::article.name'));
    
        $table->addHeaderAction(
            // New custom action
            CreateHeaderAction::make()
           ->route('documentation.articles.create',['documentation_id'=> $documentation_id])  // Dynamically pass the row's ID
        );
        
        $table->queryUsing(function (Builder $query) use ($documentation_id){
            $query->select(['id', 'title', 'content', 'topic_id','created_at','user_id', 'status'])->where('documentation_id', $documentation_id);

        });

        return $table->renderTable();
    }

    public function create($documentation_id)
    { 
        $this->pageTitle(trans('plugins/documentation::topic.create')); 
        $article = new Article();
        $article->documentation_id = $documentation_id;
        $article->user_id = Auth::id();
        return ArticleForm::createFromModel($article)->renderForm();
    }

    public function store(ArticleRequest $request)
    {  
        $article = new Article();
        $article->documentation_id = $request->documentation_id;
        $article->user_id = $request->user_id; 

        $form = ArticleForm::createFromModel($article)->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.topics.index',['documentation_id' =>  $form->getModel()->documentation_id]))
            ->setNextUrl(route('documentation.topics.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Article $article)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $article->name]));

        return ArticleForm::createFromModel($article)->renderForm();
    }

    public function update(Article $article, ArticleRequest $request)
    {
        ArticleForm::createFromModel($article)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.topics.index',['documentation_id'=>$article->documentation->id]))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Article $article)
    {
        return DeleteResourceAction::make($article);
    }
    
}
