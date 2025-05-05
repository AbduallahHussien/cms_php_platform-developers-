<?php

Route::group(['namespace' => 'Botble\Whatsapp\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(),'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'whatsapp', 'as' => 'whatsapp.'], function () {
            Route::resource('', 'WhatsappController')->parameters(['' => 'whatsapp']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'WhatsappController@deletes',
                'permission' => 'whatsapp.destroy',
            ]);

            Route::get('whatsapp/get-templates', [
                'as'         => 'get.templates',
                'uses'       => 'WhatsappController@get_templates',
            ]);

            Route::get('whatsapp/get-groups', [
                'as'         => 'get.groups',
                'uses'       => 'WhatsappController@get_groups',
            ]);

            Route::post('whatsapp/delete-group', [
                'as'         => 'delete.group',
                'uses'       => 'WhatsappController@DeleteGroup',
            ]);

            Route::get('whatsapp/get-group', [
                'as'         => 'get.group',
                'uses'       => 'WhatsappController@getGroup',
            ]);

            Route::get('whatsapp/get-reports', [
                'as'         => 'get.reports',
                'uses'       => 'WhatsappController@getReports',
            ]);

            Route::get('whatsapp/get-report', [
                'as'         => 'get.report',
                'uses'       => 'WhatsappController@getReport',
            ]);

            Route::post('whatsapp/send-audio', [
                'as'         => 'send.audio',
                'uses'       => 'WhatsappController@send_audio',
            ]);

            Route::get('whatsapp/view-more', [
                'as'         => 'view.more',
                'uses'       => 'WhatsappController@ViewMore',
            ]);

            Route::post('whatsapp/send-voice', [
                'as'         => 'send.voice',
                'uses'       => 'WhatsappController@send_voice',
            ]);

            Route::post('whatsapp/send-image', [
                'as'         => 'send.image',
                'uses'       => 'WhatsappController@send_image',
            ]);

            Route::get('whatsapp/get-conversation-type', [
                'as'         => 'conversation.type',
                'uses'       => 'WhatsappController@get_conversation_type',
            ]);

            Route::post('whatsapp/set-conversation-type', [
                'as'         => 'set.conversation.type',
                'uses'       => 'WhatsappController@set_conversation_type',
            ]);

            Route::get('whatsapp/get-chat', [
                'as'         => 'get.chat',
                'uses'       => 'WhatsappController@get_chat',
            ]);

            Route::get('whatsapp/get-conByType', [
                'as'         => 'Get.conByType',
                'uses'       => 'WhatsappController@GetConByType',
            ]);

            Route::post('whatsapp/add-template', [
                'as'         => 'add.template',
                'uses'       => 'WhatsappController@AddTemplate',
            ]);

            Route::get('whatsapp/get-template', [
                'as'         => 'get.template',
                'uses'       => 'WhatsappController@GetTemplateById',
            ]);

            Route::post('whatsapp/edit-template', [
                'as'         => 'edit.template',
                'uses'       => 'WhatsappController@EditTemplate',
            ]);

            Route::post('whatsapp/delete-template', [
                'as'         => 'delete.template',
                'uses'       => 'WhatsappController@DeleteTemplate',
            ]);

            Route::post('whatsapp/add-QuickReply', [
                'as'         => 'add.QuickReply',
                'uses'       => 'WhatsappController@AddQuickReply',
            ]);

            Route::post('whatsapp/add-broadcast', [
                'as'         => 'add.broadcast',
                'uses'       => 'WhatsappController@addBroadcast',
            ]);

            Route::post('whatsapp/edit-broadcast', [
                'as'         => 'edit.broadcast',
                'uses'       => 'WhatsappController@editBroadcast',
            ]);

            Route::post('whatsapp/send-group-message', [
                'as'         => 'send.group.message',
                'uses'       => 'WhatsappController@SendGroupMessage',
            ]);

            Route::post('whatsapp/send-group-templtes', [
                'as'         => 'send.group.templtes',
                'uses'       => 'WhatsappController@SendGroupsTempltes',
            ]);

            Route::get('/contacts', [
                'as'         => 'contacts.index',
                'uses'       => 'WhatsappController@contacts',
                'permission' => 'contacts.index',
            ]);

            Route::get('whatsapp/broadcast', [
                'as'         => 'broadcast.index',
                'uses'       => 'WhatsappController@broadcast',
            ]);

            Route::get('whatsapp/get-contacts', [
                'as'         => 'get.contacts',
                'uses'       => 'WhatsappController@get_contacts',
                'permission' => 'contacts.index',
            ]);

            Route::get('whatsapp/get-contact', [
                'as'         => 'get.contact',
                'uses'       => 'WhatsappController@get_contact',
            ]);

            Route::post('whatsapp/edit-contact', [
                'as'         => 'edit.contact',
                'uses'       => 'WhatsappController@edit_contact',
            ]);

            Route::post('whatsapp/delete-contact', [
                'as'         => 'delete.contact',
                'uses'       => 'WhatsappController@delete_contact',
            ]);

            Route::post('whatsapp/save-settings', [
                'as'         => 'save.settings',
                'uses'       => 'WhatsappController@save_settings',
                'permission' => 'whatsapp.settings',
            ]);

            Route::post('whatsapp/listener', [
                'as'         => 'save.chat',
                'uses'       => 'WhatsappController@msg_received',
            ]);

           

           

            

            


            
            
            

            

            


            

        });
      
    });

});
