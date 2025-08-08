<?php 

use Botble\Whatsapp\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('whatsapp-plugin/api')->group(function () {
    Route::post('/ultramsg-webhook', [WebhookController::class, 'handleWebhook']);
});
