<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio33" tabindex="-33" aria-labelledby="modalEvidenciasCriterio33Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio33Label">Seleccione las evidencias(Maximo 40)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio33" id="claveCriterio33">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valorCriterio33" id="txtValorCriterio33" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidadCriterio33" id="txtCantidadCriterio33" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="totalCriterio33" id="txtTotalCriterio33" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="yearCriterio33" id="txtYearCriterio33" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio33">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('evaluaciones-administracion-acreditaciones-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio33"/>
                @endcan
            </div>
        </div>
    </div>
</div>
