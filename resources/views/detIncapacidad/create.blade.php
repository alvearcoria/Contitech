 @include('includes.head')

    @if (count($errors) < 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     {!! Form::open(array('route' => 'detIncapacidad.store','method'=>'POST','onsubmit' => 'console.log("cierre create det"); window.parent.closeModal(); return true;')) !!}
         @include('detIncapacidad.form')
    {!! Form::close() !!}


