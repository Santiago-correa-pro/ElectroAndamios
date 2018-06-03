<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';

    protected $primaryKey = 'idpersona';

    public $timeStamps = false;

    protected $guarded = [];

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'tipo_persona',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];
}
