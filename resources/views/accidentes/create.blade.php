@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Registrar nuevo accidente</h2>
            </div>
                <a class="btn btn-danger" href="{{ route('accidentes.index') }}"><span class="fas fa-arrow-alt-circle-left"></span> Regresar</a>
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


    {!! Form::open(array('route' => 'accidentes.store','method'=>'POST')) !!}
         @include('accidentes.form')
    {!! Form::close() !!}


@endsection