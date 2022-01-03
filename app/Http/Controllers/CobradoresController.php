<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuotero;
use App\Models\Ips;
use App\Models\DatoCliente;
use App\Models\DatoPersonal;
use App\Models\CabeceraCuotero;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;


class CobradoresController extends Controller
{
    public function ver ()

    {   
        return view('welcome');
    }

     public function buscar (Request $request)

    {   
        $operaciones = Cuotero::select('fsd0171.*')
                ->where('fsd0171.beope1', '=',$request->get('operacion') )
                ->get();

        $datos = DatoCliente::select('fsd0011.*')
                ->where('fsd0011.aacuen', '=',$operaciones[0]->aacuen)
                ->get();

        $cabecera = CabeceraCuotero::select('fsd0122.*')
                ->where('fsd0122.bfope1', '=',$operaciones[0]->beope1)
                ->get();        


        $cuotas = DB::table('public.fsd0171')
                ->where('beope1', $request->get('operacion'))
                ->where('beesta', 'P')
                ->orderBy('becta')
                ->get();


        $cuenta = $operaciones[0]->beope1;
        $date =new \Carbon\Carbon();
        $fecha = $date->format('Y-m-d');
        $tasa = $cabecera[0]->bftasa;
     
       
       

        $params['operaciones'] = $operaciones;
        $params['datos'] = $datos;

      
        return view('cobradores.admin', $params);
    }

public function buscarOperacion ()

    {   
        
        return view('cobradores.busqueda');
    }

public function ListarOperaciones (Request $request)

    {   
        $cedula = $request->get('cedula');
        

       $cabecera = DatoPersonal::select('fsd0011.*')
                ->where('fsd0011.aadocu', '=',$cedula)
                ->get();  

        $cuenta = $cabecera[0]->aacuen;
     
     
        
       //------CREAR TOKEN DE ACCESO------
        
        $salt = '34a@$#aA98gsdf45mk23$';
        $password = 'f4c'.date('Y').'L4n'.date('d').'d14';
        $hash = hash('sha256', $salt . $password);


        //------CONSULTA HTTP AL MOTOR SHERLOCK
        $client = new Client();
        $body = array(
                'accion' => 'consultar',
                'cuenta' => $cuenta    
        ); 
        $endpoint = 'https://intranet.facilandia.com.py/api/v3/index.php/carrito';
        $params = http_build_query($body);
        $url = $endpoint . "?" . $params;
        $headers = array(
            'x-auth-token' => $hash,
            'Content-Type' => 'application/x-www-form-urlencod'

        );
        $response = $client->GET($url, $headers);
        $operaciones = json_decode($response->getBody());

        // $data= json_decode($operaciones[0]->operacion_credito);
        // dd($data[0]->operacion);
    
     
        return view('cobradores.busqueda')->with(['operaciones' => $operaciones]);
      
    }

     public function MostrarOperacion (Request $request)

    {   
         $operaciones = Cuotero::select('fsd0171.*')
                ->where('fsd0171.beope1', '=',$request->get('operacion') )
                ->get();

        $datos = DatoCliente::select('fsd0011.*')
                ->where('fsd0011.aacuen', '=',$operaciones[0]->aacuen)
                ->get();

        $cabecera = CabeceraCuotero::select('fsd0122.*')
                ->where('fsd0122.bfope1', '=',$operaciones[0]->beope1)
                ->get();        


        $cuotas = DB::table('public.fsd0171')
                ->where('beope1', $request->get('operacion'))
                ->where('beesta', 'P')
                ->orderBy('becta')
                ->get();


        $cuenta = $operaciones[0]->beope1;
        $date =new \Carbon\Carbon();
        $fecha = $date->format('Y-m-d');
        $tasa = $cabecera[0]->bftasa;
     
       
       
        $params ['producto'] = $request->get('producto');
        $params['operaciones'] = $operaciones;
        $params['datos'] = $datos;

      
        return view('cobradores.busqueda_x_cuenta', $params);
    }

    public function ips (Request $request)

    {   
        
       $ips=Ips::all();
          
    foreach ($ips as $key) {
        
        if (empty($key->estado) || empty($key->ultimo) ){
       $url = "https://intranet.facilandia.com.py/laravel/sherlock/public/index.php/ips?documento=".$key->documento;

       $contenido_ips = @file_get_contents($url);
       $contenido_ips=json_decode($contenido_ips);
       
       if($contenido_ips == null ||$contenido_ips->estado == "" || $contenido_ips->ultimo =="" ){
       $contenido_ips = new \stdClass;
       $contenido_ips->estado = 0;
       $contenido_ips->ultimo = 0; 
       }else{
    
        if($contenido_ips->estado='ACTIVO\n\t\t\t\t\t\t\t\t\t\t\t'){

            $contenido_ips->estado = 'ACTIVO';

        }
        }
     Ips::where('documento',$key->documento)->update(['estado'=>$contenido_ips->estado,'ultimo'=>$contenido_ips->ultimo]);
    }
}
    }

}
