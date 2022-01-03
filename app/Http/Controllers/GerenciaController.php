<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CargarCarro;

class GerenciaController extends Controller
{
    
    public function InformeEntregas()
    {

      $pendiente = CargarCarro::where('estado','=',0)
                ->count();
      $entregado = CargarCarro::where('estado','=',1)
                ->count();
      $desistido = CargarCarro::where('estado','=',2)
                ->count();
        
      $params['p'] = $pendiente;
      $params['e'] = $entregado;
      $params['d'] = $desistido;           
      return view('gerencia.InformeEntregas',$params);     
    }
}
