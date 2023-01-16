@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de tecnologia->Formación de recursos humanos</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de tecnologia->Formación de recursos humanos.')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año a evaluar:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();" style="font-size:13px; text-align:center;">
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
                                    <a class="nav-link {{ $item->id == 24 ? 'active' : '' }}" id="objetivo-{{ $item->id }}" data-toggle="pill" href="#objetivos-{{ $item->id }}" role="tab" aria-controls="objetivos-{{ $item->id }}" aria-selected="true">
                                        @if ($item->id == 24)
                                            Verano
                                        @endif
                                        @if ($item->id == 25)
                                            Servicio social
                                        @endif
                                        @if ($item->id == 26)
                                            Practicas profesionales
                                        @endif
                                        @if ($item->id == 27)
                                            Residencias profesionales
                                        @endif
                                        @if ($item->id == 28)
                                            Tesis de TSU
                                        @endif
                                        @if ($item->id == 29)
                                            Tesis de licenciatura
                                        @endif
                                        @if ($item->id == 30)
                                            Tesis de maestría
                                        @endif
                                        @if ($item->id == 31)
                                            Tesis de doctorado
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach ($criterios as $item)
                                <div class="tab-pane fade show {{ $item->id == 24 ? 'active' : '' }}" id="objetivos-{{ $item->id }}" role="tabpanel" aria-labelledby="objetivo-{{ $item->id }}">
                                    @if ($item->id == 24)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio24')
                                    @endif
                                    @if ($item->id == 25)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio25')
                                    @endif
                                    @if ($item->id == 26)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio26')
                                    @endif
                                    @if ($item->id == 27)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio27')
                                    @endif
                                    @if ($item->id == 28)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio28')
                                    @endif
                                    @if ($item->id == 29)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio29')
                                    @endif
                                    @if ($item->id == 30)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio30')
                                    @endif
                                    @if ($item->id == 31)
                                        @include('estimulos.evaluaciones.direccionProyTec.formacion.tblCriterio31')
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
            $('#btnActualizarCriterio24').on('click', actualizarEvidenciasCriterio24);
            $('#btnActualizarCriterio25').on('click', actualizarEvidenciasCriterio25);
            $('#btnActualizarCriterio26').on('click', actualizarEvidenciasCriterio26);
            $('#btnActualizarCriterio27').on('click', actualizarEvidenciasCriterio27);
            $('#btnActualizarCriterio28').on('click', actualizarEvidenciasCriterio28);
            $('#btnActualizarCriterio29').on('click', actualizarEvidenciasCriterio29);
            $('#btnActualizarCriterio30').on('click', actualizarEvidenciasCriterio30);
            $('#btnActualizarCriterio31').on('click', actualizarEvidenciasCriterio31);
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
            obtenerCriterio24(año, 24);
            obtenerCriterio25(año, 25);
            obtenerCriterio26(año, 26);
            obtenerCriterio27(año, 27);
            obtenerCriterio28(año, 28);
            obtenerCriterio29(año, 29);
            obtenerCriterio30(año, 30);
            obtenerCriterio31(año, 31);
        }
    </script>
@endsection
