@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/')  }}">Inicio</a></li>
        <li class="breadcrumb-item active">Grupo 2</li>
        <li class="breadcrumb-item active">Factor 3</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Factor 3')
        <div class="container" style="border: solid 1px #000; border-radius: 5px; padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; font-weight: bold;">
            <div class="table-responsive">
                <table id="tblColaboradores" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col"  colspan="2" style="font-size:13px;">FACTOR DEL NIVEL DE IMPACTO AL DESARROLLO INSTITUCIONAL</th>
                        </tr>
                        <tr class="text-center">
                            <th scope="col" style="font-size:13px;">F2=Factor</th>
                            <th scope="col" style="font-size:13px;">Nivel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:13px;" class="text-center">1</td>
                            <td style="font-size:13px;" class="text-center">Medio</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endcomponent
@endsection
