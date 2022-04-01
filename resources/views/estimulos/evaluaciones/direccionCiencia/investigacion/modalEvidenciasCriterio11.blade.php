<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio11" tabindex="-1" aria-labelledby="modalEvidenciasCriterio11Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio11Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="clave" id="clave">
                <input type="hidden" name="year" id="year">
                <div class="row" id="contenedorCriterio11">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('estimulo-evaluaciones-ciencia-investigacion-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio11"/>
                @endcan
            </div>
        </div>
    </div>
</div>