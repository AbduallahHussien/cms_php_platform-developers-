<?php

namespace Botble\PluginUploader\Http\Controllers;


use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class UploaderController extends BaseController
{
     
    public function index()
    {
        return view('plugins/plugin_uploader::index');
    }

    public function upload(Request $request)
    {
         // Validate the file
        //  $request->validate([
        //     'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // Adjust file validation as needed
        // ]);

        // Store the file
        // $path = $request->file('file')->store('uploads', 'public');
        $path="test";

        // Return a response (success or failure)
        return response()->json(['message' => 'File uploaded successfully!', 'path' => $path]);
    }
}
