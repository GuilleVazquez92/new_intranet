<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito_x_Producto extends Model
{
    use HasFactory;

    protected $table = 'public.tef0121';
    
    protected $primaryKey = 'tccarcod';
    
    public $timestamps=false;

   
    protected $fillable = [
    'tccarcod', 
    'tccarfec', 
    'tccarhor', 
    'tccarcue', 
    'tccarite', 
    'tccarpre', 
    'tccarcan', 
    'tccardes', 
    'tccartli', 
    'tccardct', 
    'tccares1', 
    'tccarcos', 
    'tcpordes', 
    'tcdepcod', 
    'tcnccant', 
    'tcncmon', 
    'tcncest', 
    'tcchecknc', 
    'tcdesc', 
    'tcpreclist', 
    'tccarprom', 
    'tccarcam', 
    'tccarusu', 
    'tccarfecha', 
    'tccarhora', 
    'tccarmotivo', 
    'tccarprecio',

    ];
}
