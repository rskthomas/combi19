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

Route::post('/', function () {
    
    return view('user.search',['popup' => 'true']);
} )
    ->name('homeredirect');

Route::get(
    '/profile/{user}',
    function (User $user) {

             return view('user.profile', ['user' => $user]);
    }
)   ->middleware('auth')
    ->name('profile');



//Routes for administrator with prefix /administrator
//example: combi19/administrator/altachofer


Route::group(['prefix' => 'administrator', 'middleware' => ['role:administrator']], function () {

    Route::get('altachofer', [RegisteredUserController::class, 'createChofer'])
        ->name('altachofer');

    Route::post('altachofer', [RegisteredUserController::class, 'storeChofer']);

    Route::get('listarchoferes', [ChoferesController::class, 'listarChoferes'])
        ->name('listarchoferes');
    
    Route::get('eliminarchofer/{user}',function (User $user) {
    
        return ChoferesController::eliminarChofer($user);
    } )   ->middleware('auth')
->name('eliminar');

});



//Routes for Choferes
Route::group(['prefix' => 'chofer', 'middleware' => ['role:chofer']], function () {
});


Route::get('editarusuario/{user}', function(User $user){
    if (($user->id ==  Auth::user()->id) or (Auth::user()-> hasRole('administrator')) ){
    return view('user.modificarperfil',['user'=>$user]);
    }
    else {
        echo "NO TIENE PERMISO PARA ACCEDER A ESTA PAGINA";
    }
})->name ('edit');

Route::put('editarusuarios', [UsuariosController::class ,'modificarUsuario'])-> name('editarusuarios');