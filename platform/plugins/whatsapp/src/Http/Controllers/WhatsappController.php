<?php

namespace Botble\Whatsapp\Http\Controllers;

use Assets;
use URL;
use File;
// use Auth;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Whatsapp\Http\Requests\WhatsappRequest;
use Botble\Whatsapp\Repositories\Interfaces\WhatsappInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Whatsapp\Tables\WhatsappTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Whatsapp\Forms\WhatsappForm;
use Botble\Base\Forms\FormBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Botble\Base\Facades\ACL;
use Botble\Whatsapp\Models\WhatsappSetting;
use Botble\Whatsapp\Http\Services\WhatsappService;
use Pusher\Pusher;
class WhatsappController extends BaseController
{
    /**
     * @var WhatsappInterface
     */
    protected $whatsappRepository;
    protected $whatsappService;

    /**
     * @param WhatsappInterface $whatsappRepository
     */
    public function __construct(WhatsappInterface $whatsappRepository,WhatsappService $whatsappService)
    {
        $this->whatsappRepository = $whatsappRepository;
        $this->whatsappService = $whatsappService;
    }

    /**
     * @param WhatsappTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    { 
        // $database = app('whatsapp.firebase.database');

        // // Write to Firebase
        // $database->getReference('notifications/test')
        //     ->set(['message' => 'Hello from Botble WhatsApp plugin']);

        page_title()->setTitle(trans('plugins/whatsapp::whatsapp.name'));
        
        Assets::addScriptsDirectly([
            'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js',
            'vendor/core/plugins/whatsapp/plugins/custom/bootstrap/js/bootstrap.bundle.js',
            'https://maps.googleapis.com/maps/api/js',
            // 'https://maps.google.com/maps/api/js?sensor=false',
            'vendor/core/plugins/whatsapp/plugins/waitme/waitMe.min.js',
            'vendor/core/plugins/whatsapp/plugins/noty/lib/noty.js',
            'vendor/core/plugins/whatsapp/plugins/vendor/js/notifications.js',
            'https://js.pusher.com/7.2/pusher.min.js',
            'vendor/core/plugins/whatsapp/plugins/custom/whatsapp/record.js',
            'vendor/core/plugins/whatsapp/js/app.js',
            'vendor/core/plugins/whatsapp/plugins/custom/whatsapp/scripts.js?v=100',
        ])
        ->addStylesDirectly([
            'vendor/core/plugins/whatsapp/plugins/vendor/fonts/boxicons.css',
            'vendor/core/plugins/whatsapp/plugins/vendor/css/core.css',
            'vendor/core/plugins/whatsapp/plugins/vendor/css/theme-default.css',
            'vendor/core/plugins/whatsapp/plugins/custom/whatsapp/style.css',    
            'vendor/core/plugins/whatsapp/plugins/noty/lib/noty.css',
            'vendor/core/plugins/whatsapp/plugins/noty/lib/themes/mint.css',
            'vendor/core/plugins/whatsapp/plugins/waitme/waitMe.min.css',
            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',


        ]);
        $sett = whatsapp_settings();
        if($sett &&$sett !=''){
                $params=array(
                    'token' => $sett[0]->ultramsg_whatsapp_token
                    );
                    $curl = curl_init();
            
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.ultramsg.com/".$sett[0]->ultramsg_whatsapp_instance_id."/instance/me?" .http_build_query($params),
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
                $user = json_decode($response, TRUE);
               
                return view('plugins/whatsapp::index',compact('user'));
        }else{
            $user = array(
                'id'=>'',
                'profile_picture'=>''
            );

            return view('plugins/whatsapp::index',compact('user'));
        }

        
    }
    //Send Image 
    public function send_image(Request $request) 
    {
        info('img request');
        info($request->all());
        $path = $request->path;
        $to = $request->to; 
        $referenceId = $request->referenceId;
        $img_base64 = urlencode($path);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/$instance/messages/image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "token=$token&to=$to&image=$img_base64&caption=image&referenceId=$referenceId&nocache=",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
    //End Send Image 
    
    //send voice 
    public function send_voice(Request $request){
        $sett = whatsapp_settings();

        if(isset($_FILES['file']) and !$_FILES['file']['error']){
            $referenceId = Auth::id();
            $chat_id = $request->chat_id;
            $fname = rand(1,10000000000000000)."-".date("Y-m-d").".mp3";
            move_uploaded_file($_FILES['file']['tmp_name'], "record".$fname);
            $file_path = "record".$fname;
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/".$sett[0]->ultramsg_whatsapp_instance_id."/messages/audio",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "token=".$sett[0]->ultramsg_whatsapp_token."&to=$chat_id&audio=".URL::to('/')."/".$file_path."&referenceId=$referenceId&nocache=",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
           
            File::delete($file_path);
            return  $response  ;
            
        }

            //End Send voice
            
    }
    //End Send voice

    // Send Audio
    public function send_audio(Request $request){
        $sett = whatsapp_settings();
        $path = $request->path;
        $to = $request->to;
        $referenceId = Auth::id();

            $img_base64 = urlencode($path);
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/".$sett[0]->ultramsg_whatsapp_instance_id."/messages/audio",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "token=".$sett[0]->ultramsg_whatsapp_token."&to=$to&audio=$img_base64&referenceId=$referenceId&nocache=",
                CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return $response;
            }
    }
    // End Send Audio

    // Get Chat 
    public function get_chat(Request $request)
    {
        $chat_id = $request->chat_id;
        $instance_id = $request->instance;
        // $res = DB::select("select msg.* from ( SELECT * from whatsapp_chat where msg_id like '%".$chat_id."%' and chat_id =".$instance_id." order by time DESC LIMIT 100 ) msg order by msg.time ASC ");  
        // info($res);
        // return $res;
       
        //////////////////////////////////////////////////////////////////////////////////////////
        $messages = DB::table('whatsapp_chat')
        ->where('chat_id', $instance_id)
        ->where('msg_id', 'like', '%' . $chat_id . '%')
        ->orderByDesc('time')
        ->limit(100)
        ->get()
        ->sortBy('time')
        ->values()
        ->all();  // convert Collection to plain array of stdClass objects
        return $messages;
    // info($messages);
    

        /////////////////////////////////////////////////////////////////////////////////////////
        // $database = app('whatsapp.firebase.database'); 
        // $instanceId = $request->instance;
        // $chatId = $request->chat_id;
        // // info($chatId);
        // $reference = $database->getReference('whatsapp_chat');
        
        // // This pulls ALL matching chat_id, since Firebase doesn't allow complex filters (e.g. LIKE + AND)
        // $snapshot = $reference
        //     ->orderByChild('chat_id')
        //     ->equalTo((int)$instanceId)
        //     ->limitToLast(200) // We fetch more to allow for LIKE filtering
        //     ->getSnapshot();

        //     // info($snapshot);
        // $results = [];
        // foreach ($snapshot->getValue() as $record) {
        //     if (strpos($record['msg_id'], $chatId) !== false) {
        //         $results[] = $record;
        //     }
        // }

        // // Sort ascending by time
        // usort($results, fn($a, $b) => $a['time'] <=> $b['time']);

        // // Return latest 100
        // $results = array_slice($results, -100);
        // info(response()->json($results));
    }
    public function reports(){
        return view('plugins/whatsapp::reports');
    }
    // End Get Chat

    //view more
    public function ViewMore(Request $request) {
        $chat_id = $request->chat_id;
        $instance = $request->instance;
        $length = $request->length;
        return DB::select("select msg.* from ( SELECT * from whatsapp_chat where msg_id like '%".$chat_id."%' and chat_id =".$instance." order by time DESC LIMIT $length,100 ) msg order by msg.time ASC ");
    }
    // End view more

    // Get Conversation Type
    public function get_conversation_type(Request $request){
        $chat_id = $request->chat_id;
        return DB::select("select type from whatsapp_conversations_type where id='".$chat_id."' ");
    }
    // End Get Conversation Type

    // Set Conversation Type
    public function set_conversation_type(Request $request){
        $chat_id = $request->chat_id;
        $action = $request->action;
        $title =  $request->title;
        $img = $request->img;
        
        $query = DB::select("select type from whatsapp_conversations_type where id='".$chat_id."' ");
        if($query && $query!='') {

            DB::table('whatsapp_conversations_type')
            ->where('id',$chat_id)
            ->update([
                'type'  => $action,
                'img'   => $img ,
                'title' => $title
            ]);

        }else{

            DB::table('whatsapp_conversations_type')->insert([
                'id'    => "'$chat_id'",
                'type'  => "'$action'",
                'img'   => "'$img'",
                'title' => "'$title'"
            ]);

        }
    }
    // End  Set Conversation Type

    public function GetConByType (Request $request){
        $type = $request->type;
        return DB::select("select * from conversations_type where type='".$type."' ");
    }

    public function contacts(){ 
        if (!Auth::user()->hasPermission('contacts.index')) {
            abort(403, 'Unauthorized action.');
        }
        return view('plugins/whatsapp::contacts');
    }
    public function broadcast(){
        return view('plugins/whatsapp::broadcast');
    }
    
    //GET ALL TEMPLATES
    public function get_templates(){
        return DB::select("SELECT * from whatsapp_templates");
    }
    //END GET ALL TEMPLATES
    // GET TEMPLATE BY ID
    public function GetTemplateById(Request $request){
        $id =  $request->id;
        return DB::select("SELECT * from whatsapp_templates where id = $id ");
    }
    // END GET TEMPLATE BY ID
    //EDIT TEMPLATE
    public function EditTemplate(Request $request){
        $id = $request->id;
        $name =  $request->title;
        $file = $request->file;
        $file_type = $request->file_type;
        $message = $request->message;
       
        return DB::table('whatsapp_templates')
        ->where('id',$id)
        ->update([
            'title'    => $name,
            'file'     => ($file!='')?$file:'' ,
            'fileType' => ($file_type!='')?$file_type:'' ,
            'message'  => ($message!='')?$message:'' 
        ]);

    }
    //END EDIT TEMPLATE

    //DELETE TEMPLATE
    public function DeleteTemplate(Request $request){

        $id = $request->id;
        return DB::table('whatsapp_templates')->where('id', '=', $id)->delete();
        
    }
    //DELETE TEMPLATE
    
    //ADD Broadcast
    public function addBroadcast(Request $request){

        $name = $request->name;
        $recipients = $request->recipients;
        return DB::table('whatsapp_broadcast')->insert([
            'name'    => $name,
            'recipients'  => $recipients,
        ]);

    }
    //End ADD Broadcast

    // edit Broadcast
    public function editBroadcast(Request $request){
        $id = $request->id;
        $name = $request->name;
        $recipients = $request->recipients;
        return DB::table('whatsapp_broadcast')
        ->where('id',$id)
        ->update([
            'name' => $name ,
            'recipients' => $recipients 
        ]);
    }
    //end edit Broadcast

    //GET ALL GROUPS
    public function get_Groups(){
        return DB::select("SELECT * from whatsapp_broadcast");
    }
    //END GET ALL GROUPS

    //DELETE GROUP
    public function DeleteGroup(Request $request){
        $id = $request->id;
        DB::table('whatsapp_broadcast')->where('id', $id)->delete();
    }
    //END DELETE GROUP

    // GET GROUP
    public function getGroup(Request $request){
        $id = $request->id;
        return DB::select("SELECT * from whatsapp_broadcast where id = $id");
    }
    //END GET GROUP

    // GET REPORTS
    public function getReports(){
        return DB::select("SELECT whatsapp_reports.*,whatsapp_broadcast.name as 'GroupName' , whatsapp_templates.title as 'templateName' FROM `whatsapp_reports` left JOIN whatsapp_broadcast on whatsapp_reports.broadcast_id = whatsapp_broadcast.id left JOIN whatsapp_templates on whatsapp_reports.template_id = whatsapp_templates.id");
    }
    //END GET REPORTS

    // GET REPORT
    public function getReport(Request $request){
        $id = $request->id;
        return DB::select(" SELECT whatsapp_reports.*, whatsapp_broadcast.name as 'GroupName' , whatsapp_templates.title as 'templateName' FROM `whatsapp_reports` left JOIN whatsapp_broadcast on whatsapp_reports.broadcast_id = whatsapp_broadcast.id left JOIN whatsapp_templates on whatsapp_reports.template_id = whatsapp_templates.id where whatsapp_reports.id=$id ");
    }
    // GET REPORT

    //GET CONTACTS
    public function get_contacts()
    {
        if (!Auth::user()->hasPermission('contacts.index')) {
            abort(403, 'Unauthorized action.');
        }
        return DB::select(" SELECT * from whatsapp_contacts");
    }
    //END GET CONTACTS

     //GET CONTACT
     public function get_contact(Request $request){
        $id = $request->id;
        return DB::select("SELECT * from whatsapp_contacts where id = $id ");
    }
    //END GET CONTACT

    //EDIT CONTACT
    public function edit_contact(Request $request){

        $id = $request->id;
        $name = $request->name;
        $channel = $request->channel;
        $email = $request->email;
        $phone = $request->phone;
        $tags = $request->tags;
        $country = $request->country;
        $language = $request->language;
        $conversation_status = $request->conversation_status;
        $assignee = $request->assignee;

        return DB::table('whatsapp_contacts')
        ->where('id',$id)
        ->update([
            'name' => $name ,
            'channel' => $channel ,
            'email' => $email ,
            'phone' => $phone ,
            'tags' => $tags ,
            'country' => $country ,
            'language' => $language ,
            'conversation_status' => $conversation_status ,
            'assignee' => $assignee ,
            
        ]);

    }
    //END EDIT CONTACT

    //DELETE CONTACT
    public function delete_contact(Request $request){
        $id = $request->id;
        DB::table('whatsapp_contacts')->where('id', $id)->delete();
    }
    //END DELETE CONTACT

    public function AddTemplate(Request $request){

        $name = $request->title;
        $file = $request->file;
        $file_type = $request->file_type;
        $message = $request->message;

        return DB::table('whatsapp_templates')->insert([
            'title' => $name,
            'file' => ($file!='')?$file:'',
            'fileType' => ($file_type!='')?$file_type:'',
            'message' => $message
        ]);
    }

    public function AddQuickReply(Request $request){
        $message = $request->message;
        return DB::table('whatsapp_quick-replies')->insert([
            'message' => $message
        ]);
    }



    public function save_settings(Request $request)
    {
        abort_unless(Auth::user()->hasPermission('whatsapp.settings'), 403, 'Unauthorized action.');

        $token = $request->input('tkn_id');
        $instanceId = $request->input('instance_id'); 

        $res_save_settings = $this->whatsappService->save_settings($token,$instanceId);

        if ($res_save_settings['code'] == 0) {
            return response()->json([
                'message' => $res_save_settings['msg'] ?? 'Something went wrong.',
            ], 500);
        }
        
        return response()->json([
            'message' => 'Settings saved successfully.',
        ]);
         
    }

    // SEND GROUP MESSAGE
    public function SendGroupMessage(Request $request){
        // GET VALUES
            $groupIds = $request->groupsIds;
            $message = $request->message;
            $token = $request->token;
            $instance = $request->instance;
            $referenceId = $request->referenceId;
            $file = $request->file;
            $fileType = $request->fileType;
        //END  GET VALUES

 

            //LOOP FOR GROUPS
            foreach($groupIds as $groupId){
                //SELECT BROADCAST BY ID
                $broadcast = DB::select(" SELECT * from whatsapp_broadcast where id = $groupId ");
                //END SELECT BROADCAST BY ID

                //SPLIT BY SPACE
                $SplitBySpaces = explode("\n", $broadcast[0]->recipients);
                //END SPLIT BY SPACE
                $SplitByComma=[];

                //LOOP AFTER SPLITER AND SPLIT BY COMMA
                    foreach($SplitBySpaces as  $SplitBySpace){   
                        $SplitByComma[] = explode(",", $SplitBySpace);
                    }
                //END LOOP AFTER SPLITER AND SPLIT BY COMMA

                //LOOP TO SEND MESSAGES 
                foreach($SplitByComma as  $single){
                    # $single[1] => NAME 

                    //CHECK IF NUMERIC AFTER SEND 

                    if( array_key_exists('0', $single)&& is_numeric($single[0])){
                     
                        //CHECK IF AUDIO OR MESSAGE ONLY 
                        if($fileType == 'audio'){
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://api.ultramsg.com/$instance/messages/audio",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 30,
                              CURLOPT_SSL_VERIFYHOST => 0,
                              CURLOPT_SSL_VERIFYPEER => 0,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => "token=$token&to=".$single[0]."@c.us&audio=https://file-example.s3-accelerate.amazonaws.com/audio/2.mp3&referenceId=$referenceId&nocache=",
                              CURLOPT_HTTPHEADER => array(
                                "content-type: application/x-www-form-urlencoded"
                              ),
                            ));
                            
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            
                            curl_close($curl);
                            
                        }

                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.ultramsg.com/$instance/messages/chat",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_SSL_VERIFYHOST => 0,
                            CURLOPT_SSL_VERIFYPEER => 0,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "token=$token&to=".$single[0]."@c.us&body=".$message."&priority=10&referenceId=$referenceId",
                            CURLOPT_HTTPHEADER => array(
                                "content-type: application/x-www-form-urlencoded"
                            ),
                            ));
                            
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                           

                            curl_close($curl);
                            if ($err) {
                                echo "cURL Error #:" . $err;
                            } else {
                            echo $response;
                            }
                        
                     
                    }
                    //END CHECK IF NUMERIC AFTER SEND 
                }
                //END LOOP TO SEND MESSAGES 

            }
            //END LOOP FOR GROUPS
           // echo json_encode('success', JSON_UNESCAPED_UNICODE);
    }

    public function SendGroupsTempltes(Request $request){

        // GET VALUES
        $groupIds =$request->groupsIds;
        $templatesIds = $request->templatesIds;
        $to = $request->to;
        $from = $request->from;
        $token = $request->token;
        $instance = $request->instance;
        $referenceId = $request->referenceId;
        //END  GET VALUES
        
        //LOOP FOR TEMPLATES
        foreach($templatesIds as $TempId){
            //SELECT TEMPLATES BY ID
            $TEMP =  DB::select(" SELECT * from whatsapp_templates where id = $TempId");
            //END SELECT TEMPLATES BY ID

            //LOOP FOR GROUPS
            foreach($groupIds as $groupId){
                $counter = 0;
                $success = 0;
                $fails = 0;  

                $broadcast = DB::select("SELECT * from whatsapp_broadcast where id = $groupId");
                //END SELECT BROADCAST BY ID
                //SPLIT BY SPACE
                $SplitBySpaces = explode("\n", $broadcast[0]->recipients);
                //END SPLIT BY SPACE
                $SplitByComma=[];

                //LOOP AFTER SPLITER AND SPLIT BY COMMA
                    foreach($SplitBySpaces as  $SplitBySpace){   
                        $SplitByComma[] = explode(",", $SplitBySpace);
                    }
                //END LOOP AFTER SPLITER AND SPLIT BY COMMA

                //LOOP TO SEND MESSAGES 
                foreach($SplitByComma as  $single){
                   
                    
                    # $single[0] => NAME 

                    //CHECK IF NUMERIC AFTER SEND 

                    if( array_key_exists('0', $single)&& is_numeric($single[0])){
                        $counter++;
                        //CHECK IF AUDIO OR MESSAGE ONLY 
                        if($TEMP[0]->fileType == 'audio'){
                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://api.ultramsg.com/$instance/messages/audio",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 30,
                              CURLOPT_SSL_VERIFYHOST => 0,
                              CURLOPT_SSL_VERIFYPEER => 0,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS => "token=$token&to=".$single[0]."@c.us&audio=https://file-example.s3-accelerate.amazonaws.com/audio/2.mp3&referenceId=$referenceId&nocache=",
                              CURLOPT_HTTPHEADER => array(
                                "content-type: application/x-www-form-urlencoded"
                              ),
                            ));
                                 
                            
                           
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            curl_close($curl);
                            if ($err) {
                                $fails++;
                               
                            } else {
                            echo $response;
                            $success++;
                            }
                        }

                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.ultramsg.com/$instance/messages/chat",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_SSL_VERIFYHOST => 0,
                            CURLOPT_SSL_VERIFYPEER => 0,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => "token=$token&to=".$single[0]."@c.us&body=".$TEMP[0]->message."&priority=10&referenceId=$referenceId",
                            CURLOPT_HTTPHEADER => array(
                                "content-type: application/x-www-form-urlencoded"
                            ),
                            ));
                            
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            curl_close($curl);
                            if ($err) {
                                $fails++;
                               
                            } else {
                            echo $response;
                                $success++;
                            }
                        
                     
                    }
                    //END CHECK IF NUMERIC AFTER SEND 
                }
                //END LOOP TO SEND MESSAGES 
                
                DB::table('whatsapp_reports')->insert([
                    'broadcast_id' => $groupId,
                    'name'=>$broadcast[0]->name,
                    'message' => $TEMP[0]->message,
                    'template_id'=>$TempId,
                    'count' => $counter,
                    'date'=>date("Y/m/d")   
                ]);
            }
            //END LOOP FOR GROUPS
        }   
        //END GET LOOP FOR TEMPLATES
       return true;
    }

    // pusher event
    public function msg_received(Request $request) {


               return  whatsapp_insert_chat(

                $request->data['instanceId'],
                $request->data['event_type'],
                $request->data['referenceId'],
                $request->data['id'],
                $request->data['from'],
                $request->data['to'],
                $request->data['author'],
                $request->data['pushname'],
                $request->data['ack'],
                $request->data['type'],
                $request->data['body'],
                $request->data['media'],
                $request->data['fromMe'],
                $request->data['self'],
                $request->data['isForwarded'],
                $request->data['time'],
                $request->data['address'],
                $request->data['latitude'],
                $request->data['longitude']
                );
            
    }
    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/whatsapp::whatsapp.create'));

        return $formBuilder->create(WhatsappForm::class)->renderForm();
    }

    /**
     * @param WhatsappRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(WhatsappRequest $request, BaseHttpResponse $response)
    {
        $whatsapp = $this->whatsappRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(whatsapp_MODULE_SCREEN_NAME, $request, $whatsapp));

        return $response
            ->setPreviousUrl(route('whatsapp.index'))
            ->setNextUrl(route('whatsapp.edit', $whatsapp->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $whatsapp = $this->whatsappRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $whatsapp));

        page_title()->setTitle(trans('plugins/whatsapp::whatsapp.edit') . ' "' . $whatsapp->name . '"');

        return $formBuilder->create(WhatsappForm::class, ['model' => $whatsapp])->renderForm();
    }

    /**
     * @param int $id
     * @param WhatsappRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, WhatsappRequest $request, BaseHttpResponse $response)
    {
        $whatsapp = $this->whatsappRepository->findOrFail($id);

        $whatsapp->fill($request->input());

        $whatsapp = $this->whatsappRepository->createOrUpdate($whatsapp);

        event(new UpdatedContentEvent(WHATSAPP_MODULE_SCREEN_NAME, $request, $whatsapp));

        return $response
            ->setPreviousUrl(route('whatsapp.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $whatsapp = $this->whatsappRepository->findOrFail($id);

            $this->whatsappRepository->delete($whatsapp);

            event(new DeletedContentEvent(WHATSAPP_MODULE_SCREEN_NAME, $request, $whatsapp));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $whatsapp = $this->whatsappRepository->findOrFail($id);
            $this->whatsappRepository->delete($whatsapp);
            event(new DeletedContentEvent(WHATSAPP_MODULE_SCREEN_NAME, $request, $whatsapp));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
