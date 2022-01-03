<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    
    protected $primaryKey = 'id';
    
    public $timestamps=true;

   
    protected $fillable = [
     'descripcion',
   
   ];
    


    use HasFactory;
}
