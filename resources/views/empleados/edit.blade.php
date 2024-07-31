@extends('empleados.layout')
@section('content')
 
<!--contenedor del crud-->
<div class="card" style="margin: 40px auto; width: 700px">
  <div class="card-header"><h4>Editar Empleado</h4></div>

    <!--contenedor con los datos a editar del empleado seleccionado-->
    <div class="card-body">
        
        <!--aqui el id permanece oculto ya que no es una variable que se pueda
        editar, esta es asignada automaticamente por la base de datos y es
        auto incrementable-->
        <form action="{{ url('empleados/' .$empleados->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{$empleados->id}}" id="id" />
            
            <!--aqui se editan las variables y luego proceden a enviarse a la base de
            datos para actualizarse. cada variable tiene su respectiva verificacion de
            error manejada en el controlador para que no se permitan ingresar valores
            nulos en ninguno de los campos-->
            <label>Nombre</label></br>
            <input type="text" name="nombre" id="nombre" value="{{$empleados->nombre}}" class="form-control @error('nombre') is-invalid @enderror"></br>
            @error('nombre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label>Apellido</label></br>
            <input type="text" name="apellido" id="apellido" value="{{$empleados->apellido}}" class="form-control @error('apellido') is-invalid @enderror"></br>
            @error('apellido')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <label>Cargo</label></br>
            <input type="text" name="cargo" id="cargo" value="{{$empleados->cargo}}" class="form-control @error('cargo') is-invalid @enderror"></br>
            @error('cargo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <label>Departamento</label></br>
            <input type="text" name="departamento" id="departamento" value="{{$empleados->departamento}}" class="form-control @error('departamento') is-invalid @enderror"></br>
            @error('departamento')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <!--contenedor de los botones aceptar y cancelar. al aceptar se procede a
            enviar los datos a la base de datos y actualizarse, regresandote luego a la
            pagina principal. al cancelar te regresa a la pagina principal pero sin
            realizar ningun tipo cambio a los datos-->
            <div class="d-flex justify-content-center"> 
            <input type="submit" value="Aceptar" class="btn btn-outline-success" style="margin-right: 10px">
            <button type="button" onclick="window.location.href='{{ url('/empleados') }}'" class="btn btn-outline-danger ml-7">Cancelar</button></br>
            </div>
        </form>
   
  </div>
</div>
 
@stop