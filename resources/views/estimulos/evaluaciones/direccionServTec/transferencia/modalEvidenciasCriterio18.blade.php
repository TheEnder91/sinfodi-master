<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio18" tabindex="-1" aria-labelledby="modalEvidenciasCriterio18Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio18Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio18" id="claveCriterio18">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valor" id="txtValorCriterio18" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidad" id="txtCantidadCriterio18" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="total" id="txtTotalCriterio18" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="year" id="txtYearCriterio18" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio18">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('estimulo-evaluaciones-servicios-transferencia-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio18"/>
                @endcan
            </div>
        </div>
    </div>
</div>
