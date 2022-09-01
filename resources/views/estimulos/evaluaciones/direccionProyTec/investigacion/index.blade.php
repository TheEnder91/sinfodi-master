@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de proyectos tecnologicos->Investigación cientifica</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de proyectos tecnologicos->Investigación cientifica.')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();" style="font-size:13px;">
                        @for ($i = date('Y'); $i >= 2021; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            @foreach ($criterios as $item)
                                <li class="nav-item">
                                    <a class="nav-link {{ $item->id == 6 ? 'active' : '' }}" id="objetivo-{{ $item->id }}" data-toggle="pill" href="#objetivos-{{ $item->id }}" role="tab" aria-controls="objetivos-{{ $item->id }}" aria-selected="true">
                                        @if ($item->id == 6)
                                            Hasta 2.0
                                        @endif
                                        @if ($item->id == 7)
                                            Entre 2.0 y 4.0
                                        @endif
                                        @if ($item->id == 8)
                                            Mayor de 4.0
                                        @endif
                                        @if ($item->id == 9)
                                            Autor de libros
                                        @endif
                                        @if ($item->id == 10)
                                            Memorias internacionales
                                        @endif
                                        @if ($item->id == 11)
                                            Memorias nacionales
                                        @endif
                                        @if ($item->id == 12)
                                            Editor de libros
                                        @endif
                                        @if ($item->id == 13)
                                            Publicación de capítulos
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach ($criterios as $item)
                                <div class="tab-pane fade show {{ $item->id == 6 ? 'active' : '' }}" id="objetivos-{{ $item->id }}" role="tabpanel" aria-labelledby="objetivo-{{ $item->id }}">
                                    @if ($item->id == 6)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio6')
                                    @endif
                                    @if ($item->id == 7)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio7')
                                    @endif
                                    @if ($item->id == 8)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio8')
                                    @endif
                                    @if ($item->id == 9)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio9')
                                    @endif
                                    @if ($item->id == 10)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio10')
                                    @endif
                                    @if ($item->id == 11)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio11')
                                    @endif
                                    @if ($item->id == 12)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio12')
                                    @endif
                                    @if ($item->id == 13)
                                        @include('estimulos.evaluaciones.direccionProyTec.investigacion.tblCriterio13')
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initVer);

        function initVer(){
            VerDatos(0);
            $('#btnActualizarCriterio6').on('click', actualizarEvidenciasCriterio6);
            $('#btnActualizarCriterio7').on('click', actualizarEvidenciasCriterio7);
            $('#btnActualizarCriterio8').on('click', actualizarEvidenciasCriterio8);
            $('#btnActualizarCriterio9').on('click', actualizarEvidenciasCriterio9);
            $('#btnActualizarCriterio10').on('click', actualizarEvidenciasCriterio10);
            $('#btnActualizarCriterio11').on('click', actualizarEvidenciasCriterio11);
            $('#btnActualizarCriterio13').on('click', actualizarEvidenciasCriterio13);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            VerDatos(year);
        }

        function VerDatos(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            obtenerCriterio6(año, 6);
            obtenerCriterio7(año, 7);
            obtenerCriterio8(año, 8);
            obtenerCriterio9(año, 9);
            obtenerCriterio10(año, 10);
            obtenerCriterio11(año, 11);
            obtenerCriterio12(año, 12);
            obtenerCriterio13(año, 13);
        }
    </script>
@endsection
