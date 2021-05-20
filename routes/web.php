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
        Route::get('/{chofer}','ChoferesController@show')
        ->name('info')
        ->withoutMiddleware('role:administrator');

        //-----------------------------------------------------//
        Route::get('/{chofer}/edit','ChoferesController@edit')
        ->name('edit');

        //-----------------------------------------------------//
        Route::put('/{chofer}/update', 'UsuariosController@update')
        ->name('update');

        //-----------------------------------------------------//
        Route::delete('/{chofer}/delete', 'ChoferesController@destroy')
        ->name('delete');

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
    Route::get('/info', 'LugarController@show')
   ->name('infolugar');

});




//-----------------RUTAS------------------------
Route::name('ruta.')
->prefix('/ruta')
->middleware('role:administrator')
->group(function () {


    //-------------------------------------------------------------------------------------//
    Route::get('/alta', [RutaController::class, 'create'])
    ->name('create');
    
    
    //-------------------------------------------------------------------------------------//
    Route::post('/alta/store', [RutaController::class, 'store'])
    ->name('store');


    
    //-------------------------------------------------------------------------------------//
    Route::get('/listar', [RutaController::class, 'index'])
        ->name('index');



    //-------------------------------------------------------------------------------------//
    Route::get( '/{ruta}', 'RutaController@show')
        ->name('info');


    
    //-------------------------------------------------------------------------------------//
    Route::get('{ruta}/delete', 'RutaController@destroy')
        ->name('delete');


    
    //-------------------------------------------------------------------------------------//
    Route::get('{ruta}/edit', 'RutaController@edit')
    ->name('edit');


    
    //-------------------------------------------------------------------------------------//
    Route::put('{ruta}/update', [RutaController::class, 'update'])->name('update');



});




//----------------------RUTAS ADMINISTRADOR------------------------------------
Route::group(['prefix' => 'administrator', 'middleware' => ['role:administrator']], function () {

    //--------------------- rutas para administrar choferes

    Route::get('eliminarchofer/{user}', function (User $user) {

        return ChoferesController::destroy($user);
    })->name('eliminar');


//----------------rutas para administrar Rutas-----




    //---------------------rutas para administrar combis
    Route::get('altacombi', [CombiController::class, 'createCombi'])
        ->name('altacombi');

    Route::post('altacombi', [CombiController::class, 'store']);

    Route::get('listarcombis', [CombiController::class, 'listarCombis'])
        ->name('listarcombis');
});





Route::get('editarusuario/{user}', [UsuariosController::class, 'edit'])
        ->name('user.edit');


Route::put('editarusuarios', [UsuariosController::class, 'update'])->name('editarusuarios');

