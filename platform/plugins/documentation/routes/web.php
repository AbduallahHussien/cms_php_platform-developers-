<?php

use Illuminate\Support\Facades\Route;
use Botble\Base\Facades\AdminHelper;

Route::group(['namespace' => 'Botble\Documentation\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'documentations', 'as' => 'documentation.'], function () {
            Route::resource('', 'DocumentationController')->parameters(['' => 'documentation']);
        });
    });
});
