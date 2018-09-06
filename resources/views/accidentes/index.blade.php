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
                <h2>Control de Accidentes</h2>
            </div>
        </div>
    </div>
        <div class="row">
            @if(Auth::user()->permisos_user=="E")
            <div class="col-sm">
                <a href="{{ route('accidentes.create') }}" class="btn btn-success"><span class="fas fa-user-plus"></span> Registrar nuevo accidente</a>
            </div>
            @endif

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<br>
   <!-- <table id="tab_pac" class="table table-bordered tablesorter table-condensed">-->
<table id="tablaAccidentes" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th class="th-sm">No Nóm</th>
            <th class="th-sm">Paciente</th>
            <th class="th-sm">Planta</th>
            <th class="th-sm">Fecha Accidente</th>
            <th class="th-sm">Fecha de reporte</th>
            <th class="th-sm">Fecha est ing lab</th>
            <th class="th-sm">Tipo de Riesgo</th>
            <th class="th-sm">Diagnostico</th>
            <th class="th-sm">Inc?</th>
            <th class="th-sm">Estatus</th>
            <th class="th-sm">Accciones</th>
        </tr>
    </thead>
    @php
        $i=1;
    @endphp
    @foreach ($accidentes as $accidente)
    <tr>
        <td> {{ $i }} </td>
        <td> {{ $accidente->paciente->num_nomina_pac }} </td>
        <td> {{ $accidente->paciente->nombre_pac }} </td>
        <td> {{ $accidente->planta->siglas_pla }} </td>
        <td>
            @php
            $mes='';
            switch(substr($accidente->fecha_accidente,5,2)){
                case '01':
                    {$mes='Ene';
                        break;}
                case '02':
                    {$mes='Feb';
                    break;}
                case '03':
                    {$mes='Mar';
                    break;}
                case '04':
                    {$mes='Abr';
                    break;}
                case '05':
                    {    $mes='May';
                    break;}
                case '06':
                    {$mes='Jun';
                    break;}
                case '07':
                    {$mes='Jul';
                    break;}
                case '08':
                    {$mes='Ago';
                    break;}
                case '09':
                    {$mes='Sept';
                    break;}
                case '10':
                    {$mes='Oct';
                    break;}
                case '11':
                    {$mes='Nov';
                    break;}
                case '12':
                    {$mes='Dic';
                    break;}
                }
            @endphp
            {{substr($accidente->fecha_accidente,8,2).'-'.$mes.'-'.substr($accidente->fecha_accidente,2,2)}}
          </td>
         <td>
            @php
            $mes='';
            switch(substr($accidente->fecha_acude,5,2)){
                case '01':
                    {$mes='Ene';
                        break;}
                case '02':
                    {$mes='Feb';
                    break;}
                case '03':
                    {$mes='Mar';
                    break;}
                case '04':
                    {$mes='Abr';
                    break;}
                case '05':
                    {    $mes='May';
                    break;}
                case '06':
                    {$mes='Jun';
                    break;}
                case '07':
                    {$mes='Jul';
                    break;}
                case '08':
                    {$mes='Ago';
                    break;}
                case '09':
                    {$mes='Sept';
                    break;}
                case '10':
                    {$mes='Oct';
                    break;}
                case '11':
                    {$mes='Nov';
                    break;}
                case '12':
                    {$mes='Dic';
                    break;}
                }
            @endphp
            {{substr($accidente->fecha_acude,8,2).'-'.$mes.'-'.substr($accidente->fecha_acude,2,2)}}
          </td>
          <td>
               @if($accidente->incapacidad_aplica=='S')

                @php 
                    $x = $accidente->incapacidad;
                @endphp

                @foreach ($x as $y)

                @php
            $mes='';
            switch(substr($y->fecha_ing_lab,5,2)){
                case '01':
                    {$mes='Ene';
                        break;}
                case '02':
                    {$mes='Feb';
                    break;}
                case '03':
                    {$mes='Mar';
                    break;}
                case '04':
                    {$mes='Abr';
                    break;}
                case '05':
                    {    $mes='May';
                    break;}
                case '06':
                    {$mes='Jun';
                    break;}
                case '07':
                    {$mes='Jul';
                    break;}
                case '08':
                    {$mes='Ago';
                    break;}
                case '09':
                    {$mes='Sept';
                    break;}
                case '10':
                    {$mes='Oct';
                    break;}
                case '11':
                    {$mes='Nov';
                    break;}
                case '12':
                    {$mes='Dic';
                    break;}
                }
            @endphp
            {{substr($y->fecha_ing_lab,8,2).'-'.$mes.'-'.substr($y->fecha_ing_lab,2,2)}}

                @endforeach

            @else
                <span style="color: #dc3545"> NA </span>
            @endif
          </td>
        <td>@if($accidente->tipo_riesgo_acc=='AT')
                Accidente de Trabajo
            @elseif($accidente->tipo_riesgo_acc=='ATR')   
                Accidente de Trayecto
            @else
                Incidente de trabajo
            @endif
        </td>
        <td>{{ $accidente->diagnostico->nombre_diagn }}</td>
        <td>
            <center>
            @if($accidente->incapacidad_aplica=='S')

                @php 
                    $x = $accidente->incapacidad;
                @endphp

                @foreach ($x as $y)

                <span class='fas fa-check-circle' style="color: #28a745"> Si </span><br>
                <span class='fas fa-file-medical-alt'></span>
                <span class="badge badge-pill badge-primary"> {{ $y->detIncapacidad->count() }}</span><br>
                <span class='fas fa-calendar'> </span>
                <span class="badge badge-pill badge-primary"> {{ $y->dias_totales_inc }} </span>
                
                @php 
                    $count_inc = $y->detIncapacidad->count();
                @endphp

                @endforeach

            @else
                <span class='fas fa-times-circle' style="color: #dc3545"> No </span>
            @endif


            </center>
        </td>
        <td>
            @if($accidente->estatus_acc=='A')
            <div class="alert alert-success" role="alert">
                Proceso
            </div>
             @else
            <div class="alert alert-danger" role="alert">
                Terminada
            </div>
            @endif
        </td>
        <td>
        @if(Auth::user()->permisos_user=="L")
             <a class="btn btn-primary" href="{{ route('accidentes.show',$accidente->id_accidente) }}" title="Ver"><span class="fas fa-eye"></span></a>
        @elseif($accidente->estatus_acc == 'T')
            <a class="btn btn-primary" href="{{ route('accidentes.show',$accidente->id_accidente) }}" title="Ver"><span class="fas fa-eye"></span></a>
        @else
             <a class="btn btn-primary" href="{{ route('accidentes.edit',$accidente->id_accidente) }}" title="Editar"><span class="fas fa-edit"></span></a>

             @if(isset($count_inc) && $count_inc==0)
             {!! Form::open(['method' => 'DELETE','route' => ['accidentes.destroy', $accidente->id_accidente],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("el accidente del paciente","'.$accidente->paciente->nombre_pac.'","'.$accidente->id_accidente.'")']) !!}  
             <button class='btn btn-danger' type='submit' value='submit' title="Borrar">
                        <span class='fas fa-times'> </span>
                    </button>  
            @endif                      
                {!! Form::close() !!}
        @endif
        </td>

    </tr>
    @php
        $i++;
    @endphp
    @endforeach
    </table>

</div> 

<script type="text/javascript">

$(document).ready(function () {
  $('#tablaAccidentes').DataTable({
    "scrollX": true,
    "scrollY": 400,
    "select:": true,
     "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
  });
  $('.dataTables_length').addClass('bs-select');
});
    function registra_bandera(incapacidad,band){

console.log('en ajax');
         $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/incapacidades/terminado', // This is the url we gave in the route
            data: {
                    'incapacidad' : incapacidad,
                    'band' : band
                   }, // a JSON object to send back
            success: function(response){ // What to do if we succeed
                console.log(response); 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('error'); // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });

        location.reload();

    }

</script>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datatables.min.css') }}"/>
 
<script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>

@endsection



