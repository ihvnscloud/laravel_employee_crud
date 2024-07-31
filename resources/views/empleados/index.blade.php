@extends('empleados.layout') <!--esta linea se podria decir que hereda
                                el layout y lo muestra en esta vista. se 
                                realiza lo mismo con cada una de las vistas
                                o paginas creadas-->
@section('content') <!--esta linea define una sección llamada content y el 
                    contenido colocado entre ellas reemplazará a la sección
                    yield('content') que se encuentra en el layout. se realiza
                    lo mismo con cada una de las vistas o paginas creadas-->

<!--css del order by de la barra id nombre
apellido cargo y departamento-->
<style>
.sort-arrow {
  font-weight: bold;
  text-decoration: none;
  margin-left: 2px;
}

.sort-arrow.asc:after {
  content: "▲";
}

.sort-arrow.desc:after {
  content: "▼";
}

.table th a {
  color: #000;
  text-decoration: none;
}
</style>
    <!--contenedor del crud-->
    <div class="container">
        <div class="row" style="margin:40px">
            <div class="col-12">
                <div class="card">
                    <!--contenedor con el titulo el cual es un link que te
                    lleva devuelta a este mismo sitio (index)-->
                    <div class="card-header text-center">
                        <a href="{{ route('empleados.index') }}" style="text-decoration: none; color: inherit;">
                            <h2>Lista de Empleados</h2></a>
                                <!--contenedor con la barra de busqueda la cual con ayuda del controlador 
                                dependiendo de lo que se ingrese busca registros en la base de datos que
                                concuerden con ella-->
                                <div class="form-group">
                                    <form method="get" action="/search">
                                            <div class="input-group">
                                                <input class="form-control" name="search" placeholder="Buscar empleado" value="{{ isset($search) ? $search : '' }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                    </div>
                    <div class="card-body">
                        <!--aqui se hace una validacion con ayuda del controlador,
                        si al registrar un empleado la sesion es exitosa procedera
                        a mostrarse un mensaje de empleado añadido correctamente-->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <!--contenedor del boton añadir empleados, este te redirige
                        a su respectiva pagina create-->
                        <div class="d-flex"> 
                            <a href="{{ url('/empleados/create') }}" class="btn btn-success flex-grow-1" title="Añadir Nuevo Empleado"> Añadir Empleado</a>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <!--aqui esta declarada la barra con los valores del crud, es decir,
                                        id nombre apellido cargo y departamento. a su vez, estos con ayuda
                                        del controlador se pueden ordenar cada uno por orden ascendente o
                                        descendente. con el if se verifica la peticion en el controlador
                                        y dependiendo del orden que devuelva se muestra en la vista-->
                                        <th>
                                            <a href="{{ route('empleados.index', ['sort' => 'id', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                                ID
                                                @if (request()->get('sort') == 'id')
                                                    <span class="sort-arrow {{ request()->get('direction') == 'asc' ? 'asc' : 'desc' }}"></span>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('empleados.index', ['sort' => 'nombre', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                                Nombre
                                                @if (request()->get('sort') == 'nombre')
                                                    <span class="sort-arrow {{ request()->get('direction') == 'asc' ? 'asc' : 'desc' }}"></span>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('empleados.index', ['sort' => 'apellido', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                                Apellido
                                                @if (request()->get('sort') == 'apellido')
                                                    <span class="sort-arrow {{ request()->get('direction') == 'asc' ? 'asc' : 'desc' }}"></span>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('empleados.index', ['sort' => 'cargo', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                                Cargo
                                                @if (request()->get('sort') == 'cargo')
                                                    <span class="sort-arrow {{ request()->get('direction') == 'asc' ? 'asc' : 'desc' }}"></span>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('empleados.index', ['sort' => 'departamento', 'direction' => request()->get('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                                Departamento
                                                @if (request()->get('sort') == 'departamento')
                                                    <span class="sort-arrow {{ request()->get('direction') == 'asc' ? 'asc' : 'desc' }}"></span>
                                                @endif
                                            </a>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!--aqui lo que se hace es recorrer cada cada empleado de la
                                base de datos y mostrarlos en pantalla con su respectiva
                                informacion y respectivos botones de accion-->
                                @foreach($empleados as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->apellido }}</td>
                                        <td>{{ $item->cargo }}</td>
                                        <td>{{ $item->departamento }}</td>
                                        
                                        <td>
                                            <!--estos son los botones de ver y editar los cuales dependiendo
                                            del id del empleado seleccionado se puede ver o editar su informacion.
                                            estos te redirigen a sus respectivas paginas de show y edit-->
                                            <a href="{{ url('/empleados/' . $item->id) }}" title="Ver Empleado"><button class="btn btn-outline-secondary btn-sm"> Ver</button></a>
                                            <a href="{{ url('/empleados/' . $item->id . '/edit') }}" title="Editar Empleado"><button class="btn btn-outline-primary btn-sm"> Editar</button></a>
 
                                            <!--este es el boton de eliminar el cual tiene su respectivo
                                            mensaje de advertencia estas seguro de eliminar el usuario?
                                            al aceptar se procedera a eliminar al usuario de la base de
                                            datos de lo contrario al cancelar se conservara el registro-->
                                            <form method="POST" action="{{ url('/empleados' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar Empleado" onclick="return confirm('¿Estás seguro que deseas eliminar a este empleado?')"> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection