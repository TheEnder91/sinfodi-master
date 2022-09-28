@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección General->Posgrado</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección general->Posgrado')
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
                                    <a class="nav-link {{ $item->id == 2 ? 'active' : '' }}" id="objetivo-{{ $item->id }}" data-toggle="pill" href="#objetivos-{{ $item->id }}" role="tab" aria-controls="objetivos-{{ $item->id }}" aria-selected="true">
                                        @if ($item->id == 2)
                                            Graduado entre 20 y 30 meses
                                        @endif
                                        @if ($item->id == 3)
                                            Graduado entre 31 y 36 meses
                                        @endif
                                        @if ($item->id == 4)
                                            Graduado entre 37 y 42 meses
                                        @endif
                                        @if ($item->id == 5)
                                            Graduado entre 43 y 48 meses
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach ($criterios as $item)
                                <div class="tab-pane fade show {{ $item->id == 2 ? 'active' : '' }}" id="objetivos-{{ $item->id }}" role="tabpanel" aria-labelledby="objetivo-{{ $item->id }}">
                                    @if ($item->id == 2)
                                        @include('estimulos.evaluaciones.direcionGeneral.posgrado.tblCriterio2')
                                    @endif
                                    @if ($item->id == 3)
                                        @include('estimulos.evaluaciones.direcionGeneral.posgrado.tblCriterio3')
                                    @endif
                                    @if ($item->id == 4)
                                        @include('estimulos.evaluaciones.direcionGeneral.posgrado.tblCriterio4')
                                    @endif
                                    @if ($item->id == 5)
                                        @include('estimulos.evaluaciones.direcionGeneral.posgrado.tblCriterio5')
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(initVer);

        function initVer(){
            VerDatos(0);
            $('#btnActualizarCriterio2').on('click', actualizarEvidenciasCriterio2);
            $('#btnActualizarCriterio3').on('click', actualizarEvidenciasCriterio3);
            $('#btnActualizarCriterio4').on('click', actualizarEvidenciasCriterio4);
            $('#btnActualizarCriterio5').on('click', actualizarEvidenciasCriterio5);
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
            obtenerCriterio2(año, 2);
            obtenerCriterio3(año, 3);
            obtenerCriterio4(año, 4);
            obtenerCriterio5(año, 5);
        }
    </script>
@endsection
