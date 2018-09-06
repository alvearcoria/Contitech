<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SelNutricion\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;

Use App\Planta;
Use App\Area;
Use App\Incapacidad;
Use App\Accidente;
Use App\DetIncapacidad;

class IndicadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $incapacidades = new Incapacidad();

        $incapacidades = Incapacidad::whereIn('id_planta',$plantas_perm)->get();

        //dd($incapacidades->where('id_planta',1)->where('tipo_inc_gral','EG')->count());

        return view('indicadores.index', compact('incapacidades','plantas_perm'));
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
