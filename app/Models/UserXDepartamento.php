<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserXDepartamento extends Model
{
    use HasFactory;

    protected $table = 'users_x_departamentos';
    
    protected $primaryKey = 'id';
    
    public $timestamps=true;

    protected $fillable = [
     'iduser',
     'iddepartamento',
   
   ];
   
 
    public function user() {
    return $this->belongsTo(\App\Models\User::class, 'iduser', 'id');
    }
}
