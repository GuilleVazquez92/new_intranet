<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ips extends Model

{

    use HasFactory;
    
    protected $table = 'new_intranet.ips';
    
    protected $primaryKey = 'cuenta';
    
    public $timestamps=false;

   
    protected $fillable = [
     
   'nombre', 
   'documento', 
   ];
    

}
