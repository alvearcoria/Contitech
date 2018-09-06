<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SelNutricion\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;

use App\Incapacidad;
use App\DetIncapacidad;

class DetIncapacidadController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function altaDetInc($id,$origen)
    {
    	$incapacidad = Incapacidad::find($id);
        return view('detIncapacidad.create',compact('incapacidad','origen'));
    }


    public function store(Request $request)
    {
        /*
        $pdfName = 'Incapacidad_'.$request->folio_inc.'.'. $request->file('incapacidad_pdf')->getClientOriginalExtension();

        $request->file('incapacidad_pdf')->move(storage_path() . '/app/incapacidades/'.$request->id_incapacidad.'/', $pdfName);

        dd($request);

*/
        $detIncapacidad = new DetIncapacidad();

        $detIncapacidad->id_incapacidad   = $request-> id_incapacidad;
        $detIncapacidad->fecha_rec_inc   = $request-> fecha_rec_inc;
        $detIncapacidad->fecha_ini_inc_det   = $request-> fecha_ini_inc_det;
        $detIncapacidad->folio_inc   = $request-> folio_inc;
        $detIncapacidad->tipo_inc   = $request-> tipo_inc;
        $detIncapacidad->dias_inc   = $request-> dias_inc ;
        $detIncapacidad->diagnostico_inc   = $request-> diagnostico_inc;
        $detIncapacidad->user_reg_det_inc     = Auth::user()->id;

        if($request->hasFile('incapacidad_pdf')){
            
            $pdfName = $request->id_incapacidad.'_Incapacidad_'.$request->folio_inc.'.'. $request->file('incapacidad_pdf')->getClientOriginalExtension();
            $pathPdf='expediente_incapacidades/'.$request->id_incapacidad.'/'.$pdfName;

            $request->file('incapacidad_pdf')->move(storage_path() . '/app/expediente_incapacidades/'.$request->id_incapacidad.'/', $pdfName);

            $detIncapacidad->incapacidad_pdf = $pathPdf;
        }


        $detIncapacidad->save();

        $incapacidad=Incapacidad::find($request->id_incapacidad);

        $fecha_inicio = date("Y-m-d",strtotime($request->fecha_ini_inc_det));
        $nuevafecha = date("Y-m-d",strtotime($fecha_inicio."+ ".($request->dias_inc)." days"));

        $incapacidad->fecha_ing_lab = $nuevafecha;

        $incapacidad->dias_totales_inc = $incapacidad->detIncapacidad->sum('dias_inc');
 
        $incapacidad->save();

        if($incapacidad->id_accidente =! null){
            return redirect()->route('accidentes.edit',$incapacidad->id_accidente);
        }else{
            return redirect()->route('incapacidades.edit',$incapacidad->id_incapacidad);
        }
    }

         public function editDetInc($id,$origen)
    {
        $detIncapacidad =DetIncapacidad::find($id);
        $incapacidad = Incapacidad::find($detIncapacidad->id_incapacidad);

        if($incapacidad->detIncapacidad->max('id_det_incapacidad')==$id){
            $dias_edit=true;
        }else{
            $dias_edit=false;}
        
        return view('detIncapacidad.edit',compact('detIncapacidad','incapacidad','origen','dias_edit'));
    }

      public function update(Request $request, $id)
    {    

        $detIncapacidad = DetIncapacidad::find($id);

        $detIncapacidad->id_incapacidad   = $request-> id_incapacidad;
        $detIncapacidad->fecha_rec_inc   = $request-> fecha_rec_inc;
        $detIncapacidad->fecha_ini_inc_det   = $request-> fecha_ini_inc_det;
        $detIncapacidad->folio_inc   = $request-> folio_inc;
        $detIncapacidad->tipo_inc   = $request-> tipo_inc;
        $detIncapacidad->dias_inc   = $request-> dias_inc ;
        $detIncapacidad->diagnostico_inc   = $request-> diagnostico_inc;
        $detIncapacidad->user_update_det_inc     = Auth::user()->id;

        if($request->hasFile('incapacidad_pdf')){
            
            $pdfName = $request->id_incapacidad.'_Incapacidad_'.$request->folio_inc.'.'. $request->file('incapacidad_pdf')->getClientOriginalExtension();
            $pathPdf='expediente_incapacidades/'.$request->id_incapacidad.'/'.$pdfName;

            $request->file('incapacidad_pdf')->move(storage_path() . '/app/expediente_incapacidades/'.$request->id_incapacidad.'/', $pdfName);

            $detIncapacidad->incapacidad_pdf = $pathPdf;
        }

        $detIncapacidad->save();

        $incapacidad=Incapacidad::find($request->id_incapacidad);

        $fecha_inicio = date("Y-m-d",strtotime($request->fecha_ini_inc_det));
        $nuevafecha = date("Y-m-d",strtotime($fecha_inicio."+ ".($request->dias_inc)." days"));

        $incapacidad->fecha_ing_lab = $nuevafecha;

        $incapacidad->dias_totales_inc = $incapacidad->detIncapacidad->sum('dias_inc');
 
        $incapacidad->save();

        if($incapacidad->id_accidente =! null){
            return redirect()->route('accidentes.edit',$incapacidad->id_accidente);
        }else{
            return redirect()->route('incapacidades.edit',$incapacidad->id_incapacidad);
        }
    }


    public function destroy($id)
    {
        $det = DetIncapacidad::find($id);
        $id_inc= $det->id_incapacidad;
        $dias_menos=$det->dias_inc;
        $det->delete();

        $incapacidad=Incapacidad::find($id_inc);

        if($incapacidad->detIncapacidad->count()==0){
            $incapacidad->fecha_ing_lab = null;
        }
        else{
            $det=$incapacidad->detIncapacidad->last();
            $fecha_inicio = date("Y-m-d",strtotime($det->fecha_ini_inc_det));
            $nuevafecha = date("Y-m-d",strtotime($fecha_inicio."+ ".($det->dias_inc)." days"));
            $incapacidad->fecha_ing_lab = $nuevafecha;
        }

        
        $incapacidad->dias_totales_inc = $incapacidad->detIncapacidad->sum('dias_inc');
 
        $incapacidad->save();

        return redirect()->route('incapacidades.edit',$id_inc)->with('success','La incapacidad se ha borrado correctamente');
    }


}
