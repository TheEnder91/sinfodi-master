<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio24" tabindex="-1" aria-labelledby="modalEvidenciasCriterio24Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio24Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio24" id="claveCriterio24">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valorCriterio24" id="txtValorCriterio24" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidadCriterio24" id="txtCantidadCriterio24" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="totalCriterio24" id="txtTotalCriterio24" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="yearCriterio24" id="txtYearCriterio24" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio24">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('estimulo-evaluaciones-administracion-formacion-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio24"/>
                @endcan
            </div>
        </div>
    </div>
</div>
