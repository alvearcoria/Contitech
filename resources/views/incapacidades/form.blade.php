
<style>

.iframe_alta{
	padding: 5px;
	overflow: hidden;
	height: 100%;
  width: 100%;
}

.modal-dialog {
  position:absolute;
  top:50% !important;
  transform: translate(0, -50%) !important;
  -ms-transform: translate(0, -50%) !important;
  -webkit-transform: translate(0, -50%) !important;
  margin:auto 5%;
}
.modal-content {
  /*min-height:100%;*/
  position:absolute;
  top:5px;
  bottom:0;
  left:0;
  right:0;
  	width: 80vw;
  	height:65vh;
}
.modal-body {
  padding: 5px;
  position:absolute;
  top:55px; /** height of header **/
  bottom:55px;  /** height of footer **/
  left:0;
  right:0;
  height: 75%;
  width: 100%;
}
.modal-footer {
  position:absolute;
  bottom:0;
  left:0;
  right:0;
overflow: hidden;
}


</style>

  @if(isset($incapacidad))
  @php

  $hoy = strtotime(date("Y-m-d"));
  
  $fecha_sist = strtotime($incapacidad->fecha_ing_lab);
  
  if($hoy <= $fecha_sist){
    $comp_fecha = false;
  }else{
    $comp_fecha = true;
  }

@endphp
<div class="row justify-content-center" id='saveInc'>
  @else
<div class="row justify-content-center d-none" id='saveInc'>
  @endif  
    <div class="col-2">
      <button class='btn btn-success' type='submit' value='submit'>
          <span class='fas fa-save'> </span> Guardar
      </button>
    </div>
    @if(isset($incapacidad) and $incapacidad->estatus_inc == 'A' and $comp_fecha and $detIncapacidad->count() > 0)

    <div class="col-sm-2">
        <a data-toggle="modal" class="btn btn-info" href="{{ route('incapacidades.terminarDatos',$incapacidad->id_incapacidad) }}" data-target="#terminarInc" id='btnTerminar'><span class="fas fa-archive" title="Terminar"></span> Terminar</a>
      </div>
    @endif
  </div>

