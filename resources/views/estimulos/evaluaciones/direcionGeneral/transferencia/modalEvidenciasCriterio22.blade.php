<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio22" tabindex="-1" aria-labelledby="modalEvidenciasCriterio22Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio22Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio22" id="claveCriterio22">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valor" id="txtValorCriterio22" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidad" id="txtCantidadCriterio22" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="total" id="txtTotalCriterio22" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="year" id="txtYearCriterio22" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio22">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('estimulo-evaluaciones-general-transferencia-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio22"/>
                @endcan
            </div>
        </div>
    </div>
</div>
