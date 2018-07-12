@extends('layouts.sidebar')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pacientes</h2>
            </div>
        </div>
    </div>
        <div class="row">
        
         {!! Form::open(['method'=>'get']) !!}
            <div class="col-sm">
                <div class="input-group">
                    <input class="form-control" id="search"
                           value="{{ request('search') }}"
                            name="search"
                           type="text" id="search"/>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-warning" >
                        <span class="fas fa-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
            <div class="col-sm">
                <a href="{{ route('pacientes.index') }}" class="btn btn-primary"><span class="fas fa-users"></span> Todos</a>
            </div>
            <div class="col-sm">
                <a href="{{ route('pacientes.create') }}" class="btn btn-success"><span class="fas fa-user-plus"></span> Registrar paciente</a>
            </div>

        </div>



    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

  <div class="cant" style="margin-top: 10px;">
    Pacientes Totales: {{ $pacientes->total() }} mostrando del {{ $pacientes->firstItem() }} al {{ $pacientes->lastItem() }}.
  </div>

    <table id="tab_pac" class="table table-bordered tablesorter">
        <thead class="thead-blue">
        <tr>
            <th>@sortablelink('id_paciente','Id')</th>
            <th>@sortablelink('nombre_pac','Nombre paciente')</th>
            <th>Sexo</th>
            <th>Número del Seguro Social (NSS)</th>
            <th>Número Nómina</th>
            <th width="280px">Accciones</th>
        </tr>
    </thead>
    @foreach ($pacientes as $paciente)
    <tr>
        <td> {{ $paciente->id_paciente}} </td>
        <td> {{ $paciente->nombre_pac }} </td>
        <td>
            <center>
            @if ($paciente->sexo_pac=="F")
                <span class="fa fa-female"></span>
            @else
                <span class="fa fa-male"></span>
            @endif
            </center>
        </td>
        <td>{{ $paciente->nss_pac }}</td>
        <td>{{ $paciente->num_nomina_pac }}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('pacientes.edit',$paciente->id_paciente) }}" title="Editar"><span class="fas fa-edit"></span></a>            
                {!! Form::open(['method' => 'DELETE','route' => ['pacientes.destroy', $paciente->id_paciente],'style'=>'display:inline','onsubmit' => 'return ConfirmDeleteModel("el paciente","'.$paciente->nombre_pac.'","'.$paciente->id_paciente.'")']) !!} 
                
                    <button class='btn btn-danger' type='submit' value='submit' title="Borrar">
                        <span class='fas fa-times'> </span>
                    </button>                        
                {!! Form::close() !!}
            
        </td>
    </tr>
    @endforeach
    </table>

    {!! $pacientes->appends(\Request::except('page'))->render() !!}

    <!--{!! $pacientes->links() !!}-->

@endsection



