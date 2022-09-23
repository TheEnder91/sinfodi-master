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
                <th scope="col" style="font-size:13px;">Detalles</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-lg" id="detalleCriterio38ModalLabel" tabindex="-1" role="dialog" aria-labelledby="detalleCriterio38ModalLabel" aria-hidden="true">
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
                                    <table id="tblTransferenciaBCriterio38" class="table table-bordered table-striped display" style="font-size:13px;">
                                        <caption style="font-size:13px;">Sumar solo los proyectos que sean interinstitucionales.</caption>
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">interinstitucional</th>
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
    function obtenerCriterio38(year, criterio){
        var id_objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero38){
                var datosCriterio38 = datosCritero38.response;
                // console.log(datosCritero38);
                // Codigo para guardar en el sistema...
                if(datosCriterio38.length > 0){
                    // console.log(datosCriterio38);
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
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/puntos/" + criterio + "/" + id_objetivo,
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
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/saveDatos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: dataCriterio38.clave_participante,
                                        nombre: dataCriterio38.nombre_participante,
                                        id_objetivo: id_objetivo,
                                        id_criterio: criterio,
                                        direccion: "DGeneral",
                                        puntos: dataCriterio38.occurrence,
                                        total_puntos: puntosTotales,
                                        year: year,
                                        username: dataCriterio38.usuario_participante
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio38(year, criterio);
                                        // console.log('Ok');
                                    }
                                });
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
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio38){
                var datosGeneralCriterio38 = datosGeneralCriterio38.response;
                // console.log(datosGeneralCriterio38);
                var row = "";
                for(var i = 0; i < datosGeneralCriterio38.length; i++){
                    var dataGeneralCriteri38 = datosGeneralCriterio38[i];
                    // console.log(dataGeneralCriteri38);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriteri38.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriteri38.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataGeneralCriteri38.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriteri38.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriteri38.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriteri38.year + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;"><a href="javascript:verDetalleCriterio38(' + dataGeneralCriteri38.year + ', ' + dataGeneralCriteri38.clave + ')"><i class="fa fa-search"></i></a></td>';
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

    function verDetalleCriterio38(year, clave){
            $('#detalleCriterio38ModalLabel').modal({backdrop: 'static', keyboard: false});
            document.getElementById('tituloModal').innerHTML='Detalle transferencia de conocimiento->actividades B.';
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/getDatosinterinstitucional/" + clave + "/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosTransferenciaBCriterio38){
                    // console.log(datosTransferenciaBCriterio38);
                    var dataTransferenciaBCriterio38 = datosTransferenciaBCriterio38.response;
                    var row = "";
                    if(dataTransferenciaBCriterio38.length > 0){
                        for(var i = 0; i < dataTransferenciaBCriterio38.length; i++){
                            var getTransferenciaBCriterio38 = dataTransferenciaBCriterio38[i];
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + getTransferenciaBCriterio38.cgn + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio38.interinstitucional + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio38.tipo + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio38.year + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(300) + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblTransferenciaBCriterio38")) {
                        tblDifusionDivulgacion = $("#tblTransferenciaBCriterio38").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblTransferenciaBCriterio38 > tbody').html('');
                    $('#tblTransferenciaBCriterio38 > tbody').append(row);
                    $('#tblTransferenciaBCriterio38').DataTable({
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
