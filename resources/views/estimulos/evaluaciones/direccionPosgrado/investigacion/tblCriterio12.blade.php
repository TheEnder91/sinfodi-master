<div class="table-responsive" width = "100%">
    <table id="tblCriterio12" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Editor de libros científicos en editoriales de reconocido prestigio (Valor del punto: 70).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function obtenerCriterio12(year, criterio){
        var row = "";
        if ($.fn.dataTable.isDataTable("#tblCriterio12")) {
            tblDifusionDivulgacion = $("#tblCriterio12").DataTable();
            tblDifusionDivulgacion.destroy();
        }
        $('#tblCriterio12 > tbody').html('');
        $('#tblCriterio12 > tbody').append(row);
        $('#tblCriterio12').DataTable({
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
            lengthMenu: [[10, 15, 20, 50], [10, 15, 20, 50]]
        });
    }
</script>
