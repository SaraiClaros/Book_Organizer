<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneroModel extends Model
{
    use HasFactory;

    protected $table = 'genero';
    protected $primaryKey = 'genero_id'; 
    
    protected $fillable = [
        'genero', 
        'descripcion',
    ];
}
