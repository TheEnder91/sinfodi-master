<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio34" class="table table-bordered table-striped">
        <caption>Nuevas técnicas acreditadas y validadas como tales por la dirección técnica.</caption>
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
    function obtenerCriterio34(year, criterio){
        verTablaCriterio34(year);
    }

    function verTablaCriterio34(year){
        var row = "";
        if ($.fn.dataTable.isDataTable("#tblCriterio34")) {
            tblDifusionDivulgacion = $("#tblCriterio34").DataTable();
            tblDifusionDivulgacion.destroy();
        }
        $('#tblCriterio34 > tbody').html('');
        $('#tblCriterio34 > tbody').append(row);
        $('#tblCriterio34').DataTable({
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
