<?php

namespace Botble\Documentation\Http\Controllers\Site;
 
use Botble\Base\Http\Controllers\BaseController;
use Botble\Documentation\Models\Article;

class ArticleController extends BaseController
{
    public function show($article_id)
    {
        // Retrieve the article by ID
        $article = Article::findOrFail($article_id);

        // Return the article content in a JSON format
        return response()->json([
            'content' => $article->content,  // Assuming 'content' is the field containing the article body
        ]);
    }
}