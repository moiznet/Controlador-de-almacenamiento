<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grupos extends Model
{
    use HasFactory;

    protected $table = 'grupo_tabla';  

        protected $fillable = [  
            'grupos',
            'user_id',
            
        ];
}
