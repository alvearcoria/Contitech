
<div class="container">

  <h5>Datos del Paciente</h5>

      

            <div class="form-group row">
                {{ Form::label('nombre_pac', 'Nombre:',array('class' => 'col-sm-3 col-form-label')) }}
                
                <div class="col-sm">
                  {{ Form::text('nombre_pac', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nombres (s)')) }}
                </div>

                  {{ Form::label('sexo_pac', 'Sexo: ',array('class' => 'col-sm-2 col-form-label')) }}
                <div class="col-sm">
                    <div class="custom-control custom-radio custom-control-inline">
                      {{ Form::radio('sexo_pac', 'M', false, array('id'=>'sexo_m','class' => 'custom-control-input','required'=>'required')) }}
                      <label class="custom-control-label" for="sexo_m">
                            <span class="fa fa-male"></span>
                        </label>
                    </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        {{ Form::radio('sexo_pac', 'F', false, array('id'=>'sexo_f','class' => 'custom-control-input','required'=>'required')) }}
                        <label class="custom-control-label" for="sexo_f">
                            <span class="fa fa-female"></span>
                        </label>
                      </div>
                </div>

              </div>

              <div class="form-group row">
                  
                  {{ Form::label('nss_pac', 'Número del Seguro Social: ',array('class' => 'col-sm-3 col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('nss_pac', null, array('class' => 'form-control','placeholder' => 'NSS...','onkeypress'=>'return valida_numeros(event)','maxlength'=>'12')) }}
                  </div>

                  {{ Form::label('num_nomina_pac', 'Número de nómina: ',array('class' => 'col-sm col-form-label')) }}
                  <div class="col-sm">
                    {{ Form::text('num_nomina_pac', null, array('class' => 'form-control','placeholder' => 'Nómina...','onkeypress'=>'return valida_numeros(event)','maxlength'=>'10')) }}
                  </div>

              </div>
                  
                  <div class="row justify-content-center">
                    <div class="col-4">
                      <button class='btn btn-success' type='submit' value='submit' onclick="return">
                        <span class='fas fa-save'> </span> Guardar
                      </button>
                    </div>
                  </div>


</div> <!-- CONTAINER-->





