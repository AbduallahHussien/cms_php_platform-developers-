<?php

namespace App\Http\Controllers;
use App\Events\NotificationEvent;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
class Webhook extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            event(new NotificationEvent($request->all()));
            return response()->json(['status' => 'Webhook received and event fired']);
        } catch (\Throwable $e) {
            Log::error('Webhook processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            // dd($e->getMessage(), $e->getFile(), $e->getLine());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}