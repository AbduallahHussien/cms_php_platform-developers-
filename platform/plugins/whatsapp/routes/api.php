<?php

use Botble\Whatsapp\Http\Controllers\WebhookController;
use Botble\Whatsapp\Models\WhatsappSetting;
use Illuminate\Support\Facades\Route;

Route::prefix('whatsapp-plugin/api')->group(function () { 
    Route::post('/ultramsg-webhook', [WebhookController::class, 'handleWebhook']);
});
 
// Route::get('/test-ffmpeg', function() {
//     $output = shell_exec('ffmpeg -version 2>&1');
//     dd($output);
// });
     
