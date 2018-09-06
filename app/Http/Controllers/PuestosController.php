<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puesto;


class PuestosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $puestos = new Puesto();

        $puestos = Puesto::all();

        return view('puestos.index', compact('puestos'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puestos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $puesto = new Puesto;

        $puesto->nombre_puesto   = $request-> nombre_puesto;

        $puesto->save();

        return redirect()->route('puestos.index')
                        ->with('success','Datos del puesto registrados correctamente');
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
        $puesto = Puesto::find($id);
        return view('puestos.edit',compact('puesto'));
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
        $puesto = Puesto::find($id);

        $puesto->nombre_puesto   = $request-> nombre_puesto;

        $puesto->save();

        return redirect()->route('puestos.index')
                        ->with('success','Datos del puesto actulizados correctamente');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Puesto::find($id)->delete();
        return redirect()->route('puestos.index')
                         ->with('success','Puesto borrado correctamente');
    }
}
