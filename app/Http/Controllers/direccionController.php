<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Direccion;

class direccionController extends Controller
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

        $localidad = $request['localidad'];
        $codigoPostal = $request['codigoPostal'];
        $telContacto = $request['telContacto'];
        $provincia = $request['provincia'];

        $calle = $request['calle'];
        $numero = $request['numero'];
        $piso = $request['piso'];
        $dpto = $request['dpto'];
        $referencia = $request['referencia'];

        $direccion = new direccion();
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
        $direccion->user = $u;
        $direccion->save();

        return redirect('/home');



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
