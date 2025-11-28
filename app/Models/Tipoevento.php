<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipoevento extends Model
{
    protected $table = 'tipoevento';           
    protected $primaryKey = 'id_tipoevento';   
    public $timestamps = false;                

    protected $fillable = ['descripcion_tipoevento'];
}
