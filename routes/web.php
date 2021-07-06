<?php

//this line below imports routes from auth.php
require __DIR__ . '/auth.php';

use App\Models\Comentario;
use App\Models\Producto;
use App\Models\Role;
use App\Models\Ruta;
use App\Models\User;
use App\Models\Combi;
use App\Models\Lugar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\CombiController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\ChoferesController;
use App\Http\Controllers\Auth\UsuariosController;
use App\Http\Controllers\Auth\RegisteredUserController;

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
// -------------Home----------------


Route::name('home')
    ->prefix('/')
    ->group(function () {

        //--------------------------Home for all users----------------------------------------------------//
        Route::get('/', 'HomeController@create');

        //--------------------------autocomplete API----------------------------------------------------//
        Route::get('api/lugares/find', 'HomeController@getAutocompleteData')
            ->name('.autocomplete');
    });


//----------------Rutas para todos los usuarios--------------------


Route::name('user.')
    ->prefix('/user')
    ->middleware('role:administrator')
    ->group(function () {

        //-----------------------------------------------------//
        Route::get('/bloqueados', 'UsuariosController@getBloqueados')
            ->name('bloqueados');
        //--------------------------perfil----------------------------------------------------//
        Route::get('/{user}', 'UsuariosController@show')
            ->name('info')
            ->withoutMiddleware('role:administrator')
            ->middleware('auth');

        //-----------------------------------------------------//
        Route::get('/{user}/edit', 'UsuariosController@edit')
            ->name('edit');

        //-----------------------------------------------------//
        Route::put('/update', 'UsuariosController@update')
            ->name('update');

        //--------------------------perfil----------------------------------------------------//
        Route::get('/{user}/viajes', 'UsuariosController@misViajes')
            ->name('viajes')
            ->withoutMiddleware('role:administrator')
            ->middleware('auth');
    });








//-----------------------COMBI-------------------------------
Route::name('combi.')
    ->prefix('/combi')
    ->middleware('role:administrator')
    ->group(function () {

        //-----------------------------------------------------//
        Route::get('/alta', 'CombiController@create')
            ->name('new');

        //-----------------------------------------------------//
        Route::post('/alta/store', 'CombiController@store')
            ->name('store');;

        //-----------------------------------------------------//
        Route::get('/listar', 'CombiController@index')
            ->name('listar');

        //-----------------------------------------------------//
        Route::get('/{combi}', 'CombiController@show')
            ->name('info')
            ->withoutMiddleware('role:administrator')
            ->middleware('auth');

        //-----------------------------------------------------//
        Route::get('/{combi}/edit', 'CombiController@edit')
            ->name('edit');

        //-----------------------------------------------------//
        Route::put('/{combi}/update', 'CombiController@update')
            ->name('update');

        //-----------------------------------------------------//
        Route::delete('/{combi}/delete', 'CombiController@destroy')
            ->name('delete');
    });

//Rutas para los viajeros

//----------------COMENTARIOS---------------------

Route::name('comentario.')
    ->prefix('/comentario')
    ->group(function () {

        //-------------------------------------------------------------//
        Route::get('/alta', 'ComentarioController@create')
            ->name('create')
            ->middleware('role:user');

        //------------------------------------------------------------//

        Route::post('/alta/store', 'ComentarioController@store')
            ->name('store')
            ->middleware('role:user');


        //------------------------------------------------------------//
        Route::get('/listar', 'ComentarioController@index')
            ->middleware('auth')
            ->name('index');

        //-------------------------------------------------------------//
        Route::get('/{comentario}', 'ComentarioController@show')
            ->name('info');

        //-------------------------------------------------------------------------------------//
        Route::delete('{comentario}/delete', 'ComentarioController@destroy')
            ->middleware('auth')
            ->name('delete');


        //-------------------------------------------------------------------------------------//
        Route::get('{comentario}/edit', 'ComentarioController@edit')
            ->name('edit');

        //-------------------------------------------------------------------------------------//
        Route::put('{comentario}/update', 'ComentarioController@update')
            ->name('update');
    });

//Rutas para los choferes

