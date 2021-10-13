<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\pedido;
use App\Models\detallepedido;



class pedidoContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $u = $user->name;

        $pedido = new pedido();
        $pedido->user = $u;
        $pedido->save();
        $id_pedido = pedido::latest('id')->first(); 
        $id_p = $id_pedido->id;


        foreach($request->get('cantidad') as $idart=>$cantidad){

            $catalogo = db::table('products')->where('id','=',$idart)->get();
            $cat = $catalogo[0];
            $prod = $cat->titulo;
            $px= $cat->precio;

            $detpedido = new detallepedido();
            $detpedido->id_pedido = $id_p;
            $detpedido->cantidad = $cantidad;
            $detpedido->producto = $prod;
            $detpedido->precio = $px;
            $detpedido->usuario = $u;
            $detpedido->save();

        }

        $precio = db::table('detallepedidos')->where('id_pedido','=',$id_p)->get()->sum('precio');
        $precio;
       
        $pedido = pedido::find($id_p);
        $pedido->total;
        $pedido->estado;
        $pedido->save();

        return view('resumen');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
