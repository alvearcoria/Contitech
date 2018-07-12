@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Datos de la parte del cuerpo (Accidentabilidad)</h2>
            </div>
        </div>
    </div>
        <div class="row">
        
            <div class="col-sm">
                <a href="{{ route('partes_cuerpo.create') }}" class="btn btn-success"><span class="fas fa-plus-circle"></span> Registrar partes del cuerpo</a>
            </div>

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Partes Totales: {{ $partes_cuerpo->count() }} 
  </div>
    <div class="table-responsive-sm"    >
    <!--<table id="tab_pac" class="table table-bordered tablesorter" > -->
    <table id="tab_pac" class="table table-sm" style="font-size: 13px;">
        <thead class="thead-blue">
        <tr>
            <th>Id</th>
            <th>Nombre de la parte del cuerpo</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    @foreach ($partes_cuerpo as $parte_cuerpo)
    <tr>
        <td>{{ $parte_cuerpo->id_parte_cuerpo}}</td>
        <td>{{ $parte_cuerpo->nombre_parte_cuerpo}}</td>
        <td>    
            <center>
            <a class="btn btn-primary" href="{{ route('partes_cuerpo.edit',$parte_cuerpo->id_parte_cuerpo) }}"><span class="fas fa-edit" title="Editar Parte del Cuerpo"></span></a>
            {!! Form::open(['method' => 'DELETE','route' => ['partes_cuerpo.destroy', $parte_cuerpo->id_parte_cuerpo],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("la parte del cuerpo","'.$parte_cuerpo->nombre_parte_cuerpo.'","'.$parte_cuerpo->id_parte_cuerpo.'")']) !!}
                <button class='btn btn-danger' type='submit' value='submit' title="Borrar Parte">
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