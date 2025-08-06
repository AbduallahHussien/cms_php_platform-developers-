<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
// use Throwable;


if (! function_exists('whatsapp_settings')) {
    function whatsapp_settings()
    {
        return DB::select("SELECT * from whatsapp_setting");
    }
}
// if (! function_exists('whatsapp_insert_chat')) {
//     function whatsapp_insert_chat($instanceId,$event_type,$referenceId,$msg_id,$from,$to,$author,$pushname,$ack,$type,$body,$media,$fromMe,$self,$isForwarded,$time,$lo_address,$lo_latitude,$lo_longitude) {
//         if($event_type == 'message_received'){
//             $contact_id = $from;
//         }else{
//             $contact_id = $to;
//         }
//         $message = DB::select("SELECT * from whatsapp_chat where msg_id='".$msg_id."'");
//         if($message && $message !=''){
//             return array('action'=> 'same');
//         }else{
//             DB::table('whatsapp_chat')->insert([
//                 'msg_id'=>$msg_id,
//                 'chat_id' => $instanceId,
//                 'event_type'=>$event_type,
//                 'referenceId' => ($referenceId!='')?$referenceId:'',
//                 'from' =>$from,
//                 'to'=>$to, 
//                 'author' => ($author!='')?$author:'',
//                 'pushname'=>($pushname !='')? $pushname :'me',
//                 'ack' =>($ack!='')?$ack:'',
//                 'type'=>$type,
//                 'body' =>($body!='')?$body:'' ,
//                 'media'=>($media!='')?$media:'',  
//                 'fromMe'=>$fromMe, 
//                 'self'=>$self, 
//                 'isForwarded'=>$isForwarded, 
//                 'time'=>$time, 
//                 'lo_address'=>($lo_address!='')?$lo_address:'' , 
//                 'lo_latitude'=>($lo_latitude!='')?$lo_latitude:'', 
//                 'lo_longitude'=>($lo_longitude!='')?$lo_longitude:'', 
//             ]);
//             //check if contact exists
//             $contact = DB::select("SELECT * from whatsapp_contacts where id='".$contact_id."'");
//             //GET CONTACT DISPLAY 
//                 $sett = whatsapp_settings();
//                 $params=array(
//                 'token' => $sett[0]->ultramsg_whatsapp_token,
//                 'chatId' => $contact_id
//                 );
//                 $curl = curl_init();
                
//                 curl_setopt_array($curl, array(
//                   CURLOPT_URL => "https://api.ultramsg.com/".$sett[0]->ultramsg_whatsapp_instance_id."/contacts/image?" .http_build_query($params),
//                   CURLOPT_RETURNTRANSFER => true,
//                   CURLOPT_ENCODING => "",
//                   CURLOPT_MAXREDIRS => 10,
//                   CURLOPT_TIMEOUT => 30,
//                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                   CURLOPT_CUSTOMREQUEST => "GET",
//                   CURLOPT_HTTPHEADER => array(
//                     "content-type: application/x-www-form-urlencoded"
//                   ),
//                 ));
                
//                 $response = curl_exec($curl);
//                 $image = json_decode($response, TRUE);
                
//             //END GET 
//             if ($contact && $contact!='') {
//                     DB::table('whatsapp_contacts')
//                     ->where('id',$contact_id)
//                     ->update([
//                         'last_message'  =>$body,
//                         'display'=>$image['success'] ?? null
//                     ]);     
            
        
//             }else{
//                 DB::table('whatsapp_contacts')->insert([
//                 'id' => $contact_id,
//                 'display'=>$image['success'] ?? null,
//                 'last_message'=>($body!='')?$body:'' ,
//                 'name' => ($pushname !='')? $pushname :'me',
//                 'date_added'=> date('Y-m-d'),
//                 'conversation_status' =>"open",
//             ]);
        
//             }
//         } 
//         return array('action'=> 'done');
    
//     }
// }

 

if (! function_exists('whatsapp_insert_chat')) {
  
    function whatsapp_insert_chat(
        $instanceId, $event_type, $referenceId, $msg_id, $from, $to, $author,
        $pushname, $ack, $type, $body, $media, $fromMe, $self, $isForwarded,
        $time, $lo_address, $lo_latitude, $lo_longitude
    ) {
        try {
            // ✅ Determine contact ID
            $contact_id = $event_type === 'message_received' ? $from : $to;

            // ✅ Get Firebase database instance (must be bound in a service provider)
            $database = app('whatsapp.firebase.database');

            // ✅ Reference to chats
            $chatRef = $database->getReference('whatsapp_chat');

            // ✅ Check if message already exists in Firebase (prevent duplicates)
            // $existingMessages = $chatRef->orderByChild('msg_id')->equalTo($msg_id)->getValue();

            // if (!empty($existingMessages)) {
            //     return ['action' => 'same']; // ✅ message already exists
            // }

            // ✅ Prepare chat data
            $chatData = [
                'msg_id'        => $msg_id,
                'chat_id'       => $instanceId,
                'event_type'    => $event_type,
                'referenceId'   => $referenceId ?: '',
                'from'          => $from,
                'to'            => $to,
                'author'        => $author ?: '',
                'pushname'      => $pushname ?: 'me',
                'ack'           => $ack ?: '',
                'type'          => $type,
                'body'          => $body ?: '',
                'media'         => $media ?: '',
                'fromMe'        => $fromMe,
                'self'          => $self,
                'isForwarded'   => $isForwarded,
                'time'          => $time,
                'lo_address'    => $lo_address ?: '',
                'lo_latitude'   => $lo_latitude ?: '',
                'lo_longitude'  => $lo_longitude ?: '',
            ];

            // ✅ Push chat message into Firebase
            $chatRef->push($chatData);
            

            // ✅ Handle contact info in Firebase
            $sanitizedContactId = str_replace('.', '_', $contact_id);
            $contactRef = $database->getReference('whatsapp_contacts/' . $sanitizedContactId);


            // 🔄 Get contact image from UltraMsg
            $sett = whatsapp_settings();
            $response = Http::get("https://api.ultramsg.com/{$sett[0]->ultramsg_whatsapp_instance_id}/contacts/image", [
                'token' => $sett[0]->ultramsg_whatsapp_token,
                'chatId' => $contact_id,
            ]);

            $imageData = $response->json();

            $displayImage = null;
            if (!empty($imageData['image'])) {
                $displayImage = $imageData['image'];
            } else {
                // fallback placeholder image URL
                $displayImage = 'https://i.pravatar.cc/300';
            }
            

            // ✅ Update or insert contact in Firebase
            $contactSnapshot = $contactRef->getValue();

            if ($contactSnapshot) {
                $contactRef->update([
                    'last_message' => $body,
                    'display' => $displayImage,
                ]);
            } else {
                $contactRef->set([
                    'id'                => $contact_id,
                    'display'           => $displayImage,
                    'last_message'      => $body ?: '',
                    'name'              => $pushname ?: 'me',
                    'date_added'        => now()->format('Y-m-d'),
                    'conversation_status' => 'open',
                ]);
            }
            // info('done');
            return ['action' => 'done'];

        } catch (Throwable $e) {
            Log::error('Firebase RTDB error', [
                'error' => $e->getMessage(),
            ]);
            return ['action' => 'error'];
        }
    }
}
