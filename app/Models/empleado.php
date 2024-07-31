<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*este archivo es un modelo llamado empleado el cual sirve como una
representación de una tabla de la base de datos. se pudiera decir
que un modelo es el puente o conexion entre el php y la tabla en
este caso empleados de la base de datos*/

class empleado extends Model
{
    /*aqui se esta asignando el nombre de la tabla, su llave primaria
    el cual es el id y el resto de los valores siendo fillable lo que
    quiere decir que se podran rellenar futuramente con el programa*/
    protected $table='empleados';
    protected $tprimaryKey='id';
    protected $fillable=[
        'nombre',
        'apellido',
        'cargo',
        'departamento'
        ];
    
    use HasFactory;
}