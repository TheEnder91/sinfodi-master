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
        var id_objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/tranferenciaB/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero41){
                var datosCriterio41 = datosCritero41.response;
                // console.log(datosCritero41);
                // Codigo para guardar en el sistema...
                if(datosCriterio41.length > 0){
                    // console.log(datosCriterio41);
                    let arrCriterio41 = [];
                    datosCriterio41.forEach((x)=>{
                        if(x['trl'] == 1){
                            if(arrCriterio41.some((val)=>{ return val['clave_participante'] == x['clave_participante']})){
                                arrCriterio41.forEach((k)=>{
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
                                arrCriterio41.push(a);
                            }
                        }
                    });
                    // console.log(arrCriterio41);
                    if(arrCriterio41.length > 0){
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/tranferenciaB/puntos/" + criterio + "/" + id_objetivo,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(puntosCriterio41){
                                var puntos = puntosCriterio41.response;
                                // console.log(puntos[0].puntos);
                                for(var i = 0; i < arrCriterio41.length; i++){
                                    var dataCriterio41 = arrCriterio41[i];
                                    // console.log(dataCriterio41);
                                    var puntosTotales = dataCriterio41.occurrence * puntos[0].puntos;
                                    // console.log(dataCriterio41.clave_participante + '->' + puntosTotales);
                                    verTablaCriterio41(year, criterio);
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/tranferenciaB/saveDatos",
                                        data: {
                                            token: $('#txtTokenRepo').val(),
                                            clave: dataCriterio41.clave_participante,
                                            nombre: dataCriterio41.nombre_participante,
                                            id_objetivo: id_objetivo,
                                            id_criterio: criterio,
                                            direccion: "DServTec",
                                            puntos: dataCriterio41.occurrence,
                                            total_puntos: puntosTotales,
                                            year: year,
                                            username: dataCriterio41.usuario_participante
                                        },
                                        headers: {
                                            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                        },
                                        success: function(data){
                                            // verTablaCriterio41(year, criterio);
                                            console.log('Ok');
                                        }
                                    });
                                }
                            },
                        });
                    }else{
                        verTablaCriterio41(year, criterio);
                    }
                }else{
                    verTablaCriterio41(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio41(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionServTec/tranferenciaB/datosTransferenciaB/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCienciaCriterio41){
                var datosCienciaCriterio41 = datosCienciaCriterio41.response;
                // console.log(datosCienciaCriterio41);
                var row = "";
                if(datosCienciaCriterio41.length > 0){
                    for(var i = 0; i < datosCienciaCriterio41.length; i++){
                    var dataCienciaCriteri40 = datosCienciaCriterio41[i];
                    // console.log(dataCienciaCriteri40);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-servicios-transferenciaB-index") ?>';
                    // console.log(permissions);
                    if(dataCienciaCriteri40.username == authUser || permissions == 1){
                            row += "<tr>";
                            row += '<th style="font-size:12px;" scope="row" class="text-center" width="10%">' + dataCienciaCriteri40.clave + '</td>';
                            row += '<td style="font-size:12px;" width="60%">' + dataCienciaCriteri40.nombre.toUpperCase() + "</td>";
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataCienciaCriteri40.puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + parseInt(dataCienciaCriteri40.total_puntos) + '</td>';
                            row += '<td style="font-size:12px;" class="text-center" width="10%">' + dataCienciaCriteri40.year + '</td>';
                            row += "</tr>";
                    }
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
