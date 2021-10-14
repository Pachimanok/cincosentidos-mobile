<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



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
    $role = $user->role;
    $message = session('message');
    
       
    if($role == 'user'){

        $qfacturacion = db::table('facturacions')->where('user','=',$name)->get()->count();
        $pedidos = db::table('pedidos')->where('user','=',$name)->where('estado','!=','comprando')->take(5)->get();
        $qp = $pedidos->count();
        $detalle = db::table('detallepedidos')->join('products', 'detallepedidos.id_producto','=','products.id')->select('detallepedidos.*','products.sub_titulo')->where('detallepedidos.user','=',$name)    ->get();
        
        
        if($qfacturacion == 0){

            return view('facturacion')->with('user', $name);
        }

        return view('home')->with('name', $name)->with('email', $email)->with('pedidos', $pedidos)->with('qp', $qp)->with('detalles', $detalle)->with('message', $message);

    }else{

        $pNuevos = db::table('pedidos')
        ->where('estado','=','comprado')->orderBy('created_at', 'DESC')->take(5)->get();
        $qnuevos = db::table('pedidos')
        ->where('estado','=','comprado')->count();

        $pFacturados = db::table('pedidos')
        ->where('estado','=','facturado')->orderBy('created_at', 'DESC')->take(5)->get();
        $qfacturados = db::table('pedidos')
        ->where('estado','=','facturado')->count();

        $pEnviados = db::table('pedidos')
        ->where('estado','=','enviado')->orderBy('created_at', 'DESC')->take(5)->get();
        $qenviados = db::table('pedidos')
        ->where('estado','=','enviado')->orderBy('created_at', 'DESC')->count();
        
        $pComprando = db::table('pedidos')
        ->where('estado','=','comprando')->orderBy('created_at', 'DESC')->take(5)->get();
        $qcomprando= db::table('pedidos')
        ->where('estado','=','comprando')->count();

        $pDespacho = db::table('pedidos')
        ->where('estado','=','SolicitadoDespacho')->orderBy('created_at', 'DESC')->take(5)->get();
        $qdespacho= db::table('pedidos')
        ->where('estado','=','SolicitadoDespacho')->count();
        
        
        $detalle = db::table('detallepedidos')->select('id_pedido','cantidad', 'producto')->get();
     


        return view('admin.home')->with('user', $user)
        ->with('pedidosNuevos', $pNuevos)
        ->with('qnuevos', $qnuevos)
        ->with('pedidosFacturados', $pFacturados)
        ->with('qfacturados', $qfacturados)
        ->with('pedidosEnviados', $pEnviados)
        ->with('qenviados', $qenviados)
        ->with('pedidosComprando', $pComprando)
        ->with('qcomprando', $qcomprando)
        ->with('pedidosDespacho', $pDespacho)
        ->with('qdespacho', $qdespacho)        
        ->with('detalles', $detalle);
        

    }
    

})->middleware('auth');

Route::resource('catalogo', 'App\Http\Controllers\productoController');
Route::resource('pedido', 'App\Http\Controllers\pedidoContoller');
Route::resource('facturacion', 'App\Http\Controllers\facturacionController');
Route::resource('direccion', 'App\Http\Controllers\direccionController');
Route::resource('mp', 'App\Http\Controllers\mpController');
Route::resource('adminPedido', 'App\Http\Controllers\adminPedidoController');
Route::resource('usuarios', 'App\Http\Controllers\usuariosController');
Route::resource('imprimir', 'App\Http\Controllers\imprimirController');









