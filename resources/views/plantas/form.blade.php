
<br>
<div class="container">

  <h5>Datos de la Planta</h5>

             <div class="form-group row">
                {{ Form::label('siglas_pla', 'Siglas Planta:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm-2">
                  {{ Form::text('siglas_pla', null, array('class' => 'form-control', 'placeholder' => 'Siglas...','maxlength'=>'6','required' => 'required')) }}
                </div>

                {{ Form::label('nombre_pla', 'Nombre de la planta:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm">
                  {{ Form::text('nombre_pla', null, array('class' => 'form-control', 'placeholder' => 'Nombre de la planta')) }}
                </div>
              </div>

            <div class="form-group row">
                {{ Form::label('no_pla', 'No Planta:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm-1">
                  {{ Form::text('no_pla', null, array('class' => 'form-control', 'placeholder' => '00','onkeypress'=>'return valida_numeros(event)','maxlength'=>'2')) }}
                </div>
                  {{ Form::label('color_pla', 'Color:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm">
                  {{ Form::text('color_pla', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Color','maxlength'=>'20')) }}
                </div>
              </div>

                  <div class="row justify-content-center">
                    <div class="col-4">
                      <button class='btn btn-success' type='submit' value='submit'>
                        <span class='fas fa-save'> </span> Guardar
                      </button>
                    </div>
                  </div>


</div> <!-- CONTAINER-->




