<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';  

    protected $fillable = ['categoria']; 

    
    public function pdfs()
    {
        return $this->hasMany(Pdf::class, 'categoria_id');
    }
}
