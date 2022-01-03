<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticaEntrega extends Model
{
    protected $table = 'logistica_entregas';
    
    protected $primaryKey = 'id';
    
    public $timestamps=true;

   
    protected $fillable = [
     
    'carrito',
    'nombre',
    'direccion',
    'observacion',
    'estado',
    'motivo',
    'created',
    'longitud',
    'latitud',
    'telefono',
   
   ];

    use HasFactory;
}
