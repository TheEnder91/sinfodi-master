<div class="table-responsive">
    <table id="tblCriterio2" class="table table-bordered table-striped">
        <caption>Alumno del programa de maestría del CIDETEQ graduado entre 20 y 30 meses.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
                <th scope="col">Evidencias</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datosCriterio2 as $item)
                @if ($item->username == Auth::user()->usuario || Auth::user()->hasPermissionTo('estimulo-evaluaciones-direccionGral-posgrado-index'))
                    <tr>
                        <th scope="row" class="text-center" width="10%">{{ $item->clave }}</th>
                        <td width="40%">{{ $item->nombre }}</td>
                        <td class="text-center" width="10%">{{ $item->puntos }}</td>
                        <td class="text-center" width="10%">{{ $item->total_puntos }}</td>
                        <td class="text-center" width="10%">{{ $item->year }}</td>
                        @foreach ($evidenciasCriterio2 as $item2)
                            @if ($item->clave == $item2->numero_personal)
                                <a href="#" data-toggle="modal" data-target="#modalPDF_{{ $item2->numero_personal }}"><i class="fa fa-eye"></i></a>
                                <!-- Modal Visualizar PDFs -->
                                <div class="modal fade bd-example-modal-xl" id="modalPDF_{{ $item2->numero_personal }}" tabindex="-1" role="dialog" aria-labelledby="modalPDFLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalPDFLabel">Evidencia: <b>{{ $item2->numero_personal }}</b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                 <object class="PDFdoc" width="100%" height="700px" type="application/pdf" data="{{ $item2->documentacion }}"></object>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(function(){
        $('#tblCriterio2').DataTable({
            "order":[[0, "asc"]],
            "language":{
              "lengthMenu": "Mostrar _MENU_ registros por página.",
              "info": "Página _PAGE_ de _PAGES_",
              "infoEmpty": "No se encontraron registros.",
              "infoFiltered": "(filtrada de _MAX_ registros)",
              "loadingRecords": "Cargando...",
              "processing":     "Procesando...",
              "search": "Buscar:",
              "zeroRecords":    "No se encontraron registros.",
              "paginate": {
                              "next":       ">",
                              "previous":   "<"
                          },
            },
            lengthMenu: [[10, 15, 20], [10, 15, 20]]
        });
    });
</script>
