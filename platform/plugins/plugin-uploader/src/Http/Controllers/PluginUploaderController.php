<?php

namespace Botble\PluginUploader\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\PluginUploader\Http\Requests\PluginUploaderRequest;
use Botble\PluginUploader\Models\PluginUploader;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\PluginUploader\Tables\PluginUploaderTable;
use Botble\PluginUploader\Forms\PluginUploaderForm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class PluginUploaderController extends BaseController
{
  

    public function index()
    {
        $this->pageTitle(trans('plugins/plugin-uploader::plugin-uploader.upload_new_plugin'));

        return view('plugins/plugin-uploader::index');
    }

    private function is_already_exists($zip,$extractBasePath)
    {
        try 
        {
            // Get the first folder name inside the zip
          $firstFolderName = $zip->getNameIndex(0);
        //   info($firstFolderName);
          $firstFolderName = explode('/', $firstFolderName)[0]; // Get top-level folder name
        //   info($firstFolderName);
          $finalExtractPath = $extractBasePath . '/' . $firstFolderName;
        //   info($finalExtractPath);
          if (file_exists($finalExtractPath)) 
          {
              return ['code' => 1 , 'data' => true , 'msg' => "A folder called '$firstFolderName' already exists..." ];
          }
          return ['code' => 1 , 'data' => false];
        }    
        catch(Exception $ex)      
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }
    // private function is_plugin($zip)
    // {
    //     try 
    //     {
    //         $containsPluginJson = false;

    //         for ($i = 0; $i < $zip->numFiles; $i++) {
    //         try 
    //         {
    //             $entryName = $zip->getNameIndex($i);

    //             // Check if it's exactly "plugin.json" or like "folder/plugin.json"
    //             if (basename($entryName) === 'plugin.json' && substr_count($entryName, '/') <= 1) {
    //                 $containsPluginJson = true;
    //                 break;
    //             }
    //         }
    //         catch(Exception $e)
    //         {
    //             throw new Exception($e->getMessage());
    //         }
    //         }

    //         if(!$containsPluginJson)
    //         {
    //             return ['code' => 1 , 'data' => $containsPluginJson,'msg' => "The uploaded file must be botble plugin"];
    //         }
    //         return ['code' => 1 , 'data' => $containsPluginJson];
    //     }
    //     catch(Exception $ex)
    //     {
    //         return ['code' => 0 , 'msg' => $ex->getMessage()];
    //     }
    // }


    protected function is_valid_plugin_structure(ZipArchive $zip)
    {
        $rootFolders = [];

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entry = $zip->getNameIndex($i);
            $parts = explode('/', $entry);

            // Get the first-level folder only (excluding files directly at the root)
            if (count($parts) > 1 && $parts[0] !== '') {
                $rootFolders[$parts[0]] = true;
            }
        }

        if (count($rootFolders) !== 1) {
            return [
                'code' => 0,
                'msg' => 'ZIP must contain exactly one root folder.'
            ];
        }

        $pluginFolderName = array_keys($rootFolders)[0];

        $pluginJsonIndex = $zip->locateName($pluginFolderName . '/plugin.json');
        if ($pluginJsonIndex === false) {
            return [
                'code' => 0,
                'msg' => "Not Valid Plugin Structure"
            ];
        }

        return [
            'code' => 1,
            'data' => $pluginFolderName
        ];
    }

    private function handleError($zip,$fullZipPath,$msg)
    {
         // Folder already exists!
         $zip->close(); // <<< FIRST close
         unlink($fullZipPath); // <<< THEN delete
         throw new Exception($msg);
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

            $file = $request->file('file');

            $tempPath = storage_path('app/temp');
            $extractBasePath = base_path('platform/plugins');
            // $extractBasePath = storage_path('platform/plugins');
            
            if (!file_exists($tempPath)) 
            {
                mkdir($tempPath, 0777, true);
            }
            if (!file_exists($extractBasePath)) 
            {
                mkdir($extractBasePath, 0777, true);
            }

            $filename = uniqid('upload_') . '.zip';
            $file->move($tempPath, $filename);

            $fullZipPath = $tempPath . '/' . $filename;

            // Log::info('ZIP Path: ' . $fullZipPath);
            // Log::info('File exists: ' . (file_exists($fullZipPath) ? 'yes' : 'no'));

            $zip = new ZipArchive;

            if ($zip->open($fullZipPath) === true) 
            {
                 
                $res_is_valid_plugin_structure = $this->is_valid_plugin_structure($zip);

                if($res_is_valid_plugin_structure['code'] == 0)
                {
                   $this->handleError($zip,$fullZipPath,$res_is_valid_plugin_structure['msg']);
                }
                
                $pluginFolderName = $res_is_valid_plugin_structure['data'];

                $pluginPath = $extractBasePath . '/' . $pluginFolderName;
                info($extractBasePath);
                info($pluginFolderName);
                info($pluginPath);
                if (file_exists($pluginPath)) 
                {
                    $this->handleError($zip, $fullZipPath, 'Plugin folder already exists: ' . $pluginFolderName);
                }

                // Everything is safe -> extract
                $zip->extractTo($extractBasePath);
                $zip->close();
                unlink($fullZipPath); // delete zip after extraction
 
                return response()->json(['code' => true, 'msg' => 'File uploaded and extracted successfully.']);
            } 
            else 
            {
                throw new Exception('Failed to open the ZIP file.');
            }
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
