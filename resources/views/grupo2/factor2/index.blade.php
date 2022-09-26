@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/')  }}">Inicio</a></li>
        <li class="breadcrumb-item active">Grupo 2</li>
        <li class="breadcrumb-item active">Factor 2</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Factor 2')
        <div class="container" style="border: solid 1px #000; border-radius: 5px; padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; font-weight: bold;">
            Conforme a los Lineamientos para el Otorgamiento de Estímulos por Proyecto del Personal Científico y Tecnológico del CIDETEQ en el
            ANEXO 1 página 13; criterio de la Dirección General de no evaluarse y acordado por el Comité de Estímulos conforme al oficio SDCH-056-
            2022 de fecha 13 de junio 2022.
        </div>
    @endcomponent
@endsection
