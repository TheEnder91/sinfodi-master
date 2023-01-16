<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio38" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Proyectos interinstitucionales (Valor del punto: 300).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function obtenerCriterio38(year, criterio){
        var id_objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero38){
                var datosCriterio38 = datosCritero38.response;
                // console.log(datosCritero38);
                // Codigo para guardar en el sistema...
                if(datosCriterio38.length > 0){
                    // console.log(datosCriterio37);
                    let arrCriterio38 = [];
                    datosCriterio38.forEach((x)=>{
                        if(x['interinstitucional'] == 'Si'){
                            if(arrCriterio38.some((val)=>{ return val['clave_participante'] == x['clave_participante']})){
                                arrCriterio38.forEach((k)=>{
                                    if(k['clave_participante'] === x['clave_participante']){
                                        k['nombre_participante'] = x['nombre_participante']
                                        k['usuario_participante'] = x['usuario_participante']
                                        k['year'] = x['year']
                                        k["occurrence"]++;
                                    }
                                });
                            }else{
                                let a = {}
                                a['clave_participante'] = x['clave_participante']
                                a['nombre_participante'] = x['nombre_participante']
                                a['usuario_participante'] = x['usuario_participante']
                                a['year'] = x['year']
                                a["occurrence"] = 1;
                                arrCriterio38.push(a);
                            }
                        }
                    });
                    // console.log(arrCriterio38);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/puntos/" + criterio + "/" + id_objetivo,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(puntosCriterio38){
                            var puntos = puntosCriterio38.response;
                            // console.log(puntos[0].puntos);
                            for(var i = 0; i < arrCriterio38.length; i++){
                                var dataCriterio38 = arrCriterio38[i];
                                // console.log(dataCriterio38);
                                var puntosTotales = dataCriterio38.occurrence * puntos[0].puntos;
                                    // console.log(dataCriterio38.clave_participante + '->' + puntosTotales);
                                // console.log(puntosTotales);
                                verTablaCriterio38(year, criterio);
                                // $.ajax({
                                //     type: 'POST',
                                //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/saveDatos",
                                //     data: {
                                //         token: $('#txtTokenRepo').val(),
                                //         clave: dataCriterio38.clave_participante,
                                //         nombre: dataCriterio38.nombre_participante,
                                //         id_objetivo: id_objetivo,
                                //         id_criterio: criterio,
                                //         direccion: "DCiencia",
                                //         puntos: dataCriterio38.occurrence,
                                //         total_puntos: puntosTotales,
                                //         year: year,
                                //         username: dataCriterio38.usuario_participante
                                //     },
                                //     headers: {
                                //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                //     },
                                //     success: function(data){
                                //         verTablaCriterio38(year, criterio);
                                //         // console.log('Ok');
                                //     }
                                // });
                            }
                        },
                    });
                }else{
                    verTablaCriterio38(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio38(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio38){
                var datosCienciaCriterio38 = datosCienciaCriterio38.response;
                // console.log(datosCienciaCriterio38);
                var row = "";
                for(var i = 0; i < datosCienciaCriterio38.length; i++){
                    var dataCienciaCriteri38 = datosCienciaCriterio38[i];
                    // console.log(dataCienciaCriteri38);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriteri38.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataCienciaCriteri38.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataCienciaCriteri38.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataCienciaCriteri38.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataCienciaCriteri38.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataCienciaCriteri38.year + '</td>';
                            row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio38")) {
                    tblDifusionDivulgacion = $("#tblCriterio38").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio38 > tbody').html('');
                $('#tblCriterio38 > tbody').append(row);
                $('#tblCriterio38').DataTable({
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
