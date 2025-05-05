<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Services\PayUService\Exception;

if (! function_exists('whatsapp_settings')) {
    function whatsapp_settings()
    {
        return DB::select("SELECT * from whatsapp_setting");
    }
}
if (! function_exists('whatsapp_insert_chat')) {
    function whatsapp_insert_chat($instanceId,$event_type,$referenceId,$msg_id,$from,$to,$author,$pushname,$ack,$type,$body,$media,$fromMe,$self,$isForwarded,$time,$lo_address,$lo_latitude,$lo_longitude) {
        if($event_type == 'message_received'){
            $contact_id = $from;
        }else{
            $contact_id = $to;
        }
        $message = DB::select("SELECT * from whatsapp_chat where msg_id='".$msg_id."'");
        if($message && $message !=''){
            return array('action'=> 'same');
        }else{
            DB::table('whatsapp_chat')->insert([
                'msg_id'=>$msg_id,
                'chat_id' => $instanceId,
                'event_type'=>$event_type,
                'referenceId' => ($referenceId!='')?$referenceId:'',
                'from' =>$from,
                'to'=>$to, 
                'author' => ($author!='')?$author:'',
                'pushname'=>($pushname !='')? $pushname :'me',
                'ack' =>($ack!='')?$ack:'',
                'type'=>$type,
                'body' =>($body!='')?$body:'' ,
                'media'=>($media!='')?$media:'',  
                'fromMe'=>$fromMe, 
                'self'=>$self, 
                'isForwarded'=>$isForwarded, 
                'time'=>$time, 
                'lo_address'=>($lo_address!='')?$lo_address:'' , 
                'lo_latitude'=>($lo_latitude!='')?$lo_latitude:'', 
                'lo_longitude'=>($lo_longitude!='')?$lo_longitude:'', 
            ]);
            //check if contact exists
            $contact = DB::select("SELECT * from whatsapp_contacts where id='".$contact_id."'");
            //GET CONTACT DISPLAY 
                $sett = whatsapp_settings();
                $params=array(
                'token' => $sett[0]->ultramsg_whatsapp_token,
                'chatId' => $contact_id
                );
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://api.ultramsg.com/".$sett[0]->ultramsg_whatsapp_instance_id."/contacts/image?" .http_build_query($params),
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                  ),
                ));
                
                $response = curl_exec($curl);
                $image = json_decode($response, TRUE);
            //END GET 
            if ($contact && $contact!='') {
                    DB::table('whatsapp_contacts')
                    ->where('id',$contact_id)
                    ->update([
                        'last_message'  =>$body,
                        'display'=>$image['success']
                    ]);     
            
        
            }else{
                DB::table('whatsapp_contacts')->insert([
                'id' => $contact_id,
                'display'=>$image['success'],
                'last_message'=>($body!='')?$body:'' ,
                'name' => ($pushname !='')? $pushname :'me',
                'date_added'=> date('Y-m-d'),
                'conversation_status' =>"open",
            ]);
        
            }
        } 
        return array('action'=> 'done');
    
    }
}