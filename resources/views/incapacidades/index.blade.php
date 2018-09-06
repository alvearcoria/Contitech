<meta name="csrf-token" content="{{ csrf_token() }}">

<style type="text/css">
#tablaIncapacidades{
  font-size: 12px;
}     

table thead {
    font-size: 12px;
}

table tfoot {
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

.red{
     background-color: #ffc4c4 !important;
}
</style>

@extends('layouts.sidebar')


@section('content')

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="pull-left">
                <h2>Control de Incapacidades</h2>
            </div>

        </div>
        @if(Auth::user()->permisos_user=="E")
        <div class="col-sm-3">
            <a href="{{ route('incapacidades.create') }}" class="btn btn-success"><span class="fas fa-user-plus"></span> Registrar nueva incapacidad</a>
        </div>
        @endif
        <div class="col-sm-1">
            <a href="{{ route('incapacidades.create') }}" class="btn btn-secondary"><span class="fas fa-file-download"></span> Descargar</a>
            
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Incapacidades Totales: {{ $incapacidades->total() }} mostrando del {{ $incapacidades->firstItem() }} al {{ $incapacidades->lastItem() }}.
  </div>

   <table id="tablaIncapacidades" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Item</th>
            <th>No Nóm</th>
            <th>Paciente</th>
            <th>Planta</th>
            <th>Fecha 1ra Incapacidad</th>
            <th>Fecha ingreso lab</th>
            <th>Detalle Incapacidad</th>
            <th>Estatus</th>
            <th>Accciones</th>
        </tr>
    </thead>
    <tbody>
    @php
        $i=1;
        $hoy_2=date('Y-m-d');
    @endphp
    @foreach ($incapacidades as $incapacidad)
    
        @if($incapacidad->detIncapacidad->count() > 0 and $incapacidad->fecha_ing_lab < $hoy_2 and $incapacidad->estatus_inc == 'A')  
    <tr class="red">
        @else
    <tr>
        @endif 
        <td> {{ $i }} </td>
        <td> {{ $incapacidad->paciente->num_nomina_pac }} </td>
        <td> {{ $incapacidad->paciente->nombre_pac }} </td>
        <td> {{ $incapacidad->planta->siglas_pla }} </td>
        <td>
            @php
            $mes='';
            switch(substr($incapacidad->fecha_inicio_inc,5,2)){
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
            {{substr($incapacidad->fecha_inicio_inc,8,2).'-'.$mes.'-'.substr($incapacidad->fecha_inicio_inc,0,4)}}
          </td>
         <td>
            @php
            $mes='';
            switch(substr($incapacidad->fecha_ing_lab,5,2)){
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
            {{substr($incapacidad->fecha_ing_lab,8,2).'-'.$mes.'-'.substr($incapacidad->fecha_ing_lab,0,4)}}
          </td>
        <td>
            <center>
                <span class='fas fa-file-medical-alt'></span>
                <span class="badge badge-pill badge-primary"> {{ $incapacidad->detIncapacidad->count() }}</span><br>
                <span class='fas fa-calendar'> </span>
                <span class="badge badge-pill badge-primary"> {{ $incapacidad->dias_totales_inc }} </span>
            </center>
        </td>
        <td>
            @if($incapacidad->estatus_inc=="A")
                @if($incapacidad->detIncapacidad->count()==0)
                     <div class="alert alert-warning" role="alert">
                        Sin registros
                     </div>
                @else
                     <div class="alert alert-success" role="alert">
                        Proceso
                     </div>
                @endif
            @else
                <div class="alert alert-danger" role="alert">
                    Terminada
                 </div>
            @endif
        </td>
        <td>
        @if(Auth::user()->permisos_user=="L")
             <a class="btn btn-primary" href="{{ route('incapacidades.show',$incapacidad->id_incapacidad) }}" title="Ver"><span class="fas fa-eye"></span></a>
        @else
            @if($incapacidad->estatus_inc=="T")
                <a class="btn btn-primary" href="{{ route('incapacidades.show',$incapacidad->id_incapacidad) }}" title="Ver"><span class="fas fa-eye"></span></a>
            @else
            <a class="btn btn-primary" href="{{ route('incapacidades.edit',$incapacidad->id_incapacidad) }}" title="Editar"><span class="fas fa-edit"></span></a> 
                @if($incapacidad->detIncapacidad->count()==0)           
                {!! Form::open(['method' => 'DELETE','route' => ['incapacidades.destroy', $incapacidad->id_incapacidad],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("la incapacidad del paciente","'.$incapacidad->paciente->nombre_pac.'","'.$incapacidad->id_incapacidad.'")']) !!} 
                
                    <button class='btn btn-danger' type='submit' value='submit' title="Borrar">
                        <span class='fas fa-times'> </span>
                    </button>                        
                {!! Form::close() !!}
                @endif
             @endif
        @endif
        </td>
    </tr>
    @php
        $i++;
    @endphp
    @endforeach
    </tbody>
    <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th id='list_plantas'></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</div> 

<script type="text/javascript">

    $(document).ready(function () {

  $('#tablaIncapacidades').DataTable({
    "scrollX": true,
    "scrollY": 400,
    "select:": true,
     "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
  });
  $('.dataTables_length').addClass('bs-select');

  var table =$('#tablaIncapacidades').DataTable();

    $('#list_plantas').html( '<input type="text" placeholder="Buscar por Planta" id="text_plantas" />' );

    $('#text_plantas').on( 'keyup', function () {

    table
        .columns( 3 )
        .search( this.value )
        .draw();
} );

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



