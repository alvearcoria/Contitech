
<br>
<div class="container">

  <h5>Datos de la Puesto</h5>

             <div class="form-group row">

                {{ Form::label('nombre_puesto', 'Nombre del puesto:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm">
                  {{ Form::text('nombre_puesto', null, array('class' => 'form-control', 'placeholder' => 'Nombre del puesto')) }}
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




