<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    
    function ver($cuota)
    {
    
    $mora->monto = DB::select('SELECT public.get_mora_cuota(?,?,?,?)',[$cuenta,$fecha, $tasa,$cuota]);

        return $mora;
    }