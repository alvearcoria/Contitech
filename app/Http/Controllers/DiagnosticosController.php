<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diagnostico;

class DiagnosticosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosticos = new Diagnostico();

        $diagnosticos = Diagnostico::all();

        return view('diagnosticos.index', compact('diagnosticos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diagnosticos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diagnostico = new Diagnostico;

        $diagnostico->nombre_diagn   = $request-> nombre_diagn;

        $diagnostico->save();

        return redirect()->route('diagnosticos.index')
                        ->with('success','Datos del diagnostico registrados correctamente');
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
        $diagnostico = Diagnostico::find($id);
        return view('diagnosticos.edit',compact('diagnostico'));
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
        $diagnostico = Diagnostico::find($id);

        $diagnostico->nombre_diagn   = $request-> nombre_diagn;

        $diagnostico->save();

        return redirect()->route('diagnosticos.index')
                        ->with('success','Datos del puesto actulizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Diagnostico::find($id)->delete();
        return redirect()->route('diagnosticos.index')
                         ->with('success','Diagnostico borrado correctamente');
    }
}
