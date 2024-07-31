@extends('empleados.layout')
@section('content')

<!--contenedor del crud-->
<div class="card" style="margin:40px">
  <div class="card-header"><h4>Añadir Empleado</h4></div>

    <!--contenedor con los campos a rellenar para crear el registro
    del empleado-->
    <div class="card-body">

        <!--aqui el id no es una variable que se pueda ingresar ya que, como
        esta explicado en el archivo edit.blade, esta es asignada automaticamente
        por la base de datos y es auto incrementable-->
        <form action="{{ url('empleados') }}" method="post">
            {!! csrf_field() !!}

            <!--aqui se ingresa cada variable para luego enviarse a la base de
            datos y realizar el registro. cada variable tiene su respectiva verificacion
            de error manejada en el controlador para que no se puedan ingresar
            valores nulos en ninguno de los campos-->
            <label>Nombre</label></br>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"></br>
            @error('nombre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label>Apellido</label></br>
             <input type="text" name="apellido" id="apellido" class="form-control @error('apellido') is-invalid @enderror"></br>
            @error('apellido')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label>Cargo</label></br>
             <input type="text" name="cargo" id="cargo" class="form-control @error('cargo') is-invalid @enderror"></br>
            @error('cargo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label>Departamento</label></br>
             <input type="text" name="departamento" id="departamento" class="form-control @error('departamento') is-invalid @enderror"></br>
            @error('departamento')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!--contenedor de los botones aceptar y cancelar. al aceptar se envian los
            datos a la base de datos para realizar el registro, regresandote luego a la
            pagina principal mostrandote un mensaje de empleado añadido correctamente
            el cual es colocado por el controlador. si en cambio seleccionas cancelar
            te regresa a la pagina principal sin realizar ningun registro-->
            <div class="d-flex justify-content-center"> 
            <input type="submit" value="Aceptar" class="btn btn-outline-success" style="margin-right: 10px">
            <button type="button" onclick="window.location.href='{{ url('/empleados') }}'" class="btn btn-outline-danger ml-7">Cancelar</button></br>
            </div>
        </form>
    
    </div>
</div>
 
@stop