<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio39" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Proyectos de I&D en colaboración con otras direcciones (Valor del punto: 200).</caption>
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
    function obtenerCriterio39(year, criterio){
        var id_objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero39){
                var datosCriterio39 = datosCritero39.response;
                // console.log(datosCritero39);
                // Codigo para guardar en el sistema...
                if(datosCriterio39.length > 0){
                    // console.log(datosCriterio37);
                    let arrCriterio39 = [];
                    datosCriterio39.forEach((x)=>{
                        if(x['interdirecciones'] == 'Si'){
                            if(arrCriterio39.some((val)=>{ return val['clave_participante'] == x['clave_participante']})){
                                arrCriterio39.forEach((k)=>{
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
                                arrCriterio39.push(a);
                            }
                        }
                    });
                    // console.log(arrCriterio39);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/puntos/" + criterio + "/" + id_objetivo,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(puntosCriterio39){
                            var puntos = puntosCriterio39.response;
                            // console.log(puntos[0].puntos);
                            for(var i = 0; i < arrCriterio39.length; i++){
                                var dataCriterio39 = arrCriterio39[i];
                                // console.log(dataCriterio39);
                                var puntosTotales = dataCriterio39.occurrence * puntos[0].puntos;
                                // console.log(dataCriterio39.clave_participante + '->' + puntosTotales);
                                verTablaCriterio39(year, criterio);
                                // $.ajax({
                                //     type: 'POST',
                                //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/saveDatos",
                                //     data: {
                                //         token: $('#txtTokenRepo').val(),
                                //         clave: dataCriterio39.clave_participante,
                                //         nombre: dataCriterio39.nombre_participante,
                                //         id_objetivo: id_objetivo,
                                //         id_criterio: criterio,
                                //         direccion: "DCiencia",
                                //         puntos: dataCriterio39.occurrence,
                                //         total_puntos: puntosTotales,
                                //         year: year,
                                //         username: dataCriterio39.usuario_participante
                                //     },
                                //     headers: {
                                //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                //     },
                                //     success: function(data){
                                //         verTablaCriterio39(year, criterio);
                                //         // console.log('Ok');
                                //     }
                                // });
                            }
                        },
                    });
                }else{
                    verTablaCriterio39(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio39(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionCiencia/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio39){
                var datosCienciaCriterio39 = datosCienciaCriterio39.response;
                // console.log(datosCienciaCriterio39);
                var row = "";
                for(var i = 0; i < datosCienciaCriterio39.length; i++){
                    var dataCienciaCriteri39 = datosCienciaCriterio39[i];
                    // console.log(dataCienciaCriteri39);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-ciencia-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriteri39.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataCienciaCriteri39.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataCienciaCriteri39.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataCienciaCriteri39.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataCienciaCriteri39.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataCienciaCriteri39.year + '</td>';
                            row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio39")) {
                    tblDifusionDivulgacion = $("#tblCriterio39").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio39 > tbody').html('');
                $('#tblCriterio39 > tbody').append(row);
                $('#tblCriterio39').DataTable({
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
