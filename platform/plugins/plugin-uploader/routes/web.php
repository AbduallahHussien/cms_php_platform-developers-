<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;
use Botble\PluginUploader\Http\Controllers\PluginUploaderController;

Route::group(['namespace' => 'Botble\PluginUploader\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        // Route::group(['prefix' => 'plugin-uploaders', 'as' => 'plugin-uploader.'], function () {
        //     Route::resource('', 'PluginUploaderController')->parameters(['' => 'plugin-uploader']);
        // });

        Route::get('plugin-uploader',[PluginUploaderController::class,'index'])->name('plugin-uploader.index');
        Route::post('upload',[PluginUploaderController::class,'upload'])->name('plugin-uploader.upload-file');
    });
});
