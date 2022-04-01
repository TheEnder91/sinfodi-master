<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio33" class="table table-bordered table-striped">
        <caption>Pruebas de desempeño(limite superior de 40 puntos máximo).</caption>
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
    function obtenerCriterio33(year, criterio){
        verTablaCriterio33(year);
    }

    function verTablaCriterio33(year){
        var row = "";
        if ($.fn.dataTable.isDataTable("#tblCriterio33")) {
            tblDifusionDivulgacion = $("#tblCriterio33").DataTable();
            tblDifusionDivulgacion.destroy();
        }
        $('#tblCriterio33 > tbody').html('');
        $('#tblCriterio33 > tbody').append(row);
        $('#tblCriterio33').DataTable({
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
