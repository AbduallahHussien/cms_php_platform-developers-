<?php

namespace Botble\PluginUploader\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Exception;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Validator;


class PluginUploaderController extends BaseController
{
  

    public function index()
    {
        $this->pageTitle(trans('plugins/plugin-uploader::plugin-uploader.upload_new_plugin'));

        return view('plugins/plugin-uploader::index');
    }

    private function getPluginJsonContents($zip)
    {
        for ($i = 0; $i < $zip->numFiles; $i++) 
        {
            $entryName = $zip->getNameIndex($i);
    
            // Normalize slashes and trim leading/trailing slashes
            $entryName = trim(str_replace('\\', '/', $entryName), '/');
    
            // Check if it's 'plugin.json' at the root
            if (basename($entryName) === 'plugin.json' && substr_count($entryName, '/') === 0) {
                $stream = $zip->getStream($entryName);
                if ($stream) {
                    $contents = stream_get_contents($stream);
                    fclose($stream);
    
                    // Optionally decode if you want JSON as array/object
                    $jsonData = json_decode($contents, true); // Use false for object instead of array
                    return $jsonData;
                }
            }
        }
    
        return null; // Not found or failed to read
    }
    
 

    private function failAndCleanup($zip,$fullZipPath,$msg)
    {
         // Folder already exists!
         $zip->close(); // <<< FIRST close
         unlink($fullZipPath); // <<< THEN delete
         throw new Exception($msg);
    }

    private function extractPluginName(string $id): ?string
    {
        if (str_contains($id, '/')) {
            $parts = explode('/', $id);
            return $parts[1] ?? null;
        }

        return null;
    }
     
    private function isValidPluginJson(?array $json): bool
    {
        return !is_null($json) && array_key_exists('id', $json);
    }

    public function upload(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:zip|max:51200',
            ]);
    
            if ($validator->fails()) 
            {
                throw new Exception($validator->errors()->first());
            }

            $tempPath = storage_path('app/temp');
            // $extractBasePath = base_path('platform/plugins'); 
            
            File::ensureDirectoryExists($tempPath);

            $filename = uniqid('upload_') . '.zip';

            $file = $request->file('file');

            $file->move($tempPath, $filename);

            $fullZipPath = $tempPath . '/' . $filename;
 
            $zip = new ZipArchive;

            if ($zip->open($fullZipPath) !== true) 
            {
                throw new Exception('Failed to open the ZIP file.'); 
            }

            $json = $this->getPluginJsonContents($zip);

            if (!$this->isValidPluginJson($json)) 
            {
                return $this->failAndCleanup($zip,$fullZipPath,'Please upload a valid plugin.');
            }

            $pluginName = $this->extractPluginName($json['id']);

            if(!$pluginName)
            {
                $this->failAndCleanup($zip,$fullZipPath,"please upload a valid plugin");
            }
            
            $basePluginPath = plugin_path();
            
            if (is_dir($basePluginPath . '/' . $pluginName)) 
            {
                $this->failAndCleanup($zip,$fullZipPath,"Plugin already exists");
            } 
          
            $zip->extractTo(plugin_path($pluginName));

            // $zip->extractTo(storage_path($pluginName));

            $zip->close();

            unlink($fullZipPath); // delete zip after extraction

            return response()->json(['code' => true, 'msg' => 'File uploaded and extracted successfully.']);
            
            
          
        } 
        catch (Exception $e) 
        {
            // Log::error('File upload failed: ' . $e->getMessage());
            return response()->json([
                'code' => false,
                'msg' => $e->getMessage(),
            ], 500);
        }
    }
    
}
