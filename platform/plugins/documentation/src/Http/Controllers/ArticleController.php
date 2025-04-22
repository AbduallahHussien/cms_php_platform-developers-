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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ArticleController extends BaseController
{
    // public function __construct()
    // {
    //     $this
    //         ->breadcrumb()
    //         ->add(trans(trans('plugins/documentation::article.name')), route('documentation.articles.index'));
    // }

    private function setArticleBreadcrumb($documentation_id)
    {
        $this->breadcrumb()
            ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'))
            ->add(trans('plugins/documentation::article.name'),route('documentation.articles.index', ['documentation_id' => $documentation_id])
        );
    }

    public function index($documentation_id,ArticleTable $table) 
    { 
        $this->breadcrumb()
        ->add(trans(trans('plugins/documentation::documentation.name')), route('documentation.index'));
        $this->pageTitle(trans('plugins/documentation::article.name'));
    
        $table->addHeaderAction(
            // New custom action
            CreateHeaderAction::make()->route('documentation.articles.create',['documentation_id'=> $documentation_id])  // Dynamically pass the row's ID
        );
        
        $table->queryUsing(function (Builder $query) use ($documentation_id){
            $query->select(['id','order', 'title', 'content', 'topic_id','created_at','user_id', 'status'])
                  ->where('documentation_id', $documentation_id);

        });

        return $table->renderTable();
    }

    public function create($documentation_id)
    { 
        $this->setArticleBreadcrumb($documentation_id);
        $this->pageTitle(trans('plugins/documentation::article.create')); 
        $article = new Article();
        $article->documentation_id = $documentation_id;
        $article->user_id = Auth::id();
        $maxOrder = Article::max('order') ?? 0;
        $article->order = $maxOrder + 1;
        return ArticleForm::createFromModel($article)->renderForm();
    }

    public function store(ArticleRequest $request)
    {   
        $article = new Article();
        $article->documentation_id = $request->documentation_id;
        $form = ArticleForm::createFromModel($article)->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.articles.index',['documentation_id' =>  $form->getModel()->documentation_id]))
            ->setNextUrl(route('documentation.articles.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Article $article)
    { 
        $this->setArticleBreadcrumb($article->documentation_id);
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => Str::limit($article->title, 8)]));

        return ArticleForm::createFromModel($article)->renderForm();
    }

    public function update(Article $article, ArticleRequest $request)
    {
        ArticleForm::createFromModel($article)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('documentation.articles.index',['documentation_id'=>$article->documentation_id]))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Article $article)
    {
        return DeleteResourceAction::make($article);
    }

    public function updateOrder(Request $request)
    {
        // return response()->json(['success' => true]);
        $item = Article::findOrFail($request->id);
        $item->order = $request->order;
        $item->save();

        return response()->json(['success' => true]);
    }
    
}
