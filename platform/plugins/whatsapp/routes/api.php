<?php

use Botble\Whatsapp\Http\Controllers\WebhookController;
use Botble\Whatsapp\Models\WhatsappSetting;
use Illuminate\Support\Facades\Route;

Route::prefix('whatsapp-plugin/api')->group(function () { 
    Route::post('/ultramsg-webhook', [WebhookController::class, 'handleWebhook']);
});

Route::get('ts', function () {
    $database = app('whatsapp.firebase.database');
    // $database = $firebase->createDatabase();
    $snapshot = $database
    ->getReference('whatsapp_chat')
    ->orderByChild('msg_id')
    ->equalTo('false_963938056303@c.us_3EB0DBED33483CBADCEFD5')
    ->getSnapshot();

$records = $snapshot->getValue(); 
if (!$records) {
    return 'No record found for this msg_id';
}

// Step 2: Loop through found records (could be more than one)
foreach ($records as $pushId => $data) {
    // Step 3: Update media key
    $database->getReference("whatsapp_chat/{$pushId}/media")
        ->set('https://new-link-to-your-media.com/image.jpeg');
}

return 'Media updated successfully';

});
