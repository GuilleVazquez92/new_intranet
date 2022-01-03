@extends('adminlte::page')
@section('content_header')
    <h1 align="right">Logistica/Cargar Entrega</h1>
@stop

@section('content')
<div class="col-md-5 ">



<form action="{{route('CargarEntrega')}}" method="POST">
  {{csrf_field()}}
   <label>Carro</label>
   <input value="{{$carro}}" class="form-control" id="nombre" name="carrito" readonly>
   <label for="inputState">Nombre</label>
   <input type="int" class="form-control" name="nombre" id="nombre">
   <label for="inputState">Dirección</label>
   <input type="int" class="form-control" name="direccion">
   <input type="hidden" id="txtLat" class="form-control" placeholder="latitude" name="txtLat">
     <input type="hidden" name="estado" value="1">
   <input type="hidden" id="txtLng" class="form-control" placeholder="longitud" name="txtLng">
    <label for="inputState">Telefono</label>
   <input type="tex" class="form-control" name="telefono" id="telefono">
   <label for="inputState">Observación</label>
   <input type="int" class="form-control" name="observacion" id="observacion">
    <br>
   <div class="row">

    <div class="col-md-12">
        <div id="map_canvas" style="height:350px">
    </div> <br>
       
   </div>
   
<button type="submit" class="btn btn-primary">Cargar</button>&nbsp&nbsp
</form>
<form action="{{route('DesistirEntrega')}}" method="POST">
  {{csrf_field()}}
  <input value="{{$carro}}" class="form-control" id="nombre" name="carrito" type="hidden">
  <input value="0" name="mostrar" type="hidden">
 <button type="submit" class="btn btn-danger">Desistir</button>
</form>
</div>

@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2QF1gXM89q7vo9JIc5x7x_lXjEgP8xQs"></script>


<script>
       navigator.geolocation.getCurrentPosition(function(location) {
  console.log(location.coords.latitude);
  console.log(location.coords.longitude);

   $("#txtLat").val(location.coords.latitude);
    $("#txtLng").val(location.coords.longitude);

    var map;
    var center = {lat: location.coords.latitude, lng: location.coords.longitude};
    var vMarker;

    function initMap() {

        map = new google.maps.Map(document.getElementById('map_canvas'), {
        center: center,
        zoom: 15
        });

        var vMarker = new google.maps.Marker({
        position: {lat: location.coords.latitude, lng: location.coords.longitude},
        map:map,
        draggable: true,
        title: 'Ubication'

        });

         google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(6));
                $("#txtLng").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });
            map.setCenter(vMarker.position);
            vMarker.setMap(map); 

    }
 function movePin() {
            var geocoder = new google.maps.Geocoder();
            var textSelectM = $("#txtCiudad").text();
            var textSelectE = $("#txtEstado").val();
            var inputAddress = $("#txtDireccion").val() + ' ' + textSelectM + ' ' + textSelectE;
            geocoder.geocode({
                "address": inputAddress
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    vMarker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    map.panTo(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                    $("#txtLat").val(results[0].geometry.location.lat());
                    $("#txtLng").val(results[0].geometry.location.lng());
                }

            });
        }

    initMap();
});

           
        </script>
@stop