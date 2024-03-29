<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel"><i class="fa fa-pencil"></i> Editar criterio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('estimulos.factores.factor1.actividadesA.form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="font-size:13px;">Cancelar</button>
                @can('estimulo-actividadA-edit')
                    <input type="button" class="btn btn-success" value="Actualizar" id="btnActualizar" style="font-size:13px;"/>
                @endcan
            </div>
        </div>
    </div>
</div>
