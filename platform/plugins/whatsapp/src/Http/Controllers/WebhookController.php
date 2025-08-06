<?php

namespace Botble\Whatsapp\Http\Controllers;

use Botble\Whatsapp\Events\WhatsappNotificationEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Throwable;
class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        try {
            // info($request->all());
            event(new WhatsappNotificationEvent($request->all()));

            return response()->json(['status' => 'Webhook received and event fired']);
        } catch (Throwable $e) {
            Log::error('Webhook processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
