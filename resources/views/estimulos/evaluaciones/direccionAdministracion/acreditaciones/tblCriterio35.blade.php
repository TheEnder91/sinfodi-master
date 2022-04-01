<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio35" class="table table-bordered table-striped">
        <caption>Pruebas interlaboratorio(puntos por analito 60 puntos máximo).</caption>
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
    function obtenerCriterio35(year, criterio){
        verTablaCriterio35(year);
    }

    function verTablaCriterio35(year){
        var row = "";
        if ($.fn.dataTable.isDataTable("#tblCriterio35")) {
            tblDifusionDivulgacion = $("#tblCriterio35").DataTable();
            tblDifusionDivulgacion.destroy();
        }
        $('#tblCriterio35 > tbody').html('');
        $('#tblCriterio35 > tbody').append(row);
        $('#tblCriterio35').DataTable({
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
