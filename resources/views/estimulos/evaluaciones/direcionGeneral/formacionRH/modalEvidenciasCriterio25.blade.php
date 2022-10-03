<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio25" tabindex="-1" aria-labelledby="modalEvidenciasCriterio25Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio25Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio25" id="claveCriterio25">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valorCriterio25" id="txtValorCriterio25" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidadCriterio25" id="txtCantidadCriterio25" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="totalCriterio25" id="txtTotalCriterio25" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="yearCriterio25" id="txtYearCriterio25" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio25">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- @can('estimulo-evaluaciones-general-formacion-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio25"/>
                @endcan --}}
            </div>
        </div>
    </div>
</div>
