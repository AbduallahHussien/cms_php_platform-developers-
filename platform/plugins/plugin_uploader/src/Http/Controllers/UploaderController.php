<?php

namespace Botble\PluginUploader\Http\Controllers;


use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Exception;
use Illuminate\Support\Facades\Log;

class UploaderController extends BaseController
{

    public function index()
    {
        return view('plugins/plugin_uploader::index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:zip|max:51200',
        ]);

        try 
        {
            $file = $request->file('file');

            $tempPath = storage_path('app/temp');
            $extractBasePath = storage_path('app/extracted');

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

            Log::info('ZIP Path: ' . $fullZipPath);
            Log::info('File exists: ' . (file_exists($fullZipPath) ? 'yes' : 'no'));

            $zip = new ZipArchive;
            if ($zip->open($fullZipPath) === true) 
            {
                // Get the first folder name inside the zip
                $firstFolderName = $zip->getNameIndex(0);
                $firstFolderName = explode('/', $firstFolderName)[0]; // Get top-level folder name

                $finalExtractPath = $extractBasePath . '/' . $firstFolderName;

                if (file_exists($finalExtractPath)) 
                {
                    // Folder already exists!
                    $zip->close(); // <<< FIRST close
                    unlink($fullZipPath); // <<< THEN delete
                    throw new Exception("A folder called '$firstFolderName' already exists. Please rename your ZIP and try again.");
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
            Log::error('File upload failed: ' . $e->getMessage());

            return response()->json([
                'code' => false,
                'msg' => $e->getMessage(),
            ], 500);
        }
    }
}
