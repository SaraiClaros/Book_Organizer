<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosModel extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'usuarios_id'; 

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

   
    protected static function booted()
    {
        static::creating(function ($usuario) {
            $usuario->password = bcrypt($usuario->password); 
        });
    }


    
}
