@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Areas</h2>
            </div>
        </div>
    </div>
        <div class="row">
        
            <div class="col-sm">
                <a href="{{ route('areas.create') }}" class="btn btn-success"><span class="fas fa-plus-circle"></span> Registrar Area</a>
            </div>

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Areas Totales: {{ $areas->count() }} 
  </div>
    <div class="table-responsive-sm"    >
    <!--<table id="tab_pac" class="table table-bordered tablesorter" > -->
    <table id="tab_pac" class="table table-sm" style="font-size: 13px;">
        <thead class="thead-blue">
        <tr>
            <th>Id</th>
            <th>Nombre del Area</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    @foreach ($areas as $area)
    <tr>
        <td>{{ $area->id_area}}</td>
        <td>{{ $area->nombre_area}}</td>
        <td>    
            <center>
            <a class="btn btn-primary" href="{{ route('areas.edit',$area->id_area) }}"><span class="fas fa-edit" title="Editar Area"></span></a>
            {!! Form::open(['method' => 'DELETE','route' => ['areas.destroy', $area->id_area],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("el area","'.$area->nombre_area.'","'.$area->id_area.'")']) !!}
                <button class='btn btn-danger' type='submit' value='submit' title="Borrar Area">
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