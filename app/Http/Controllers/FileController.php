<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;
use Illuminate\Support\Facades\DB; 
use App\Models\userCuota;
use App\Models\gruposc;
use App\Models\grupos;
use ZipArchive;
use SplFileInfo; // To easily get file information

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
            'file' => 'required|mimes:jpg,png,doc,docx,xls,xlsx,xlsm,svg,txt,pdf,zip|max:2048', // Example validation rules
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

        //get User Grupo
        $user_grupo = grupos::where('user_id', $userid)->get();
        $user_grup = $user_grupo[0]->grupos;

        if($user_grup == null){

            
            $cuota_usuario_kb = $cuota_usuario_kb;
            

        }else{

            

            //get Cuota Grupo
            $user_grupos = gruposc::where('nombre', $user_grup)->get();
            $user_grupos_cuota = $user_grupos[0]->cuota_grupo;

            


            if( $user_grupos_cuota >= $cuota_usuario_kb ){

                $cuota_usuario_kb = $user_grupos_cuota;
            }
    

        }

        

        //get espacio usado
        $espacio_usado = DB::table('files_table')
              ->where('userid', $userid)
              ->sum('filesize');

        //espacio usado + peso de archivo
        $espacio_usado_mas_archivo = $espacio_usado + $fileSizeKB;

        //si excede la Cuota
        if($espacio_usado_mas_archivo >= $cuota_usuario_kb ){

            return response()->json(['message' => 'Error : Excede la Cuota de Almacenamiento' ], 200);
        
        }else{


        }
      
        
        
         


        $currentTimestamp = time();
        $fullfilename = explode(".", $fileName);
        $fileNameToSave = $fullfilename[0].'_'.$currentTimestamp.'.'.$fileExtension;

        $path = $request->file('file')->storeAs('uploads', $fileNameToSave , 'public');
        

        
            if($fileExtension == 'zip'){
                

                $zip_file = 'storage/'.$path; // Replace with the actual path to your zip file

                $zip = new ZipArchive();
                $fileExtensions = [];

                if ($zip->open($zip_file) === TRUE) {
                    

                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i);

                        // Use SplFileInfo to get the file extension reliably
                        $fileInfo = new SplFileInfo($filename);
                        $extension = $fileInfo->getExtension();

                        if (!empty($extension)) {
                            $fileExtensions[] = $extension;

                            if($extension == "jpg" || $extension == "png" || $extension == "doc"  || $extension == "docx" || $extension == "xls" || $extension == "xlsx" || $extension == "xlsm" || $extension == "svg" || $extension == "txt" || $extension == "pdf"  || $extension == "zip" ){


                            }else{

                                return response()->json(['message' => 'Error: El Archivo .zip contiene archivos No Permitidos' ], 200);

                            }

                        }
                    }
                    $zip->close();

                } else {
                    return response()->json(['message' => 'Error: No Abre Archivo Zip' ], 200);
             
                }

                //return $fileExtensions;
                
            }



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