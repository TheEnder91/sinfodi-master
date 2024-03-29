<div class="table-responsive" width = "100%">
    <table id="tblCriterio11" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Memorias nacionales en extenso con arbitraje limitado hasta un máximo de 4 (Valor del punto: 5).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direcionGeneral.investigacion.modalEvidenciasCriterio11')

<script>
    function obtenerCriterio11(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/searchInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero11){
                var datosCriterio11 = datosCritero11.response;
                // console.log(datosCritero11);
                // Codigo para guardar en el sistema...
                if(datosCriterio11.length > 0){
                    for(var i = 0; i < datosCriterio11.length; i++){
                        var dataCriterio11 = datosCriterio11[i];
                        // console.log(dataCriterio11);
                        verTablaCriterio11(year, criterio);
                        // $.ajax({
                        //     type: 'POST',
                        //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/DifDiv/saveDatosDifDiv",
                        //     data: {
                        //         token: $('#txtTokenRepo').val(),
                        //         clave: dataCriterio11.numero_personal,
                        //         nombre: dataCriterio11.nombre,
                        //         id_objetivo: 3,
                        //         id_criterio: 11,
                        //         direccion: "DGeneral",
                        //         puntos: 0,
                        //         total_puntos: 0,
                        //         year: year,
                        //         username: dataCriterio11.username,
                        //     },
                        //     headers: {
                        //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                        //     },
                        //     success: function(data){
                        //         verTablaCriterio11(year, criterio);
                        //     }
                        // });
                    }
                }else{
                    verTablaCriterio11(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio11(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/datosInvestigacion/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosGeneralCriterio11){
                // console.log(datosGeneralCriterio11);
                var datosGeneralCriterio11 = datosGeneralCriterio11.response;
                var row = "";
                for(var i = 0; i < datosGeneralCriterio11.length; i++){
                    var dataGeneralCriterio11 = datosGeneralCriterio11[i];
                    // console.log(dataGeneralCriterio11);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-general-investigacion-index") ?>';
                    // console.log(permissions);
                    if(dataGeneralCriterio11.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio11.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataGeneralCriterio11.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio11.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataGeneralCriterio11.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataGeneralCriterio11.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio11(' + dataGeneralCriterio11.year + ', ' + dataGeneralCriterio11.clave + ', ' + 11 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio11")) {
                    tblDifusionDivulgacion = $("#tblCriterio11").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio11 > tbody').html('');
                $('#tblCriterio11 > tbody').append(row);
                $('#tblCriterio11').DataTable({
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

    function verEvidenciasCriterio11(year, clave, criterio){
        var objetivo = 3;
        $('#txtCantidadCriterio11').val(0);
        $('#txtTotalCriterio11').val(0);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/searchEvidenciasInvestigacion/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio11){
                // console.log(dataEvidenciasCriterio11); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio11').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio11){
                        puntos = puntosCriterio11.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio11').val(puntos);
                        var datos = dataEvidenciasCriterio11.response;
                        var row = "";
                        $('#claveCriterio11').val(clave);
                        $('#txtYearCriterio11').val(year);
                        // console.log(datos);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            // console.log(claveData.clave);
                            row += '<div class="col-12 col-md-2 text-center">';
                            row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-Memorias/' + claveData.clave + '.pdf" target="_blank">';
                            row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                            row += '</a><br>';
                            row += '<b><input type="checkbox" class="evidenciasCriterio11" name="evidenciasCriterio11[]" id="evidenciasCriterio11'+claveData.clave+'" value="'+claveData.clave+'" onClick="contarEvidenciasCriterio11('+puntos+');"> ' + claveData.clave + '</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio11").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio11){
                                var array = getEvidenciasCriterio11.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio11:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio11"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio11").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio11.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio11"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio11').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio11').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio11(puntos){
        // Parte para contar la cantidad de evidencias a la que pertenece...
        var evidencias = [];
        $('input.evidenciasCriterio11:checked').each(function(){
            evidencias.push(this.value);
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio11').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
        // console.log(puntos);
        var totalPuntos = cantidad * puntos;
        $('#txtTotalCriterio11').val(totalPuntos);
    }

    function actualizarEvidenciasCriterio11(){
        var clave = $('#claveCriterio11').val();
        var year = $('#txtYearCriterio11').val();
        var cantidad = $('#txtCantidadCriterio11').val();
        var total = $('#txtTotalCriterio11').val();
        var evidenciasCriterio11 = [];
        var puntos = 0;
        var criterio = 11;
        var objetivo = 3;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/obtenerEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio11){
                var existe = searchEvidenciasCriterio11.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/puntosinvestigacion/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio11){
                        puntos = puntosCriterio11.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio11:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio11').val();
                        // console.log(cantidadEvidencias);
                        if(cantidadEvidencias == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else if(cantidadEvidencias > 4){
                            swal({
                                type: 'warning',
                                title: 'No puede seleccionar mas de 4 evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/savePuntos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidadEvidencias,
                                        total_puntos: total,
                                        year: year
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio11){
                                                var getPuntos = getEvidenciasCriterio11.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatosPuntos",
                                                    data: {
                                                        token: $('#txtTokenRepo').val(),
                                                        clave: clave,
                                                        id_criterio: criterio,
                                                        puntos: getPuntos.puntos,
                                                        total_puntos: getPuntos.total_puntos,
                                                        year: year
                                                    },
                                                    headers: {
                                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                                    },
                                                    success: function(data){
                                                        swal({
                                                            type: 'success',
                                                            text: 'Se han actualizado los puntos con exito',
                                                            showConfirmButton: false,
                                                            timer: 2000
                                                        }).catch(swal.noop);
                                                        $('#modalEvidenciasCriterio11').modal('hide');
                                                        verTablaCriterio11(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatos",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidad,
                                        total_puntos: total,
                                        year: year,
                                        id_criterio: criterio
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/getEvidenciasInvestigacion/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio11){
                                                var getPuntos = getEvidenciasCriterio11.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionGeneral/investigacion/updateDatosPuntos",
                                                    data: {
                                                        token: $('#txtTokenRepo').val(),
                                                        clave: clave,
                                                        id_criterio: criterio,
                                                        puntos: getPuntos.puntos,
                                                        total_puntos: getPuntos.total_puntos,
                                                        year: year
                                                    },
                                                    headers: {
                                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                                    },
                                                    success: function(data){
                                                        swal({
                                                            type: 'success',
                                                            text: 'Se han actualizado los puntos con exito',
                                                            showConfirmButton: false,
                                                            timer: 2000
                                                        }).catch(swal.noop);
                                                        $('#modalEvidenciasCriterio11').modal('hide');
                                                        verTablaCriterio11(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }
                        }
                    },
                });
            },
        });
    }
</script>
