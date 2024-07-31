<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleado;

/*este archivo es el controlador el cual se pudiera decir
que actua como intermediario entre las peticiones recibidas
y la base de datos o vistas del crud. por ej cuando se selecciona
ver empleados el controlador busca el empleado con el id seleccionado
y procede a reenviarlo a la vista show con sus respectivos datos*/

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*este es controlador del index del crud y aqui se esta validando
        el order by el cual dependiendo del valor que obtenga es decir
        ascendente o descendente lo devolvera y mostrara en el index
        con su respectivo orden*/
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
    
        $empleados = empleado::orderBy($sort, $direction)->get();
    
        return view('empleados.index', compact('empleados', 'sort', 'direction'));
    
    }

    public function search(Request $request)
    {
        /*este es el controlador de la busqueda, aqui dependiendo del
        valor ingresado se busca o comparara con cada dato almacenado
        en cada uno de los campos de la base de datos y luego devuelve 
        en el mismo index el registro que contenga los datos buscados*/
        $search = $request->search;

        $empleados = empleado::where(function($query) use ($search){

            $query->where('id','like',"%$search%")
            ->orWhere('nombre','like',"%$search%")
            ->orWhere('apellido','like',"%$search%")
            ->orWhere('cargo','like',"%$search%")
            ->orWhere('departamento','like',"%$search%");

        })

        ->get();

        return view('empleados.index',compact('empleados','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*este es el controlador de crear el cual te redirige a la
        vista de crear empleado*/
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*este es el controlador encargado de almacenar los datos en
        la base de datos el cual te permite crear un empleado. este 
        valida si estas ingresando todos los datos necesarios, el required
        hace referencia a que todos los campos deben ser llenados obligatoriamente.
        luego con el if se hace la verificacion, si alguno de esos campos esta vacio
        enviara el error al archivo create y no permitira la creacion del registro
        redirigiendote a la misma vista create pero ahora con los respectivos mensajes
        de error. de lo contrario si todo esta bien, se procedera a redirigirse al index 
        mostrando el mensaje de empleado añadido correctamente*/
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cargo' => 'required',
            'departamento' => 'required',
        ]);
        if ($request->has('errors')) {
        return redirect()->back()->withErrors($request->all());
        }
        $input=$request->all();
        empleado::create($input);
        session()->flash('success', 'Empleado añadido correctamente');
        return redirect('empleados');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*este es el controlador de ver el cual te redirige a su
        respectiva vista llamada show y muestra dependiendo del
        id la informacion de ese empleado en especifico que se 
        encuentra almacenada en la base de datos*/
        $empleados=empleado::find($id);
        return view('empleados.show')->with('empleados',$empleados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*este es el controlador de editar el cual te redirige a la
        vista de view el cual dependiendo de su id te permite editar
        la informacion de ese empleado en especifico*/
        $empleados=empleado::find($id);
        return view('empleados.edit')->with('empleados',$empleados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*este es el controlador de actualizar el cual dependiendo del id
        te permite editar la informacion de ese empleado en especifico. a su
        vez, asi como ocurre con el store este valida si estas ingresando todos
        los datos necesarios haciendo la verificacion con el if, si alguno de esos
        campos esta vacio enviara el error al archivo edit y no permitira la actualizacion
        del registro redirigiendote a la misma vista edit pero ahora con sus mensajes de
        error. de lo contrario si todo esta bien, se procedera a redirigirse al index teniendo
        al empleado actualizado*/
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cargo' => 'required',
            'departamento' => 'required',
        ]);
        if ($request->has('errors')) {
            return redirect()->back()->withErrors($request->all());
        }
        $empleados=empleado::find($id);
        $input=$request->all();
        $empleados->update($input);
        return redirect('empleados')->with('flash_message','Empleado Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*este es el controlador de eliminar el cual dependiendo del
        id elimina a ese empleado de la base de datos redirigiendo
        nuevamente al index del crud actualizado*/
        empleado::destroy($id);
        return redirect('empleados')->with('flash_message','Empleado Eliminado');
    }
}