@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Puestos</h2>
            </div>
        </div>
    </div>
        <div class="row">
        
            <div class="col-sm">
                <a href="{{ route('puestos.create') }}" class="btn btn-success"><span class="fas fa-plus-circle"></span> Registrar Puesto</a>
            </div>

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Puestos Totales: {{ $puestos->count() }} 
  </div>
    <div class="table-responsive-sm"    >
    <!--<table id="tab_pac" class="table table-bordered tablesorter" > -->
    <table id="tab_pac" class="table table-sm" style="font-size: 13px;">
        <thead class="thead-blue">
        <tr>
            <th>Id</th>
            <th>Nombre del Puesto</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    @foreach ($puestos as $puesto)
    <tr>
        <td>{{ $puesto->id_puesto}}</td>
        <td>{{ $puesto->nombre_puesto}}</td>
        <td>    
            <center>
            <a class="btn btn-primary" href="{{ route('puestos.edit',$puesto->id_puesto) }}"><span class="fas fa-edit" title="Editar Puesto"></span></a>
            {!! Form::open(['method' => 'DELETE','route' => ['puestos.destroy', $puesto->id_puesto],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("el puesto","'.$puesto->nombre_puesto.'","'.$puesto->id_puesto.'")']) !!}
                <button class='btn btn-danger' type='submit' value='submit' title="Borrar Puesto">
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