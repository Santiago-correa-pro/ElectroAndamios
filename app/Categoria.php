<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    
    protected $primaryKey = 'idcategoria';

    protected $guarded = [];

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'condicion'
    ];
}
