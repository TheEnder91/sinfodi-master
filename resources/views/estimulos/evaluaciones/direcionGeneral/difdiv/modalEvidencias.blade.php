<div class="modal fade bd-example-modal-lg" id="modalEvidencias" tabindex="-1" aria-labelledby="modalEvidenciasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvidenciasLabel">Seleccione las evidencias(Maximo 5)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="clave" id="clave">
                <input type="hidden" name="year" id="year">
                <div class="row" id="contenedor">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @can('estimulo-evaluaciones-general-difusiondivulgacion-update')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar"/>
                @endcan
            </div>
        </div>
    </div>
</div>
