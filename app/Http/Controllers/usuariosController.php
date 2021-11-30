<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class usuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = db::table('users')->get();
       return view('admin.usuarios')->with('usuarios',$usuarios);
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
        
        $quser = db::table('users')->where('users.id', '=',$id)->get();
        $user=$quser[0];
        $direccions = db::table('users')->join('direccions','users.name','=','direccions.user')->where('users.id', '=',$id)->get();
        $facturacions = db::table('users')->join('facturacions','users.name','=','facturacions.user')->where('users.id', '=',$id)->get();

        return view('admin.verUsuario')
        ->with('usuario',$user)
        ->with('facturacions',$facturacions)
        ->with('direccions',$direccions);
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
        foreach($request['role'] as $role);

        $dto = $request['descuento'] / 100;

        $descuento = user::find($id);
        $descuento->descuento = $dto;
        $descuento->role = $role;
        $descuento->save();

        $quser = db::table('users')->where('users.id', '=',$id)->get();
        $user=$quser[0];

        $direccions = db::table('users')->join('direccions','users.name','=','direccions.user')->where('users.id', '=',$id)->get();
        $facturacions = db::table('users')->join('facturacions','users.name','=','facturacions.user')->where('users.id', '=',$id)->get();

        return view('admin.verUsuario')
        ->with('usuario',$user)
        ->with('facturacions',$facturacions)
        ->with('direccions',$direccions);
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
