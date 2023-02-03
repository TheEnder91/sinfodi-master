<div class="table-responsive" width = "100%">
    <table id="tblCriterio41" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Proyectos de I&DT con avance tecnológico (Valor del punto: 500).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index")) --}}
                    {{-- <th scope="col" style="font-size:13px;">Evidencias</th> --}}
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function obtenerCriterio41(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosServiciosCriterio41){
                var datosServiciosCriterio41 = datosServiciosCriterio41.response;
                // console.log(datosServiciosCriterio41);
                var row = "";
                for(var i = 0; i < datosServiciosCriterio41.length; i++){
                    var dataServiciosCriteri40 = datosServiciosCriterio41[i];
                    // console.log(dataServiciosCriteri40);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataServiciosCriteri40.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataServiciosCriteri40.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataServiciosCriteri40.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataServiciosCriteri40.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataServiciosCriteri40.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataServiciosCriteri40.year + '</td>';
                            row += "</tr>";
                    }
                }
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
            },
        });
    }
</script>
