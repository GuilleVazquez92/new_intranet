@extends('adminlte::page')
@section('content_header')
    <h1>Buscar Cliente</h1>
@stop

@section('content')
<div class="col-md-12 contenido-dos">


<form action="{{route('buscarCliente')}}" method="POST">
  {{csrf_field()}}

<div>
	<br>
</div>

<div class="form-row">
          <div class="form-group col-md-4">
          <label for="inputEmail4">N° de Operación</label>
          <input type="text" class="form-control" name="operacion" placeholder="">
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

@if(empty($operaciones))

@else
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>FICHA DE SEGUIMIENTO</b></h3><br>
                <b><br><p>Cliente:</b>{{$operaciones[0]->aacuen}} - {{$datos[0]->aanom}} </p>
                <b><p>Operacion:</b> {{$operaciones[0]->beope1}}</p>
                <b><p>Documento Nº</b> {{$datos[0]->aadocu}}</p>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    
                    <tr>
                      <th>Nº</th>
                      <th>Fecha de Vencimiento</th>
                      <th>Valor Cuota</th>
                      <th>Total</th>
                      <th>Fecha de Pago</th>
                     
                      

                    </tr>
                   
                  </thead>
                  <tbody>
                      @php
                        $i = 0;
                        @endphp
                    @foreach($operaciones as $operacion )
                    <tr data-widget="expandable-table" aria-expanded="false">
                      <td>{{$operacion->becta}}</td>
                      <td>{{$operacion->be1vto}}</td>
                      <td>{{$operacion->bevcta}}</td>
                      
                     
                      @if($operacion->beesta == 'P')
                      <td>{{monto($operacion->beope1,$operacion->becta)}}</td>
                      @else
                      <td>0</td>
                      @endif

                      @if ($operacion->beesta == 'C')
                      <td>{{$operacion->befchp}}</td>
                      @else
                      <td></td>
                      @endif
                      
                    </tr>
             @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

@endif
@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop