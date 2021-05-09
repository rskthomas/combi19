<?php

//this line below imports routes from auth.php
require __DIR__ . '/auth.php';

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoferesController;
use App\Http\Controllers\Auth\UsuariosController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CombiController;
use App\Models\Combi;

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

Route::get('/', 'HomeController@create')
    ->name('home');


Route::get(
    '/profile/{user}',
    function (User $user) {

        return view('user.profile', ['user' => $user]);
    }
)->middleware('auth')
    ->name('profile');




Route::name('combi.')
     ->prefix('/combi/{combi}')
     ->middleware('role:administrator')
     ->group(function () {

        //-----------------------------------------------------//
        Route::get('/','CombiController@get')
        ->name('info')
        ->withoutMiddleware('role:administrator');

        //-----------------------------------------------------//
        Route::get('/edit','CombiController@edit')
        ->name('edit');
        //-----------------------------------------------------//

        Route::put('/update', 'CombiController@update')
        ->name('update');


    });




//Routes for administrator with prefix /administrator
//example: combi19/administrator/altachofer


Route::group(['prefix' => 'administrator', 'middleware' => ['role:administrator']], function () {

    //---------------------routes for altachofer
    Route::get('altachofer', [RegisteredUserController::class, 'createChofer'])
        ->name('altachofer');

    Route::post('altachofer', [RegisteredUserController::class, 'storeChofer']);

    Route::get('listarchoferes', [ChoferesController::class, 'listarChoferes'])
        ->name('listarchoferes');

    Route::get('eliminarchofer/{user}', function (User $user) {

        return ChoferesController::eliminarChofer($user);
    })->middleware('auth')
        ->name('eliminar');

    //---------------------routes for combis
    Route::get('altacombi', [CombiController::class, 'createCombi'])
        ->name('altacombi');

    Route::post('altacombi', [CombiController::class, 'store']);

    Route::get('listarcombis', [CombiController::class, 'listarCombis'])
        ->name('listarcombis');


});


//Routes for Choferes
Route::group(['prefix' => 'chofer', 'middleware' => ['role:chofer']], function () {
});


Route::get('editarusuario/{user}', function (User $user) {
    if (($user->id ==  Auth::user()->id) or (Auth::user()->hasRole('administrator'))) {
        return view('user.modificarperfil', ['user' => $user]);
    } else {
        echo "NO TIENE PERMISO PARA ACCEDER A ESTA PAGINA";
    }
})->name('edit');

Route::put('editarusuarios', [UsuariosController::class, 'modificarUsuario'])->name('editarusuarios');
