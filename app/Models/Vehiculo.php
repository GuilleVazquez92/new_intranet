<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'public.tef022';
    
    protected $primaryKey = 'autocod';
    
    public $timestamps=false;

   
    protected $fillable = [
     'autocod', 
     'autocha', 
     'autochas', 
     'autoesta', 
     'automodelo', 
     'automarca', 
     'autonro',

    ];

    use HasFactory;
}
