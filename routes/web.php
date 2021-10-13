<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/home', function () {
    $user = Auth::user();
    $name = $user->name;
    $email = $user->email;

    return view('home')->with('name', $name)->with('email', $email);

})->middleware('auth');

Route::resource('catalogo', 'App\Http\Controllers\productoController');
Route::resource('pedido', 'App\Http\Controllers\pedidoContoller');
