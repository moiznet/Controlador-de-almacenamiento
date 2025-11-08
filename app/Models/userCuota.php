<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userCuota extends Model
{
    use HasFactory;

    protected $table = 'user_cuota_table'; // Specify your custom table name

        protected $fillable = [ // Define fillable attributes for mass assignment
            'user_id',
            'couta_user',
        ];

}
