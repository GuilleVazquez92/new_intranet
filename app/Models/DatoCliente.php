<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoCliente extends Model
{
     protected $table = 'public.fsd0011';
    
    protected $primaryKey = 'aacuen';
    
    public $timestamps=false;

   
    protected $fillable = [
     
    'aacuen', 
    'aadocu', 
    'agdocu', 
    'aanom', 
    'aaape1', 
    'aaape2', 
    'aaape3', 
    'aanom1', 
    'aanom2', 
    'ahpais', 
    'aaresi', 
    'aasexo', 
    'aafech', 
    'aknive', 
    'aqclub', 
    'aavivi', 
    'aavehi', 
    'aahijo', 
    'aaesta', 
    'aaregi', 
    'bknive', 
    'ansect', 
    'alacti', 
    'aafeco', 
    'aausua', 
    'aafina', 
    'aapubl', 
    'atfoto', 
    'atfirm', 
    'atdire', 
    'aanatu', 
    'aaestn', 
    'aadocc', 
    'aatipc', 
    'aacodi', 
    'aanive', 
    'bkesta', 
    'aafecv', 
    'aaruc', 
    'aacat1', 
    'aacat2', 
    'aacat3', 
    'aafecc', 
    'bltipo', 
    'blnomb', 
    'blfech', 
    'blempl', 
    'baruc', 
    'blpate', 
    'bmdest', 
    'blambi', 
    'aahipo', 
    'aatasa', 
    'aahipcob', 
    'afaja', 
    'aaso', 
    'aban', 
    'acobr', 
    'acali', 
    'ainf', 
    'adenun', 
    'taso', 
    'asituacion', 
    'arecurrent', 
    'aestado', 
    'aclasificacion', 
    'atipo',
   ];
    

    
    use HasFactory;
}
