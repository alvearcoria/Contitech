@extends('layouts.sidebar')


@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar paciente</h2>
            </div>
            <div class="pull-right">
                 <a class="btn btn-danger" href="{{ route('pacientes.index') }}"><span class="fas fa-arrow-alt-circle-left"></span> Regresar</a>
            </div>
        </div>
    </div>


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

     {!! Form::model($paciente, ['method' => 'PATCH','route' => ['pacientes.update', $paciente->id_paciente]]) !!}
        @include('pacientes.form')
    {!! Form::close() !!}



@endsection