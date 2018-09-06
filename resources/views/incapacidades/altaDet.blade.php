<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>

    <body>
        <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

         {!! Form::open(array('route' => 'incapacidades.storeDetInc','method'=>'POST')) !!}

        <div class="form-group row">
                <div class="col-sm text-center">
                    <h4 class="d-block" style="background-color: #34495E; color:#fff; margin: 15px;">Registro de incapacidad</h4>
                </div>
            </div>

        <div class="form-group row">
        {{ Form::label('fecha_rec_inc', 'Fecha en que se recibe: ',array('class' => 'col-sm-4 col-form-label')) }}
                <div class="input-group col-sm-4">
                  {{ Form::date('fecha_rec_inc', null,array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'DD/MM/AAAA')) }}
                  <div class="input-group-prepend">
                    <span class="input-group-text fas fa-calendar" id="inputGroupPrepend2"></span>
                  </div>
                </div>
         </div>

         {!! Form::close() !!}

        </div>

    </body>
</html>