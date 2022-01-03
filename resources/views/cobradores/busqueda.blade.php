@extends('adminlte::page')
@section('content_header')
    <h1>Buscar Cliente</h1>
@stop

@section('content')
<div class="col-md-12 contenido-dos">


<form action="{{route('buscarOperacion')}}" method="POST">
  {{csrf_field()}}

<div>
  <br>
</div>
<div class="form-row">
          <div class="form-group col-md-4">
          <label for="inputEmail4">N° de Cedula</label>
          <input type="text" class="form-control" name="cedula" placeholder="">
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
       

         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Operaciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Operación </th>
                      <th>Producto</th>
                      <th>Estado</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($operaciones as $operacion)
                    <tr>
                      
                      <td>
                        @php
                        $data = json_decode($operacion->operacion_credito);
                        if(empty($data[0]->operacion)){
                        echo 0;
                        }else
                        {
                        echo $data[0]->operacion;
                        }
                        @endphp
                        
                      </td>
                      <td>

                        @php
                        $detalle = json_decode($operacion->detalle);
                        echo ($detalle[0]->descripcion);
                        @endphp

                      
                      
                      </td>
                      <td>
                             <?php 
                        $data = json_decode($operacion->operacion_credito);

                        if($data == null){
                          ?>
                        <button class="bg-warning">Contado</button>
                        <?php
                        }else{
                        if($data[0]->estado_operacion == 'VIGENTE'){
                           ?>
                        <button class="bg-primary">Vigente</button>
                        <?php 
                        }else
                        {
                         ?>
                        <button class="bg-danger">Cancelado</button>
                        <?php 
                        }
                        }
                         ?>

                      </td>
                      <td>
                    
                      <form action="{{route('MostrarOperacion')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="operacion" value="
                        <?php  
                         if(empty($data[0]->operacion)){
                          0;
                        }else{
                        ?>
                        {{$data[0]->operacion}}

                        <?php 
                        } ?>
                        ">
                        <input type="hidden" name="producto" value="{{$detalle[0]->descripcion}}">
                        <button class="bg-primary">Ver</button></td>

                    </form>
                    </tr>
                    @endforeach 
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

        
@endif
@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop