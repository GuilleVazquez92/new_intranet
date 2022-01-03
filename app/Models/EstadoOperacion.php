<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoOperacion extends Model
{

    use HasFactory;

     protected $table = 'public.fst044';
    
    protected $primaryKey = 'bjesta';
    
    public $timestamps=false;

   
    protected $fillable = [
     
    'bjesta', 
    'bjdesc', 
    'bjcor', 
    'bjcant', 
    'bjmont', 
    'bjver',
   ];
    
}