<div class="container">

		<div class="form-group row">
				<div class="col-sm text-center">
					<h4 class="d-block" style="background-color: #34495E; color:#fff; margin: 15px;">Datos del Paciente</h4>
				</div>
			</div>

		<div class="form-group row">  

		<div class="col-sm-1">
			{{ Form::text('id_paciente', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'ID','id'=>'id_paciente','readonly'=>'readonly')) }}
		</div>

		<div class="col-sm">
			{{ Form::text('nombre_pac', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nombres (s)','id'=>'nombre_pac','readonly'=>'readonly')) }}
		</div>

		@if(!isset($incapacidad))
		<div class="col-sm-1">
			<a data-toggle="modal" class="btn btn-success" href="{{ route('pacientes.find') }}" data-target="#findPaciente" id='btnFindPaciente'><span class="fas fa-binoculars"></span></a>
		</div>
		@endif
	</div>

	<div class="form-group row">
		{{ Form::label('sexo_pac', 'Sexo: ',array('class' => 'col-sm-1 col-form-label')) }}
                <div class="col-sm">
                    <div class="custom-control custom-radio custom-control-inline">
                      {{ Form::radio('sexo_pac', 'M', false, array('id'=>'sexo_m','class' => 'custom-control-input','required'=>'required','disabled'=>'true')) }}
                      <label class="custom-control-label" for="sexo_m">
                            <span class="fa fa-male"></span>
                        </label>
                    </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        {{ Form::radio('sexo_pac', 'F', false, array('id'=>'sexo_f','class' => 'custom-control-input','required'=>'required','disabled'=>'true')) }}
                        <label class="custom-control-label" for="sexo_f">
                            <span class="fa fa-female"></span>
                        </label>
                      </div>
                </div>

        {{ Form::label('nss_pac', 'Núm del Seguro Social: ',array('class' => 'col-sm col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('nss_pac', null, array('class' => 'form-control','placeholder' => 'NSS...','onkeypress'=>'return valida_numeros(event)','maxlength'=>'12','readonly'=>'readonly','id'=>'nss_pac')) }}
                  </div>

                  {{ Form::label('num_nomina_pac', 'Núm de nómina: ',array('class' => 'col-sm col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('num_nomina_pac', null, array('class' => 'form-control','placeholder' => 'Nómina...','onkeypress'=>'return valida_numeros(event)','maxlength'=>'10','readonly'=>'readonly','id'=>'num_nomina_pac')) }}
                  </div>

	</div>

	@if(isset($incapacidad))
		<div id='datosAccidente'>
	@else
		<div id='datosAccidente' class='d-none'>
	@endif

	<div class="form-group row">
		{{ Form::label('id_planta', 'Planta: ',array('class' => 'col-sm-1 col-form-label')) }}
		<div class="col-sm">
			{{ Form::select('id_planta',$plantas,null,array('class'=>'form-control','required' => 'required')) }}
		</div>

		{{ Form::label('id_area', 'Area de la Planta: ',array('class' => 'col-sm col-form-label')) }}
		<div class="col-sm">
			{{ Form::select('id_area',$areas,null,array('class'=>'form-control','required' => 'required')) }}
		</div>

	</div>
@if(isset($detIncapacidad))

  @if($detIncapacidad->count() > 0)
  	<div class="form-group row">
  		{{ Form::label('fecha_inicio_inc', 'Fecha inicio incapacidad : ',array('class' => 'col-sm-3 col-form-label')) }}
                  <div class="input-group col-sm-4">
                    {{ Form::date('fecha_inicio_inc', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA', 'readonly'=>'readonly')) }}
                    <div class="input-group-prepend">
                      <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                    </div>
                  </div>
      {{ Form::label('tipo_inc_gral', 'Tipo de incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
          <div class="col-sm">
          {{ Form::select('tipo_inc_gral', 
          array('' => 'Seleccionar...',
                'EG' => 'Enfermedad General',
                'LM' => 'Licencia Médica',
                'M' => 'Maternidad'
          ),null,array('required'=>'required','id'=>'turno_pac','class'=>'form-control')) }}
          </div>
      </div>
  @else
    <div class="form-group row">
      {{ Form::label('fecha_inicio_inc', 'Fecha inicio incapacidad : ',array('class' => 'col-sm-3 col-form-label')) }}
                  <div class="input-group col-sm-4">
                    {{ Form::date('fecha_inicio_inc', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                    <div class="input-group-prepend">
                      <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                    </div>
                  </div>
        {{ Form::label('tipo_inc_gral', 'Tipo de incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
          <div class="col-sm">
          {{ Form::select('tipo_inc_gral', 
          array('' => 'Seleccionar...',
                'EG' => 'Enfermedad General',
                'LM' => 'Licencia Médica',
                'M' => 'Maternidad'
          ),null,array('required'=>'required','id'=>'turno_pac','class'=>'form-control')) }}
          </div>
      </div>
  @endif
@else

<div class="form-group row">
      {{ Form::label('fecha_inicio_inc', 'Fecha inicio incapacidad : ',array('class' => 'col-sm-3 col-form-label')) }}
                  <div class="input-group col-sm-4">
                    {{ Form::date('fecha_inicio_inc', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                    <div class="input-group-prepend">
                      <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                    </div>
                  </div>
      {{ Form::label('tipo_inc_gral', 'Tipo de incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
          <div class="col-sm">
          {{ Form::select('tipo_inc_gral', 
          array('' => 'Seleccionar...',
                'EG' => 'Enfermedad General',
                'LM' => 'Licencia Médica',
                'M' => 'Maternidad'
          ),null,array('required'=>'required','id'=>'turno_pac','class'=>'form-control')) }}
          </div>
      </div>

@endif
     <div class="form-group row">
		{{ Form::label('fecha_ing_lab', 'Fecha ing laborar: ',array('class' => 'col-sm-3 col-form-label')) }}
                <div class="input-group col-sm-4">
                  {{ Form::date('fecha_ing_lab', null,array('class' => 'form-control', 'placeholder' => 'DD/MM/AAAA','readonly'=>'readonly')) }}
                  <div class="input-group-prepend">
                    <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                  </div>
                </div>
         </div>

        <div class="form-group row">
          {{ Form::label('observaciones_inc', 'Observaciones: ',array('class' => 'col-sm-2 col-form-label')) }}
          <div class="col-sm">
          {{ Form::text('observaciones_inc', null, array('class' => 'form-control', 'placeholder' => 'Observaciones')) }}
          </div>
        </div>

@if(!isset($incapacidad))

	<div class="row justify-content-center">
		<div class="col-4">
			<button class='btn btn-success' type='submit' value='submit' >
					<span class='fas fa-save'> </span> Guardar y continuar
			</button>
		</div>
	</div>
 @endif

@if(isset($incapacidad))

	<div id="incapacidades">


	<div class="form-group row">
				<div class="col-sm text-center">
					<h4 class="d-block" style="background-color: #34495E; color:#fff; margin: 15px;">Datos Generales Incapacidad</h4>
				</div>
			</div>

       <div class="form-group row">
         	{{ Form::label('dias_totales_inc', 'Dias totales:',array('class' => 'col-sm-2 col-form-label')) }}
                
	        <div class="col-sm-2">
	            {{ Form::text('dias_totales_inc', null, array('class' => 'form-control','readonly'=>'readonly')) }}
	        </div>

	        <div class="col-sm-2">
				<a data-toggle="modal" class="btn btn-success" href="{{ route('incapacidades.altaDet',[$incapacidad->id_incapacidad, 'i']) }}" data-target="#altaDet" id='btnAltaDet'><span class="fas fa-file-medical"></span></a>
			</div>
    </div>
    {!! Form::close() !!}
        <div class="form-group row">

        	@if($detIncapacidad->count() > 0)
        	<table id="tab_pac" class="table table-bordered tablesorter">
		        <thead class="thead-blue">
		        <tr>
		            <th>Folio</th>
		            <th>Inicia</th>
		            <th>Termina</th>
		            <th>Días</th>
		            <th>Diagnóstico</th>
		            <th>Tipo</th>
		            <th width="180px">Accciones</th>
		        </tr>
		    </thead>
		    @php
        	  $detIncapacidad=$detIncapacidad->get();
        	  $i=0;
        	@endphp
	@foreach ($detIncapacidad as $det)
	  @php
        $i++;
    @endphp
    <tr>
        <td>{{ $det->folio_inc}}</td>
        @php
            $mes='';
            switch(substr($det->fecha_ini_inc_det,5,2)){
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
        <td>{{substr($det->fecha_ini_inc_det,8,2).'-'.$mes.'-'.substr($det->fecha_ini_inc_det,0,4)}}</td>

        @php
        	$fecha_inicio = date("Y-m-d",strtotime($det->fecha_ini_inc_det));
        	$nuevafecha = date("Y-m-d",strtotime($fecha_inicio."+ ".($det->dias_inc-1)." days"));

        	$mes='';
            switch(substr($nuevafecha,5,2)){
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
        <td>{{substr($nuevafecha,8,2).'-'.$mes.'-'.substr($nuevafecha,0,4)}}</td>
        <td>{{ $det->dias_inc}}</td>
        <td>{{ $det->diagnostico_inc}}</td>
        <td>{{ $det->tipo_inc}}</td>
        <td>
             <center>
            <a data-toggle="modal" class="btn btn-primary btnEditDet" href="{{ route('incapacidades.editDet',[$det->id_det_incapacidad, 'i']) }}" data-target="#editDet"><span class="fas fa-edit"></span></a>
            @if($detIncapacidad->count()==$i)
            	{!! Form::open(['method' => 'DELETE','route' => ['detIncapacidad.destroy', $det->id_det_incapacidad],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("la incapacidad del paciente","'.$incapacidad->paciente->nombre_pac.'","'.$det->folio_inc.'")']) !!} 
                
                    <button class='btn btn-danger' type='submit' value='submit' title="Borrar">
                        <span class='fas fa-times'> </span>
                    </button>                        
                {!! Form::close() !!}
            @endif
            </center>
        </td>
    </tr>
    @endforeach
		</table>
		    @else
		     <div class="col-md-12 col-md-offset-1">
		    <div class="alert alert-warning" role="alert">
			  <h4 class="alert-heading">Incapacidad Registrada</h4>
			  <p>Se han registrado correctamente los datos generales de la incapacidad.</p>
			  <p class="mb-0">Por favor da de alta las incapacidades del trabajador.</p>
			</div>
		</div>

		    @endif

        </div>

</div><!-- Historia incapacidades -->

@endif

</div>
							
</div> <!-- CONTAINER-->

<!-- MODAL FIND-->

<div class="modal fade" id="findPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Seleccionar Paciente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrar-find">Cancelar</button>
				<button type="button" class="btn btn-success" id="usar-datos">Seleccionar Paciente</button>
			</div>
		</div>
	</div>
</div>

<!-- MODAL CAMARA-->

<div class="modal fade" id="altaDet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Registro de Incapaciad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer" id="modal-footer">
				<button type="button" class="btn btn-danger cerrar-cam" data-dismiss="modal" id="cerrar-altDet">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editDet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Editar Incapaciad</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer" id="modal-footer">
				<button type="button" class="btn btn-danger cerrar-cam" data-dismiss="modal" id="cerrar-altDet">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="terminarInc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terminar Incapaciad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-danger cerrar-cam" data-dismiss="modal" id="cerrar-altDet">Cancelar</button>
      </div>
    </div>
  </div>
</div>


@if(isset($incapacidad))
<script type="text/javascript">
	$(function() {

		var sexo = '{{ $incapacidad->paciente->sexo_pac }}';

        document.getElementById('nombre_pac').value= '{{ $incapacidad->paciente->nombre_pac }}';
        document.getElementById('nss_pac').value='{{ $incapacidad->paciente->nss_pac }}';
        document.getElementById('num_nomina_pac').value='{{ $incapacidad->paciente->num_nomina_pac }}';

        if(sexo=="M"){
            document.getElementById('sexo_m').checked = true;
        }

        if(sexo=="F"){
            document.getElementById('sexo_f').checked = true;
        }

	});
</script>
@endif

<script type="text/javascript">

/*##########  Funciones buscar PAciente  ##############*/

	window.closeModal=function(){
		$('#altaDet').modal('hide');
    $('#editDet').modal('hide');
    $('#terminarInc').modal('hide');
	}

	$('#btnFindPaciente').on('click', function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		$(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" src="'+url+'"></iframe>');
	});

	$('#btnAltaDet').on('click', function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		$(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" src="'+url+'" class="iframe_alta"></iframe>');
	});

    $('#btnTerminar').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" src="'+url+'" class="iframe_alta"></iframe>');
  });

	$('.btnEditDet').on('click', function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		$(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" src="'+url+'" class="iframe_alta"></iframe>');
	});

	$('#cerrar-altDet').on('click',function(e){
		$('#altaDet').modal('hide');
	});

 	$('#cerrar-find').on('click',function(e){
		$('#id_paciente').val(null);
		$('#nombre_pac').val(null);
		$('#nss_pac').val(null);
		$('#num_nomina_pac').val(null);
		$('#sexo_f').attr('checked', false);
		$('#sexo_m').attr('checked', false);
	});

	$('#usar-datos').on('click',function(e){
		if($('#id_paciente').val()==""){
			alert('Debes seleccionar un paciente');
		}
		else{
			$('#findPaciente').modal('hide');
			$('#datosAccidente').removeClass('d-none');
		}
	});

	$('#altaDet').on('hidden.bs.modal', function () {
		console.log('se cerro modal');
		window.setTimeout('location.reload()',1000);
    console.log('despues del setTime');
  });

  $('#editDet').on('hidden.bs.modal', function () {
    console.log('se cerro modal');
    window.setTimeout('location.reload()',1000);
    console.log('despues del setTime');
  });

@if(isset($incapacidad))
  $('#terminarInc').on('hidden.bs.modal', function () {
    console.log('se cerro modal Terminar Inc');
    window.setTimeout('window.location.href = "http://contitech.com/incapacidades/{{ $incapacidad->id_incapacidad }}";',1000);
  });

  @endif


</script>



