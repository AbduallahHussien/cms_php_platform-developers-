<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
 


if (! function_exists('whatsapp_settings')) {
    function whatsapp_settings()
    {
        return DB::select("SELECT * from whatsapp_settings");
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

 
 

if (!function_exists('getCountryByPhone')) {
    /**
     * Get country name by phone number
     *
     * @param string $phone
     * @return string|null
     */
    function getCountryByPhone(string $phone): ?string
    {
        // Remove all non-numeric characters (spaces, +, etc.)
        $digits = preg_replace('/\D+/', '', $phone);

        // Mapping of country codes to country names (you can expand this)
        $arabicCountryCodes = [
            '213' => 'Algeria',
            '973' => 'Bahrain',
            '269' => 'Comoros',
            '253' => 'Djibouti',
            '20'  => 'Egypt',
            '964' => 'Iraq',
            '962' => 'Jordan',
            '965' => 'Kuwait',
            '961' => 'Lebanon',
            '218' => 'Libya',
            '222' => 'Mauritania',
            '212' => 'Morocco',
            '968' => 'Oman',
            '970' => 'Palestine',
            '974' => 'Qatar',
            '966' => 'Saudi Arabia',
            '252' => 'Somalia',
            '249' => 'Sudan',
            '963' => 'Syria',
            '216' => 'Tunisia',
            '971' => 'United Arab Emirates',
            '967' => 'Yemen',
        ];

        // Check from longest code to shortest
        foreach ($arabicCountryCodes as $code => $country) {
            if (strpos($digits, $code) === 0) {
                return $country;
            }
        }

        return null; // country not found
    }
}


if (! function_exists('whatsapp_insert_chat')) {
  
    function whatsapp_insert_chat(
        $instanceId, $event_type, $referenceId, $msg_id, $from, $to, $author,
        $pushname, $ack, $type, $body, $media, $fromMe, $self, $isForwarded,
        $time, $lo_address, $lo_latitude, $lo_longitude
    ) {
        try {

            $settings = whatsapp_settings()[0] ?? null;
            if (!$settings) {
                throw new Exception('WhatsApp settings not found');
            }

            // info('056303');
            // ✅ Determine contact ID
            $chatId = $event_type === 'message_received' ? $from : $to;

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
 

            $imageResponse = Http::get("https://api.ultramsg.com/{$settings->ultramsg_whatsapp_instance_id}/contacts/image", [
                'token' => $settings->ultramsg_whatsapp_token,
                'chatId' =>$chatId,
            ]);

            $imageData = $imageResponse->json(); 
            $displayImage = $imageData['success'] ?? 'https://i.pravatar.cc/300'; 

            $contactRef = $database->getReference('whatsapp_contacts');

            
            $response_contact_info = Http::get("https://api.ultramsg.com/{$settings->ultramsg_whatsapp_instance_id}/contacts/contact", [
                'token' => $settings->ultramsg_whatsapp_token,
                'chatId' => $chatId,
            ]);
                
            $contactData = $response_contact_info->json();
            $contactName = $pushname ?: $contactData['pushname'];
            $receiverPhone = explode('@',$chatId)[0];

            $results = $contactRef->orderByChild('chatId')->equalTo($chatId)->getValue();
            info('a');
            if ($results && count($results) > 0) 
            { 
                info('b');
                // Only one child exists, get its key
                $childKey = array_key_first($results);
           
                // Update that specific child
                $contactRef->getChild($childKey)->update([
                    'last_message'        => $body ?? '',
                    'display'             => $displayImage,
                    'name'                => $contactName,
                    'last_updated'          => now()->timestamp, 
                    'channel'             => 'WhatsApp',
                    'email'               => '',
                    'phone'               => '00'.$receiverPhone,
                    'tags'                => '',
                    'country'             => getCountryByPhone($receiverPhone),
                    'language'            => '',
                    'assignee'            => '',
                    'whatsappId'          => $settings->whatsapp_id,
                ]);
            } 
            else 
            {
                info('c');
                $contactData = [
                    'chatId'              => $chatId,
                    'display'             => $displayImage,
                    'last_message'        => $body ?: '',
                    'name'                => $contactName,
                    'last_updated'        => now()->timestamp, 
                    'channel'             => 'WhatsApp',
                    'email'               => '',
                    'phone'               => '00'.$receiverPhone,
                    'tags'                => '',
                    'country'             => getCountryByPhone($receiverPhone),
                    'language'            => '',
                    'assignee'            => '',
                    'conversation_status' => 'open', 
                    'whatsappId'          => $settings->whatsapp_id,
                ]; 

                $contactRef->push($contactData);
            }
  
            return ['action' => 'done'];

        } catch (Throwable $e) {
            Log::error('Firebase RTDB error', [
                'error' => $e->getMessage(),
            ]);
            return ['action' => 'error'];
        }
    }
}
