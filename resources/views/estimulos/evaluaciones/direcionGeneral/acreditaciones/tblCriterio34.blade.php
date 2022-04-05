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
                <th scope="col">Evidencias</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.acreditaciones.modalEvidenciasCriterio34')

<script>
    function obtenerCriterio34(year, criterio){
        verTablaCriterio34(year, criterio);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero34){
                var datosCriterio34 = datosCritero34.response;
                // console.log(datosCritero34);
                // Codigo para guardar en el sistema...
                for(var i = 0; i < datosCriterio34.length; i++){
                    var dataCriterio34 = datosCriterio34[i];
                    // console.log(dataCriterio34);
                    consultarDatos({
                        action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchUsername/" + dataCriterio34.numero_personal,
                        type: 'GET',
                        dataType: 'json',
                        ok: function(datosCritero34Username){
                            // Codigo para guardar en el sistema...
                            var username = datosCritero34Username.response[0];
                            // console.log(username.clave + "->" + username.usuario);
                            var options = {
                                action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/saveDatosAcreditaciones",
                                json: {
                                    clave: dataCriterio34.numero_personal,
                                    nombre: dataCriterio34.nombre_personal,
                                    id_objetivo: 8,
                                    id_criterio: criterio,
                                    direccion: "DGeneral",
                                    puntos: 0,
                                    total_puntos: 0,
                                    year: year,
                                    username: username.usuario,
                                    _token: "{{ csrf_token() }}",
                                },
                                type: 'POST',
                                dateType: 'json',
                            };
                            // console.log(options); // Se comenta para futuras pruebas...
                            guardarAutomatico(options);
                            verTablaCriterio34(year, criterio);
                            // Finaliza codigo para guardar en el sistema...
                        },
                    });
                }
            },
        });
    }

    function verTablaCriterio34(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/datosAcreditaciones/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio34){
                // console.log(datosGeneralCriterio34);
                var datosGeneralCriterio34 = datosGeneralCriterio34.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio34.length; i++){
                    var dataGeneralCriterio34 = datosGeneralCriterio34[i];
                    // console.log(dataGeneralCriterio34);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-acreditaciones-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio34.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%">' + dataGeneralCriterio34.clave + '</td>';
                        row += '<td width="40%">' + dataGeneralCriterio34.nombre + "</td>";
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio34.puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio34.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%">' + dataGeneralCriterio34.year + '</td>';
                        if(permissions == 1){
                            row += '<td class="text-center" width="10%"><a href="javascript:verEvidenciasCriterio34(' + dataGeneralCriterio34.year + ', ' + dataGeneralCriterio34.clave + ', ' + criterio +')"><i class="fa fa-edit"></i></a></td>';
                        }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio34")) {
                    tblCriterio34 = $("#tblCriterio34").DataTable();
                    tblCriterio34.destroy();
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
            },
        });
    }

    function verEvidenciasCriterio34(year, clave, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/acreditaciones/searchEvidencias/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio34){
                // console.log(dataEvidenciasCriterio34); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio34').modal('show');
                var datos = dataEvidenciasCriterio34;
                // console.log(datos);
                var row = "";
                $('#clave').val(clave);
                $('#year').val(year);
                for(var i = 0; i < datos.length; i++){
                    var claveData = datos[i];
                    // console.log(claveData.archivo);
                    row += '<div class="col-12 col-md-2 text-center">';
                    row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-EventosAcademicos/' + claveData.clave + '.pdf" target="_blank">';
                    row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                    row += '</a><br>';
                    row += '<b><input type="checkbox" class="evidenciasCriterio34" name="evidenciasCriterio34[]" id="evidenciasCriterio34'+claveData.clave+'" value="'+claveData.clave+'"> ' + claveData.clave + '</b>';
                    row += '</div>';
                }
                $("#contenedorCriterio34").html(row).fadeIn('slow');
            },
        });
    }
</script>
