@extends('layouts.app')

@section('title_page')
    <img src="{{ asset('img/sostenibilidad.jpg') }}" width="50px" height="50px"> Sostenibilidad económica
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ \App\Traits\Principal::getUrlToken('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Añadir registros</li>
    </ol>
@endsection

@section('content')
    @component('components.card')
        @slot('title_card', 'Crear registro->Sostentabilidad economica')
        <div class="row">
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" name="id" id="txtId">
                <div class="card card-primary">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="proys-tab" data-toggle="tab" href="#proys" role="tab" aria-controls="proys" aria-selected="true">Proyectos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="servEsp-tab" data-toggle="tab" href="#servEsp" role="tab" aria-controls="servEsp" aria-selected="true">Servicios especiales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cursos-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="cursos" aria-selected="true">Cursos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="proys" role="tabpanel" aria-labelledby="proys-tab">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>CGN:</label>
                                        <input type="text" class="form-control form-control-sm" name="cgn" id="txtCGN">
                                    </div>
                                    <div class="col-10">
                                        <label class="col-form-label"  style="font-size:13px;"><span style="color: red">*</span>Nombre del proyecto:</label>
                                        <input type="text" class="form-control form-control-sm" name="proyecto" id="txtProyecto">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Clave:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="claveLider" id="txtClaveLider" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label"  style="font-size:13px;"><span style="color: red"  style="font-size:13px;">*</span>Nombre del lider del proyecto:</label>
                                        <div class="ui-widget">
                                            <input type="text" class="form-control form-control-sm" name="nombreLider" id="txtNombreLider" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Usuario:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="usuarioLider" id="txtUsuarioLider" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label class="col-form-label"  style="font-size:13px;">Seleccione una opción:</label>
                                        <div style="column-count:4; list-style: none;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input remanente" name="remanente[]" id="remanente" value="remanente">
                                                <label class="custom-control-label" for="remanente" style="font-weight: normal; font-size:13px;">Remanente</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input interinstitucional" name="interinstitucional[]" id="interinstitucional" value="interinstitucional">
                                                <label class="custom-control-label" for="interinstitucional" style="font-weight: normal; font-size:13px;">Interinstitucional</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input interareas" name="interareas[]" id="interareas" value="interareas">
                                                <label class="custom-control-label" for="interareas" style="font-weight: normal; font-size:13px;">Inter-áreas</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input interdirecciones" name="interdirecciones[]" id="interdirecciones" value="interdirecciones">
                                                <label class="custom-control-label" for="interdirecciones" style="font-weight: normal; font-size:13px;">Inter-direcciones</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Clave:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="clave" id="txtClave" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label"  style="font-size:13px;"><span style="color: red">*</span>Nombre del participante:</label>
                                        <div class="ui-widget">
                                            <input type="text" class="form-control form-control-sm" name="nombre" id="txtNombre" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Usuario:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="usuario" id="txtUsuario" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label class="col-form-label"  style="font-size:13px;">Lider o participante del proyecto:</label>
                                        <div style="column-count:2; list-style: none;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input lider" name="lider[]" id="lider" value="Lider" onclick="calcular1();">
                                                <label class="custom-control-label" for="lider" style="font-weight: normal; font-size:13px;">Lider</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input participante" name="participante[]" id="participante" value="participante" disabled checked>
                                                <label class="custom-control-label" for="participante" style="font-weight: normal; font-size:13px;">Participante</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;"><span style="color: red">*</span>Porcentaje:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="procentaje" id="txtPorcentaje" onKeyPress="return soloNumeros(event)" onkeyup="calcular1();" value='0'>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>$ por CTCI:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="monto" id="txtMonto" onKeyPress="return soloNumeros(event)" onkeyup="calcular1();" value='0'>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Año:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="year" id="txtYear" value="{{ date("Y") - 1 }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="col-form-label"  style="font-size:13px;">$ por participación:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="importe" id="txtImporte" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Puntos T.:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="puntosTotales" id="txtPuntosTotales" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">P. Lider:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="puntosLider" id="txtPuntosLider" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">N. Puntos:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="nuevosPuntosTotales" id="txtNuevosPuntosTotales" readonly>
                                    </div>
                                    <div class="col-2">
                                        <label class="col-form-label"  style="font-size:13px;">Puntos por participación:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="nuevosPuntosParticipacion" id="txtNuevosPuntosParticipacion" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">Total:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="total" id="txtTotal" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">TRL Inicio:</label>
                                        <select name="trlInicio" id="trlInicio" class="form-control form-control-sm">
                                            <option value="0" style="font-size:13px;">No aplica</option>
                                            @for ($i = 1; $i < 10; $i++)
                                                <option value="{{ $i}}" style="font-size:13px;">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label"  style="font-size:13px;">TRL Final:</label>
                                        <select name="trlFinal" id="trlFinal" class="form-control form-control-sm">
                                            <option value="0" style="font-size:13px;">No aplica</option>
                                            @for ($i = 1; $i < 10; $i++)
                                                <option value="{{ $i}}" style="font-size:13px;">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label class="col-form-label"  style="font-size:13px;">TRL Evolucion:</label>
                                        <select name="trlEvolucion" id="trlEvolucion" class="form-control form-control-sm">
                                            <option value="0" style="font-size:13px;">No aplica</option>
                                            @for ($i = 1; $i < 10; $i++)
                                                <option value="{{ $i}}" style="font-size:13px;">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-left">
                                            <input type="button" class="btn btn-danger" value="Cancelar" id="btnCancelarProys"/>
                                        </div>
                                        <div class="float-left">
                                            <input type="button" class="btn btn-primary" value="Guardar" id="btnGuardarProys"/>
                                        </div>
                                        <div class="float-left" style="padding-left: 1em;">
                                            <input type="button" class="btn btn-primary" value="Actualizar" id="btnActualizarProys"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="tblCriterio14Proys" class="table table-bordered table-striped" width="100%">
                                                <caption>RELACIÓN DE PROYECTOS CONCLUIDOS Y CERRADOS INTERNAMENTE POR EL CTCI BAJO LOS ACUERDOS 14/05/2021-5 y 04/06/2021-6</caption>
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col" style="font-size:13px; display:none;">#</th>
                                                        <th scope="col" style="font-size:13px">CGN</th>
                                                        <th scope="col" style="font-size:13px">Nombre del proyecto</th>
                                                        <th scope="col" style="font-size:13px">Lider y/o participantes</th>
                                                        <th scope="col" style="font-size:13px">% Parti.</th>
                                                        <th scope="col" style="font-size:13px">$ CTCI</th>
                                                        <th scope="col" style="font-size:13px">$ Parti.</th>
                                                        <th scope="col" style="font-size:13px">Total</th>
                                                        <th scope="col" style="font-size:13px">Año</th>
                                                        <th scope="col" style="font-size:13px;">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="servEsp" role="tabpanel" aria-labelledby="servEsp-tab">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>CGN:</label>
                                        <input type="text" class="form-control form-control-sm" name="cgn" id="txtCGNServEsp">
                                    </div>
                                    <div class="col-10">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre del servicio especial:</label>
                                        <input type="text" class="form-control form-control-sm" name="proyecto" id="txtProyectoServEsp">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Clave:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="claveResponsableServEsp" id="txtClaveResponsableServEsp" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre del responsable:</label>
                                        <div class="ui-widget">
                                            <input type="text" class="form-control form-control-sm" name="nombreResponsableServEsp" id="txtNombreResponsableServEsp" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Usuario:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="usuarioResponsableServEsp" id="txtUsuarioResponsableServEsp" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Clave:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="claveParticipanteServEsp" id="txtClaveParticipanteServEsp" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre del participante:</label>
                                        <div class="ui-widget">
                                            <input type="text" class="form-control form-control-sm" name="nombreParticipanteServEsp" id="txtNombreParticipanteServEsp" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Usuario:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="usuarioParticipanteServEsp" id="txtUsuarioParticipanteServEsp" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Responsable o participante del proyecto:</label>
                                        <div style="column-count:2; list-style: none;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input responsableServEsp" name="responsableServEsp[]" id="responsableServEsp" value="Responsable">
                                                <label class="custom-control-label" for="responsableServEsp" style="font-weight: normal; font-size:13px;">Responsable</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input participanteServEsp" name="participanteServEsp[]" id="participanteServEsp" value="Participante">
                                                <label class="custom-control-label" for="participanteServEsp" style="font-weight: normal; font-size:13px;">Participante</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Porcentaje:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="procentajeServEsp" id="txtPorcentajeServEsp" onKeyPress="return soloNumeros(event)" onkeyup="calcularServEsp();" value='0'>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>$ por CTCI:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="montoServEsp" id="txtMontoServEsp" onKeyPress="return soloNumeros(event)" onkeyup="calcularServEsp();" value='0'>
                                    </div>
                                    <div class="col-2">
                                        <label class="col-form-label" style="font-size:13px;">$ por participación:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="importeServEsp" id="txtImporteServEsp" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="totalServEsp" id="txtTotalServEsp" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="yearServEsp" id="txtYearServEsp" value="{{ date("Y") - 1 }}" readonly>
                                    </div>
                                    <div class="col-2">
                                        <br>
                                        <div class="float-right">
                                            <input type="button" class="btn btn-danger" value="Cancelar" id="btnCancelarServEsp"/>
                                        </div>
                                    </div>
                                    <div class="col-1"><br>
                                        <div class="float-right">
                                            <input type="button" class="btn btn-primary" value="Guardar" id="btnGuardarServEsp"/>
                                        </div>
                                        <div class="float-right">
                                            <input type="button" class="btn btn-primary" value="Actualizar" id="btnActualizarServEsp"/>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="tblCriterio14ServEsp" class="table table-bordered table-striped" style="width: 100%;">
                                                <caption>RELACIÓN DE SERVICIOS ESPECIALES CONCLUIDOS EN 2020 Y CERRADOS INTERNAMENTE POR EL CTCI BAJO EL ACUERDO 04/06/2021-2</caption>
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col" style="font-size:13px; display:none;">#</th>
                                                        <th scope="col" style="font-size:13px">CGN</th>
                                                        <th scope="col" style="font-size:13px">Nombre del proyecto</th>
                                                        <th scope="col" style="font-size:13px">Lider y/o participantes</th>
                                                        <th scope="col" style="font-size:13px">% Parti.</th>
                                                        <th scope="col" style="font-size:13px">$ CTCI</th>
                                                        <th scope="col" style="font-size:13px">$ Parti.</th>
                                                        <th scope="col" style="font-size:13px">Total</th>
                                                        <th scope="col" style="font-size:13px">Año</th>
                                                        <th scope="col" style="font-size:13px;">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>CGN:</label>
                                        <input type="text" class="form-control form-control-sm" name="cgn" id="txtCGNCursos">
                                    </div>
                                    <div class="col-10">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre del curso:</label>
                                        <input type="text" class="form-control form-control-sm" name="proyecto" id="txtProyectoCursos">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Clave:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="claveResponsableCursos" id="txtClaveResponsableCursos" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre del responsable:</label>
                                        <div class="ui-widget">
                                            <input type="text" class="form-control form-control-sm" name="nombreResponsableCursos" id="txtNombreResponsableCursos" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Usuario:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="usuarioResponsableCursos" id="txtUsuarioResponsableCursos" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Clave:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="claveParticipanteCursos" id="txtClaveParticipanteCursos" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Nombre del participante:</label>
                                        <div class="ui-widget">
                                            <input type="text" class="form-control form-control-sm" name="nombreParticipanteCursos" id="txtNombreParticipanteCursos" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Usuario:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="usuarioParticipanteCursos" id="txtUsuarioParticipanteCursos" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Responsable o participante del curso:</label>
                                        <div style="column-count:2; list-style: none;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input responsableCursos" name="responsableCursos[]" id="responsableCursos" value="Responsable">
                                                <label class="custom-control-label" for="responsableCursos" style="font-weight: normal; font-size:13px;">Responsable</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input participanteCursos" name="participanteCursos[]" id="participanteCursos" value="Participante">
                                                <label class="custom-control-label" for="participanteCursos" style="font-weight: normal; font-size:13px;">Participante</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>Porcentaje:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="procentajeCursos" id="txtPorcentajeCursos" onKeyPress="return soloNumeros(event)" onkeyup="calcularCursos();" value='0'>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;"><span style="color: red">*</span>$ por CTCI:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="montoCursos" id="txtMontoCursos" onKeyPress="return soloNumeros(event)" onkeyup="calcularCursos();" value='0'>
                                    </div>
                                    <div class="col-2">
                                        <label class="col-form-label" style="font-size:13px;">$ por participación:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="importeCursos" id="txtImporteCursos" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="totalCursos" id="txtTotalCursos" readonly>
                                    </div>
                                    <div class="col-1">
                                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="yearCursos" id="txtYearCursos" value="{{ date("Y") - 1 }}" readonly>
                                    </div>
                                    <div class="col-2">
                                        <br>
                                        <div class="float-right">
                                            <input type="button" class="btn btn-danger" value="Cancelar" id="btnCancelarCursos"/>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <br>
                                        <div class="float-right">
                                            <input type="button" class="btn btn-primary" value="Guardar" id="btnGuardarCursos"/>
                                        </div>
                                        <div class="float-right">
                                            <input type="button" class="btn btn-primary" value="Actualizar" id="btnActualizarCursos"/>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="tblCriterio14Cursos" class="table table-bordered table-striped" style="width: 100%;">
                                                <caption>RELACIÓN DE CURSOS CONCLUIDOS EN 2020 Y CERRADOS INTERNAMENTE POR EL CTCI BAJO EL ACUERDO 14/05/2021-2</caption>
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col" style="font-size:13px; display:none;">#</th>
                                                        <th scope="col" style="font-size:13px">CGN</th>
                                                        <th scope="col" style="font-size:13px">Nombre del proyecto</th>
                                                        <th scope="col" style="font-size:13px">Lider y/o participantes</th>
                                                        <th scope="col" style="font-size:13px">% Parti.</th>
                                                        <th scope="col" style="font-size:13px">$ CTCI</th>
                                                        <th scope="col" style="font-size:13px">$ Parti.</th>
                                                        <th scope="col" style="font-size:13px">Total</th>
                                                        <th scope="col" style="font-size:13px">Año</th>
                                                        <th scope="col" style="font-size:13px;">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('scripts')
    <script>
        $(document).ready(initCriterio14);

        function initCriterio14(){
            $('#txtId').hide();
            // Mostrar u ocultar los botones de guardar y actualizar...
            $('#btnGuardarProys').show();
            $('#btnActualizarProys').hide();
            $('#btnCancelarProys').hide();
            $('#btnGuardarServEsp').show();
            $('#btnActualizarServEsp').hide();
            $('#btnCancelarServEsp').hide();
            $('#btnGuardarCursos').show();
            $('#btnActualizarCursos').hide();
            $('#btnCancelarCursos').hide();
            // Funciones para autocompletar los nombres de los lideres, responsables y participantes...
            ConsultarLider();
            ConsultarColaborador();
            ConsultarResponsable();
            ConsultarParticipante();
            ConsultarResponsableCursos();
            ConsultarParticipanteCursos();
            // Funciones para mostrar en las tablas los datos...
            obtenerProyectos();
            obtenerServEsp();
            obtenerCursos();
            // Funciones para los botones para guardar los registros...
            $('#btnGuardarProys').on('click', guardarProyectos);
            $('#btnActualizarProys').on('click', actualizarProyectos);
            $('#btnCancelarProys').on('click', cancelarProyectos);
            $('#btnGuardarServEsp').on('click', guardarServEsp);
            $('#btnActualizarServEsp').on('click', actualizarServEsp);
            $('#btnCancelarServEsp').on('click', cancelarServEsp);
            $('#btnGuardarCursos').on('click', guardarCursos);
            $('#btnActualizarCursos').on('click', actualizarCursos);
            $('#btnCancelarCursos').on('click', cancelarCursos);
        }

        // Apartir de aqui las funciones son para la seccion de proyectos...
        // Funcion para mostrar los datos de los proyectos...
        function obtenerProyectos(){
            var tipo = 'Proyectos';
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/datosSostentabilidad/" + tipo,
                type: 'GET',
                dataType: 'json',
                ok: function(datosProyectos){
                    // console.log(datosProyectos);;
                    var row = "";
                    for(var i = 0; i < datosProyectos.length; i++){
                        var dataProyectos = datosProyectos[i];
                        // console.log(dataProyectos);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="4%" style="font-size:12px; vertical-align:middle; display:none;">' + dataProyectos.id + '</td>';
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px; vertical-align:middle;">' + dataProyectos.cgn + '</td>';
                        row += '<td width="33%" style="font-size:12px; text-align:justify;">' + dataProyectos.nombre + "</td>";
                        if(dataProyectos.lider_responsable == "Si"){
                            row += '<td class="text-center" width="15%" style="font-size:12px;background-color:yellow; vertical-align:middle;">' + dataProyectos.nombre_participante.toUpperCase() + '</td>';
                        }else{
                            row += '<td class="text-center" width="15%" style="font-size:12px; vertical-align:middle;">' + dataProyectos.nombre_participante.toUpperCase() + '</td>';
                        }
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'%'+dataProyectos.porcentaje_participacion+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'$'+new Intl.NumberFormat().format(dataProyectos.monto_ingresado)+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'$'+new Intl.NumberFormat().format(dataProyectos.ingreso_participacion)+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+dataProyectos.total+'</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px; vertical-align:middle;">'+dataProyectos.year+'</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px; vertical-align:middle;">'+
                                    '<a href="javascript:editarProys('+ dataProyectos.id +', '+dataProyectos.year+')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;'+
                                    '<a href="javascript:eliminarProys('+ dataProyectos.id +')"><i class="fa fa-trash-alt"></i></a>'+
                                '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio14Proys")) {
                        tblDifusionDivulgacion = $("#tblCriterio14Proys").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio14Proys > tbody').html('');
                    $('#tblCriterio14Proys > tbody').append(row);
                    $('#tblCriterio14Proys').DataTable({
                        "order":[[0, "desc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[10, 15, 20, 25, 50], [10, 15, 20, 25, 50]]
                    });
                },
            });
        }

        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre del lider de proyecto...
        function ConsultarColaborador(){
            $("#txtNombre").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClave").val(ui.item.clave);
                        $("#txtUsuario").val(ui.item.usuario);
                    }
                },
            });
        }

        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre del lider de proyecto...
        function ConsultarLider(){
            $("#txtNombreLider").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClaveLider").val(ui.item.clave);
                        $("#txtUsuarioLider").val(ui.item.usuario);
                    }
                },
            });
        }

        // Funcion para calcular los montos...
        function calcular1(){
            var porcentaje = parseFloat(new Intl.NumberFormat().format($('#txtPorcentaje').val())) / 100;
            var monto = parseFloat($('#txtMonto').val());
            // Obtenemos el ingreso conforme a porcentaje de participacion...
            var ingreso = porcentaje * monto;
            $('#txtImporte').val('$' + new Intl.NumberFormat().format(ingreso));
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/getPuntos",
                type: 'GET',
                dataType: 'json',
                ok: function(dataPuntos){
                    var puntos = parseInt(dataPuntos[0].puntos);
                    // Obtener los puntos totales...
                    var puntosTotales = monto / puntos;
                    $('#txtPuntosTotales').val(new Intl.NumberFormat().format(puntosTotales));
                    // Obtener los puntos de lider
                    var puntos = parseFloat(0.2);
                    var puntosLider = puntosTotales * puntos;
                    $('#txtPuntosLider').val(new Intl.NumberFormat().format(puntosLider));
                    // Obtener los nuevos puntos totales...
                    var nuevosPuntosTotales = puntosTotales - puntosLider;
                    $('#txtNuevosPuntosTotales').val(new Intl.NumberFormat().format(nuevosPuntosTotales));
                    // Obtener los puntos por participación...
                    var puntosParticipacion = nuevosPuntosTotales * porcentaje;
                    $('#txtNuevosPuntosParticipacion').val(new Intl.NumberFormat().format(puntosParticipacion));
                    // Obtener el total de puntos, dependiendo si es lider o participante...

                    if($('#lider').prop('checked')){
                        var total = puntosLider + puntosParticipacion;
                    }else{
                        var total = puntosParticipacion;
                    }
                    $('#txtTotal').val(new Intl.NumberFormat().format(total));
                },
            });
        }

        function guardarProyectos(){
            var cgn = $('#txtCGN').val();
            var nombreProyecto = $('#txtProyecto').val();
            var claveresponsable = $('#txtClaveLider').val();
            var nombreresponsable = $('#txtNombreLider').val();
            var usuarioresponsable = $('#txtUsuarioLider').val();
            if($('#remanente').prop('checked')){
                var remanente = "Si"
            }else{
                var remanente = "No";
            }
            if($('#interinstitucional').prop('checked')){
                var interinstitucional = "Si"
            }else{
                var interinstitucional = "No";
            }
            if($('#interareas').prop('checked')){
                var interareas = "Si"
            }else{
                var interareas = "No";
            }
            if($('#interdirecciones').prop('checked')){
                var interdirecciones = "Si"
            }else{
                var interdirecciones = "No";
            }
            var claveParticipante = $('#txtClave').val();
            var nombreParticipante = $('#txtNombre').val();
            var usuarioParticipante = $('#txtUsuario').val();
            if($('#lider').prop('checked')){
                var lider = "Si"
            }else{
                var lider = "No";
            }
            if($('#participante').prop('checked')){
                var participante = "Si"
            }else{
                var participante = "No";
            }
            var porcentajeParticipacion = parseFloat($('#txtPorcentaje').val());
            var monto = parseFloat($('#txtMonto').val());
            var ingresoParticipacion = parseFloat($('#txtImporte').val().split('$').join('').split(',').join('') || 0);
            var puntosTotales = parseFloat($('#txtPuntosTotales').val());
            var puntosLider = parseFloat($('#txtPuntosLider').val());
            var nuevosPuntos = parseFloat($('#txtNuevosPuntosTotales').val());
            var puntosParticipacion = parseFloat($('#txtNuevosPuntosParticipacion').val());
            var total = parseFloat($('#txtTotal').val());
            var year = parseFloat($('#txtYear').val());
            // TRL...
            var trlInicio = parseFloat($('#trlInicio').val());
            var trlFinal = parseFloat($('#trlFinal').val());
            var trlEvolucion = parseFloat($('#trlEvolucion').val());
            // Termina TRL..

            if(cgn == "" || nombreProyecto == "" || nombreresponsable == "" || nombreParticipante == "" || porcentajeParticipacion == 0 || monto == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }

            var options = {
                action: "{{ config('app.url') }}/modulos/sostenibilidad/store",
                json: {
                    cgn: cgn,
                    nombre: nombreProyecto,
                    clave_responsable: claveresponsable,
                    nombre_responsable: nombreresponsable,
                    usuario_responsable: usuarioresponsable,
                    clave_participante: claveParticipante,
                    nombre_participante: nombreParticipante,
                    usuario_participante: usuarioParticipante,
                    lider_responsable: lider,
                    participante: participante,
                    porcentaje_participacion: porcentajeParticipacion,
                    monto_ingresado: monto,
                    ingreso_participacion: ingresoParticipacion,
                    remanente: remanente,
                    interinstitucional: interinstitucional,
                    interareas: interareas,
                    interdirecciones: interdirecciones,
                    puntos_totales: puntosTotales,
                    puntos_lider: puntosLider,
                    nuevos_puntos_totales: nuevosPuntos,
                    puntos_participacion: puntosParticipacion,
                    total: total,
                    year: year,
                    tipo: "Proyectos",
                    trl_inicio: trlInicio,
                    trl_final: trlFinal,
                    trl_evolucion: trlEvolucion,
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'Se ha guardado correctamente el registro.',
                url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}"
            };
            // console.log(options);
            peticionGeneralAjax(options);
            // Limpiamos todos los campos...
            $('#txtCGN').val('');
            $('#txtProyecto').val('');
            $('#txtClaveLider').val('');
            $('#txtNombreLider').val('');
            $('#txtUsuarioLider').val('');
            $('#txtClave').val('');
            $('#txtNombre').val('');
            $('#txtUsuario').val('');
            $('#txtPorcentaje').val(0);
            $('#txtMonto').val(0);
            $('#txtImporte').val(0);
            $('#txtPuntosTotales').val(0);
            $('#txtPuntosLider').val(0);
            $('#txtNuevosPuntosTotales').val(0);
            $('#txtNuevosPuntosParticipacion').val(0);
            $('#txtTotal').val(0);
            if($('#lider').prop('checked')){
                document.getElementById("lider").checked = false;
            }else if($('#remanente').prop('checked')){
                document.getElementById("remanente").checked = false;
            }else if($('#interinstitucional').prop('checked')){
                document.getElementById("interinstitucional").checked = false;
            }else if($('#interareas').prop('checked')){
                document.getElementById("interareas").checked = false;
            }else if($('#direcciones').prop('checked')){
                document.getElementById("direcciones").checked = false;
            }
        }

        function editarProys(id, year){
            $('#btnActualizarProys').show();
            $('#btnGuardarProys').hide();
            $('#btnCancelarProys').show();
            //Consultar los datos de la base de datos...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/getSostentabilidad/"+id+"/"+year,
                type: 'GET',
                dataType: 'json',
                ok: function(getSostentabilidad){
                    var getSostentabilidad = getSostentabilidad.response[0];
                    // console.log(getSostentabilidad.cgn);
                    $('#txtId').val(getSostentabilidad.id);
                    $('#txtCGN').val(getSostentabilidad.cgn);
                    $('#txtProyecto').val(getSostentabilidad.nombre);
                    $('#txtClaveLider').val(getSostentabilidad.clave_responsable);
                    $('#txtNombreLider').val(getSostentabilidad.nombre_responsable);
                    $('#txtUsuarioLider').val(getSostentabilidad.usuario_responsable);
                    if(getSostentabilidad.remanente == 'No'){
                        $("#remanente").prop('checked', false);
                    }else{
                        $("#remanente").prop('checked', true);
                    }
                    if(getSostentabilidad.interinstitucional == 'No'){
                        $("#interinstitucional").prop('checked', false);
                    }else{
                        $("#interinstitucional").prop('checked', true);
                    }
                    if(getSostentabilidad.interareas == 'No'){
                        $("#interareas").prop('checked', false);
                    }else{
                        $("#interareas").prop('checked', true);
                    }
                    if(getSostentabilidad.interdirecciones == 'No'){
                        $("#interdirecciones").prop('checked', false);
                    }else{
                        $("#interdirecciones").prop('checked', true);
                    }
                    $('#txtClave').val(getSostentabilidad.clave_participante);
                    $('#txtNombre').val(getSostentabilidad.nombre_participante);
                    $('#txtUsuario').val(getSostentabilidad.usuario_participante);
                    if(getSostentabilidad.lider_responsable == 'No'){
                        $("#lider").prop('checked', false);
                    }else{
                        $("#lider").prop('checked', true);
                    }
                    $('#txtPorcentaje').val(getSostentabilidad.porcentaje_participacion);
                    $('#txtMonto').val(getSostentabilidad.monto_ingresado);
                    $('#txtImporte').val(getSostentabilidad.ingreso_participacion);
                    $('#txtPuntosTotales').val(getSostentabilidad.puntos_totales);
                    $('#txtPuntosLider').val(getSostentabilidad.puntos_lider);
                    $('#txtNuevosPuntosTotales').val(getSostentabilidad.nuevos_puntos_totales);
                    $('#txtNuevosPuntosParticipacion').val(getSostentabilidad.puntos_participacion);
                    $('#txtTotal').val(getSostentabilidad.total);
                    $('#txtYear').val(getSostentabilidad.year);
                    $('#trlInicio').val(getSostentabilidad.trl_inicio);
                    $('#trlFinal').val(getSostentabilidad.trl_final);
                    $('#trlEvolucion').val(getSostentabilidad.trl_evolucion);
                },
            });
        }

        function actualizarProyectos(){
            var id = $('#txtId').val();
            var cgn = $('#txtCGN').val();
            var nombreProyecto = $('#txtProyecto').val();
            var claveresponsable = $('#txtClaveLider').val();
            var nombreresponsable = $('#txtNombreLider').val();
            var usuarioresponsable = $('#txtUsuarioLider').val();
            if($('#remanente').prop('checked')){
                var remanente = "Si"
            }else{
                var remanente = "No";
            }
            if($('#interinstitucional').prop('checked')){
                var interinstitucional = "Si"
            }else{
                var interinstitucional = "No";
            }
            if($('#interareas').prop('checked')){
                var interareas = "Si"
            }else{
                var interareas = "No";
            }
            if($('#interdirecciones').prop('checked')){
                var interdirecciones = "Si"
            }else{
                var interdirecciones = "No";
            }
            var claveParticipante = $('#txtClave').val();
            var nombreParticipante = $('#txtNombre').val();
            var usuarioParticipante = $('#txtUsuario').val();
            if($('#lider').prop('checked')){
                var lider = "Si"
            }else{
                var lider = "No";
            }
            if($('#participante').prop('checked')){
                var participante = "Si"
            }else{
                var participante = "No";
            }
            var porcentajeParticipacion = parseFloat($('#txtPorcentaje').val());
            var monto = parseFloat($('#txtMonto').val());
            var ingresoParticipacion = parseFloat($('#txtImporte').val().split('$').join('').split(',').join('') || 0);
            var puntosTotales = parseFloat($('#txtPuntosTotales').val());
            var puntosLider = parseFloat($('#txtPuntosLider').val());
            var nuevosPuntos = parseFloat($('#txtNuevosPuntosTotales').val());
            var puntosParticipacion = parseFloat($('#txtNuevosPuntosParticipacion').val());
            var total = parseFloat($('#txtTotal').val());
            var year = parseFloat($('#txtYear').val());
            // TRL...
            var trlInicio = parseFloat($('#trlInicio').val());
            var trlFinal = parseFloat($('#trlFinal').val());
            var trlEvolucion = parseFloat($('#trlEvolucion').val());
            // Fin TRL...
            if(cgn == "" || nombreProyecto == "" || nombreresponsable == "" || nombreParticipante == "" || porcentajeParticipacion == 0 || monto == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            swal({
                type: 'warning',
                title: "Se actualizara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, actualizar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/modulos/sostenibilidad/updateSostentabilidad/"+id,
                    json: {
                        cgn: cgn,
                        nombre: nombreProyecto,
                        clave_responsable: claveresponsable,
                        nombre_responsable: nombreresponsable,
                        usuario_responsable: usuarioresponsable,
                        clave_participante: claveParticipante,
                        nombre_participante: nombreParticipante,
                        usuario_participante: usuarioParticipante,
                        lider_responsable: lider,
                        participante: participante,
                        porcentaje_participacion: porcentajeParticipacion,
                        monto_ingresado: monto,
                        ingreso_participacion: ingresoParticipacion,
                        remanente: remanente,
                        interinstitucional: interinstitucional,
                        interareas: interareas,
                        interdirecciones: interdirecciones,
                        puntos_totales: puntosTotales,
                        puntos_lider: puntosLider,
                        nuevos_puntos_totales: nuevosPuntos,
                        puntos_participacion: puntosParticipacion,
                        total: total,
                        trl_inicio: trlInicio,
                        trl_final: trlFinal,
                        trl_evolucion: trlEvolucion,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'Se ha actualizado correctamente el registro.',
                    url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}",
                };
                // console.log(options);
                peticionGeneralAjax(options);
            });
        }

        function cancelarProyectos(){
            $('#txtId').val('');
            $('#txtCGN').val('');
            $('#txtProyecto').val('');
            $('#txtClaveLider').val('');
            $('#txtNombreLider').val('');
            $('#txtUsuarioLider').val('');
            $("#remanente").prop('checked', false);
            $("#interinstitucional").prop('checked', false);
            $("#interareas").prop('checked', false);
            $("#interdirecciones").prop('checked', false);
            $('#txtClave').val('');
            $('#txtNombre').val('');
            $('#txtUsuario').val('');
            $("#lider").prop('checked', false);
            $('#txtPorcentaje').val('0');
            $('#txtMonto').val('0');
            $('#txtImporte').val('');
            $('#txtPuntosTotales').val('');
            $('#txtPuntosLider').val('');
            $('#txtNuevosPuntosTotales').val('');
            $('#txtNuevosPuntosParticipacion').val('');
            $('#txtTotal').val('');
            $('#txtYear').val(new Date().getFullYear() - 1);
            $('#btnActualizarProys').hide();
            $('#btnGuardarProys').show();
            $('#btnCancelarProys').hide();
            $('#trlInicio').val(0);
            $('#trlFinal').val(0);
            $('#trlEvolucion').val(0);
        }

        function eliminarProys(id){
            swal({
                type: 'warning',
                title: "Se eliminara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/modulos/sostenibilidad/destroySostentabilidad/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        // Apartir de aqui las funciones son para la seccion de servicios especiales...
        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre del responsable...
        function ConsultarResponsable(){
            $("#txtNombreResponsableServEsp").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClaveResponsableServEsp").val(ui.item.clave);
                        $("#txtUsuarioResponsableServEsp").val(ui.item.usuario);
                    }
                },
            });
        }

        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre del participante...
        function ConsultarParticipante(){
            $("#txtNombreParticipanteServEsp").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClaveParticipanteServEsp").val(ui.item.clave);
                        $("#txtUsuarioParticipanteServEsp").val(ui.item.usuario);
                    }
                },
            });
        }

        // Función para calcular los montos...
        function calcularServEsp(){
            var porcentaje = parseInt(new Intl.NumberFormat().format($('#txtPorcentajeServEsp').val())) / 100;
            var monto = parseInt($('#txtMontoServEsp').val());
            // Obtenemos el ingreso conforme a porcentaje de participacion...
            var ingreso = porcentaje * monto;
            $('#txtImporteServEsp').val('$' + new Intl.NumberFormat().format(ingreso));
            // Obtenermos los puntos totales individuales...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/getPuntos",
                type: 'GET',
                dataType: 'json',
                ok: function(dataPuntos){
                    var puntos = parseInt(dataPuntos[0].puntos);
                    // Obtener los puntos totales...
                    var puntosTotales = ingreso / puntos;
                    $('#txtTotalServEsp').val(new Intl.NumberFormat().format(puntosTotales));
                },
            });
        }

        function obtenerServEsp(){
            var tipo = 'Servicios Especiales';
            // console.log(tipo);
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/datosSostentabilidad/" + tipo,
                type: 'GET',
                dataType: 'json',
                ok: function(datosServEsp){
                    // console.log(datosServEsp);
                    var row = "";
                    for(var i = 0; i < datosServEsp.length; i++){
                        var dataServEsp = datosServEsp[i];
                        // console.log(dataServEsp);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="5%" style="font-size:12px; display:none; vertical-align:middle;">' + dataServEsp.id + '</td>';
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px; vertical-align:middle;">' + dataServEsp.cgn + '</td>';
                        row += '<td width="28%" style="font-size:12px; text-align:justify;">' + dataServEsp.nombre + "</td>";
                        if(dataServEsp.lider_responsable == "Si"){
                            row += '<td class="text-center" width="15%" style="font-size:12px;background-color:yellow; vertical-align:middle;">' + dataServEsp.nombre_participante.toUpperCase() + '</td>';
                        }else{
                            row += '<td class="text-center" width="15%" style="font-size:12px; vertical-align:middle;">' + dataServEsp.nombre_participante.toUpperCase() + '</td>';
                        }
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'%'+dataServEsp.porcentaje_participacion+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'$'+new Intl.NumberFormat().format(dataServEsp.monto_ingresado)+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'$'+new Intl.NumberFormat().format(dataServEsp.ingreso_participacion)+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+dataServEsp.total+'</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px; vertical-align:middle;">'+dataServEsp.year+'</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px; vertical-align:middle;">'+
                                    '<a href="javascript:editarServEsp('+ dataServEsp.id +', '+dataServEsp.year+')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;'+
                                    '<a href="javascript:eliminarServEsp('+ dataServEsp.id +')"><i class="fa fa-trash-alt"></i></a>'+
                                '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio14ServEsp")) {
                        tblDifusionDivulgacion = $("#tblCriterio14ServEsp").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio14ServEsp > tbody').html('');
                    $('#tblCriterio14ServEsp > tbody').append(row);
                    $('#tblCriterio14ServEsp').DataTable({
                        "order":[[0, "desc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[10, 15, 20, 25, 50], [10, 15, 20, 25, 50]]
                    });
                },
            });
        }

        function guardarServEsp(){
            var cgn = $('#txtCGNServEsp').val();
            var nombreServEsp = $('#txtProyectoServEsp').val();
            var claveResponsable = $('#txtClaveResponsableServEsp').val();
            var nombreResponsable = $('#txtNombreResponsableServEsp').val();
            var usuarioResponsable = $('#txtUsuarioResponsableServEsp').val();
            var claveParticipante = $('#txtClaveParticipanteServEsp').val();
            var nombreParticipante = $('#txtNombreParticipanteServEsp').val();
            var usuarioParticipante = $('#txtUsuarioParticipanteServEsp').val();
            var porcentaje = parseFloat($('#txtPorcentajeServEsp').val());
            var montoCTCI = parseFloat($('#txtMontoServEsp').val());
            var montoParticipacion = parseFloat($('#txtImporteServEsp').val().split('$').join('').split(',').join('') || 0);
            var total = parseFloat($('#txtTotalServEsp').val());
            var year = parseFloat($('#txtYearServEsp').val());
            if($('#responsableServEsp').prop('checked')){
                var responsable = "Si"
            }else{
                var responsable = "No";
            }
            if($('#participanteServEsp').prop('checked')){
                var participante = "Si"
            }else{
                var participante = "No";
            }
            // console.log(responsable + '->' + participante);
            // Nos muestra un mensaje de que debe de llenar los campos...
            if(cgn == "" || nombreServEsp == "" || nombreResponsable == "" || nombreParticipante == "" || porcentaje == 0 || montoCTCI == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            if(responsable == "No" && participante == "No"){
                swal({
                    type: 'warning',
                    text: 'Favor de seleccionar si es el responsable o el participante.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/modulos/sostenibilidad/store",
                json: {
                    cgn: cgn,
                    nombre: nombreServEsp,
                    clave_responsable: claveResponsable,
                    nombre_responsable: nombreResponsable,
                    usuario_responsable: usuarioResponsable,
                    clave_participante: claveParticipante,
                    nombre_participante: nombreParticipante,
                    usuario_participante: usuarioParticipante,
                    lider_responsable: responsable,
                    participante: participante,
                    porcentaje_participacion: porcentaje,
                    monto_ingresado: montoCTCI,
                    ingreso_participacion: montoParticipacion,
                    remanente: "No",
                    interinstitucional: "No",
                    interareas: "No",
                    interdirecciones: "No",
                    puntos_totales: 0.00,
                    puntos_lider: 0.00,
                    nuevos_puntos_totales: 0.00,
                    puntos_participacion: 0.00,
                    total: total,
                    year: year,
                    tipo: "Servicios Especiales",
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}"
            };
            // console.log(options);
            peticionGeneralAjax(options);
            $('#txtCGNServEsp').val('');
            $('#txtProyectoServEsp').val('');
            $('#txtClaveResponsableServEsp').val('');
            $('#txtNombreResponsableServEsp').val('');
            $('#txtUsuarioResponsableServEsp').val('');
            $('#txtClaveParticipanteServEsp').val('');
            $('#txtNombreParticipanteServEsp').val('');
            $('#txtUsuarioParticipanteServEsp').val('');
            $('#txtPorcentajeServEsp').val(0);
            $('#txtMontoServEsp').val(0);
            $('#txtImporteServEsp').val('');
            $('#txtTotalServEsp').val('');
            document.getElementById("responsableServEsp").checked = false;
            document.getElementById("participanteServEsp").checked = false;
        }

        function editarServEsp(id, year){
            $('#btnActualizarServEsp').show();
            $('#btnGuardarServEsp').hide();
            $('#btnCancelarServEsp').show();
            //Consultar los datos de la base de datos...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/getSostentabilidad/"+id+"/"+year,
                type: 'GET',
                dataType: 'json',
                ok: function(getSostentabilidad){
                    var getSostentabilidad = getSostentabilidad.response[0];
                    // console.log(getSostentabilidad.cgn);
                    $('#txtId').val(getSostentabilidad.id);
                    $('#txtCGNServEsp').val(getSostentabilidad.cgn);
                    $('#txtProyectoServEsp').val(getSostentabilidad.nombre);
                    $('#txtClaveResponsableServEsp').val(getSostentabilidad.clave_responsable);
                    $('#txtNombreResponsableServEsp').val(getSostentabilidad.nombre_responsable);
                    $('#txtUsuarioResponsableServEsp').val(getSostentabilidad.usuario_responsable);
                    $('#txtClaveParticipanteServEsp').val(getSostentabilidad.clave_participante);
                    $('#txtNombreParticipanteServEsp').val(getSostentabilidad.nombre_participante);
                    $('#txtUsuarioParticipanteServEsp').val(getSostentabilidad.usuario_participante);
                    if(getSostentabilidad.lider_responsable == 'No'){
                        $("#responsableServEsp").prop('checked', false);
                    }else{
                        $("#responsableServEsp").prop('checked', true);
                    }
                    if(getSostentabilidad.participante == 'No'){
                        $("#participanteServEsp").prop('checked', false);
                    }else{
                        $("#participanteServEsp").prop('checked', true);
                    }
                    $('#txtPorcentajeServEsp').val(getSostentabilidad.porcentaje_participacion);
                    $('#txtMontoServEsp').val(getSostentabilidad.monto_ingresado);
                    $('#txtImporteServEsp').val(getSostentabilidad.ingreso_participacion);
                    $('#txtTotalServEsp').val(getSostentabilidad.total);
                    $('#txtYearServEsp').val(getSostentabilidad.year);
                },
            });
        }

        function actualizarServEsp(){
            var id = $("#txtId").val();
            var cgn = $('#txtCGNServEsp').val();
            var nombreServEsp = $('#txtProyectoServEsp').val();
            var claveResponsable = $('#txtClaveResponsableServEsp').val();
            var nombreResponsable = $('#txtNombreResponsableServEsp').val();
            var usuarioResponsable = $('#txtUsuarioResponsableServEsp').val();
            var claveParticipante = $('#txtClaveParticipanteServEsp').val();
            var nombreParticipante = $('#txtNombreParticipanteServEsp').val();
            var usuarioParticipante = $('#txtUsuarioParticipanteServEsp').val();
            var porcentaje = parseFloat($('#txtPorcentajeServEsp').val());
            var montoCTCI = parseFloat($('#txtMontoServEsp').val());
            var montoParticipacion = parseFloat($('#txtImporteServEsp').val().split('$').join('').split(',').join('') || 0);
            var total = parseFloat($('#txtTotalServEsp').val());
            var year = parseFloat($('#txtYearServEsp').val());
            if($('#responsableServEsp').prop('checked')){
                var responsable = "Si"
            }else{
                var responsable = "No";
            }
            if($('#participanteServEsp').prop('checked')){
                var participante = "Si"
            }else{
                var participante = "No";
            }
            // console.log(responsable + '->' + participante);
            // Nos muestra un mensaje de que debe de llenar los campos...
            if(cgn == "" || nombreServEsp == "" || nombreResponsable == "" || nombreParticipante == "" || porcentaje == 0 || montoCTCI == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            if(responsable == "No" && participante == "No"){
                swal({
                    type: 'warning',
                    text: 'Favor de seleccionar si es el responsable o el participante.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            swal({
                type: 'warning',
                title: "Se actualizara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, actualizar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/modulos/sostenibilidad/updateSostentabilidad/"+id,
                    json: {
                        cgn: cgn,
                        nombre: nombreServEsp,
                        clave_responsable: claveResponsable,
                        nombre_responsable: nombreResponsable,
                        usuario_responsable: usuarioResponsable,
                        clave_participante: claveParticipante,
                        nombre_participante: nombreParticipante,
                        usuario_participante: usuarioParticipante,
                        lider_responsable: responsable,
                        participante: participante,
                        porcentaje_participacion: porcentaje,
                        monto_ingresado: montoCTCI,
                        ingreso_participacion: montoParticipacion,
                        total: total,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'Se ha actualizado correctamente el registro.',
                    url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}",
                };
                // console.log(options);
                peticionGeneralAjax(options);
            });
        }

        function cancelarServEsp(){
            $('#txtId').val('');
            $('#txtCGNServEsp').val('');
            $('#txtProyectoServEsp').val('');
            $('#txtClaveResponsableServEsp').val('');
            $('#txtNombreResponsableServEsp').val('');
            $('#txtUsuarioResponsableServEsp').val('');
            $('#txtClaveParticipanteServEsp').val('');
            $('#txtNombreParticipanteServEsp').val('');
            $('#txtUsuarioParticipanteServEsp').val('');
            $("#responsableServEsp").prop('checked', false);
            $("#participanteServEsp").prop('checked', false);
            $('#txtPorcentajeServEsp').val('');
            $('#txtMontoServEsp').val('');
            $('#txtImporteServEsp').val('');
            $('#txtTotalServEsp').val('');
            $('#txtYearServEsp').val(new Date().getFullYear() - 1);
            $('#btnActualizarServEsp').hide();
            $('#btnGuardarServEsp').show();
            $('#btnCancelarServEsp').hide();
        }

        function eliminarServEsp(id){
            swal({
                type: 'warning',
                title: "Se eliminara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/modulos/sostenibilidad/destroySostentabilidad/" + id,
                    json: {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    },
                    type: 'POST',
                    dateType: 'json',
                    mensajeConfirm: 'El registro se elimino correctamente',
                    url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}"
                };
                peticionGeneralAjax(options);
            });
        }

        // Apartir de aqui las funciones son para la seccion de cursos...
        // Muestra los datos en la tabla para los cursos...
        function obtenerCursos(){
            var tipo = 'Cursos';
            // console.log(tipo);
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/datosSostentabilidad/" + tipo,
                type: 'GET',
                dataType: 'json',
                ok: function(datosCursos){
                    // console.log(datosCursos);
                    var row = "";
                    for(var i = 0; i < datosCursos.length; i++){
                        var dataCursos = datosCursos[i];
                        // console.log(dataCursos);
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="5%" style="font-size:12px; display:none; vertical-align:middle;">' + dataCursos.id + '</th>';
                        row += '<td scope="row" class="text-center" width="10%" style="font-size:12px; vertical-align:middle;">' + dataCursos.cgn + '</td>';
                        row += '<td width="33%" style="font-size:12px; text-align:justify;">' + dataCursos.nombre + "</td>";
                        if(dataCursos.lider_responsable == "Si"){
                            row += '<td class="text-center" width="15%" style="font-size:12px;background-color:yellow; vertical-align:middle;">' + dataCursos.nombre_participante.toUpperCase() + '</td>';
                        }else{
                            row += '<td class="text-center" width="15%" style="font-size:12px; vertical-align:middle;">' + dataCursos.nombre_participante.toUpperCase() + '</td>';
                        }
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'%'+dataCursos.porcentaje_participacion+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'$'+new Intl.NumberFormat().format(dataCursos.monto_ingresado)+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+'$'+new Intl.NumberFormat().format(dataCursos.ingreso_participacion)+'</td>';
                        row += '<td class="text-center" width="8%" style="font-size:12px; vertical-align:middle;">'+dataCursos.total+'</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px; vertical-align:middle;">'+dataCursos.year+'</td>';
                        row += '<td class="text-center" width="5%" style="font-size:12px; vertical-align:middle;">'+
                                    '<a href="javascript:editarCursos('+ dataCursos.id +', '+dataCursos.year+')"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;'+
                                    '<a href="javascript:eliminarCursos('+ dataCursos.id +')"><i class="fa fa-trash-alt"></i></a>'+
                                '</td>';
                        row += "</tr>";
                    }
                    if ($.fn.dataTable.isDataTable("#tblCriterio14Cursos")) {
                        tblDifusionDivulgacion = $("#tblCriterio14Cursos").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblCriterio14Cursos > tbody').html('');
                    $('#tblCriterio14Cursos > tbody').append(row);
                    $('#tblCriterio14Cursos').DataTable({
                        "order":[[0, "desc"]],
                        "language":{
                          "lengthMenu": "Mostrar _MENU_ registros por página.",
                          "info": "Página _PAGE_ de _PAGES_",
                          "infoEmpty": "No se encontraron registros.",
                          "infoFiltered": "(filtrada de _MAX_ registros)",
                          "loadingRecords": "Cargando...",
                          "processing":     "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords":    "No se encontraron registros.",
                          "paginate": {
                                          "next":       ">",
                                          "previous":   "<"
                                      },
                        },
                        lengthMenu: [[10, 15, 20, 25, 50], [10, 15, 20, 25, 50]]
                    });
                },
            });
        }

        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre del responsable...
        function ConsultarResponsableCursos(){
            $("#txtNombreResponsableCursos").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClaveResponsableCursos").val(ui.item.clave);
                        $("#txtUsuarioResponsableCursos").val(ui.item.usuario);
                    }
                },
            });
        }

        // Edgar Carrasco->(05/11/2021): Funcion para autocompletar el nombre del participante...
        function ConsultarParticipanteCursos(){
            $("#txtNombreParticipanteCursos").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('buscar.colaborador') }}",
                        type: "POST",
                        dateType: "json",
                        data: {
                            nombre: request.term,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data){
                            response($.map(data.response, function(item){
                                return {
                                    label: item.nombre,
                                    value: item.nombre,
                                    id: item.clave,
                                    clave: item.clave,
                                    id: item.usuario,
                                    usuario: item.usuario,
                                };
                            }));
                            // console.log(data.response); // Edgar Carrasco->(05/11/2021): Se comenta para futuras pruebas...
                        },
                    });
                },
                minlength: 2,
                select: function (event, ui) {
                    if (ui.item) {
                        $("#txtClaveParticipanteCursos").val(ui.item.clave);
                        $("#txtUsuarioParticipanteCursos").val(ui.item.usuario);
                    }
                },
            });
        }

        // Función para calcular el monto de los cursos...
        function calcularCursos(){
            var porcentaje = parseInt(new Intl.NumberFormat().format($('#txtPorcentajeCursos').val())) / 100;
            var monto = parseFloat($('#txtMontoCursos').val());
            // Obtenemos el ingreso conforme a porcentaje de participacion...
            var ingreso = porcentaje * monto;
            $('#txtImporteCursos').val('$' + new Intl.NumberFormat().format(ingreso));
            // Obtenermos los puntos totales individuales...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/getPuntos",
                type: 'GET',
                dataType: 'json',
                ok: function(dataPuntos){
                    var puntos = parseInt(dataPuntos[0].puntos);
                    // Obtener los puntos totales...
                    var puntosTotales = ingreso / puntos;
                    $('#txtTotalCursos').val(new Intl.NumberFormat().format(puntosTotales));
                },
            });
        }

        function guardarCursos(){
            var cgn = $('#txtCGNCursos').val();
            var nombreCursos = $('#txtProyectoCursos').val();
            var claveResponsable = $('#txtClaveResponsableCursos').val();
            var nombreResponsable = $('#txtNombreResponsableCursos').val();
            var usuarioResponsable = $('#txtUsuarioResponsableCursos').val();
            var claveParticipante = $('#txtClaveParticipanteCursos').val();
            var nombreParticipante = $('#txtNombreParticipanteCursos').val();
            var usuarioParticipante = $('#txtUsuarioParticipanteCursos').val();
            var porcentaje = parseFloat($('#txtPorcentajeCursos').val());
            var montoCTCI = parseFloat($('#txtMontoCursos').val());
            var montoParticipacion = parseFloat($('#txtImporteCursos').val().split('$').join('').split(',').join('') || 0);
            var total = parseFloat($('#txtTotalCursos').val());
            var year = parseFloat($('#txtYearCursos').val());
            if($('#responsableCursos').prop('checked')){
                var responsable = "Si"
            }else{
                var responsable = "No";
            }
            if($('#participanteCursos').prop('checked')){
                var participante = "Si"
            }else{
                var participante = "No";
            }
            // Nos muestra un mensaje de que debe de llenar los campos...
            if(cgn == "" || nombreCursos == "" || nombreResponsable == "" || nombreParticipante == "" || porcentaje == 0 || montoCTCI == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de llenar los campos marcados con *.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            if(responsable == "No" && participante == "No"){
                swal({
                    type: 'warning',
                    text: 'Favor de seleccionar si es el responsable o el participante.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            var options = {
                action: "{{ config('app.url') }}/modulos/sostenibilidad/store",
                json: {
                    cgn: cgn,
                    nombre: nombreCursos,
                    clave_responsable: claveResponsable,
                    nombre_responsable: nombreResponsable,
                    usuario_responsable: usuarioResponsable,
                    clave_participante: claveParticipante,
                    nombre_participante: nombreParticipante,
                    usuario_participante: usuarioParticipante,
                    lider_responsable: responsable,
                    participante: participante,
                    porcentaje_participacion: porcentaje,
                    monto_ingresado: montoCTCI,
                    ingreso_participacion: montoParticipacion,
                    remanente: "No",
                    interinstitucional: "No",
                    interareas: "No",
                    interdirecciones: "No",
                    puntos_totales: 0.00,
                    puntos_lider: 0.00,
                    nuevos_puntos_totales: 0.00,
                    puntos_participacion: 0.00,
                    total: total,
                    year: year,
                    tipo: "Cursos",
                    _token: "{{ csrf_token() }}",
                },
                type: 'POST',
                dateType: 'json',
                mensajeConfirm: 'Se han actualizado los puntos para la evaluación.',
                url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}"
            };
            // console.log(options);
            peticionGeneralAjax(options);
            $('#txtCGNCursos').val('');
            $('#txtProyectoCursos').val('');
            $('#txtClaveResponsableCursos').val('');
            $('#txtNombreResponsableCursos').val('');
            $('#txtUsuarioResponsableCursos').val('');
            $('#txtClaveParticipanteCursos').val('');
            $('#txtNombreParticipanteCursos').val('');
            $('#txtUsuarioParticipanteCursos').val('');
            $('#txtPorcentajeCursos').val(0);
            $('#txtMontoCursos').val(0);
            $('#txtImporteCursos').val('');
            $('#txtTotalCursos').val('');
            document.getElementById("responsableCursos").checked = false;
            document.getElementById("participanteCursos").checked = false;
        }

        function editarCursos(id, year){
            $('#btnActualizarCursos').show();
            $('#btnGuardarCursos').hide();
            $('#btnCancelarCursos').show();
            //Consultar los datos de la base de datos...
            consultarDatos({
                action: "{{ config('app.url') }}/modulos/sostenibilidad/getSostentabilidad/"+id+"/"+year,
                type: 'GET',
                dataType: 'json',
                ok: function(getSostentabilidad){
                    var getSostentabilidad = getSostentabilidad.response[0];
                    // console.log(getSostentabilidad.cgn);
                    $('#txtId').val(getSostentabilidad.id);
                    $('#txtCGNCursos').val(getSostentabilidad.cgn);
                    $('#txtProyectoCursos').val(getSostentabilidad.nombre);
                    $('#txtClaveResponsableCursos').val(getSostentabilidad.clave_responsable);
                    $('#txtNombreResponsableCursos').val(getSostentabilidad.nombre_responsable);
                    $('#txtUsuarioResponsableCursos').val(getSostentabilidad.usuario_responsable);
                    $('#txtClaveParticipanteCursos').val(getSostentabilidad.clave_participante);
                    $('#txtNombreParticipanteCursos').val(getSostentabilidad.nombre_participante);
                    $('#txtUsuarioParticipanteCursos').val(getSostentabilidad.usuario_participante);
                    if(getSostentabilidad.lider_responsable == 'No'){
                        $("#responsableCursos").prop('checked', false);
                    }else{
                        $("#responsableCursos").prop('checked', true);
                    }
                    if(getSostentabilidad.participante == 'No'){
                        $("#participanteCursos").prop('checked', false);
                    }else{
                        $("#participanteCursos").prop('checked', true);
                    }
                    $('#txtPorcentajeCursos').val(getSostentabilidad.porcentaje_participacion);
                    $('#txtMontoCursos').val(getSostentabilidad.monto_ingresado);
                    $('#txtImporteCursos').val(getSostentabilidad.ingreso_participacion);
                    $('#txtTotalCursos').val(getSostentabilidad.total);
                    $('#txtYearCursos').val(getSostentabilidad.year);
                },
            });
        }

        function actualizarCursos(){
            var id = $("#txtId").val();
            var cgn = $('#txtCGNCursos').val();
            var nombreCursos = $('#txtProyectoCursos').val();
            var claveResponsable = $('#txtClaveResponsableCursos').val();
            var nombreResponsable = $('#txtNombreResponsableCursos').val();
            var usuarioResponsable = $('#txtUsuarioResponsableCursos').val();
            var claveParticipante = $('#txtClaveParticipanteCursos').val();
            var nombreParticipante = $('#txtNombreParticipanteCursos').val();
            var usuarioParticipante = $('#txtUsuarioParticipanteCursos').val();
            var porcentaje = parseFloat($('#txtPorcentajeCursos').val());
            var montoCTCI = parseFloat($('#txtMontoCursos').val());
            var montoParticipacion = parseFloat($('#txtImporteCursos').val().split('$').join('').split(',').join('') || 0);
            var total = parseFloat($('#txtTotalCursos').val());
            var year = parseFloat($('#txtYearCursos').val());
            if($('#responsableCursos').prop('checked')){
                var responsable = "Si"
            }else{
                var responsable = "No";
            }
            if($('#participanteCursos').prop('checked')){
                var participante = "Si"
            }else{
                var participante = "No";
            }
            // console.log(responsable + '->' + participante);
            // Nos muestra un mensaje de que debe de llenar los campos...
            if(cgn == "" || nombreCursos == "" || nombreResponsable == "" || nombreParticipante == "" || porcentaje == 0 || montoCTCI == 0){
                swal({
                    type: 'warning',
                    text: 'Favor de seleccionar si es el responsable o el participante.',
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
                return;
            }
            swal({
                type: 'warning',
                title: "Se actualizara el registro.",
                text: "¿Desea continuar?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Si, actualizar",
                denyButtonText: "Cancelar",
            }).then((result) => {
                var options = {
                    action: "{{ config('app.url') }}/modulos/sostenibilidad/updateSostentabilidad/"+id,
                    json: {
                        cgn: cgn,
                        nombre: nombreCursos,
                        clave_responsable: claveResponsable,
                        nombre_responsable: nombreResponsable,
                        usuario_responsable: usuarioResponsable,
                        clave_participante: claveParticipante,
                        nombre_participante: nombreParticipante,
                        usuario_participante: usuarioParticipante,
                        lider_responsable: responsable,
                        participante: participante,
                        porcentaje_participacion: porcentaje,
                        monto_ingresado: montoCTCI,
                        ingreso_participacion: montoParticipacion,
                        total: total,
                        _token: "{{ csrf_token() }}",
                    },
                    type: 'PUT',
                    dateType: 'json',
                    mensajeConfirm: 'Se ha actualizado correctamente el registro.',
                    url: "{{ config('app.url') }}/modulos/sostenibilidad/listSostenibilidad?token={{ Session::get('token') }}",
                };
                // console.log(options);
                peticionGeneralAjax(options);
            });
        }

        function cancelarCursos(){
            $('#txtId').val('');
            $('#txtCGNCursos').val('');
            $('#txtProyectoCursos').val('');
            $('#txtClaveResponsableCursos').val('');
            $('#txtNombreResponsableCursos').val('');
            $('#txtUsuarioResponsableCursos').val('');
            $('#txtClaveParticipanteCursos').val('');
            $('#txtNombreParticipanteCursos').val('');
            $('#txtUsuarioParticipanteCursos').val('');
            $("#responsableCursos").prop('checked', false);
            $("#participanteCursos").prop('checked', false);
            $('#txtPorcentajeCursos').val('');
            $('#txtMontoCursos').val('');
            $('#txtImporteCursos').val('');
            $('#txtTotalCursos').val('');
            $('#txtYearCursos').val(new Date().getFullYear() - 1);
            $('#btnActualizarCursos').hide();
            $('#btnGuardarCursos').show();
            $('#btnCancelarCursos').hide();
        }
    </script>
@endsection
