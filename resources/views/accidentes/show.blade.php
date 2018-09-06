<style>
#loading {
    position: absolute;
  
    padding-top: 100px;
    z-index: 1;
    display:block;
    width: 100%;
    height:1500;
    min-height:100vh;
    overflow: hidden;
    top: 0;
    bottom: 0;
    background: url('{{ URL::asset('img/loader.gif') }}') no-repeat center 250px;
    background-color: rgba(0,0,0,0.4);
}

</style>

<div id="loading"></div>
@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ver accidente</h2>
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


    {!! Form::model($accidente, ['method' => 'PATCH','route' => ['accidentes.update', $accidente->id_accidente]]) !!}
         @include('accidentes.form2')



@endsection