<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gruposc extends Model
{
    use HasFactory;

    protected $table = 'grupos_tabla'; // Specify your custom table name

        protected $fillable = [
            'nombre',
            'descripcion',
        ];
}
