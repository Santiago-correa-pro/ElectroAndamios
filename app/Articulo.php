<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';
    
    protected $primaryKey = 'idarticulo';

    protected $guarded = [];

    public $timestamps = true;

    protected $fillable = [
        'idcategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'estado'
    ];
}
