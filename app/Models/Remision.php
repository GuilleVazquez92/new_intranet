<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remision extends Model
{
    use HasFactory;

    protected $table = 'public.remision';
    
    protected $primaryKey = 'reid';
    
    public $timestamps=false;

   
    protected $fillable = [
     'reid', 
     'reitem1', 
     'reitem2', 
     'reitem3', 
     'renro', 
     'tccarcod', 
     'bfope1', 
     'rediresal', 
     'redireent', 
     'returent', 
     'remotrans', 
     'autocod', 
     'chocodi', 
     'retracod', 
     'rebaimp', 
     'reesta', 
     'reusuario', 
     'renrofact', 
     'refecfact',
    
    ];

    
    
}
