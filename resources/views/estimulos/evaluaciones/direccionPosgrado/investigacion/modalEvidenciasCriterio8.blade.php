<div class="modal fade bd-example-modal-lg" id="modalEvidenciasCriterio8" tabindex="-1" aria-labelledby="modalEvidenciasCriterio8Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasCriterio8Label">Seleccione las evidencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="clave" id="clave">
                <input type="hidden" name="year" id="year">
                <div class="row" id="contenedorCriterio8">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('estimulo-evaluaciones-administracion-investigacion-index')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizarCriterio8"/>
                @endcan
            </div>
        </div>
    </div>
</div>
