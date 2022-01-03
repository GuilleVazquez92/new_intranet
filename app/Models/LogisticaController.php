<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Remision;
use App\Models\Carrito_x_Producto;
use App\Models\LogisticaEntrega;
use App\Models\Chofer;
use App\Models\Vehiculo;
use Carbon\Carbon;

class LogisticaController extends Controller
{
    public function BuscarCarroPost(Request $request)

    {
        
        $remisiones = Remision::select('public.remision.*')
                ->where('remision.tccarcod', '=',$request->get('carro'))
                ->get();

        $productos = Carrito_x_Producto::select('public.tef0121.*')
                ->where('tef0121.tccarcod', '=',$request->get('carro'))
                ->get();

        $entrega = LogisticaEntrega::select('logistica_entregas.estado')
                ->where('carrito', '=', $request->get('carro'))->get();

         $user         =\Auth::user()->id;

         $chofer = Chofer::select('public.tef0121.clusu')
         ->where('chocodi', '=', $remisiones[0]->autocodi)
         ->get();
         
         $params['remisiones']  = $remisiones;
         $params['productos']   = $productos;
         $params['user']        = $user;


         dd($chofer);

         if (!empty($entrega[0]->estado)) {

         $params['entrega']     = $entrega[0]->estado;    
         }
         
         //return view ('logistica.BuscarCarro',$params);

    }

     public function BuscarCarro(Request $request)

    {
        
        return view ('logistica.BuscarCarro');

    }

     public function CargarCarro(Request $request)

    {
        
        return view ('logistica.CargarCarro');

    }

      public function BuscarDetallePost(Request $request)

    {
        
        $carro=$request->get('carro');
        $params ['carro']= $carro;
        

        return view('logistica.DatosCarrito', $params);

    }

        public function CargarEntrega(Request $request)

    {
        

        $date = Carbon::now(new \DateTimeZone('America/Asuncion'));
        $entrega                =  new  \App\Models\LogisticaEntrega;
        $entrega->carrito       =$request->get('carrito');
        $entrega->nombre        =$request->get('nombre');
        $entrega->direccion     =$request->get('direccion');
        $entrega->estado        =$request->get('estado');
        $entrega->latitud       =$request->get('txtLat');
        $entrega->longitud      =$request->get('txtLng');
        $entrega->observacion   =$request->get('observacion');
        $entrega->created       =$date->format('d-m-Y H:i:s');
        $entrega->user         =\Auth::user()->id;
        $entrega->save();

        $params['message'] = 'Entrega EXITOSA!!';
        return view('logistica.BuscarCarro',$params);

    }

           public function VerEntregas()

    {
        
        return view('logistica.VerEntregas');

    }

           public function DesistirEntrega(Request $request)

    {
        $mostrar        =$request->get('mostrar');

        if ($mostrar ==0) 
        {
        $carrito        =$request->get('carrito');
        $params['carro'] = $carrito;
        return view('logistica.DesistirEntrega',$params);
        }elseif($mostrar ==1)
        {
        $date = Carbon::now(new \DateTimeZone('America/Asuncion'));
        $entrega                =  new  \App\Models\LogisticaEntrega;
        $entrega->nombre        ='';
        $entrega->direccion     ='';
        $entrega->carrito       =$request->get('carrito');
        $entrega->estado        =$request->get('estado');
        $entrega->motivo        =$request->get('motivo');
        $entrega->created       =$date->format('d-m-Y H:i:s');
        $entrega->user          =\Auth::user()->id;
        $entrega->save();

       $params['message'] = 'Entrega DESISTIDA!!';
        return view('logistica.BuscarCarro',$params);


        }; 

       

    }

     public function CargarCarroPost(Request $request)

    {
        
       $carro = $request->get('carro');

       dd($carro);

    }
}
