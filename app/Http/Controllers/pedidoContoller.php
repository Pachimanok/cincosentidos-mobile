<?php

namespace App\Http\Controllers;

use App\Mail\pedidoNuevo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\pedido;
use App\Models\detallepedido;
use App\Models\Facturacion;
use App\Models\Direccion;
use Illuminate\Support\Facades\Mail;

class pedidoContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user != null) {

            $u = $user->name;
            $d = $user->descuento;
            $dto = 1 - $d;

            $pedido = new pedido();
            $pedido->user = $u;
            $pedido->save();

            $id_pedido = pedido::latest('id')->first();
            $id_p = $id_pedido->id;

            foreach ($request->get('cantidad') as $idart => $cantidad) {

                $catalogo = db::table('products')->where('id', '=', $idart)->get();
                $cat = $catalogo[0];
                $prod = $cat->titulo;
                $id_producto = $cat->id;
                $px = $cat->precio;
                $pf = $px * $dto * $cantidad;

                if ($cantidad >= 1) {
                    if ($cantidad >= 1) {
                        $detpedido = new detallepedido();
                        $detpedido->id_pedido = $id_p;
                        $detpedido->cantidad = $cantidad;
                        $detpedido->producto = $prod;
                        $detpedido->id_producto = $id_producto;
                        $detpedido->precio = $pf;
                        $detpedido->user = $u;
                        $detpedido->save();
                    }
                }
            }
           


            /* detalle pedido */
            $detalle = db::table('detallepedidos')->where('id_pedido', '=', $id_p)->get();
            $total = $detalle->sum('precio');

            /* total a pagar */
            $qpx = db::table('pedidos')->where('id', '=', $id_p)->get();
            $precio = $qpx[0];
            $px = $precio->total;
            $id = $precio->id;

            $pedido = pedido::find($id_p);
            $pedido->total = $total;
            $pedido->estado = 'comprando';
            $pedido->save();

            $facturacion = db::table('facturacions')->where('user', '=', $u)->get();
            $direccion = db::table('direccions')->where('user', '=', $u)->get();
            $mail = Mail::to('manuval@finca-algarve.com.ar')->send(new pedidoNuevo($pedido)); 


