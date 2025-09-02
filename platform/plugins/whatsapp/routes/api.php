<?php

use Botble\Whatsapp\Http\Controllers\WebhookController;
use Botble\Whatsapp\Models\WhatsappSetting;
use Illuminate\Support\Facades\Route;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Http;

Route::prefix('whatsapp-plugin/api')->group(function () { 
    Route::post('/ultramsg-webhook', [WebhookController::class, 'handleWebhook']);
});



Route::get('test-wh',function(){
    $slugify = new Slugify();
    echo $slugify->slugify('Hello World!'); // hello-world
});

Route::get('tmpo',function(){
    // dd(getCountryByPhone('963938056303'));
    $sett = whatsapp_settings();
    $response = Http::get("https://api.ultramsg.com/{$sett[0]->ultramsg_whatsapp_instance_id}/contacts/contact", [
        'token' => $sett[0]->ultramsg_whatsapp_token,
        'chatId' => '963938056303@c.us',
    ]);
    dd($response->json());
});
// Route::get('/test-ffmpeg', function() {
//     $output = shell_exec('ffmpeg -version 2>&1');
//     dd($output);
// });
     
