@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Diagnosticos (Accidentabilidad)</h2>
            </div>
        </div>
    </div>
        <div class="row">
        
            <div class="col-sm">
                <a href="{{ route('diagnosticos.create') }}" class="btn btn-success"><span class="fas fa-plus-circle"></span> Registrar Diagnostico</a>
            </div>

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Diagnosticos Totales: {{ $diagnosticos->count() }} 
  </div>
    <div class="table-responsive-sm"    >
    <!--<table id="tab_pac" class="table table-bordered tablesorter" > -->
    <table id="tab_pac" class="table table-sm" style="font-size: 13px;">
        <thead class="thead-blue">
        <tr>
            <th>Id</th>
            <th>Nombre del Diagnostico</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    @foreach ($diagnosticos as $diagnostico)
    <tr>
        <td>{{ $diagnostico->id_diagn}}</td>
        <td>{{ $diagnostico->nombre_diagn}}</td>
        <td>    
            <center>
            <a class="btn btn-primary" href="{{ route('diagnosticos.edit',$diagnostico->id_diagn) }}"><span class="fas fa-edit" title="Editar Diagnostico"></span></a>
            {!! Form::open(['method' => 'DELETE','route' => ['diagnosticos.destroy', $diagnostico->id_diagn],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("el diagnostico","'.$diagnostico->nombre_diagn.'","'.$diagnostico->id_diagn.'")']) !!}
                <button class='btn btn-danger' type='submit' value='submit' title="Borrar Diagnostico">
                    <span class='fas fa-times' > </span>
                </button>
            {!! Form::close() !!}
            </center>
        </td>
    </tr>
    @endforeach
    </table>
</div>

@endsection