<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper; 

use Botble\Documentation\Http\Controllers\TopicController;

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
   
        });

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
});
