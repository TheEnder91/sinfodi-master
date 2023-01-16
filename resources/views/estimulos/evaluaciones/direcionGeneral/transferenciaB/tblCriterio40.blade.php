<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio40" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Proyectos de I&D en colaboración con otros grupos de la misma área (Valor del punto: 150).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                <th scope="col" style="font-size:13px;">Detalles</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-lg" id="detalleCriterio40ModalLabel" tabindex="-1" role="dialog" aria-labelledby="detalleCriterio40ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title tituloModal" id="exampleModalLongTitle">
                    <div class="tituloModal" id="tituloModal"></div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cuerpoModal">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tblTransferenciaBCriterio40" class="table table-bordered table-striped display" style="font-size:13px;">
                                        <caption style="font-size:13px;">Sumar solo los proyectos que sean interáreas.</caption>
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">interáreas</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Tipo</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Año</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">Puntaje</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function obtenerCriterio40(year, criterio){
        var id_objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero40){
                var datosCriterio40 = datosCritero40.response;
                // console.log(datosCritero40);
                // Codigo para guardar en el sistema...
                if(datosCriterio40.length > 0){
                    // console.log(datosCriterio37);
                    let arrCriterio40 = [];
                    datosCriterio40.forEach((x)=>{
                        if(x['interareas'] == 'Si'){
                            if(arrCriterio40.some((val)=>{ return val['clave_participante'] == x['clave_participante']})){
                                arrCriterio40.forEach((k)=>{
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
                                arrCriterio40.push(a);
                            }
                        }
                    });
                    // console.log(arrCriterio40);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/puntos/" + criterio + "/" + id_objetivo,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(puntosCriterio40){
                            var puntos = puntosCriterio40.response;
                            // console.log(puntos[0].puntos);
                            for(var i = 0; i < arrCriterio40.length; i++){
                                var dataCriterio40 = arrCriterio40[i];
                                // console.log(dataCriterio40);
                                var puntosTotales = dataCriterio40.occurrence * puntos[0].puntos;
                                // console.log(dataCriterio40.clave_participante + '->' + puntosTotales);
                                verTablaCriterio40(year, criterio);
                                // $.ajax({
                                //     type: 'POST',
                                //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/saveDatos",
                                //     data: {
                                //         token: $('#txtTokenRepo').val(),
                                //         clave: dataCriterio40.clave_participante,
                                //         nombre: dataCriterio40.nombre_participante,
                                //         id_objetivo: id_objetivo,
                                //         id_criterio: criterio,
                                //         direccion: "DGeneral",
                                //         puntos: dataCriterio40.occurrence,
                                //         total_puntos: puntosTotales,
                                //         year: year,
                                //         username: dataCriterio40.usuario_participante
                                //     },
                                //     headers: {
                                //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                //     },
                                //     success: function(data){
                                //         verTablaCriterio40(year, criterio);
                                //         // console.log('Ok');
                                //     }
                                // });
                            }
                        },
                    });
                }else{
                    verTablaCriterio40(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio40(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio40){
                var datosGeneralCriterio40 = datosGeneralCriterio40.response;
                // console.log(datosGeneralCriterio40);
                var row = "";
                for(var i = 0; i < datosGeneralCriterio40.length; i++){
                    var dataGeneralCriteri40 = datosGeneralCriterio40[i];
                    // console.log(dataGeneralCriteri40);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriteri40.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriteri40.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataGeneralCriteri40.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriteri40.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriteri40.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriteri40.year + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;"><a href="javascript:verDetalleCriterio40(' + dataGeneralCriteri40.year + ', ' + dataGeneralCriteri40.clave + ')"><i class="fa fa-search"></i></a></td>';
                            row += "</tr>";
                    }
                }
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
            },
        });
    }

    function verDetalleCriterio40(year, clave){
            $('#detalleCriterio40ModalLabel').modal({backdrop: 'static', keyboard: false});
            document.getElementById('tituloModal').innerHTML='Detalle transferencia de conocimiento->actividades B.';
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/getDatosInterareas/" + clave + "/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosTransferenciaBCriterio40){
                    // console.log(datosTransferenciaBCriterio40);
                    var dataTransferenciaBCriterio40 = datosTransferenciaBCriterio40.response;
                    var row = "";
                    if(dataTransferenciaBCriterio40.length > 0){
                        for(var i = 0; i < dataTransferenciaBCriterio40.length; i++){
                            var getTransferenciaBCriterio40 = dataTransferenciaBCriterio40[i];
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + getTransferenciaBCriterio40.cgn + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio40.interareas + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio40.tipo + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio40.year + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(200) + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblTransferenciaBCriterio40")) {
                        tblDifusionDivulgacion = $("#tblTransferenciaBCriterio40").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblTransferenciaBCriterio40 > tbody').html('');
                    $('#tblTransferenciaBCriterio40 > tbody').append(row);
                    $('#tblTransferenciaBCriterio40').DataTable({
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
            });
        }
</script>
