<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;
use Illuminate\Support\Facades\DB; 
use App\Models\userCuota;

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
            'file' => 'required|mimes:jpg,png,doc,docx,xls,xlsx,xlsm,svg,txt,pdf|max:2048', // Example validation rules
        ]);

        // 2. Store the file
        // The 'public' disk stores files in storage/app/public
        // The 'uploads' directory will be created if it doesn't exist
        //$path = $request->file('file')->store('uploads', 'public');
        // Optional: Get the original file name
        $fileName = $request->file('file')->getClientOriginalName();
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $fileSize = $request->file('file')->getSize();
        $fileSizeKB = round($fileSize / 1024, 2);
        $userid = $request->input('userid');

        //get User Cuota
        $cuota_usuario = userCuota::where('user_id', $userid)->get();
        $cuota_usuario_kb = $cuota_usuario[0]->couta_user;

        //get espacio usado
        $espacio_usado = DB::table('files_table')
              ->where('userid', $userid)
              ->sum('filesize');

        //espacio usado + peso de archivo
        $espacio_usado_mas_archivo = $espacio_usado + $fileSizeKB;

        //si excede la Cuota
        if($espacio_usado_mas_archivo > $cuota_usuario_kb ){

            return response()->json(['message' => 'Error : Excede la Cuota de Almacenamiento' ], 200);
        
        }else{


        }
      
        
        
         


        $currentTimestamp = time();
        $fullfilename = explode(".", $fileName);
        $fileNameToSave = $fullfilename[0].'_'.$currentTimestamp.'.'.$fileExtension;

        $path = $request->file('file')->storeAs('uploads', $fileNameToSave , 'public');
        

        // Save file to a database 

        $record = Files::create([
        'filename' => $fileNameToSave,
        'filesize' => $fileSizeKB,
        'userid' => $userid,
        'filetype' => $fileExtension
        ]);


        return response()->json(['message' => 'Su Archivo Fue Guardado' ], 200);
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