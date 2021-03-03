@extends('layouts.app')

@section('title_content')
    <i class="fa fa-cubes"></i> Módulos
@endsection

@section('title_card')
    <i class="fa fa-list"></i> Listado de módulos
@endsection

@section('content_card')

    @if (session('exito'))
        <span class="alert-success">{{ session('exito') }}</span>
    @endif

    @if (session('erro'))
        <span class="alert-success">{{ session('error') }}</span>
    @endif

    <section class="text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
            <i class="fa fa-plus-circle"></i> Nuevo registro
        </button>
    </section><br>

    @include('estimulos.modulos.tabla')

    @section('titulo_modal', 'Agregar módulo')
    @section('cuerpo_modal')
        <form action="{{ route('modulos.store') }}" method="POST">
            @csrf
            @include('estimulos.modulos.form')
            @section('botones_modal')
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Guardar
                </button>
        </form>
            @endsection
    @endsection
@endsection
