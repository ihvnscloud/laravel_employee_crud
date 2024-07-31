@extends('empleados.layout')
@section('content')
 
<!--contenedor del crud-->
<div class="card" style="margin: 40px auto; width: 700px">
  <div class="card-header"><h4>Informacion del Empleado</h4></div>
    <div class="card-body">

        <!--contenedor con la informacion del empleado seleccionando,
        mostrando sus respectivos datos-->
        <div class="card-body">
            <h5 class="card-title">ID de empleado: {{ $empleados->id }}</h5>
            <p class="card-text">Nombre: {{ $empleados->nombre }}</p>
            <p class="card-text">Apellido: {{ $empleados->apellido }}</p>
            <p class="card-text">Cargo: {{ $empleados->cargo }}</p>
            <p class="card-text">Departamento: {{ $empleados->departamento }}</p>

             <!--contenedor del boton regresar el cual te devuelve a
             la pagina principal del crud-->
            <div class="d-flex justify-content-center"> 
            <button type="button" onclick="window.location.href='{{ url('/empleados') }}'" class="btn btn-outline-success">Regresar</button></br>
            </div>
            
        </div>
       
    </div>
</div>