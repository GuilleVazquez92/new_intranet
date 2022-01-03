<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $table = 'public.tef021';
    
    protected $primaryKey = 'chocodi';
    
    public $timestamps=false;

   
    protected $fillable = [
     'chocodi', 
     'clusu', 
     'chohab',

    ];

    use HasFactory;
}
