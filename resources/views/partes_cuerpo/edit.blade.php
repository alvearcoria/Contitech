@extends('layouts.sidebar')


@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Partes Cuerpo</h2>
            </div>
            <div class="pull-right">
                 <a class="btn btn-danger" href="{{ route('partes_cuerpo.index') }}"><span class="fas fa-arrow-alt-circle-left"></span> Regresar</a>
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

     {!! Form::model($parte_cuerpo, ['method' => 'PATCH','route' => ['partes_cuerpo.update', $parte_cuerpo->id_parte_cuerpo]]) !!}
        @include('partes_cuerpo.form')
    {!! Form::close() !!}



@endsection