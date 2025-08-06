<?php  
namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Kreait\Firebase\Database;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationEvent
{
    use Dispatchable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;

        try {
            // ✅ Get Firebase database instance
            $database = app('whatsapp.firebase.database');

            // ✅ Write the event data into Firebase
            $database
                ->getReference('whatsapp_chat')
                ->push($data);

        } catch (Throwable $e) {
            Log::error('Firebase write error', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
        }
    }
}
