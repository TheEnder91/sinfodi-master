<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-pencil"></i> Editar Metas alcanzadas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="id" hidden>
                <label for="cumplimiento" class="col-form-control">
                    % CUMPLIMIENTO DE METAS:
                </label>
                <textarea class="form-control" name="cumplimiento" id="cumplimientoE"></textarea>
                <label for="f2" class="col-form-control">
                    F2 = FACTOR X Cumplimiento de Indicadores Institucionales:
                </label>
                <input type="text" name="f2" id="f2E" class="form-control" onKeyPress="return soloNumeros(event)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                @can('estimulo-meta-edit')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar"/>
                @endcan
            </div>
        </div>
    </div>
</div>
