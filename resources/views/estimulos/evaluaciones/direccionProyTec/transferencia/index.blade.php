@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluación a la dirección de proyectos->Transferencia de conocimiento e innovación</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección de proyectos tecnologicos->Transferencia de conocimiento e innovación.')
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
                                    <a class="nav-link {{ $item->id == 15 ? 'active' : '' }}" id="objetivo-{{ $item->id }}" data-toggle="pill" href="#objetivos-{{ $item->id }}" role="tab" aria-controls="objetivos-{{ $item->id }}" aria-selected="true">
                                        @if ($item->id == 15)
                                            Solicitud de patente
                                        @endif
                                        @if ($item->id == 16)
                                            Registro de modelo de utilidades solicitado
                                        @endif
                                        @if ($item->id == 17)
                                            Registro de modelo de utilidades otorgado
                                        @endif
                                        @if ($item->id == 18)
                                            Registro de diseño industrial solicitado
                                        @endif
                                        @if ($item->id == 19)
                                            Registro de diseño industrial otorgado
                                        @endif
                                        @if ($item->id == 20)
                                            Derecho de autor otorgado
                                        @endif
                                        @if ($item->id == 21)
                                            Derecho de autor solicitado
                                        @endif
                                        @if ($item->id == 22)
                                            Patente otorgada
                                        @endif
                                        @if ($item->id == 23)
                                            Formalización de contrato de transferencia
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach ($criterios as $item)
                                <div class="tab-pane fade show {{ $item->id == 15 ? 'active' : '' }}" id="objetivos-{{ $item->id }}" role="tabpanel" aria-labelledby="objetivo-{{ $item->id }}">
                                    @if ($item->id == 15)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio15')
                                    @endif
                                    @if ($item->id == 16)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio16')
                                    @endif
                                    @if ($item->id == 17)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio17')
                                    @endif
                                    @if ($item->id == 18)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio18')
                                    @endif
                                    @if ($item->id == 19)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio19')
                                    @endif
                                    @if ($item->id == 20)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio20')
                                    @endif
                                    @if ($item->id == 21)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio21')
                                    @endif
                                    @if ($item->id == 22)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio22')
                                    @endif
                                    @if ($item->id == 23)
                                        @include('estimulos.evaluaciones.direccionProyTec.transferencia.tblCriterio23')
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
            $('#btnActualizarCriterio15').on('click', actualizarEvidenciasCriterio15);
            $('#btnActualizarCriterio16').on('click', actualizarEvidenciasCriterio16);
            $('#btnActualizarCriterio17').on('click', actualizarEvidenciasCriterio17);
            $('#btnActualizarCriterio18').on('click', actualizarEvidenciasCriterio18);
            $('#btnActualizarCriterio19').on('click', actualizarEvidenciasCriterio19);
            $('#btnActualizarCriterio20').on('click', actualizarEvidenciasCriterio20);
            $('#btnActualizarCriterio21').on('click', actualizarEvidenciasCriterio21);
            $('#btnActualizarCriterio22').on('click', actualizarEvidenciasCriterio22);
            $('#btnActualizarCriterio23').on('click', actualizarEvidenciasCriterio23);
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
            obtenerCriterio15(año, 15);
            obtenerCriterio16(año, 16);
            obtenerCriterio17(año, 17);
            obtenerCriterio18(año, 18);
            obtenerCriterio19(año, 19);
            obtenerCriterio20(año, 20);
            obtenerCriterio21(año, 21);
            obtenerCriterio22(año, 22);
            obtenerCriterio23(año, 23);
        }
    </script>
@endsection
