<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargarCarro extends Model
{
    protected $table = 'logistica_carga_entregas';
    
    protected $primaryKey = 'id';
    
    public $timestamps=true;

   
    protected $fillable = [
     
    'carrito',
    'chofer',
    'vehiculo',
    'estado',
   
   ];

    use HasFactory;
}
