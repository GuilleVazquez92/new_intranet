<?php

use Illuminate\Http\Request;
use App\Models\Cuotero;
use App\Models\DatoCliente;
use App\Models\CabeceraCuotero;
use App\Models\EstadoOperacion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
    
    function monto($operacion,$cuota)
    {
    

        $cabecera = CabeceraCuotero::select('fsd0122.*')
                ->where('fsd0122.bfope1', '=',$operacion)
                ->get();        

        $date =new \Carbon\Carbon();
        $fecha = $date->format('Y-m-d');
        $tasa = $cabecera[0]->bftasa;
        $mora= DB::select('SELECT public.get_mora_cuota(?,?,?,?)',[$operacion,$fecha, $tasa,$cuota]);

        //dd($mora);
        return $mora[0]->get_mora_cuota;
    }

    function ddm($fecha)
    {

        $date = Carbon::now();
        $fechaVencimiento = Carbon::parse($fecha);

        if($date<=$fecha){
            return 0;
        }else{
        $diferencia = $fechaVencimiento->diffInDays($date);
        return $diferencia;
        }
    }

    function EstadoOperacion($operacion)
    {
         $cabecera = CabeceraCuotero::select('fsd0122.bfesta')
                ->where('fsd0122.bfope1', '=',$operacion)
                ->get();  

        if (empty($cabecera)) {
            return 0;
                }else{        
        $estado = EstadoOperacion::select('*')
                ->where('fst044.bjesta', '=',$cabecera[0]->bfesta)
                ->get();

         if (empty($estado))
        {
            return 0;
        }else{
         return $estado;   
        }
                
        }
        }   


     function tiempo($tiempo)
    
    { 

       $final   = Carbon::now() ;
       $time = Carbon::parse($tiempo);
       $total = $time->diff($final)->format('%D días - %H:%I:%S');
        return $total;
                 
    }     
       
        

   