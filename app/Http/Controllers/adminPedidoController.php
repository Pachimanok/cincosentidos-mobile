<?php

namespace App\Http\Controllers;

use App\Mail\nuevoDespacho;
use App\Models\pedido;
use App\Models\transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Redirect;
Use Illuminate\Support\Facades\Mail;

use PDF;

class adminPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $name = $user->name;
        $email = $user->email;
        $role = $user->role;

        $pNuevos = db::table('pedidos')
        ->where('estado','=','comprado')->get();
        
        $detalle = db::table('detallepedidos')->select('id_pedido','cantidad', 'producto')->get();
     
        return view('admin.pedidosNuevos')->with('user', $user)
        ->with('pedidosNuevos', $pNuevos);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $pNuevos = db::table('pedidos')->where('id','=',$id)->get();
        $transportes = db::table('transports')->get();
        $pNuevos = $pNuevos[0];
        $qfactuacion = db::table('facturacions')->get();
        $qdireccion = db::table('direccions')->get();        
        $detalle = db::table('detallepedidos')->join('products','detallepedidos.id_producto','=','products.id')->select('detallepedidos.id_pedido','detallepedidos.cantidad', 'detallepedidos.producto', 'products.sub_titulo')->get();

        

        return view('admin.verPedido')->with('user', $user)
        ->with('pedido', $pNuevos)
        ->with('detalles', $detalle)
        ->with('facturacion', $qfactuacion)
        ->with('direccion', $qdireccion);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $pNuevos = db::table('pedidos')->where('id','=',$id)->get();
        $pNuevos = $pNuevos[0];
        $qfactuacion = db::table('facturacions')->get();
        $qdireccion = db::table('direccions')->get();        
        $detalle = db::table('detallepedidos')->join('products','detallepedidos.id_producto','=','products.id')->select('detallepedidos.id_pedido','detallepedidos.cantidad', 'detallepedidos.producto', 'products.sub_titulo')->get();

        $transportes = db::table('transports')->get();
        
        return view('admin.editPedido')->with('user', $user)
        ->with('pedido', $pNuevos)
        ->with('detalles', $detalle)
        ->with('facturacion', $qfactuacion)
        ->with('direccion', $qdireccion)
        ->with('transportes', $transportes);

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
        
        if($request['enviarMail'] == 'enviar'){

            if($request['transporte'] != null){

            foreach($request['transporte'] as $transporte)
           
            $qd = db::table('transports')->select('link_seguimiento')->where('title','=',$transporte)->get();
            $link = $qd[0];
            
            $estado = 'SolicitadoDespacho';
            
            $pedido = pedido::find($id);
            $pedido->estado = $estado;
            $pedido->transporte = $transporte;
            $pedido->link_seguimiento= $link;
            $pedido->remito = $request['remito'];
            $pedido->save(); 

            $qd = db::table('pedidos')->select('pedidos.id','pedidos.user','pedidos.total','pedidos.observaciones','pedidos.seguimiento','pedidos.transporte','pedidos.factura','pedidos.remito','direccions.calle','direccions.numero','direccions.piso','direccions.dpto','direccions.referencia','direccions.provincia','direccions.localidad','direccions.codigoPostal','direccions.telContacto')->join('direccions','pedidos.id_dir','=','direccions.id')->where('pedidos.id','=',$id)->get();
            $datos = $qd[0];
            $qp = db::table('detallepedidos')->where('id_pedido','=',$id)->get();
            $qcantidad = db::table('detallepedidos')->where('id_pedido','=',$id)->sum('cantidad');

            $pdf = PDF::loadView('pdf.remito',array('datos' => $datos,'pedidos' => $qp,'cantidad' => $qcantidad));
            $output = $pdf->output();
            file_put_contents('despachos/Despacho'.$id.'.pdf', $output);
            
            // enviar mail
            $qtransporte = db::table('transports')->where('title','=',$datos->transporte)->get();
            $transporte = $qtransporte[0];
            $destinatario = $transporte->email;
            $copia = $transporte->email_cc;
            $des = explode(', ',$destinatario);
            $desCop = explode(', ',$copia);


            $mail = Mail::to($des)->cc($desCop)->send(new nuevoDespacho($datos)); 
            // cambiar status
            
            Session::flash('message','Mensaje Enviado a Transporte' . $mail);
            return Redirect::to('home'); 

            }
        };  
        foreach($request['transporte'] as $transporte)
        /* revisamos si tenemos factura para cambiar el estado */
        if ($request['factura'] != null){
            $estado = 'facturado';
            $factura = $request['factura'];

        /* no se puede enviar sin factura, si hay factura puede hacer numero de seguimiento */
        if( $request['seguimiento'] != null ){

            $estado = 'enviado';
            $seguimiento = $request['seguimiento'];

        }else {
            $seguimiento = null;
        }

        } else {
            $estado = 'comprado';
            $factura = null;
        }

        $seguimiento = $request['seguimiento'];


        if ($request['estado_pago'] == 'on'){
            $estado_pago = 'pagado';
        }else{
            $estado_pago = 'por cobrar';
        }
        

        $pedido = pedido::find($id);
        $pedido->estado = $estado;
        $pedido->estado_pago = $estado_pago;
        $pedido->seguimiento = $seguimiento;
        $pedido->transporte = $transporte;
        $pedido->factura = $factura;
        $pedido->remito = $request['remito'];
        $pedido->save();
              
        Session::flash('message','Se guardaron correctamente sus modificaciones');
        return Redirect::to('home'); 
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