Route::name('chofer.')
    ->prefix('/chofer')
    ->middleware('role:administrator')
    ->group(function () {

        //-----------------------------------------------------//
        Route::get('/alta', 'ChoferesController@create')
            ->name('create');

        //-----------------------------------------------------//
        Route::post('/alta/store', 'ChoferesController@store')
            ->name('store');;

        //-----------------------------------------------------//
        Route::get('/listar', 'ChoferesController@index')
            ->name('index');

        //-----------------------------------------------------//
        Route::get('/{chofer}/edit', 'ChoferesController@edit')
            ->name('edit');

        //-----------------------------------------------------//
        Route::put('/{chofer}/update', 'UsuariosController@update')
            ->name('update');

        //-----------------------------------------------------//
        Route::delete('/{chofer}/delete', 'ChoferesController@destroy')
            ->name('delete');

        Route::get('/log', 'ChoferesController@logviajes')
            ->withoutMiddleware('role:administrator')
            ->name('log');
    });



//Routes for administrator with prefix /administrator
//example: combi19/administrator/altachofer

//----------------LUGARES---------------------
Route::name('lugar.')
    ->prefix('/lugar')
    ->middleware('role:administrator')
    ->group(function () {

        //-------------------------------------------------------------//
        Route::get('/alta', 'LugarController@create')
            ->name('create');

        //------------------------------------------------------------//

        Route::post('/alta/store', 'LugarController@store')
            ->name('store');


        //------------------------------------------------------------//
        Route::get('/listar', 'LugarController@index')
            ->name('index');

        //-------------------------------------------------------------//
        Route::get('/{lugar}', 'LugarController@show')
            ->name('info');

        //-------------------------------------------------------------------------------------//
        Route::delete('{lugar}/delete', 'LugarController@destroy')
            ->name('delete');


        //-------------------------------------------------------------------------------------//
        Route::get('{lugar}/edit', 'LugarController@edit')
            ->name('edit');

        //-------------------------------------------------------------------------------------//
        Route::put('{lugar}/update', 'LugarController@update')
            ->name('update');
    });




//-----------------RUTAS------------------------
Route::name('ruta.')
    ->prefix('/ruta')
    ->middleware('role:administrator')
    ->group(function () {


        //-------------------------------------------------------------------------------------//
        Route::get('/alta', 'RutaController@create')
            ->name('create');


        //-------------------------------------------------------------------------------------//
        Route::post('/alta/store', 'RutaController@store')
            ->name('store');



        //-------------------------------------------------------------------------------------//
        Route::get('/listar', 'RutaController@index')
            ->name('index');



        //-------------------------------------------------------------------------------------//
        Route::get('/{ruta}', 'RutaController@show')
            ->name('info')
            ->withoutMiddleware('role:administrator');



        //-------------------------------------------------------------------------------------//
        Route::delete('{ruta}/delete', 'RutaController@destroy')
            ->name('delete');



        //-------------------------------------------------------------------------------------//
        Route::get('{ruta}/edit', 'RutaController@edit')
            ->name('edit');



        //-------------------------------------------------------------------------------------//
        Route::put('{ruta}/update', [RutaController::class, 'update'])->name('update');
    });


//-----------------VIAJES------------------------
Route::name('viaje.')
    ->prefix('/viaje')
    ->middleware('role:administrator')
    ->group(function () {


        //-------------------------------------------------------------------------------------//
        Route::get('/alta', 'ViajeController@create')
            ->name('create');
        //-------------------------------------------------------------------------------------//
        Route::post('/alta/store', 'ViajeController@store')
            ->name('store');


        //-------------------------------------------------------------------------------------//
        Route::get('/listar', 'ViajeController@index')
            ->name('index')
            ->withoutMiddleware('role:administrator');



        //-------------------------------------------------------------------------------------//
        Route::get('/{viaje}', 'ViajeController@show')
            ->name('info')
            ->withoutMiddleware('role:administrator');



        //-----------------------------  Busqueda de viajes  --------------------------------//

        Route::post('/busqueda', 'ViajeController@search')
            ->name('search')
            ->withoutMiddleware('role:administrator');




        //-------------------------------------------------------------------------------------//
        Route::delete('{viaje}/delete', 'ViajeController@destroy')
            ->name('delete');

        //-------------------------------------------------------------------------------------//
        Route::get('{viaje}/iniciar', 'ViajeController@getIniciar')
            ->name('iniciar')
            ->withoutmiddleware('role:administrator')
            ->middleware('role:chofer');
        ///------------------------------------------------------------------------//
        Route::get('{viaje}/finalizar', 'ViajeController@finalizar')
            ->name('finalizar')
            ->withoutmiddleware('role:administrator')
            ->middleware('role:chofer');

        /////------------------------------------------------------------------------//
        Route::get('{viaje}/cancelar', 'ViajeController@cancelar')
            ->name('cancelar')
            ->withoutmiddleware('role:administrator');


        //-------------------------------------------------------------------------------------//
        Route::get('{viaje}/edit', 'ViajeController@edit')
            ->name('edit');



        //-------------------------------------------------------------------------------------//
        Route::put('{viaje}/update', [ViajeController::class, 'update'])->name('update');

        //-------------------------------------------------------------------------------------//
        Route::put('{viaje}/iniciar', 'ViajeController@iniciar')
            ->name('iniciar')
            ->withoutmiddleware('role:administrator')
            ->middleware('role:chofer');
    });


