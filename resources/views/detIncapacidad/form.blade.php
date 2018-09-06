
<br>
<div class="container">

      <div class="form-group row">
        {{ Form::hidden('id_incapacidad', $incapacidad->id_incapacidad, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'ID','id'=>'id_incapacidad','readonly'=>'readonly')) }}

        {{ Form::label('fecha_rec_inc', 'Fecha en que se recibe: ',array('class' => 'col-sm col-form-label')) }}
                <div class="input-group col-sm">
                  {{ Form::date('fecha_rec_inc', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                  <div class="input-group-prepend">
                    <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                  </div>
                </div>
              
          @if($incapacidad->detIncapacidad->count()==0)
             {{ Form::label('fecha_ini_inc_det', 'Fecha de inicio de Incapacidad: ',array('class' => 'col-sm col-form-label')) }}
                <div class="input-group col-sm">
                  {{ Form::date('fecha_ini_inc_det',$incapacidad->fecha_inicio_inc,array('class' => 'form-control','readonly'=>'readonly','required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                  <div class="input-group-prepend">
                    <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                  </div>
                </div>
          @elseif($incapacidad->detIncapacidad->count()>0 && isset($detIncapacidad))
         {{ Form::label('fecha_ini_inc_det', 'Fecha de inicio de Incapacidad: ',array('class' => 'col-sm col-form-label')) }}
                <div class="input-group col-sm">
                  {{ Form::date('fecha_ini_inc_det',$detIncapacidad->fecha_inicio_inc_det ,array('class' => 'form-control','readonly'=>'readonly','required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                  <div class="input-group-prepend">
                    <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                  </div>
                </div>
          @else
            @php
              $fecha_inicio = date("Y-m-d",strtotime($incapacidad->detIncapacidad->last()->fecha_ini_inc_det));
              $nuevafecha = date("Y-m-d",strtotime($fecha_inicio."+ ".($incapacidad->detIncapacidad->last()->dias_inc)." days"));
            @endphp
            {{ Form::label('fecha_ini_inc_det', 'Fecha de inicio de Incapacidad: ',array('class' => 'col-sm col-form-label')) }}
                <div class="input-group col-sm">
                  {{ Form::date('fecha_ini_inc_det',$nuevafecha ,array('class' => 'form-control','readonly'=>'readonly','required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                  <div class="input-group-prepend">
                    <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                  </div>
                </div>
          @endif
      </div>

      <div class="form-group row">
         {{ Form::label('folio_inc', 'Folio: ',array('class' => 'col-sm-1 col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('folio_inc', null, array('class' => 'form-control','maxlength'=>'15','required' => 'required')) }}
                  </div>

          @if($origen == 'i')

          {{ Form::label('tipo_inc', 'Tipo de incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
          <div class="col-sm">
          {{ Form::select('tipo_inc', 
          array('' => 'Seleccionar...',
                'EG' => 'Enfermedad General',
                'LM' => 'Licencia Médica',
                'M' => 'Maternidad'
          ),null,array('required'=>'required','id'=>'turno_pac','class'=>'form-control')) }}
          </div>

          @else
          {{ Form::label('tipo_inc', 'Tipo de incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
          <div class="col-sm">
          {{ Form::select('tipo_inc', 
          array('' => 'Seleccionar...',
                'Int' => 'Incapacidad Interna',
                'AT' => 'Accidente de Trabajo',
                'ATR' => 'Accidente de Trayecto'
          ),null,array('required'=>'required','id'=>'turno_pac','class'=>'form-control')) }}
          </div>

          @endif

          @if(isset($dias_edit) and $dias_edit==false)
                  {{ Form::label('dias_inc', 'Dias de Incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('dias_inc', null, array('class' => 'form-control','placeholder' => '000','onkeypress'=>'return valida_numeros(event)','maxlength'=>'3','required' => 'required','readonly'=>'readonly')) }}
                  </div>
          @else
            {{ Form::label('dias_inc', 'Dias de Incapacidad: ',array('class' => 'col-sm-2 col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('dias_inc', null, array('class' => 'form-control','placeholder' => '000','onkeypress'=>'return valida_numeros(event)','maxlength'=>'3','required' => 'required')) }}
                  </div>

        @endif
       
      </div>

        <div class="form-group row">
          {{ Form::label('diagnostico_inc', 'Diagnostico Incapacidad: ',array('class' => 'col-sm-3 col-form-label')) }}
          <div class="col-sm">
            {{ Form::text('diagnostico_inc', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Diagnostico...','maxlength'=>'70')) }}
          </div>
        </div>

        @if(isset($detIncapacidad) and $detIncapacidad->incapacidad_pdf_url =! "")
          <div class="form-group row">
            {{ Form::label('incapacidad_pdf_url', 'Nombre del archivo: ',array('class' => 'col-sm-3 col-form-label')) }}
            <div class="col-sm">
              {{ Form::text('incapacidad_pdf_url', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Diagnostico...','maxlength'=>'70')) }}
            </div>
          </div>

          {{ dd($detIncapacidad) }}

          <div class="form-group row">
              {{ Form::label('incapacidad_pdf', 'Archivo de Incapacidad: ',array('class' => 'col-sm-3 col-form-label')) }}
              <div class="col-sm">
                {{ Form::file('incapacidad_pdf', ['class' => 'form-control','accept' => 'application/pdf']) }}
            </div>
             <div class="col-sm-3">
                {{ Form::label('comentario_pdf', '* Solo acepta archivos PDF ',array('style'=>'font-size:12px;', 'class' => 'col-sm col-form-label')) }}
            </div>
         </div>
        @else
         <div class="form-group row">
              {{ Form::label('incapacidad_pdf', 'Archivo de Incapacidad: ',array('class' => 'col-sm-3 col-form-label')) }}
              <div class="col-sm">
                {{ Form::file('incapacidad_pdf', ['class' => 'form-control','accept' => 'application/pdf','required'=>'require']) }}
            </div>
             <div class="col-sm-3">
                {{ Form::label('comentario_pdf', '* Solo acepta archivos PDF ',array('style'=>'font-size:12px;', 'class' => 'col-sm col-form-label')) }}
            </div>
         </div>
         @endif

                  <div class="row justify-content-center">
                    <div class="col-4">
<button class='btn btn-success' type='submit' value='submit'>
                        <span class='fas fa-save'> </span> Guardar
                      </button>
                    </div>
                  </div>


</div> <!-- CONTAINER-->