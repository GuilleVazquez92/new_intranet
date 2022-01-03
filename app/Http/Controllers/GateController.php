<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserXDepartamento;
use App\Models\Departamento;
use App\Models\LogisticaEntrega;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class GateController extends Controller
{
    
    public function logisticaUser(){

         $user = \Auth::user()->id;
       
        $puerta = UserXDepartamento::where('iduser', $user)
                  ->get();

         if (($puerta[0]->iddepartamento == 2) &&($user != 20)) {
            return true;
         }else{
            return false;
         }

    }
      public function logisticaAdmin(){

         $user = \Auth::user()->id;
       
        $puerta = UserXDepartamento::where('iduser', $user)
                  ->get();

         if ($puerta[0]->iddepartamento == 2 && $user == 20) {
            return true;
         }else{
            return false;
         }

    }


        public function CobranzaUser(){

      $user = \Auth::user()->id;
       
      $puerta = UserXDepartamento::where('iduser', $user)
                  ->get();

      if ($puerta[0]->iddepartamento == 1) 
      {
            return true;
      }else{
            return false;
      }


    }

     
    public function GGUser(){

       $user = \Auth::user()->id;

      $puerta = UserXDepartamento::where('iduser', $user)
                  ->get(); 

      if ($puerta[0]->iddepartamento == 3) 
      {
            return true;
      }else{
            return false;
      }

    }

     public function JefesCanal(){

       $user = \Auth::user()->id;

      $puerta = UserXDepartamento::where('iduser', $user)
                  ->get(); 

      if ($puerta[0]->iddepartamento == 4) 
      {
            return true;
      }else{
            return false;
      }

    }


     public function prueba()
     {

      return view('welcome');
     }
}
