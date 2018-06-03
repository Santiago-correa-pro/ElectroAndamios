<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngresoModel extends Model
{
    protected $table = 'ingreso';
    
    protected $primaryKey = 'idingreso';

    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = [
        'idproveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'estado'
    ];
}
