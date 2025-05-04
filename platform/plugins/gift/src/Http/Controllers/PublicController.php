<?php

namespace Botble\Gift\Http\Controllers;


use Botble\Base\Http\Controllers\BaseController;
use Botble\Gift\Events\SentGiftEvent;
use Botble\Gift\Forms\Fronts\GiftForm;
use Botble\Gift\Http\Requests\GiftRequest;
use Illuminate\Http\Request;
use Botble\Gift\Models\Gift;
use Botble\Gift\Models\Cert;
use Exception;
use Intervention\Image\ImageManager;
use I18N_Arabic_Glyphs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Typography\FontFactory;




class PublicController extends BaseController
{
  public function postSendGift(Request $request)
  {
    DB::beginTransaction();
    try {
      // Initialize ImageManager
      $manager = new ImageManager(new GdDriver());

      // Retrieve the certificate by ID
      $cert = Cert::findOrFail($request->messageTemplate);

      // Get the image path from the certificate
      $imagePath = Storage::path($cert->image);

      // Ensure the 'c' directory exists
      $this->ensureDirectoryExists(public_path('c'));

      
      // Check if the file does not exist at the given path
      if (!file_exists($imagePath)) {
          
        // If the file is missing, throw an exception with a custom error message
        throw new Exception('File does not exist');
      }

      // Read the contents of the file at the given path into a variable
      $imageData = file_get_contents($imagePath);

      if (!$imageData) {
        throw new Exception('Image URL is not accessible');
      }

      // Generate random file name
      $imageName = $this->generateRandomImageName();

      // Process the image and add text
      $img = $manager->read($imageData)
        ->text($this->arabic_text(' ' . $request->recipientName), $cert->to_x, $cert->to_y, function (FontFactory $font) use ($cert) {
          $this->setFontProperties($font, $cert);
        })
        ->text($this->arabic_text(' ' . $request->donorName), $cert->from_x, $cert->from_y, function (FontFactory $font) use ($cert) {
          $this->setFontProperties($font, $cert);
        })
        ->save(public_path('c/' . $imageName));

      // Create the gift entry
      $gift = $this->createGift($request, $cert);

      if(!$gift)
      {
        throw new Exception("Can not create a new gift in database");
      }

      // Prepare and send messages
      $res_sendGiftMessages = $this->sendGiftMessages($request, $gift, $imageName);

      if($res_sendGiftMessages['code'] == 0)
      {
        throw new Exception($res_sendGiftMessages['msg']);
      }

      DB::commit(); // success

      Log::info("Whatsapp Messages been sent successfully !!");
    } 
    catch (Exception $ex) 
    {
      DB::rollBack(); // undo any DB writes
      Log::error('Gift sending failed: ' . $ex->getMessage());
      return response()->json(['error' => $ex->getMessage()]);
    }
  }

  private function ensureDirectoryExists($path)
  {
    if (!File::exists($path)) {
      File::makeDirectory($path, 0777, true);
    }
  }

  private function generateRandomImageName()
  {
      return uniqid('img_', true) . '.jpg';
  }
  

  private function setFontProperties(FontFactory $font, $cert)
  {
    $fontPath = base_path('platform/plugins/gift/resources/assets/fonts/Droid_Arabic_Naskh_Bold.ttf');
    $font->filename($fontPath);    
    $font->size($cert->font_size);
    $font->color($cert->font_color);
    $font->align('center');
  }

  private function createGift(Request $request, $cert)
  {
    return Gift::create([
      'project-name'     => $request->projectName,
      'email'            => $request->email,
      'donor-name'       => $request->donorName,
      'donor-phone'      => $request->donorPhone,
      'recipient-name'   => $request->recipientName,
      'recipient-phone'  => $request->recipientPhone,
      'template-name'    => $cert->name,
      'cert_id'          => $request->messageTemplate,
    ]);
  }

  private function sendGiftMessages(Request $request, $gift, $imageName)
  {
    try 
    {
      $variables = [
        '{donor_name}' => '*' . $request->donorName . '*',
        '{recipient_name}' => '*' . $request->recipientName . '*',
      ];
  
      $donorMessage = str_replace(array_keys($variables), array_values($variables), setting('donor_message'));
      $recipientMessage = str_replace(array_keys($variables), array_values($variables), setting('recipient_message'));
  
      $res_sendImageWhatsapp = $this->sendImageWhatsapp($request->donorPhone, asset('c/' . $imageName), $gift->id, $donorMessage);

      if($res_sendImageWhatsapp['code'] == 0)
      {
        throw new Exception($res_sendImageWhatsapp['msg']);
      }
     

      $res_sendImageWhatsapp2 = $this->sendImageWhatsapp($request->recipientPhone, asset('c/' . $imageName), $gift->id, $recipientMessage);
      
      if($res_sendImageWhatsapp2['code'] == 0)
      {
        throw new Exception($res_sendImageWhatsapp2['msg']);
      }

      return ['code' => 1, 'data' => true];
      
      
    }
    catch(Exception $ex)
    {
      return ['code' => 0 , 'msg' => $ex->getMessage()];
    }
  }




  public function sendImageWhatsapp($to, $link, $id, $message)
  {
      try {
          $url = "https://api.ultramsg.com/" . setting('ultra_message_instance') . "/messages/chat";
  
          $params = [
              'token' => setting('ultra_message_token'),
              'to'    => $to,
              'body'  => "{$message}\n{$link}",
          ];
  

          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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

          if ($err) 
          {
            throw new Exception("cURL Error #:" . $err);
          } 
          else 
          {
            Gift::where('id', $id)->update(['delivered' => true]);
            
            // // Decode the JSON response
            $responseData = json_decode($response, true);
            // // Check if the send was successful
            if ($responseData && isset($responseData['sent']) && $responseData['sent'] === "true") 
            {
                return ['code' => 1 , 'data' => true];
            }
            else 
            {
              throw new Exception("UnKnow Error !!!");
            }
            
          } 
  
      } catch (Exception $ex) {
          // You can log the error or handle it as needed
          return ['code' => 0 , 'msg' => $ex->getMessage()];
      }
  }
  

  function arabic_text($text)
  {
    $Arabic = new I18N_Arabic_Glyphs();
    return $Arabic->utf8Glyphs($text);
  }
}
