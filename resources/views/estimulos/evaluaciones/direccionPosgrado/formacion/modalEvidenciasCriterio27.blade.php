<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio27" tabindex="-1" aria-labelledby="modalEvidenciasCriterio27Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio27Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="claveCriterio27" id="claveCriterio27">
                <div class="row">
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Valor punto:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="valorCriterio27" id="txtValorCriterio27" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Cantidad:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="cantidadCriterio27" id="txtCantidadCriterio27" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Total:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="totalCriterio27" id="txtTotalCriterio27" value="0" readonly>
                    </div>
                    <div class="col-2">
                        <label class="col-form-label" style="font-size:13px;">Año:</label>
                        <input type="text" class="form-control form-control-sm text-center" name="yearCriterio27" id="txtYearCriterio27" readonly>
                    </div>
                </div>
                <br>
                <div class="row" id="contenedorCriterio27">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- @can('estimulo-evaluaciones-posgrado-formacion-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio27"/>
                @endcan --}}
            </div>
        </div>
    </div>
</div>
