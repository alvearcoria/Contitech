 @include('includes.head')
<br>
<div class="container">

	   {!! Form::model($incapacidad, ['method' => 'PATCH','route' => ['incapacidades.terminar', $incapacidad->id_incapacidad],'onsubmit' => 'console.log("cierre modal terminar"); window.parent.closeModal(); return true;']) !!}

       <div class="form-group row">
      {{ Form::label('fecha_ing_lab', 'Fecha estimada de ingreso a laborar : ',array('class' => 'col-sm-5 col-form-label')) }}
                  <div class="input-group col-sm-4">
                    {{ Form::date('fecha_ing_lab', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA','readonly'=>'readonly')) }}
                    <div class="input-group-prepend">
                      <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                    </div>
                  </div>
      </div>

      <div class="form-group row">
      {{ Form::label('fecha_st_2', 'Fecha de alta : ',array('class' => 'col-sm-5 col-form-label')) }}
                  <div class="input-group col-sm-4">
                    {{ Form::date('fecha_st_2', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                    <div class="input-group-prepend">
                      <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                    </div>
                  </div>
      </div>

      <div class="form-group row">
      {{ Form::label('fecha_ing_lab_real', 'Fecha real de ingreso a laborar : ',array('class' => 'col-sm-5 col-form-label')) }}
                  <div class="input-group col-sm-4">
                    {{ Form::date('fecha_ing_lab_real', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
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

     <div class="row justify-content-center">
                    <div class="col-4">
                      <button class='btn btn-success' type='submit' value='submit' onclick="return">
                        <span class='fas fa-save'> </span> Guardar
                      </button>
                    </div>
                  </div>

    {!! Form::close() !!}
</div>


<script type="text/javascript">
	


</script>

