<div class="modal fade bd-example-modal-lg" id="modaAgregarComite" tabindex="-1" role="dialog" aria-labelledby="modaAgregarComiteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaAgregarComiteLabel">Agregar nuevo comite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveComites" id="claveComites">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-3">
                                <label class="col-form-label" style="font-size:13px;">Consecutivo:</label>
                                <input type="text" class="form-control form-control-sm text-center"  name="numeroComite" id="txtNumeroComite" readonly>
                            </div>
                            <div class="col-12">
                                <label class="col-form-label" style="font-size:13px;">Nombre del comite:</label>
                                <input type="text" class="form-control form-control-sm" name="nombreComite" id="txtNombreComite">
                            </div>
                            <div class="col-12">
                                <label class="col-form-label" style="font-size:13px;">Descripción:</label>
                                <textarea class="form-control form-control-sm" name="descripcionComite" id="txtDescripcionComite" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="col-form-label" style="font-size:13px;">Documento:</label>
                                <input type="file" class="form-control form-control-sm" name="documentoComite" id="txtDocumentoComite" accept="application/pdf" lang="es">
                            </div>
                            <div class="col-4">
                                <label class="col-form-label" style="font-size:13px;">Año:</label>
                                <input type="text" class="form-control form-control-sm text-center" name="yearComite" id="txtYearComite" value="{{ date("Y") - 1 }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="table-responsive">
                            <table id="tblComites" class="table table-bordered table-striped" style="font-size:13px;">
                                <caption style="font-size:13px;">LISTADO DE LOS COMITES REGISTRADOS POR AÑO</caption>
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" style="font-size:13px;">Nombre</th>
                                        <th scope="col" style="font-size:13px;">Documento</th>
                                        <th scope="col" style="font-size:13px;">Año</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="button" class="btn btn-success" value="Guardar" id="btnGuardarComites"/>
            </div>
        </div>
    </div>
</div>
