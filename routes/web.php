<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//en este archivo se colocan las rutas web de la aplicacion.

/*en este caso esta primera ruta definida permite que al ejecutar
el comando y servidor de laravel lo primero que se abra sea el
index del crud*/
Route::get('/', [EmpleadoController::class, 'index'])->name('empleados.index');
/*esta ruta permite devolver los sitios correspondientes al
controlador por ej ver, editar*/
Route::resource("/empleados",EmpleadoController::class);
/*esta ruta controla la busqueda que se realiza en el index*/
Route::get('/search',[EmpleadoController::class,'search']);