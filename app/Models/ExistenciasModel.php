<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LibrosModel;

class ExistenciasModel extends Model
{
    use HasFactory;

    protected $table = 'existencias';
    protected $primaryKey = 'id_existencia'; 

    protected $fillable = [
        'libros_id',
        'ubicacion_general',
        'codigo_identificacion',
    ];

    public function libros()
    {
        return $this->belongsTo(LibrosModel::class,'libros_id', 'libros_id' );
    }
}
