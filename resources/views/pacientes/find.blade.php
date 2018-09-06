<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>

    <body>
    <div class="container">
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
                <a href="{{ route('pacientes.find') }}" class="btn btn-primary"><span class="fas fa-users"></span> Todos</a>
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
            <th>Seleccionar</th>
        </tr>
    </thead>
    @php $i=1;@endphp
    @foreach ($pacientes as $paciente)
    <tr>
        <td>{{ $paciente->id_paciente}}</td>
        <td>{{ $paciente->nombre_pac}}</td>
        <td>
            <button id='button@php echo $i;@endphp' class='btn btn-default' type='button' onclick="return cargarPaciente(this,'{{ $paciente->id_paciente}}','{{ $paciente->nombre_pac}}','{{ $paciente->nss_pac}}','{{ $paciente->num_nomina_pac}}','{{ $paciente->sexo_pac }}')">
                <span class='fas fa-check-circle'> </span>
            </button>
        </td>
    </tr>
    @php
    $i++;
    @endphp
    @endforeach
    </table>

    {!! $pacientes->appends(\Request::except('page'))->render() !!}

    <!--{!! $pacientes->links() !!}-->
</div>

<script type="text/javascript">

    function cargarPaciente(buton,id,name,nss,nomina,sexo){

        parent.document.getElementById('id_paciente').value="";
        parent.document.getElementById('nombre_pac').value="";
        parent.document.getElementById('nss_pac').value="";
        parent.document.getElementById('num_nomina_pac').value="";
        parent.document.getElementById('sexo_m').checked = false;
        parent.document.getElementById('sexo_f').checked = false;


        $('.btn').removeClass('btn-success').addClass('btn-default');

        parent.document.getElementById('id_paciente').value=id;
        parent.document.getElementById('nombre_pac').value=name;
        parent.document.getElementById('nss_pac').value=nss;
        parent.document.getElementById('num_nomina_pac').value=nomina;

        if(sexo=="M"){
            parent.document.getElementById('sexo_m').checked = true;
        }

        if(sexo=="F"){
            parent.document.getElementById('sexo_f').checked = true;
        }

        $('#'+buton.id).addClass('btn-success');

}


</script>


