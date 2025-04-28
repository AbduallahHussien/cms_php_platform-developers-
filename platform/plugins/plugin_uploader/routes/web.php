<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;
use Botble\PluginUploader\Http\Controllers\UploaderController;

Route::group(['namespace' => 'Botble\PluginUploader\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'plugin_uploaders', 'as' => 'plugin_uploader.'], function () {
            Route::resource('', 'PluginUploaderController')->parameters(['' => 'plugin_uploader']);
        });
    });

    Route::get('upload-plugin',[UploaderController::class,'index'])->name('home');
    Route::post('upload-file',[UploaderController::class,'upload'])->name('file.upload');
    /////////////////////////
});
