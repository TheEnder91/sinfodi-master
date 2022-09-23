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
                <th scope="col" style="font-size:13px;">Detalles</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-lg" id="detalleCriterio39ModalLabel" tabindex="-1" role="dialog" aria-labelledby="detalleCriterio39ModalLabel" aria-hidden="true">
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
                                    <table id="tblTransferenciaBCriterio39" class="table table-bordered table-striped display" style="font-size:13px;">
                                        <caption style="font-size:13px;">Sumar solo los proyectos que sean interdirecciones.</caption>
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">CGN</th>
                                                <th scope="col" style="font-size:13px; vertical-align:middle;">interdirecciones</th>
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
    function obtenerCriterio39(year, criterio){
        var id_objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/searchTransferencia/" + year + "/" + criterio,
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
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/puntos/" + criterio + "/" + id_objetivo,
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
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/saveDatos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: dataCriterio39.clave_participante,
                                        nombre: dataCriterio39.nombre_participante,
                                        id_objetivo: id_objetivo,
                                        id_criterio: criterio,
                                        direccion: "DGeneral",
                                        puntos: dataCriterio39.occurrence,
                                        total_puntos: puntosTotales,
                                        year: year,
                                        username: dataCriterio39.usuario_participante
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        verTablaCriterio39(year, criterio);
                                        // console.log('Ok');
                                    }
                                });
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
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio39){
                var datosGeneralCriterio39 = datosGeneralCriterio39.response;
                // console.log(datosGeneralCriterio39);
                var row = "";
                for(var i = 0; i < datosGeneralCriterio39.length; i++){
                    var dataGeneralCriteri39 = datosGeneralCriterio39[i];
                    // console.log(dataGeneralCriteri39);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriteri39.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataGeneralCriteri39.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataGeneralCriteri39.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriteri39.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataGeneralCriteri39.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataGeneralCriteri39.year + '</td>';
                            row += '<td class="text-center" width="5%" style="font-size:12px;"><a href="javascript:verDetalleCriterio39(' + dataGeneralCriteri39.year + ', ' + dataGeneralCriteri39.clave + ')"><i class="fa fa-search"></i></a></td>';
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

    function verDetalleCriterio39(year, clave){
            $('#detalleCriterio39ModalLabel').modal({backdrop: 'static', keyboard: false});
            document.getElementById('tituloModal').innerHTML='Detalle transferencia de conocimiento->actividades B.';
            consultarDatos({
                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/tranferenciaB/getDatosInterdirecciones/" + clave + "/" + year,
                type: 'GET',
                dataType: 'json',
                ok: function(datosTransferenciaBCriterio39){
                    // console.log(datosTransferenciaBCriterio39);
                    var dataTransferenciaBCriterio39 = datosTransferenciaBCriterio39.response;
                    var row = "";
                    if(dataTransferenciaBCriterio39.length > 0){
                        for(var i = 0; i < dataTransferenciaBCriterio39.length; i++){
                            var getTransferenciaBCriterio39 = dataTransferenciaBCriterio39[i];
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + getTransferenciaBCriterio39.cgn + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio39.interdirecciones + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio39.tipo + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + getTransferenciaBCriterio39.year + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(200) + '</td>';
                            row += "</tr>";
                        }
                    }
                    if ($.fn.dataTable.isDataTable("#tblTransferenciaBCriterio39")) {
                        tblDifusionDivulgacion = $("#tblTransferenciaBCriterio39").DataTable();
                        tblDifusionDivulgacion.destroy();
                    }
                    $('#tblTransferenciaBCriterio39 > tbody').html('');
                    $('#tblTransferenciaBCriterio39 > tbody').append(row);
                    $('#tblTransferenciaBCriterio39').DataTable({
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
