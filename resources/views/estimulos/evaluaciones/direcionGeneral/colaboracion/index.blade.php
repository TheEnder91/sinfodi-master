@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/estimulos.png') }}" width="70px" height="40px">Estimulos
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Evaluaciones a la dirección de Ciencia->Colaboracion institucional</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Evaluación a la dirección general->Colaboracion institucional')
        <div class="row">
            <div class="col-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="year">Seleccione el año:</label>
                    </div>
                    <select class="custom-select" id="year" onChange="ShowSelected();">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i - 1 }}">{{ $i - 1 }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-1">
                <label class="col-form-label">Clave:</label>
                <input type="text" id="txtClave" class="form-control form-control-sm text-center" readonly/>
            </div>
            <div class="col-5">
                <label class="col-form-label">Nombre:</label>
                <input type="text" id="txtNombre" class="form-control form-control-sm"/>
            </div>
            <div class="col-1">
                <label class="col-form-label">Puntos:</label>
                <input type="text" id="txtPuntos" class="form-control form-control-sm"/>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table id="tblCriterio7" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Clave</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Total</th>
                        <th scope="col">Año</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <th scope="row" class="text-center" width="10%">7002</th>
                        <td width="40%">EDGAR IVAN CARRASCO GALINDO</td>
                        <td class="text-center" width="10%">10</td>
                        <td class="text-center" width="10%">10</td>
                        <td class="text-center" width="10%">2021</td>
                        <td class="text-center" width="10%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endcomponent
@endsection
