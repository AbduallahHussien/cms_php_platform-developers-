<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;
use Botble\Documentation\Http\Controllers\ArticleController;
use Botble\Documentation\Http\Controllers\Site\ArticleController as SiteArticleController;
use Botble\Documentation\Http\Controllers\TopicController;
use Botble\Theme\Facades\Theme;

Route::group(['namespace' => 'Botble\Documentation\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () 
    {
        Route::group(['prefix' => 'documentations', 'as' => 'documentation.'], function () {
            Route::resource('', 'DocumentationController')->parameters(['' => 'documentation']);
        });

        Route::group(['prefix' => 'documentations', 'as' => 'documentation.topics.'], function () {
            
            Route::get('/{documentation_id}/topics',[TopicController::class,'index'])->name('index'); 
            Route::post('/{documentation_id}/topics',[TopicController::class,'index'])->name('index'); 
            Route::get('/{documentation_id}/topics/create',[TopicController::class,'create'])->name('create');  
            Route::post('/{documentation_id}/topics/create',[TopicController::class,'store'])->name('store');  
            Route::get('/topics/edit/{topic}',[TopicController::class,'edit'])->name('edit'); 
            Route::post('/topics/edit/{topic}',[TopicController::class,'update'])->name('update'); 
            Route::delete('/topics/{topic}',[TopicController::class,'destroy'])->name('destroy');  
            Route::post('/topics/update-order', [TopicController::class, 'updateOrder'])->name('update_order');
        });

        Route::group(['prefix' => 'documentations', 'as' => 'documentation.articles.'], function () {
            Route::get('/{documentation_id}/articles',[ArticleController::class,'index'])->name('index'); 
            Route::post('/{documentation_id}/articles',[ArticleController::class,'index'])->name('index'); 
            Route::get('/{documentation_id}/articles/create',[ArticleController::class,'create'])->name('create');  
            Route::post('/{documentation_id}/articles/create',[ArticleController::class,'store'])->name('store');  
            Route::get('/articles/edit/{article}',[ArticleController::class,'edit'])->name('edit'); 
            Route::post('/articles/edit/{article}',[ArticleController::class,'update'])->name('update'); 
            Route::delete('/articles/{article}',[ArticleController::class,'destroy'])->name('destroy');
            Route::post('/articles/update-order', [ArticleController::class, 'updateOrder'])->name('update_order'); 
   
        });

        // Route::get('articles/{article}',[SiteArticleController::class,'show'])->name('articles.show');

        // Route::group(['prefix' => 'documentations/topics', 'as' => 'documentation.topics.'], function () {
        //     // Route::resource('', 'TopicController')->parameters(['' => 'topic']);
        //     // admin/documentations/topics .................................... topics.index
        //     // Route::get('/{documentation}',[TopicController::class,'index'])->name('index');
            
        //     // Route::get('/{documentation}', [
        //     //     'as' => 'index',
        //     //     'uses' => 'TopicController@index'
        //     // ]);
        //     // Route::get('/',[TopicController::class,'index'])->name('index');
        // });
    });
    Route::get('documentation/article/{article}', [SiteArticleController::class, 'show']);


    // if (defined('THEME_MODULE_SCREEN_NAME')) {
    //     Theme::registerRoutes(function () {
    //         Route::post('articles/{article}', [
    //             'as' => 'articles.show',
    //             'uses' => 'SiteArticleController@show',
    //         ]);
    //     });
    // }
});

