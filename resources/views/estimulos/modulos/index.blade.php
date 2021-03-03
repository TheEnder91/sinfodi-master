@extends('layouts.app')

@section('title_content')
    <i class="fa fa-cubes"></i> Módulos
@endsection

@section('title_card', 'Listado de módulos')

@section('content_card')
    <section class="text-right">
        <button class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Nuevo registro
        </button>
    </section><br>
    @include('estimulos.modulos.tabla')
@endsection
