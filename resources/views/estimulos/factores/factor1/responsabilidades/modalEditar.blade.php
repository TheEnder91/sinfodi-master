<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-pencil"></i> Editar nivel de responsabilidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="id" id="id" hidden>
                <label for="" class="col-form-control">
                    <span style="color: red">*</span>Nivel de responsabilidad:
                </label>
                <textarea class="form-control" name="nombre" id="nombreE"></textarea>
                <label for="" name='puntos' class="col-form-control">
                    <span style="color: red">*</span>Puntos asginado:
                </label>
                <input type="number" name="puntos" class="form-control" onKeyPress="return soloNumeros(event)" id="puntosE">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                @can('estimulo-responsabilidad-edit')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar"/>
                @endcan
            </div>
        </div>
    </div>
</div>
