@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de posgrado->Transferencia de conocimiento B</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección de posgrado->Transferencia de conocimiento B')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año a evaluar:</label>
                    </div>
                    <select class="custom-select text-center" style="font-size:13px;" id="year" onChange="ShowSelected();">
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
                                    <a class="nav-link {{ $item->id == 38 ? 'active' : '' }}" id="objetivo-{{ $item->id }}" data-toggle="pill" href="#objetivos-{{ $item->id }}" role="tab" aria-controls="objetivos-{{ $item->id }}" aria-selected="true">
                                        @if ($item->id == 38)
                                            Proyectos interinstitucionales
                                        @endif
                                        @if ($item->id == 39)
                                            Proyectos de I&D en colaboración con otras direcciones
                                        @endif
                                        @if ($item->id == 40)
                                            Proyectos de I&D en colaboración con otros grupos de la misma área
                                        @endif
                                        @if ($item->id == 41)
                                            Proyectos de I&DT con avance tecnológico(TRL)
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach ($criterios as $item)
                                <div class="tab-pane fade show {{ $item->id == 38 ? 'active' : '' }}" id="objetivos-{{ $item->id }}" role="tabpanel" aria-labelledby="objetivo-{{ $item->id }}">
                                    @if ($item->id == 38)
                                        @include('estimulos.evaluaciones.direccionPosgrado.transferenciaB.tblCriterio38')
                                    @endif
                                    @if ($item->id == 39)
                                        @include('estimulos.evaluaciones.direccionPosgrado.transferenciaB.tblCriterio39')
                                    @endif
                                    @if ($item->id == 40)
                                        @include('estimulos.evaluaciones.direccionPosgrado.transferenciaB.tblCriterio40')
                                    @endif
                                    @if ($item->id == 41)
                                        @include('estimulos.evaluaciones.direccionPosgrado.transferenciaB.tblCriterio41')
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
            verDatos(0);
        }

        function ShowSelected(){
            var year = document.getElementById("year").value;
            verDatos(year);
        }

        function verDatos(year){
            if(year === 0){
                var año = document.getElementById("year").value;
            }else{
                var año = year;
            }
            obtenerCriterio38(año, 38);
            obtenerCriterio39(año, 39);
            obtenerCriterio40(año, 40);
            obtenerCriterio41(año, 41);
        }
    </script>
@endsection
