<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SelNutricion\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;

Use App\Planta;
Use App\Area;
Use App\Incapacidad;
Use App\DetIncapacidad;

class IncapacidadController extends Controller
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
        $plantas = Planta::orderBy('id_planta','asc')->pluck('siglas_pla','id_planta')->toArray();
        $plantas[""]=".Todas";
        asort($plantas);

        $nombre = $request->get('nombre');

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

        $incapacidades = new Incapacidad();

        $incapacidades = Incapacidad::where('id_accidente',null)->whereIn('id_planta',$plantas_perm)->with('paciente')->name($nombre)
                                                      ->status($request->get('estatus_inc'))
                                                      ->planta($request->get('id_planta'))
                                                      ->paginate(1000);

        return view('incapacidades.index', compact('incapacidades','plantas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $areas = Area::orderBy('nombre_area','asc')->pluck('nombre_area','id_area')->toArray();
        $areas[""]=".Selecciona Area...";
        asort($areas);

        $detIncapacidad=null;


        return view('incapacidades.create',compact('areas','plantas','detIncapacidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $incapacidad = new Incapacidad();

        $incapacidad->id_paciente      = $request-> id_paciente;
        $incapacidad->id_planta        = $request-> id_planta;
        $incapacidad->id_area          = $request-> id_area;
        $incapacidad->fecha_inicio_inc = $request-> fecha_inicio_inc;
        $incapacidad->user_reg_inc     = Auth::user()->id;
        $incapacidad->estatus_inc      = "A";
        $incapacidad->observaciones_inc  = $request-> observaciones_inc;
        $incapacidad->tipo_inc_gral  = $request-> tipo_inc_gral;

        $incapacidad->save();

        return redirect()->route('incapacidades.edit',$incapacidad->id_incapacidad);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plantas = Planta::orderBy('id_planta','asc')->pluck('siglas_pla','id_planta')->toArray();
        $plantas[""]=".Selecciona la Planta...";
        asort($plantas);

        $areas = Area::orderBy('nombre_area','asc')->pluck('nombre_area','id_area')->toArray();
        $areas[""]=".Selecciona Area...";
        asort($areas);

        $incapacidad = Incapacidad::find($id);
        $detIncapacidad =DetIncapacidad::where('id_incapacidad',$id);
        
        return view('incapacidades.show',compact('incapacidad','detIncapacidad','areas','plantas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

        $areas = Area::orderBy('nombre_area','asc')->pluck('nombre_area','id_area')->toArray();
        $areas[""]=".Selecciona Area...";
        asort($areas);

        $incapacidad = Incapacidad::find($id);
        $detIncapacidad =DetIncapacidad::where('id_incapacidad',$id);
        
        return view('incapacidades.edit',compact('incapacidad','detIncapacidad','areas','plantas'));
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
        $incapacidad = Incapacidad::find($id);

        $incapacidad->id_planta          = $request-> id_planta;
        $incapacidad->id_area            = $request-> id_area;
        $incapacidad->fecha_inicio_inc   = $request-> fecha_inicio_inc;
        $incapacidad->fecha_ing_lab      = $request-> fecha_ing_lab;
        $incapacidad->fecha_st_2         = $request-> fecha_st_2;
        $incapacidad->user_update       = Auth::user()->id;
        $incapacidad->estatus_inc        = "A";
        $incapacidad->observaciones_inc  = $request-> observaciones_inc;
        $incapacidad->tipo_inc_gral  = $request-> tipo_inc_gral;
        $incapacidad->save();

        return redirect()->route('incapacidades.index');
    }

    public function regresarProc(Request $request){

        $incapacidad = Incapacidad::find($request->incapacidad);
            $incapacidad->estatus_inc        = $request->band;
            $incapacidad->fecha_ing_lab_real = null;    
            $incapacidad->fecha_termina_inc  = null;
            $incapacidad->fecha_st_2         = null;
            $incapacidad->user_termina       = Auth::user()->id;    
            $incapacidad->save();
        return 'success';
    }

    public function terminar(Request $request,$id){

        $incapacidad = Incapacidad::find($id);

        $incapacidad->estatus_inc = 'T';
        $incapacidad->fecha_ing_lab_real = $request->fecha_ing_lab_real;
        $incapacidad->fecha_st_2 = $request->fecha_st_2;
        $incapacidad->observaciones_inc = $request->observaciones_inc;
        $incapacidad->fecha_termina_inc = date("Y-m-d H:m:s");
        $incapacidad->user_termina = Auth::user()->id;
        $incapacidad->save();

        return 'success';
    }

    public function terminarDatos($id){

        $incapacidad = Incapacidad::find($id);
        
        return view('incapacidades.terminar',compact('incapacidad'));

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Incapacidad::find($id)->delete();
        return redirect()->route('incapacidades.index')
                         ->with('success','Incapacidad borrada correctamente');
    }
}
