<style type="text/css">
    body {
    background-color: #cdcdce !important;
    background-image: url('{{ URL::asset('img/bienvenida.jpg') }}');
    background-repeat: no-repeat;
    background-position: center top;
}

</style>

@extends('layouts.sidebar')

@section('content')
<div class="container" style="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!--
            <div class="card">
                <div class="card-header">Bienvenidos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Este es el sistema para el control de pacientes de Sel Médica.
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection