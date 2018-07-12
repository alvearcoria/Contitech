
<br>
<div class="container">

  <h5>Datos de la Diagnostico</h5>

             <div class="form-group row">

                {{ Form::label('nombre_diagn', 'Nombre del diagnostico:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm">
                  {{ Form::text('nombre_diagn', null, array('class' => 'form-control', 'placeholder' => 'Nombre del diagnostico')) }}
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




