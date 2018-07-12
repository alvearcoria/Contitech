@extends('layouts.sidebar')


@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Area</h2>
            </div>
            <div class="pull-right">
                 <a class="btn btn-danger" href="{{ route('areas.index') }}"><span class="fas fa-arrow-alt-circle-left"></span> Regresar</a>
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

     {!! Form::model($area, ['method' => 'PATCH','route' => ['areas.update', $area->id_area]]) !!}
        @include('areas.form')
    {!! Form::close() !!}



@endsection