            return view('resumen')->with('detalle', $detalle)->with('precio', $total)->with('id', $id)->with('facturacion', $facturacion)->with('direccion', $direccion);

        } else {

            $u = $request->user;
            $dto = $request->dto;

            $pedido = new pedido();
            $pedido->user = $u;
            $pedido->save();

            $id_pedido = pedido::latest('id')->first();
            $id_p = $id_pedido->id;
            return $id_p;

            foreach ($request->get('cantidad') as $idart => $cantidad) {

                $catalogo = db::table('products')->where('id', '=', $idart)->get();
                $cat = $catalogo[0];
                $prod = $cat->titulo;
                $id_producto = $cat->id;
                $px = $cat->precio;
                $pf = $px * $dto * $cantidad;

                if ($cantidad >= 1) {
                    if ($cantidad >= 1) {
                        $detpedido = new detallepedido();
                        $detpedido->id_pedido = $id_p;
                        $detpedido->cantidad = $cantidad;
                        $detpedido->producto = $prod;
                        $detpedido->id_producto = $id_producto;
                        $detpedido->precio = $pf;
                        $detpedido->user = $u;
                        $detpedido->save();
                    }
                }
            }
            /* detalle pedido */
            $detalle = db::table('detallepedidos')->where('id_pedido', '=', $id_p)->get();
            $total = $detalle->sum('precio');

            /* total a pagar */
            $qpx = db::table('pedidos')->where('id', '=', $id_p)->get();
            $precio = $qpx[0];
            $px = $precio->total;
            $id = $precio->id;

            $pedido = pedido::find($id_p);
            $pedido->total = $total;
            $pedido->estado = 'comprando';
            $pedido->save();

            $mail = Mail::to('manuval@finca-algarve.com.ar')->send(new pedidoNuevo($pedido));

            return view('resumenCompraUnica')->with('detalle', $detalle)->with('precio', $total)->with('id', $id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* 1. traemos la informacion del pedido previamente realizado */
        /* 1.a revisamos que esté en stock  */
        /* 1.b Revisamos si hay faltantes para comunicar  */
        /* 1.c compromamos le precio actual  */

        $qpedido = db::table('detallepedidos')->join('products', 'detallepedidos.id_producto', '=', 'products.id')->select('detallepedidos.cantidad', 'detallepedidos.id_producto', 'products.sub_titulo', 'products.titulo', 'products.precio', 'products.imagen')->where('detallepedidos.id_pedido', '=', $id)->where('products.stock', '=', 'si')->get();
        $qpedidoNo = db::table('detallepedidos')->join('products', 'detallepedidos.id_producto', '=', 'products.id')->select('detallepedidos.cantidad', 'detallepedidos.id_producto', 'products.sub_titulo', 'products.titulo', 'products.precio', 'products.imagen')->where('detallepedidos.id_pedido', '=', $id)->where('products.stock', '=', 'no')->get();
        $suma = db::table('detallepedidos')->join('products', 'detallepedidos.id_producto', '=', 'products.id')->select(db::raw('sum(products.precio * detallepedidos.cantidad) as sumado'))->where('detallepedidos.id_pedido', '=', $id)->where('products.stock', '=', 'si')->get();
        $qtotal = $suma[0]->sumado;
        
        /* 2. Armamos el mensaje para la vista */

        $faltantes = array();
        
        foreach ($qpedidoNo as $faltante) {
            $faltantes[] = $faltante->titulo . ' ' . $faltante->sub_titulo;
        }
        
        /* 3. Armamos el nuevo pedido */
        /* 3.a Datos del Usuario */
        /* 3.b calulamos el descuento y se lo aplicamos al precio final */
        /* 3.c armamos un nuevo pedido */
        /* 3.d buscamos el ultimo pedido generado en la DB */
        /* 3.e revisamos que haya por lo menos 1 item para mostrar */
        /* 3.f guardamos la solicitud en la DB */
        /* 3.g Buscamos los datos de facturacion y direccion */
        /* 3.h enviamos a la vista las variables */

        $user = Auth::user();
        $d = $user->descuento;
        $u = $user->name;

       /*  $id_pedido = pedido::latest('id')->first();
        $id_p = $id_pedido->id + 1;
    
        $existePedido = pedido::find($id_p);
        
        if($existePedido['id'] != $id_p){
            $id_pedido = pedido::latest('id')->first();
            $id_p = $id_pedido->id; 
        }else { */

        $dto = 1 - $d;
        $total = $qtotal * $dto;

        if ($qpedido->isEmpty()) {

            return view('noHayStock');

        } else {
            
            $pedidoas = new pedido();
            $pedidoas->user = $u;
            $pedidoas->save();

            $id_pedido = pedido::latest('id')->first();
            $id_p = $id_pedido->id; 
            
            $newPedido = new detallepedido();
            $newPedido->id_pedido = $id_p;

            foreach ($qpedido as $pedido) {

                $newPedido = new detallepedido();
                $newPedido->id_pedido = $id_p;
                $cantidad = $pedido->cantidad;
                $newPedido->cantidad = $cantidad;
                $newPedido->producto = $pedido->titulo;
                $newPedido->id_producto = $pedido->id_producto;
                $precio = $pedido->precio * $dto * $cantidad;
                $newPedido->precio = $precio;
                $newPedido->user = $u;
                $newPedido->save();
            }        
        }

        $facturacion = db::table('facturacions')->where('user', '=', $u)->get();
        $direccion = db::table('direccions')->where('user', '=', $u)->get();

        $mail = Mail::to('manuval@finca-algarve.com.ar')->send(new pedidoNuevo($newPedido)); 

        return view('repetirPedido')->with('pedidos', $qpedido)->with('pedidosNo', $faltantes)->with('dto', $dto)->with('total', $total)->with('id', $id_p)->with('facturacion', $facturacion)->with('direccion', $direccion);
     /* }; */
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->unica == 'unica') {

            foreach ($request->get('pago') as $pago);

            foreach ($request['cond_fiscal'] as $cond_fiscal);
            $razon_social = $request['razon_social'];
            $cuit = $request['cuit'];

            $facturacion = new Facturacion();
            $facturacion->titulo = $razon_social;
            $facturacion->razon_social = $razon_social;
            $facturacion->cuit = $cuit;
            $facturacion->condicion_fiscal = $cond_fiscal;
            $facturacion->user = 'unica';
            $facturacion->save();

            $qf = facturacion::latest('id')->first();
            $facturacion = $qf->id;

            $localidad = $request['localidad'];
            $codigoPostal = $request['codigoPostal'];
            $telContacto = $request['telContacto'];
            $provincia = $request['provincia'];

            $calle = $request['calle'];
            $numero = $request['numero'];
            $piso = $request['piso'];
            $dpto = $request['dpto'];
            $referencia = $request['referencia'];

            $direccion = new Direccion();
            $direccion->titulo = $calle;
            $direccion->calle = $calle;
            $direccion->numero = $numero;
            $direccion->piso = $piso;
            $direccion->dpto = $dpto;
            $direccion->localidad = $localidad;
            $direccion->provincia = $provincia;
            $direccion->codigoPostal = $codigoPostal;
            $direccion->telContacto = $telContacto;
            $direccion->referencia = $referencia;
            $direccion->user = 'unica';
            $direccion->save();

            $qf = Direccion::latest('id')->first();
            $direccion = $qf->id;

            $pedido = pedido::find($id);
            $pedido->id_dir = $direccion;
            $pedido->id_fact = $facturacion;
            $pedido->modo_pago = $pago;
            $pedido->estado_pago = 'por cobrar';
            $pedido->estado = 'comprado';
            $pedido->save();

            if ($pago == 'transferencia') {

                $pedido = 'Pedido Cinco Sentidos #000' . $id;
                $total = $request->get('total');
                /* return view('transferencia'); */
                return view('transferencia')->with('detalle', $pedido)->with('total', $total)->with('id', $id);
            } elseif ($pago == 'mercadoPago') {
                $pedido = 'Pedido Cinco Sentidos #000' . $id;
                $total = $request->get('total');

                return view('mercadoPago')->with('detalle', $pedido)->with('total', $total)->with('id', $id);
            } else {

                /* return view('efectivo'); */
                echo 'Imagen de Pago en efectivo';
            }
        };

        foreach ($request->get('facturacion') as $facturacion);
        foreach ($request->get('direccion') as $direccion);
        foreach ($request->get('pago') as $pago);

        $pedido = pedido::find($id);
        $pedido->id_dir = $direccion;
        $pedido->id_fact = $facturacion;
        $pedido->modo_pago = $pago;
        $pedido->estado_pago = 'por cobrar';
        $pedido->estado = 'comprado';
        $pedido->save();

        if ($pago == 'transferencia') {

            $pedido = 'Pedido Cinco Sentidos #000' . $id;
            $total = $request->get('total');
            /* return view('transferencia'); */
            return view('transferencia')->with('detalle', $pedido)->with('total', $total)->with('id', $id);
        } elseif ($pago == 'mercadoPago') {
            $pedido = 'Pedido Cinco Sentidos #000' . $id;
            $total = $request->get('total');

            return view('mercadoPago')->with('detalle', $pedido)->with('total', $total)->with('id', $id);
        } else {

            /* return view('efectivo'); */
            echo 'Imagen de Pago en efectivo';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
