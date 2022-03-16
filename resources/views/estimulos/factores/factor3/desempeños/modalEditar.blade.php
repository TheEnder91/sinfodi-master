<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-pencil"></i> Editar Factor por Desempeño</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="id" hidden>
                <label for="resultados" class="col-form-control" style="font-size:13px;">
                    <span style="color: red">*</span>RESULTADO DE LA EVALUACION:
                </label>
                <input type="text" name="resultados" id="resultadosE" class="form-control form-control-sm">
                <label for="f3" class="col-form-control" style="font-size:13px;">
                    <span style="color: red">*</span>F3 = FACTOR X Cumplimiento de Metas de Desempeño Cualitativo:
                </label>
                <input type="text" name="f3" id="f3E" class="form-control form-control-sm" onKeyPress="return soloNumeros(event)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="font-size:13px;">Cancelar</button>
                @can('estimulo-desempeño-edit')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar" style="font-size:13px;"/>
                @endcan
            </div>
        </div>
    </div>
</div>
