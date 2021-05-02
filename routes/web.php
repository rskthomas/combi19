<?php

use App\Http\Controllers\ChoferesController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/registerChofer',[RegisteredUserController::class, 'createChofer'])
    ->name('registerChofer');
    Route::post('/registerChofer', [RegisteredUserController::class, 'storeChofer']);


/*
//Routes for administrator
Route::group(['prefix' => 'administrator', 'middleware' => ['role:administrator']], function () {
    Route::get('/registerChofer',[RegisteredUserController::class, 'createChofer'])
    ->name('registerChofer');
    Route::post('/registerChofer', [RegisteredUserController::class, 'storeChofer']);
});*/

//Routes for Choferes

Route::get('/listarChoferes',[ChoferesController::class,'listarChoferes']);

Route::group(['prefix' => 'administrator', 'middleware' => ['role:administrator']], function () {
    Route::get('/', 'AdminController@welcome');
    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
