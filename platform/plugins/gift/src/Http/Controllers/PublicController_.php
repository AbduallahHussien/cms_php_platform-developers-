<?php

namespace Botble\Gift\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Gift\Events\SentGiftEvent;
use Botble\Gift\Forms\Fronts\GiftForm;
use Botble\Gift\Http\Requests\GiftRequest;
use Illuminate\Http\Request;
use Botble\Gift\Models\Gift;
use Botble\Gift\Models\Cert;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Botble\Media\Facades\RvMedia;
use Intervention\Image\ImageManager;
use Storage;
use File;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Interfaces\FontInterface;
use Intervention\Image\Typography\FontFactory;

if (!class_exists('Glyphs')) {
  require_once app_path('Helpers/Arabic/Arabic/Glyphs.php');
}
use I18N_Arabic_Glyphs;


class PublicController extends BaseController
{
    public function postSendGift(Request $request)
    {
      
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $cert = Cert::find($request->messageTemplate);
        $image = Storage::path($cert->image);
        if (!File::exists(public_path('c'))) {
            File::makeDirectory(public_path('c'), 0777, true, true);
        }
        $imageData = @file_get_contents($image); // Try to read the image
        
        if (!$imageData) {
            return response()->json(['error' => 'Image URL is not accessible']);
        }

        $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 2); // Generate 2 random letters
        $numbers = rand(10000, 99999); // Generate 5 random numbers
        $imageName = $letters . $numbers . '.jpg'; // Combine them into a filename
        
        $img = $manager->read($imageData)
      
        ->text($this->arabic_text(' '.$request->recipientName), $cert->to_x, $cert->to_y, function (FontFactory $font) use ($cert) {
            $font->filename(core_path('base/public/fonts/Droid_Arabic_Naskh_Bold.ttf')); // Correct Font Path
            $font->size($cert->font_size);
            $font->color($cert->font_color);
            $font->align('center');

  
        })
        ->text($this->arabic_text(' '.$request->donorName),$cert->from_x, $cert->from_y, function (FontFactory $font)  use ($cert) {
            $font->filename(core_path('base/public/fonts/Droid_Arabic_Naskh_Bold.ttf'));
            $font->size($cert->font_size);
            $font->color($cert->font_color);
            $font->align('center');
           
        })
        ->save(public_path('c/' . $imageName));
      
        
        
  
        $gift = Gift::create([
            'project-name'     => $request->projectName,
            'email'           => $request->email,
            'donor-name'      => $request->donorName,
            'donor-phone'     => $request->donorPhone,
            'recipient-name'  => $request->recipientName,
            'recipient-phone' => $request->recipientPhone,
            'template-name'   =>  $cert->name,
            'cert_id'   =>  $request->messageTemplate,
        ]);
 
        $variables = [
            '{donor_name}' => '*'.$request->donorName.'*',
            '{recipient_name}'  => '*'.$request->recipientName.'*'
        ];
      
        $donor_message = str_replace(array_keys($variables), array_values($variables), setting('donor_message'));
        $recipient_message = str_replace(array_keys($variables), array_values($variables), setting('recipient_message'));
       
        $this->sendImageWhatsapp($request->donorPhone,asset('c/' . $imageName),$gift->id,$donor_message);  
        $this->sendImageWhatsapp($request->recipientPhone,asset('c/' . $imageName),$gift->id,$recipient_message);  
    }
   public function sendImageWhatsapp($to,$link,$id,$message){
   
      $params = array(
        'token' => setting('ultra_message_token'),
        'to'    => $to,
        'body'  => $message . "\n" . $link
    );
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/".setting('ultra_message_instance')."/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
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
          Gift::where('id', $id)->update([
            'delivered'     => true
          ]);
      
      }
    }
    function arabic_text($text)
    {
        $Arabic = new \I18N_Arabic_Glyphs;
        return $Arabic->utf8Glyphs($text);
    }



   }
