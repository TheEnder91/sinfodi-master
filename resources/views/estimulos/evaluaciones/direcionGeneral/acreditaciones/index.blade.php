@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección General->Acreditaciones</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluaciones a la dirección General->Acreditaciones')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year" style="font-size:13px;">Seleccione el año:</label>
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
                                    <a class="nav-link {{ $item->id == 33 ? 'active' : '' }}" id="objetivo-{{ $item->id }}" data-toggle="pill" href="#objetivos-{{ $item->id }}" role="tab" aria-controls="objetivos-{{ $item->id }}" aria-selected="true">
                                        @if ($item->id == 33)
                                            Pruebas de desempeño
                                        @endif
                                        @if ($item->id == 34)
                                            Nuevas técnicas acreditadas
                                        @endif
                                        @if ($item->id == 35)
                                            Pruebas interlaboratorio
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            @foreach ($criterios as $item)
                                <div class="tab-pane fade show {{ $item->id == 33 ? 'active' : '' }}" id="objetivos-{{ $item->id }}" role="tabpanel" aria-labelledby="objetivo-{{ $item->id }}">
                                    @if ($item->id == 33)
                                        @include('estimulos.evaluaciones.direcionGeneral.acreditaciones.tblCriterio33')
                                    @endif
                                    @if ($item->id == 34)
                                        @include('estimulos.evaluaciones.direcionGeneral.acreditaciones.tblCriterio34')
                                    @endif
                                    @if ($item->id == 35)
                                        @include('estimulos.evaluaciones.direcionGeneral.acreditaciones.tblCriterio35')
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
            obtenerCriterio33(año, 33);
            obtenerCriterio34(año, 34);
            obtenerCriterio35(año, 35);
        }
    </script>
@endsection
