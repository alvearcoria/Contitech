<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;

class PacientesController extends Controller
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
    public function index(Request $request){

        $search = $request->get('search');
        $pacientes = new Paciente();

        $pacientes = Paciente::name($search)
                    ->sortable()
                    ->orderBy('id_paciente','ASC')
                    ->paginate(50);

        return view('pacientes.index', compact('pacientes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = new Paciente;

        $paciente->nombre_pac             = $request-> nombre_pac;
        $paciente->sexo_pac               = $request-> sexo_pac;
        $paciente->nss_pac                = $request-> nss_pac;
        $paciente->num_nomina_pac          = $request-> num_nomina_pac;

        $paciente->save();

         return redirect()->route('pacientes.index')
                        ->with('success','Datos del paciente almacenados correctamente');

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
        $paciente = Paciente::find($id);
        return view('pacientes.edit',compact('paciente'));
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
        $paciente = Paciente::find($id);
        $paciente->nombre_pac             = $request-> nombre_pac;
        $paciente->sexo_pac               = $request-> sexo_pac;
        $paciente->nss_pac                = $request-> nss_pac;
        $paciente->num_nomina_pac          = $request-> num_nomina_pac;

        $paciente->save();

         return redirect()->route('pacientes.index')
                                    ->with('success','Los datos del paciente han sido actualizados correctamente');
    }

      /**
     * Show all pacientes order by date create.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request){

        $search = $request->get('search');
        $pacientes = new Paciente();

        $pacientes = Paciente::name($search)
                    ->orderBy('id_paciente','ASC')
                    ->sortable()
                    ->paginate(50);

        return view('pacientes.find', compact('pacientes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paciente::find($id)->delete();
        return redirect()->route('pacientes.index')
                         ->with('success','Paciente borrado correctamente');
    }
}
