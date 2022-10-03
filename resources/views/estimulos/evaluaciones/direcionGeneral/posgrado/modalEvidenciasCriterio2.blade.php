<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio2" tabindex="-1" aria-labelledby="modalEvidenciasCriterio2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio2Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio2" id="claveCriterio2">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valorCriterio2" id="txtValorCriterio2" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidadCriterio2" id="txtCantidadCriterio2" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="totalCriterio2" id="txtTotalCriterio2" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="yearCriterio2" id="txtYearCriterio2" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio2">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- @can('estimulo-evaluaciones-general-posgrado-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio2"/>
                @endcan --}}
            </div>
        </div>
    </div>
</div>
