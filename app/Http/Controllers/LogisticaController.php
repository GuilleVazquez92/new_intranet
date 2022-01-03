<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Remision;
use App\Models\Carrito_x_Producto;
use App\Models\LogisticaEntrega;
use App\Models\Chofer;
use App\Models\Vehiculo;
use App\Models\CargarCarro;
use Carbon\Carbon;
use DB;

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

      
        $chofer = Chofer::select('tef021.clusu')
        ->where('chocodi', '=', $remisiones[0]->chocodi)->get();


        $vehiculo = Vehiculo::select('tef022.autocha')
                ->where('autocod', '=', $remisiones[0]->autocod)->get();


         $params['remisiones']      = $remisiones;
         $params['productos']       = $productos;
         $params['user']            = $user;
         $params['chofer']          = $chofer[0]->clusu;
         $params['vehiculo']        = $vehiculo[0]->autocha;

         if (!empty($entrega[0]->estado)) {

         $params['entrega']     = $entrega[0]->estado;    
         }
         
         return view ('logistica.BuscarCarro',$params);

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
        $carro           = $request->get('carro');
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
        $entrega->telefono      =$request->get('telefono');
        $entrega->user         =\Auth::user()->id;
        $entrega->save();


        $estado_entrega  = CargarCarro::where('carrito' ,'=',$entrega->carrito )->update(['estado' => 1]);


         $params['message'] = 'Entrega EXITOSA!!';
        return view('logistica.BuscarCarro',$params);

    }

           public function VerEntregas()

    {
        
        $username = \Auth::user()->name;
        $userid = \Auth::user()->id;
        $chofer = Chofer::select('tef021.chocodi')
                ->where('clusu', '=', $username )->get();
         

        if (!empty($chofer[0])) 
        {
            $entregas = CargarCarro::where('chofer', '=', \Auth::user()->name)->where('estado','=',1)
                ->get();

        $params['entregas'] = $entregas;

        return view('logistica.VerEntregas', $params);

        }else{

        if ($userid == 28 ) {
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 25
        or b.bccana = 12
        or b.bccana = 11
        or b.bccana = 21)
        and a.estado = 1;');
            }elseif($userid==29){
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 18
        or b.bccana = 16
        or b.bccana = 13)
        and a.estado = 1;');

            }elseif($userid==30){
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 14
        or b.bccana = 15)
        and a.estado = 1;');

            }elseif($userid==31){
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 22)
        and a.estado = 1;');

            }
        $params['entregas'] = $entregas;
        return view('logistica.jefesVerEntregas', $params);    
        }       
    
        

    }
       public function VerPendientes()

    {
        $username = \Auth::user()->name;
        $userid = \Auth::user()->id;
        $chofer = Chofer::select('tef021.chocodi')
                ->where('clusu', '=', \Auth::user()->name)->get();
         

        if (!empty($chofer[0])) 
        {
            $entregas = CargarCarro::where('chofer', '=', \Auth::user()->name)->where('estado','=',0)
                ->get();
        }else{
              if ($userid == 28 ) {
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 25
        or b.bccana = 12
        or b.bccana = 11
        or b.bccana = 21)
        and a.estado = 0;');
            }elseif($userid==29){
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 18
        or b.bccana = 16
        or b.bccana = 13)
        and a.estado = 0;');

            }elseif($userid==30){
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 14
        or b.bccana = 15)
        and a.estado = 0;');

            }elseif($userid==31){
        $entregas = DB::select( 'SELECT a.carrito, a.vehiculo, b.tccarcue cuenta,c.bccnom  canal, a.chofer,a.estado, a.created_at
        FROM  new_intranet.logistica_carga_entregas a
        left JOIN public.tef012 b ON a.carrito = b.tccarcod 
        left JOIN public.fst025 c ON b.bccana = c.bccana
        where( b.bccana = 22)
        and a.estado = 0;');

            }

        $params['entregas'] = $entregas;
        return view('logistica.jefesVerEntregas', $params);
        }       


    
        $params['entregas'] = $entregas;


        return view('logistica.VerEntregas', $params);

    }
       public function VerDesistidos()

    {
        
        $chofer = Chofer::select('tef021.chocodi')
                ->where('clusu', '=', \Auth::user()->name)->get();
         

        if (!empty($chofer[0])) 
        {
            $entregas = CargarCarro::where('chofer', '=', \Auth::user()->name)->where('estado','=',2)
                ->get();
        }else{
            $entregas = CargarCarro::where('estado','=',2)
                ->get();
        }       


    
        $params['entregas'] = $entregas;


        return view('logistica.VerEntregas', $params);

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

        $estado_entrega  = CargarCarro::where('carrito' ,'=',$entrega->carrito )->update(['estado' => 2]);

       $params['message'] = 'Entrega DESISTIDA!!';
        return view('logistica.BuscarCarro',$params);


        }; 

       

    }

     public function CargarCarroPost(Request $request)

    {
        $carrito  = CargarCarro::where('carrito' ,'=',$request->get('carro'))->get();


        if (empty($carrito[0])) {
        $carro                  =$request->get('carro');
        $chofer                 =$request->get('chofer');
        $vehiculo               =$request->get('vehiculo'); 
        
        $CargarCarro            = new  \App\Models\CargarCarro;
        $CargarCarro->carrito   = $carro;
        $CargarCarro->chofer    = $chofer;
        $CargarCarro->vehiculo  = $vehiculo;
        $CargarCarro->estado    = 0;

        $CargarCarro->save();

        return back();
        }else
        {
        $params['message'] = 'EL CARRITO YA FUE CARGADO';  
        return view('logistica.BuscarCarro',$params);
        }

        

    }
}
