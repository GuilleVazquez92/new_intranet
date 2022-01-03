@extends('adminlte::page')
@section('content_header')
<h1>Desistir Entrega</h1>
@stop

@section('content')
<form action="{{route('CargarDesistir')}}" method="POST">
  {{csrf_field()}}
  <div class="col-md-6">
    <label>Carro</label>
   <input value="{{$carro}}" class="form-control" id="nombre" name="carrito" readonly>
   <label for="inputState">Motivo </label>
   <input type="int" class="form-control" name="motivo">
   <input value="2" type="hidden" name="estado"><br> 
   <input value="1" name="mostrar" type="hidden">

<button type="submit" class="btn btn-primary">Cargar</button>
</form>
</div>
@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop