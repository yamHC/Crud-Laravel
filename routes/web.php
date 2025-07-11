<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
# ----- LLamamos al controlador EmpleadoController -----
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('auth.login');
});


/* ------ Rutas de Empleados ------ */

/* Route::get('/index', function () {
    return view('empleado.index');
    });

    Route::get('/form', function () {
        return view('empleado.form');
    });

    Route::get('/edit', function () {
        return view('empleado.edit');
    });
*/
Route::resource('empleado',EmpleadoController::class)->middleware('auth'); # mejor asi para obtener todas las funciones del controlador de empleados


Auth::routes();

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');

});


