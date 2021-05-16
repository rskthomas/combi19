<?php

//this line below imports routes from auth.php
require __DIR__ . '/auth.php';

use App\Models\Role;
use App\Models\ruta;
use App\Models\User;
use App\Models\Combi;
use App\Models\Lugar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\CombiController;
use App\Http\Controllers\LugarController;
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
Route::get('/', 'HomeController@create')
    ->name('home');

Route::post('/', function () {

    return view('user.search', ['popup' => 'true']);
})
    ->name('homeredirect');


//----------------Rutas para todos los usuarios--------------------
Route::get(
    '/profile/{user}',
    function (User $user) {

        return view('user.profile', ['user' => $user]);
    }
)->middleware('auth')
    ->name('profile');


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
        Route::get('/{combi}','CombiController@show')
        ->name('info')
        ->withoutMiddleware('role:administrator');

        //-----------------------------------------------------//
        Route::get('/{combi}/edit','CombiController@edit')
        ->name('edit');

        //-----------------------------------------------------//
        Route::put('/{combi}/update', 'CombiController@update')
        ->name('update');

        //-----------------------------------------------------//
        Route::delete('/{combi}/delete', 'CombiController@destroy')
        ->name('delete');

    });

    //Rutas para los choferes





//Routes for administrator with prefix /administrator
//example: combi19/administrator/altachofer

//----------------------RUTAS ADMINISTRADOR------------------------------------
Route::group(['prefix' => 'administrator', 'middleware' => ['role:administrator']], function () {

    //--------------------- rutas para administrar choferes
    Route::get('altachofer', [ChoferesController::class, 'create'])
        ->name('altachofer');

    Route::post('altachofer', [ChoferesController::class, 'store']);

    Route::get('listarchoferes', [ChoferesController::class, 'index'])
        ->name('listarchoferes');

    Route::get('eliminarchofer/{user}', function (User $user) {

        return ChoferesController::destroy($user);
    })->name('eliminar');


    //-------------------rutas para administrar lugares-----------------
    Route::get('altalugar', [LugarController::class, 'create'])->name('altalugar');
    Route::post('altalugar', [LugarController::class, 'store']);
    Route::get('listarlugares', [LugarController::class, 'show'])
    ->name('listarlugares');


    Route::get('infolugar/{lugar}', function (Lugar $lugar) {

        return view('lugar.infoLugar',['lugar' => $lugar]);
    })->name('infolugar');



    //----------------rutas para administrar Rutas-----

    Route::get('altaruta', [RutaController::class, 'create'])->name('altaruta');
    Route::post('altaruta', [RutaController::class, 'store']);

    Route::get('listarrutas', [RutaController::class, 'show'])
        ->name('listarrutas');



    Route::get(
        '/inforuta/{ruta}',
        function (ruta $ruta) {

            return view('rutas.info', ['ruta' => $ruta]);
        }
    )->middleware('auth')
        ->name('inforuta');


    Route::get('eliminarruta/{ruta}', function (ruta $ruta) {

        return RutaController::destroy($ruta);
    })->middleware('auth')
        ->name('eliminarruta');

    Route::get('editarruta/{ruta}', function (ruta $ruta) {
        return RutaController::edit($ruta);

    })->name('editarruta');

    Route::put('editarruta', [RutaController::class, 'update'])->name('updateruta');


    //---------------------rutas para administrar combis
    Route::get('altacombi', [CombiController::class, 'createCombi'])
        ->name('altacombi');

    Route::post('altacombi', [CombiController::class, 'store']);

    Route::get('listarcombis', [CombiController::class, 'listarCombis'])
        ->name('listarcombis');
});



//-----------------------Routes for Choferes--------------------------
Route::group(['prefix' => 'chofer', 'middleware' => ['role:chofer']], function () {
});


Route::get('editarusuario/{user}', function (User $user) {
    if (($user->id ==  Auth::user()->id) or (Auth::user()->hasRole('administrator'))) {
        return view('user.modificarperfil', ['user' => $user]);
    } else {
        echo "NO TIENE PERMISO PARA ACCEDER A ESTA PAGINA";
    }
})->name('edit');

Route::put('editarusuarios', [UsuariosController::class, 'update'])->name('editarusuarios');

