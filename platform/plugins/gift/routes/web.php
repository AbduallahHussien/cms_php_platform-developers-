<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\Gift\Http\Controllers'], function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'gifts', 'as' => 'gifts.'], function () {
            Route::resource('', 'GiftController')->except(['create', 'store'])->parameters(['' => 'gift']);
        
        });
        Route::group(['prefix' => 'certs', 'as' => 'certs.'], function () {
            Route::resource('', 'CertController')->parameters(['' => 'cert']);
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('gift', [
                'as' => 'gift.settings',
                'uses' => 'Settings\GiftSettingController@edit',
            ]);

            Route::put('gift', [
                'as' => 'gift.settings.update',
                'uses' => 'Settings\GiftSettingController@update',
                'permission' => 'gift.settings',
            ]);
        });
    });

    if (defined('THEME_MODULE_SCREEN_NAME')) {
        Theme::registerRoutes(function () {
            Route::post('gift/send', [
                'as' => 'public.send.gift',
                'uses' => 'PublicController@postSendGift',
            ]);
        });
    }
});
