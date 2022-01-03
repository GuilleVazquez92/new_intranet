@extends('adminlte::page')
@section('content_header')

@stop

@section('content')
<div class="cold-md-10">
    
    <table class="table" name="">
  <thead class="table-info">
    
    <tr>
      <th scope="col">Carrito</th>
      <th scope="col">Cuenta</th>
      <th scope="col">Chofer</th>
      <th scope="col">Canal</th>
      <th scope="col">Estado</th>
       <th scope="col">Tiempo de Espera</th>
        </tr>
  </thead>
  <tbody>
   
@foreach($entregas as $entrega)
    <tr> 
      <th>{{$entrega->carrito}} </th>
      <td> {{$entrega->cuenta}}</td>
      <td>{{$entrega->chofer}}</td>
      <td>{{$entrega->canal}}</td>
      @if($entrega->estado == 0)
      <td style="color:red;"> Pendiente
      </td>
      <td>{{tiempo($entrega->created_at)}}</td> 
      @elseif($entrega->estado==1)
      <b><td style="color:green;"> Entregado
      </td></b>
      <td>Terminado</td> 
      @else
      <b><td style="color:brown;"> Desistido
      </td></b>
      <td>Terminado</td> 
      @endif 

    </tr>
@endforeach
  </tbody>
</table>


@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop