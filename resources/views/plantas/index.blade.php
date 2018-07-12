@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Plantas</h2>
            </div>
        </div>
    </div>
        <div class="row">
        
            <div class="col-sm">
                <a href="{{ route('plantas.create') }}" class="btn btn-success"><span class="fas fa-plus-circle"></span> Registrar Planta</a>
            </div>

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Clientes Totales: {{ $plantas->count() }} 
  </div>
    <div class="table-responsive-sm"    >
    <!--<table id="tab_pac" class="table table-bordered tablesorter" > -->
    <table id="tab_pac" class="table table-sm" style="font-size: 13px;">
        <thead class="thead-blue">
        <tr>
            <th>Id</th>
            <th>Nombre de la Planta</th>
            <th>Siglas</th>
            <th>No Planta</th>
            <th>Color</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    @foreach ($plantas as $planta)
    <tr>
        <td>{{ $planta->id_planta}}</td>
        <td>{{ $planta->nombre_pla}}</td>
        <td>{{ $planta->siglas_pla}}</td>
        <td>{{ $planta->no_pla}}</td>
        <td>{{ $planta->color_pla}}</td>
        <td>
            <center>
            <a class="btn btn-primary" href="{{ route('plantas.edit',$planta->id_planta) }}"><span class="fas fa-edit" title="Editar Cliente"></span></a>
            {!! Form::open(['method' => 'DELETE','route' => ['plantas.destroy', $planta->id_planta],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("la planta","'.$planta->nombre_pla.'","'.$planta->id_planta.'")']) !!}
                <button class='btn btn-danger' type='submit' value='submit' title="Borrar Cliente">
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