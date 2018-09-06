<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planta;

use SelNutricion\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;

class PlantaController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plantas = new Planta();

        $plantas = Planta::all();

        return view('plantas.index', compact('plantas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plantas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planta = new Planta;

        $planta->nombre_pla   = $request-> nombre_pla;
        $planta->siglas_pla   = $request-> siglas_pla;
        $planta->no_pla       = $request-> no_pla;
        $planta->color_pla    = $request-> color_pla;

        $planta->save();

        return redirect()->route('plantas.index')
                        ->with('success','Datos de la planta registrados correctamente');
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
        $planta = Planta::find($id);
        return view('plantas.edit',compact('planta'));
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
        $planta = Planta::find($id);

        $planta->nombre_pla   = $request-> nombre_pla;
        $planta->siglas_pla   = $request-> siglas_pla;
        $planta->no_pla       = $request-> no_pla;
        $planta->color_pla    = $request-> color_pla;

        $planta->save();

        return redirect()->route('plantas.index')
                        ->with('success','Datos de la planta actulizados correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Planta::find($id)->delete();
        return redirect()->route('plantas.index')
                         ->with('success','Planta borrado correctamente');
    }
}
