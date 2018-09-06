<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SelNutricion\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;

Use App\Area;
Use App\Diagnostico;
Use App\ParteCuerpo;
Use App\Planta;
use App\Accidente;
use App\Log;
Use App\Incapacidad;
Use App\DetIncapacidad;

class AccidenteController extends Controller
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
     public function index(Request $request)
    {
       //$inc1 = Incapacidad::select('id_incapacidad')->where('id_accidente','=',4)->first();
       // echo $inc1->id_incapacidad;
       // dd($inc1);
       
        $search = $request->get('search');

        $plantas_perm="";
        for($i=1; $i<=5;$i++){
            switch ($i) {
                case 1:
                    if(Auth::user()->perm_planta_1==1){
                        $plantas_perm=$plantas_perm."1,";
                    }
                    break;
                case 2:
                    if(Auth::user()->perm_planta_2==1){
                        $plantas_perm=$plantas_perm."2,";
                    }
                    break;
                case 3:
                    if(Auth::user()->perm_planta_3==1){
                        $plantas_perm=$plantas_perm."3,";
                    }
                    break;
                case 4:
                    if(Auth::user()->perm_planta_4==1){
                        $plantas_perm=$plantas_perm."4,";
                    }
                    break;
                case 5:
                    if(Auth::user()->perm_planta_5==1){
                        $plantas_perm=$plantas_perm."5,";
                    }
                    break;
            }
        }
        $plantas_perm=rtrim($plantas_perm,',');
        $plantas_perm=explode(',', $plantas_perm);

        $accidentes = new Accidente();

        $accidentes = Accidente::whereIn('id_planta',$plantas_perm)->with('paciente')->name($search)
                    ->paginate(1000);

        return view('accidentes.index', compact('accidentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::orderBy('nombre_area','asc')->pluck('nombre_area','id_area')->toArray();
        $areas[""]=".Selecciona Area...";
        asort($areas);

        $diagnosticos = Diagnostico::orderBy('nombre_diagn','asc')->pluck('nombre_diagn','id_diagn')->toArray();
        $diagnosticos[""]=".Seleccionar...";
        asort($diagnosticos);

        $partBody = ParteCuerpo::orderBy('nombre_parte_cuerpo','asc')->pluck('nombre_parte_cuerpo','id_parte_cuerpo')->toArray();
        $partBody[""]=".Seleccionar...";
        asort($partBody);

        $plantas_perm="";
        for($i=1; $i<=5;$i++){
            switch ($i) {
                case 1:
                    if(Auth::user()->perm_planta_1==1){
                        $plantas_perm=$plantas_perm."1,";
                    }
                    break;
                case 2:
                    if(Auth::user()->perm_planta_2==1){
                        $plantas_perm=$plantas_perm."2,";
                    }
                    break;
                case 3:
                    if(Auth::user()->perm_planta_3==1){
                        $plantas_perm=$plantas_perm."3,";
                    }
                    break;
                case 4:
                    if(Auth::user()->perm_planta_4==1){
                        $plantas_perm=$plantas_perm."4,";
                    }
                    break;
                case 5:
                    if(Auth::user()->perm_planta_5==1){
                        $plantas_perm=$plantas_perm."5,";
                    }
                    break;
            }
        }
        $plantas_perm=rtrim($plantas_perm,',');
        $plantas_perm=explode(',', $plantas_perm);

        $plantas = Planta::whereIn('id_planta',$plantas_perm)->orderBy('id_planta','asc')->pluck('siglas_pla','id_planta')->toArray();
        $plantas[""]=".Selecciona la Planta...";
        asort($plantas);


        return view('accidentes.create',compact('areas','diagnosticos','partBody','plantas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accidente = new Accidente();

        $accidente->id_paciente        = $request-> id_paciente;
        $accidente->id_planta          = $request-> id_planta;
        $accidente->id_area            = $request-> id_area;
        $accidente->turno_pac          = $request-> turno_pac;
        $accidente->fecha_accidente    = $request-> fecha_accidente;
        $accidente->fecha_acude        = $request-> fecha_acude;
        $accidente->atendio_pac        = $request-> atendio_pac;
        $accidente->tipo_riesgo_acc    = $request-> tipo_riesgo_acc;
        $accidente->supervisor_pac     = $request-> supervisor_pac;
        $accidente->id_parte_cuerpo    = $request-> id_parte_cuerpo;
        $accidente->id_diagn           = $request-> id_diagn;
        $accidente->incapacidad_aplica = $request-> incapacidad_aplica;
        $accidente->observacion_diag   = $request-> observacion_diag;
        $accidente->observaciones_acc  = $request-> observaciones_acc;
        $accidente->estatus_acc  = 'A';
        $accidente->user_reg      = Auth::user()->id;

        $accidente->save();

        if($request->incapacidad_aplica == 'S'){
            $incapacidad = new Incapacidad();

            $incapacidad->id_paciente      = $request-> id_paciente;
            $incapacidad->id_planta        = $request-> id_planta;
            $incapacidad->id_area          = $request-> id_area;
            $incapacidad->turno_pac        = $request-> turno_pac;
            $incapacidad->fecha_inicio_inc = $request-> fecha_inicio_inc;
            $incapacidad->user_reg_inc     = Auth::user()->id;
            $incapacidad->estatus_inc      = "A";
            $incapacidad->id_accidente     = $accidente->id_accidente;
            if($request->tipo_riesgo_acc=='AT'){
                $incapacidad->tipo_inc_gral  = 'AT';
            }else{
                $incapacidad->tipo_inc_gral  = 'ATR';
            }

            $incapacidad->save();

            return redirect()->route('accidentes.edit',$accidente->id_accidente);

        }else{
            return redirect()->route('accidentes.index')->with('success','Datos del accidente almacenados correctamente');
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
        $areas = Area::orderBy('nombre_area','asc')->pluck('nombre_area','id_area')->toArray();
        $areas[""]=".Selecciona Area...";
        asort($areas);

        $diagnosticos = Diagnostico::orderBy('nombre_diagn','asc')->pluck('nombre_diagn','id_diagn')->toArray();
        $diagnosticos[""]=".Seleccionar...";
        asort($diagnosticos);

        $partBody = ParteCuerpo::orderBy('nombre_parte_cuerpo','asc')->pluck('nombre_parte_cuerpo','id_parte_cuerpo')->toArray();
        $partBody[""]=".Seleccionar...";
        asort($partBody);

        $plantas = Planta::orderBy('id_planta','asc')->pluck('siglas_pla','id_planta')->toArray();
        $plantas[""]=".Selecciona la Planta...";
        asort($plantas);

        $accidente=Accidente::find($id);

        if($accidente->incapacidad_aplica=='S'){
            $incapacidad=Incapacidad::where('id_accidente',$accidente->id_accidente)->get();
            $incapacidad=Incapacidad::find($incapacidad[0]->id_incapacidad);
            $detIncapacidad =DetIncapacidad::where('id_incapacidad',$incapacidad->id_incapacidad);
        }else{
            $incapacidad=null;
            $detIncapacidad=null;
        }

        return view('accidentes.show',compact('areas','diagnosticos','partBody','plantas','accidente','incapacidad','detIncapacidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas = Area::orderBy('nombre_area','asc')->pluck('nombre_area','id_area')->toArray();
        $areas[""]=".Selecciona Area...";
        asort($areas);

        $diagnosticos = Diagnostico::orderBy('nombre_diagn','asc')->pluck('nombre_diagn','id_diagn')->toArray();
        $diagnosticos[""]=".Seleccionar...";
        asort($diagnosticos);

        $partBody = ParteCuerpo::orderBy('nombre_parte_cuerpo','asc')->pluck('nombre_parte_cuerpo','id_parte_cuerpo')->toArray();
        $partBody[""]=".Seleccionar...";
        asort($partBody);

        $plantas_perm="";
        for($i=1; $i<=5;$i++){
            switch ($i) {
                case 1:
                    if(Auth::user()->perm_planta_1==1){
                        $plantas_perm=$plantas_perm."1,";
                    }
                    break;
                case 2:
                    if(Auth::user()->perm_planta_2==1){
                        $plantas_perm=$plantas_perm."2,";
                    }
                    break;
                case 3:
                    if(Auth::user()->perm_planta_3==1){
                        $plantas_perm=$plantas_perm."3,";
                    }
                    break;
                case 4:
                    if(Auth::user()->perm_planta_4==1){
                        $plantas_perm=$plantas_perm."4,";
                    }
                    break;
                case 5:
                    if(Auth::user()->perm_planta_5==1){
                        $plantas_perm=$plantas_perm."5,";
                    }
                    break;
            }
        }
        $plantas_perm=rtrim($plantas_perm,',');
        $plantas_perm=explode(',', $plantas_perm);

        $plantas = Planta::whereIn('id_planta',$plantas_perm)->orderBy('id_planta','asc')->pluck('siglas_pla','id_planta')->toArray();
        $plantas[""]=".Selecciona la Planta...";
        asort($plantas);

        $accidente=Accidente::find($id);

        if($accidente->incapacidad_aplica=='S'){
            $incapacidad=Incapacidad::where('id_accidente',$accidente->id_accidente)->get();
            $incapacidad=Incapacidad::find($incapacidad[0]->id_incapacidad);
            $detIncapacidad =DetIncapacidad::where('id_incapacidad',$incapacidad->id_incapacidad);
        }else{
            $incapacidad=null;
            $detIncapacidad=null;
        }

        return view('accidentes.edit',compact('areas','diagnosticos','partBody','plantas','accidente','incapacidad','detIncapacidad'));
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
        $accidente = Accidente::find($id);

        $accidente->id_paciente        = $request-> id_paciente;
        $accidente->id_planta          = $request-> id_planta;
        $accidente->id_area            = $request-> id_area;
        $accidente->turno_pac          = $request-> turno_pac;
        $accidente->fecha_accidente    = $request-> fecha_accidente;
        $accidente->fecha_acude        = $request-> fecha_acude;
        $accidente->atendio_pac        = $request-> atendio_pac;
        $accidente->tipo_riesgo_acc    = $request-> tipo_riesgo_acc;
        $accidente->supervisor_pac     = $request-> supervisor_pac;
        $accidente->id_parte_cuerpo    = $request-> id_parte_cuerpo;
        $accidente->id_diagn           = $request-> id_diagn;
        $accidente->incapacidad_aplica = $request-> incapacidad_aplica;
        $accidente->observacion_diag   = $request-> observacion_diag;
        $accidente->observaciones_acc  = $request-> observaciones_acc;
        $accidente->user_reg      = Auth::user()->id;

        $accidente->save();
        return redirect()->route('accidentes.index')->with('success','Datos del accidente actualizados correctamente');
    }

    public function terminar($id){

        $accidente = Accidente::find($id);
        $accidente->estatus_acc = 'T';
        $accidente->save();
        
        return 'success';  
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Incapacidad::where('id_accidente',$id)->delete();

        Accidente::find($id)->delete();
        return redirect()->route('accidentes.index')
                         ->with('success','Accidente borrada correctamente');
    }
}
