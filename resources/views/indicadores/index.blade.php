<meta name="csrf-token" content="{{ csrf_token() }}">

<style type="text/css">
#tablaAccidentes{
  font-size: 12px;
}     

table thead {
    font-size: 12px;
}

.table-wrapper-scroll-y {
  display: block;
  max-height: 200px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}  

.dtHorizontalVerticalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
}
#dtHorizontalVerticalExample th, td {
    white-space: nowrap;
}
</style>


@extends('layouts.sidebar')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Indicadores Servicio Médico Mes de Julio</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<br>
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>2.- Incapacidades</h5>
            </div>
        </div>
    </div>
<br>
<div class="row">
    <h8>2.1.- Número de incapacitados por mes por Planta</h8>
</div>
   <!-- <table id="tab_pac" class="table table-bordered tablesorter table-condensed">-->
<table id="tablaAccidentes" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th class="th-sm">Planta</th>
            <th class="th-sm">Accidente de trabajo</th>
            <th class="th-sm">Accidente de trayecto</th>
            <th class="th-sm">Enf. gral. IMSS</th>
            <th class="th-sm">Inc. interna</th>
            <th class="th-sm">Maternidad</th>
            <th class="th-sm">Licencia Medica</th>
            <th class="th-sm">Totales</th>
        </tr>
    </thead>
      @foreach ($plantas_perm as $planta)
    <tr>
        @php
            $datos_pla = DB::select('select * from plantas where id_planta = ?', [$planta]);
        @endphp
        <td><center> {{ $datos_pla[0]->siglas_pla }} </center></td>
        <td>
            <center> 
                {{ \App\Incapacidad::where('id_planta',$planta)->where('tipo_inc_gral','AT')->count() }}
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','ATR')->count() }}</center></td>
        <td><center> {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','EG')->count() }}</center></td>
        <td><center> {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','Int')->count() }}</center></td>
        <td><center> {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','M')->count() }}</center></td>
        <td><center> {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','LM')->count() }}</center></td>
        <td><center> <b>{{ $incapacidades->where('id_planta',$planta)->count() }}</b></center></td>
    </tr>
    @endforeach
    <tr>
        <td><center> <b>Totales</b> </center></td>
        <td><center> <b>{{ $incapacidades->where('tipo_inc_gral','AT')->count() }} </b></center></td>
        <td><center> <b>{{ $incapacidades->where('tipo_inc_gral','ATR')->count() }}</b></center></td>
        <td><center> <b>{{ $incapacidades->where('tipo_inc_gral','EG')->count() }}</b></center></td>
        <td><center> <b>{{ $incapacidades->where('tipo_inc_gral','Int')->count() }}</b></center></td>
        <td><center> <b>{{ $incapacidades->where('tipo_inc_gral','M')->count() }}</b></center></td>
        <td><center> <b>{{ $incapacidades->where('tipo_inc_gral','LM')->count() }}</b></center></td>
        <td><center> <b>{{ $incapacidades->count() }}</b></center></td>
    </tr>
    </table>
<br>
<div class="row">
    <h8>2.2.- Número de días perdidos por tipo de incapacidad</h8>
</div>
   <!-- <table id="tab_pac" class="table table-bordered tablesorter table-condensed">-->
<table id="tablaAccidentes" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th class="th-sm">Planta</th>
            <th class="th-sm">Accidente de trabajo</th>
            <th class="th-sm">Accidente de trayecto</th>
            <th class="th-sm">Enf. gral. IMSS</th>
            <th class="th-sm">Inc. interna</th>
            <th class="th-sm">Maternidad</th>
            <th class="th-sm">Licencia Medica</th>
            <th class="th-sm">Totales</th>
        </tr>
    </thead>
      @foreach ($plantas_perm as $planta)
    <tr>
        @php
            $datos_pla = DB::select('select * from plantas where id_planta = ?', [$planta]);
        @endphp
        <td><center> {{ $datos_pla[0]->siglas_pla }} </center></td>
        <td>
            <center> 
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','AT')->sum('dias_totales_inc') }} 
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','ATR')->sum('dias_totales_inc') }}
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','EG')->sum('dias_totales_inc') }}
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','Int')->sum('dias_totales_inc') }}
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','M')->sum('dias_totales_inc') }}
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->where('tipo_inc_gral','LM')->sum('dias_totales_inc') }}
            </center>
        </td>
        <td>
            <center>
                {{ $incapacidades->where('id_planta',$planta)->sum('dias_totales_inc') }}
            </center>
        </td>
    </tr>
    @endforeach
     <tr>
        <td><center> <b>Totales</b> </center></td>
        <td>
            <center> 
                <b>{{ $incapacidades->where('tipo_inc_gral','AT')->sum('dias_totales_inc') }} </b>
            </center>
        </td>
        <td>
            <center>
                <b>{{ $incapacidades->where('tipo_inc_gral','ATR')->sum('dias_totales_inc') }}</b>
            </center>
        </td>
        <td>
            <center>
                <b>{{ $incapacidades->where('tipo_inc_gral','EG')->sum('dias_totales_inc') }}</b>
            </center>
        </td>
        <td>
            <center>
                <b>{{ $incapacidades->where('tipo_inc_gral','Int')->sum('dias_totales_inc') }}</b>
            </center>
        </td>
        <td>
            <center>
                <b>{{ $incapacidades->where('tipo_inc_gral','M')->sum('dias_totales_inc') }}</b>
            </center>
        </td>
        <td>
            <center>
                <b>{{ $incapacidades->where('tipo_inc_gral','LM')->sum('dias_totales_inc') }}</b>
            </center>
        </td>
        <td>
            <center>
                <b>{{ $incapacidades->sum('dias_totales_inc') }}</b>
            </center>
        </td>
    </tr>
    </table>

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h5>3.- Accidentes</h5>
            </div>
        </div>
    </div>
<br>
<div class="row">
    <h8>3.1.- Número de accidentes e incidentes de trabajo por mes por unidad de negocio</h8>
</div>
   <!-- <table id="tab_pac" class="table table-bordered tablesorter table-condensed">-->
    @php

     $mes_let = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    @endphp
<table id="tablaAccidentes" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th class="th-sm">Mes</th>
            <th class="th-sm">Ass</th>
            <th class="th-sm">PTG</th>
            <th class="th-sm">CBG</th>
            <th class="th-sm">CV</th>
            <th class="th-sm">BH</th>
            <th class="th-sm">Totales</th>
        </tr>
    </thead>
      @foreach ($mes_let as $mes)
      
      @php
            switch($mes){
                case 'Enero':
                    {
                        $from = date('2018-01-01');
                        $to = date('2018-01-31');
                        break;
                    }
                case 'Febrero':
                    {
                        $from = date('2018-02-01');
                        $to = date('2018-02-28');
                        break;
                    }
                case 'Marzo':
                    {
                        $from = date('2018-03-01');
                        $to = date('2018-03-31');
                        break;
                    }
                case 'Abril':
                    {
                        $from = date('2018-04-01');
                        $to = date('2018-04-30');
                        break;
                    }
                case 'Mayo':
                    {
                        $from = date('2018-05-01');
                        $to = date('2018-05-31');
                        break;
                    }
                case 'Junio':
                    {
                        $from = date('2018-06-01');
                        $to = date('2018-06-30');
                        break;
                    }
                case 'Julio':
                    {
                        $from = date('2018-07-01');
                        $to = date('2018-07-31');
                        break;
                    }
                case 'Agosto':
                    {
                        $from = date('2018-08-01');
                        $to = date('2018-08-31');
                        break;
                    }
                case 'Septiembre':
                    {
                        $from = date('2018-09-01');
                        $to = date('2018-09-30');
                        break;
                    }
                case 'Octubre':
                    {
                        $from = date('2018-10-01');
                        $to = date('2018-10-31');
                        break;
                    }
                case 'Noviembre':
                    {
                        $from = date('2018-11-01');
                        $to = date('2018-11-30');
                        break;
                    }
                case 'Diciembre':
                    {
                        $from = date('2018-12-01');
                        $to = date('2018-12-31');
                        break;
                    }

                }
            @endphp
    <tr>
        <td>
            <center>
                {{ $mes }}
            </center>
        </td>
        <td>
            <center>
                {{ \App\Accidente::whereBetween(DB::raw('DATE(fecha_accidente)'),array($from,$to))->where('id_planta',1)->count() }}

            </center>
        </td>
        <td>
            <center>
                {{ \App\Accidente::whereBetween(DB::raw('DATE(fecha_accidente)'),array($from,$to))->where('id_planta',2)->count() }}
            </center>
        </td>
        <td>
            <center>
                {{ \App\Accidente::whereBetween(DB::raw('DATE(fecha_accidente)'),array($from,$to))->where('id_planta',3)->count() }}
            </center>
        </td>
        <td>
            <center>
                {{ \App\Accidente::whereBetween(DB::raw('DATE(fecha_accidente)'),array($from,$to))->where('id_planta',4)->count() }}
            </center>
        </td>
        <td>
            <center>
                {{ \App\Accidente::whereBetween(DB::raw('DATE(fecha_accidente)'),array($from,$to))->where('id_planta',5)->count() }}
            </center>
        </td>
        <td>
            <center>
                {{ \App\Accidente::whereBetween(DB::raw('DATE(fecha_accidente)'),array($from,$to))->count() }}
            </center>
        </td>
    </tr>
    @endforeach
    </table>

</div> 



<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datatables.min.css') }}"/>
 
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>

@endsection