//----------------PRODUCTOS---------------------
Route::name('producto.')
    ->prefix('/producto')
    ->middleware('role:administrator')
    ->group(function () {

        //-------------------------------------------------------------//
        Route::get('/alta', 'ProductoController@create')
            ->name('create');

        //------------------------------------------------------------//

        Route::post('/alta/store', 'ProductoController@store')
            ->name('store');


        //------------------------------------------------------------//
        Route::get('/listar', 'ProductoController@index')
            ->name('index');

        //-------------------------------------------------------------//
        Route::get('/{producto}', 'ProductoController@show')
            ->name('info');

        //-------------------------------------------------------------------------------------//
        Route::delete('{producto}/delete', 'ProductoController@destroy')
            ->name('delete');


        //-------------------------------------------------------------------------------------//
        Route::get('{producto}/edit', 'ProductoController@edit')
            ->name('edit');

        //-------------------------------------------------------------------------------------//
        Route::put('{producto}/update', 'ProductoController@update')
            ->name('update');
    });

//----------------PASAJES---------------------

Route::name('pasaje.')
    ->prefix('/pasaje')
    ->middleware('auth')
    ->group(function () {


        //-------------------------------------------------------------------------------------//
        Route::get('/alta/{viaje}', 'PasajeController@create')
            ->name('create')
            ->withoutMiddleware('role:administrator');


        //-------------------------------------------------------------------------------------//
        Route::post('/alta/store/{viaje}', 'PasajeController@store')
            ->name('store');


        //-------------------------------------------------------------------------------------//
        Route::get('/listar', 'PasajeController@index')
            ->name('index');



        //-------------------------------------------------------------------------------------//
        Route::get('/{pasaje}', 'PasajeController@show')
            ->name('info');



        //-------------------------------------------------------------------------------------//
        Route::delete('{pasaje}/delete', 'PasajeController@destroy')
            ->name('delete');



        //-------------------------------------------------------------------------------------//
        Route::get('{pasaje}/edit', 'PasajeController@edit')
            ->name('edit')
            ->middleware('role:administrator');


        //-------------------------------------------------------------------------------------//
        Route::put('{pasaje}/update', [PasajeController::class, 'update'])->name('update');

        //-------------------------------------------------------------------------------------//
        Route::get('/{pasaje}/cuestionario', 'PasajeController@getCuestionario')
            ->name('cuestionario')
            ->withoutMiddleware('role:chofer');

        //-------------------------------------------------------------------------------------//
        Route::post('/{pasaje}/subir', 'PasajeController@subir')
            ->name('subir');

        //-------------------------------------------------------------------------------------//
        Route::post('/{pasaje}/ausente', 'PasajeController@ausente')
            ->name('ausente');

        //-------------------------------------------------------------------------------------//
        Route::get('/{pasaje}/vianda', 'PasajeController@showVianda')
            ->name('vianda')
            ->middleware('role:chofer');
    });

//--------------TARJETA-------------------



Route::name('tarjeta.')
    ->prefix('/tarjeta')
    ->group(function () {




        //-------------------------------------------------------------------------------------//
        Route::get('/alta', 'TarjetaController@create')
            ->name('create');
        //-------------------------------------------------------------------------------------//
        Route::post('/alta/store', 'TarjetaController@store')
            ->name('store');


        //-------------------------------------------------------------------------------------//
        Route::put('{viaje}/update', [ViajeController::class, 'update'])->name('update');



        //-------------------------------------------------------------------------------------//

        Route::get('/alta', 'TarjetaController@create')
            ->name('create');
        //-------------------------------------------------------------------------------------//
        Route::post('/alta/store', 'TarjetaController@store')
            ->name('store');
    });
