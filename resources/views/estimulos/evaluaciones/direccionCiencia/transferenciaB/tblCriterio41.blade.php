<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio41" class="table table-bordered table-striped">
        <caption>Proyectos de I&DT con avance tecnológico(TRL).</caption>
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
    function obtenerCriterio41(year, criterio){
        verTablaCriterio41(year);
    }

    function verTablaCriterio41(year){
        var row = "";
        if ($.fn.dataTable.isDataTable("#tblCriterio41")) {
            tblDifusionDivulgacion = $("#tblCriterio41").DataTable();
            tblDifusionDivulgacion.destroy();
        }
        $('#tblCriterio41 > tbody').html('');
        $('#tblCriterio41 > tbody').append(row);
        $('#tblCriterio41').DataTable({
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
