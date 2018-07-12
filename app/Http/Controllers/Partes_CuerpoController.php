<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParteCuerpo;

class Partes_CuerpoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $partes_cuerpo = new ParteCuerpo();

        $partes_cuerpo = ParteCuerpo::all();

        return view('partes_cuerpo.index', compact('partes_cuerpo'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partes_cuerpo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parte_cuerpo = new ParteCuerpo;

        $parte_cuerpo->nombre_parte_cuerpo   = $request-> nombre_parte_cuerpo;

        $parte_cuerpo->save();

        return redirect()->route('partes_cuerpo.index')
                        ->with('success','Datos de la parte del cuerpo registrados correctamente');
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
        $parte_cuerpo = ParteCuerpo::find($id);
        return view('partes_cuerpo.edit',compact('parte_cuerpo'));
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
        $parte_cuerpo = ParteCuerpo::find($id);

        $parte_cuerpo->nombre_parte_cuerpo   = $request-> nombre_parte_cuerpo;

        $parte_cuerpo->save();

        return redirect()->route('partes_cuerpo.index')
                        ->with('success','Datos de la parte del cuerpo actulizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ParteCuerpo::find($id)->delete();
        return redirect()->route('partes_cuerpo.index')
                         ->with('success','Partes de cuerpo borrado correctamente');
    }
}
