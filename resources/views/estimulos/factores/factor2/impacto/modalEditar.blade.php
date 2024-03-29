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
                <label for="factor" class="col-form-control" style="font-size:13px;">
                    <span style="color: red">*</span>F2 = FACTOR:
                </label>
                <input type="text" name="factor" id="factorE" class="form-control form-control-sm" onKeyPress="return soloNumeros(event)">
                <label for="nivel" class="col-form-control" style="font-size:13px;">
                    <span style="color: red">*</span>Nivel:
                </label>
                <select name="nivel" id="nivelE" class="form-control form-control-sm">
                    <option value="" selected disabled style="font-size:13px;">Seleccione un nivel...</option>
                    <option value="Alto">Alto</option>
                    <option value="Medio">Medio</option>
                    <option value="Bajo">Bajo</option>
                    <option value="Nulo">Nulo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="font-size:13px;">Cancelar</button>
                @can('estimulo-impacto-edit')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar" style="font-size:13px;"/>
                @endcan
            </div>
        </div>
    </div>
</div>
