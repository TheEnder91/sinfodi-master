@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de tecnologia->Investigacion cientifica->TablaB</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de tecnologia->Investigacion cientifica -> Tabla B.')
        <div class="row" id="contenedorCriterio36">
            <style type="text/css">
                h2 {
                    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
                    color: #B8860B;
                    font-weight: normal;
                    padding-left: 0px;
                }

                #content {
                    max-width: 600px;
                    background: #FFF;
                    padding: 20px 40px;
                    margin: 80px auto;
                    border: 1px solid #D9D9D6;
                }
            </style>
            <div id="content">
                <h2>Sin información por el momento</h2>
            </div>
        </div>
    @endcomponent
@endsection
