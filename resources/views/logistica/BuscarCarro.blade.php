@extends('adminlte::page')
@section('content_header')

@if(empty($message))
@else
 <div class="alert alert-success col-md-6" >
        <h2>{{ $message }}</h2>
    </div>
@endif
    <h1>Seleccionar Carro</h1>
@stop

@section('content')



<div class="col-md-12 contenido-dos">
<form action="{{route('BuscarCarroPost')}}" method="POST">
  {{csrf_field()}}

<div>
	<br>
</div>
<div class="form-row">
          <div class="form-group col-md-4">
          <label for="inputEmail4">N° de Carro</label>
          <input type="text" class="form-control" name="carro" placeholder="">
          </div>      
</div>
<div class="cold-md-12">
 <button type="submit" class="btn btn-primary ">Buscar</button>
 </div>

</form>
</div>
<div>
    <br>
</div>
<div class="col-md-6">
    @if(empty($remisiones))
    @else
    @foreach($remisiones as $remision)

<table class="table table-bordered">
    
                    <tr>
                      <th>Remision</th>
                      <td>{{ $remision->renro}}</td>
                    </tr>
                    <tr>
                      <th>Dirección_uno</th>
                      <td>{{ $remision->redireent}}
                      </td>
                    </tr>
                      <th>Dirección_dos</th>
                      <td>{{ $remision->rediresal}}
                      </td>
                    </tr>
    
         @endforeach 

         @foreach($productos as $producto)
                    <tr> 
                      <th>Producto</th>
                      <td> {{ $producto->tccarite}} -   {{ $producto->tccardes}}<br>
                        <b>Cantidad:</b> {{$producto->tccarcan}}
                      </td>
                    </tr> 
         @endforeach 

          @if($user == 20)
<form action="{{route('CargarCarroPost')}}" method="POST">
                       {{csrf_field()}}
          <tr> 
                      <th>Chofer</th>
                      <td>    {{$chofer}}
                      </td>
          </tr> 
           <tr> 
                      <th>Vehiculo</th>
                      <td> {{$vehiculo}}
                      </td>
          </tr> 
          @endif
            <tr> 
                <th>Estado </th>
                @if(empty($entrega))
                <td style="color:red;"> Pendiente
                </td>
                @elseif($entrega==1)
                 <b><td style="color:green;"> Entregado
                </td></b>
                @else
                <b><td style="color:brown;"> Desistido
                </td></b>
                @endif
            </tr>               
     </table>  
     @if(empty($entrega))
       
        @if($user == 20)
      
      <input type="hidden" name="carro" value={{$remisiones[0]->tccarcod}}>
      <input type="hidden" name="vehiculo" value={{$vehiculo}}>
      <input type="hidden" name="chofer" value={{$chofer}}>
      <button type="submit" class="btn btn-primary">Cargar Carro</button>
      </form> 


        @else

       <form action="{{route('CarroDetallePost')}}" method="POST">
                       {{csrf_field()}}
                    <input type="hidden" name="carro" value={{$remisiones[0]->tccarcod}}>
                      <button type="submit" class="btn btn-primary">Cargar Entrega</button>
        </form> 

        @endif
    @else
    @endif        
</div>


@endif
@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop