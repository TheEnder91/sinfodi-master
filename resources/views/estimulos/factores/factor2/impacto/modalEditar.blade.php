<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-pencil"></i> Editar Nivel de Impacto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="id" hidden>
                <label for="factor" class="col-form-control">
                    F2 = FACTOR:
                </label>
                <input type="text" name="factor" id="factorE" class="form-control" onKeyPress="return soloNumeros(event)">
                <label for="nivel" class="col-form-control">
                    Nivel:
                </label>
                <select name="nivel" id="nivelE" class="form-control">
                    <option value="" selected disabled>Seleccione un nivel...</option>
                    <option value="Alto">Alto</option>
                    <option value="Medio">Medio</option>
                    <option value="Bajo">Bajo</option>
                    <option value="Nulo">Nulo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                @can('estimulo-impacto-edit')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar"/>
                @endcan
            </div>
        </div>
    </div>
</div>
