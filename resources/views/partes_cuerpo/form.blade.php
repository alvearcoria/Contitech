
<br>
<div class="container">

  <h5>Datos de la parte del cuerpo </h5>

             <div class="form-group row">

                {{ Form::label('nombre_parte_cuerpo', 'Nombre de la parte del cuerpo:',array('class' => 'col-sm-2 col-form-label')) }}
                
                <div class="col-sm">
                  {{ Form::text('nombre_parte_cuerpo', null, array('class' => 'form-control', 'placeholder' => 'Nombre de la parte del cuerpo')) }}
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




