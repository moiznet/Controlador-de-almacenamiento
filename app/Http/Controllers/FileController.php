<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;
use Illuminate\Support\Facades\DB; 


class FileController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        // 1. Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf,txt|max:2048', // Example validation rules
        ]);

        // 2. Store the file
        // The 'public' disk stores files in storage/app/public
        // The 'uploads' directory will be created if it doesn't exist
        //$path = $request->file('file')->store('uploads', 'public');
        // Optional: Get the original file name
        $fileName = $request->file('file')->getClientOriginalName();
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $fileSize = $request->file('file')->getSize();
        $userid = $request->input('userid');


        $currentTimestamp = time();
        $fullfilename = explode(".", $fileName);
        $fileNameToSave = $fullfilename[0].'_'.$currentTimestamp.'.'.$fileExtension;

        $path = $request->file('file')->storeAs('uploads', $fileNameToSave , 'public');
        

        // Save file to a database 

        $record = Files::create([
        'filename' => $fileNameToSave,
        'filesize' => $fileSize,
        'userid' => $userid,
        'filetype' => $fileExtension
        ]);


        return $userid;
        //return back()->with('success', 'File uploaded successfully! Path: ' . $path);
    }

    public function borrarArchivo(Request $request)
        {
            
            
            

            DB::table('files_table')
            ->where('id', $request->archivo_id) 
            ->delete(); 
              
            return $request->archivo_id;


            
                //return "Archivo Borrado";
               
        
        
        }


}