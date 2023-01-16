@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/')  }}">Inicio</a></li>
        <li class="breadcrumb-item active">Lineamientos o reglamento para estimulos</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Lineamientos o reglamento para estimulos.')
        <style>
            .embed-container {
                position: relative;
                padding-bottom: 56.25%;
                height: 0;
                overflow: hidden;
            }
            .embed-container iframe {
                position: absolute;
                top:0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
        <div class="embed-container">
            <iframe src="{{asset('files/lineamiento/lineamientos.pdf')}}" frameborder="0" allowfullscreen></iframe>
        </div>
    @endcomponent
@endsection
