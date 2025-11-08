<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $table = 'files_table'; // Specify your custom table name

    // Define fillable or guarded properties for mass assignment protection
        protected $fillable = ['filename', 'filesize', 'userid', 'filetype']; 


}
