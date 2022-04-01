<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio40" class="table table-bordered table-striped">
        <caption>Proyectos de I&D en colaboración con otros grupos de la misma área.</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Total</th>
                <th scope="col">Año</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function obtenerCriterio40(year, criterio){
        verTablaCriterio40(year);
    }

    function verTablaCriterio40(year){
        var row = "";
        if ($.fn.dataTable.isDataTable("#tblCriterio40")) {
            tblDifusionDivulgacion = $("#tblCriterio40").DataTable();
            tblDifusionDivulgacion.destroy();
        }
        $('#tblCriterio40 > tbody').html('');
        $('#tblCriterio40 > tbody').append(row);
        $('#tblCriterio40').DataTable({
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
