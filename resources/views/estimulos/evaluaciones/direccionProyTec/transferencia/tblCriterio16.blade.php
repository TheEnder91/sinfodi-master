<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio16" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Registro de modelo de utilidades solicitado (Valor del punto: 80).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-transferencia-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionProyTec.transferencia.modalEvidenciasCriterio16')

<script>
    function obtenerCriterio16(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero16){
                var datosCriterio16 = datosCritero16.response;
                // console.log(datosCritero16);
                // Codigo para guardar en el sistema...
                if(datosCriterio16.length > 0){
                    for(var i = 0; i < datosCriterio16.length; i++){
                        var dataCriterio16 = datosCriterio16[i];
                        verTablaCriterio16(year, criterio);
                        // console.log(dataCriterio16);
                        // $.ajax({
                        //     type: 'POST',
                        //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/saveDatosTransferencia",
                        //     data: {
                        //         token: $('#txtTokenRepo').val(),
                        //         clave: dataCriterio16.numero_personal,
                        //         nombre: dataCriterio16.nombre,
                        //         id_objetivo: 5,
                        //         id_criterio: 16,
                        //         direccion: "DProyTec",
                        //         puntos: 0,
                        //         total_puntos: 0,
                        //         year: year,
                        //         username: dataCriterio16.username,
                        //     },
                        //     headers: {
                        //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                        //     },
                        //     success: function(data){
                        //         verTablaCriterio16(year, criterio);
                        //     }
                        // });
                    }
                }else{
                    verTablaCriterio16(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio16(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosProyectosCriterio16){
                // console.log(datosProyectosCriterio16);
                var datosProyectosCriterio16 = datosProyectosCriterio16.response;
                var row = "";
                for(var i = 0; i < datosProyectosCriterio16.length; i++){
                    var dataProyectosCriterio16 = datosProyectosCriterio16[i];
                    // console.log(dataProyectosCriterio16);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-proyectos-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataProyectosCriterio16.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataProyectosCriterio16.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataProyectosCriterio16.nombre + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataProyectosCriterio16.puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataProyectosCriterio16.total_puntos + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataProyectosCriterio16.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio16(' + dataProyectosCriterio16.year + ', ' + dataProyectosCriterio16.clave + ', ' + 16 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio16")) {
                    tblDifusionDivulgacion = $("#tblCriterio16").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio16 > tbody').html('');
                $('#tblCriterio16 > tbody').append(row);
                $('#tblCriterio16').DataTable({
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
                    lengthMenu: [[10, 16, 20, 50], [10, 16, 20, 50]]
                });
            },
        });
    }

    function verEvidenciasCriterio16(year, clave, criterio){
        var objetivo = 5;
        $('#txtCantidadCriterio16').val(0);
        $('#txtTotalCriterio16').val(0.00);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio16){
                // console.log(dataEvidenciasCriterio16); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio16').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio16){
                        puntos = puntosCriterio16.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio16').val(puntos);
                        var datos = dataEvidenciasCriterio16.response;
                        var row = "";
                        $('#claveCriterio16').val(clave);
                        $('#txtYearCriterio16').val(year);
                        // console.log(datos);
                        for(var i = 0; i < datos.length; i++){
                            var claveData = datos[i];
                            if(claveData.status == 1){
                                var tipo = "-R";
                            }else{
                                var tipo = "-O";
                            }
                            // console.log(claveData.clave);
                            row += '<div class="col-12 col-md-2 text-center">';
                            row += '<a href="http://126.107.2.56/SINFODI/Files/SINFODI-PropiedadIntelectual/' + claveData.clave + tipo + '.pdf" target="_blank">';
                            row += '<img src="{{ asset('img/pdf2.png') }}" width="60px" height="60px">';
                            row += '</a><br>';
                            row += '<b><input type="checkbox" class="evidenciasCriterio16" name="evidenciasCriterio16[]" id="evidenciasCriterio16'+claveData.clave+'" value="'+claveData.porcentaje / 100+'" onClick="contarEvidenciasCriterio16(this.checked, '+puntos+', this.value);"> ' + claveData.clave + tipo + ' -> ' + claveData.porcentaje + '%</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio16").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio16){
                                var array = getEvidenciasCriterio16.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio16:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio16"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio16").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio16.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio16"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio16').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio16').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio16(estaChequeado, puntos, porcentaje){
        // Variables...
        var contador = 0;
        puntos = parseInt(puntos);
        porcentaje = parseFloat(porcentaje);
        var sumaActual = 0;
        var puntosPorcen = puntos * porcentaje;
        var campo_resultado = document.getElementById('txtTotalCriterio16');
        // Revisamos errores...
        try {
            if (campo_resultado != null) {
                if (isNaN(campo_resultado.value)) {
                    campo_resultado.value = "0.00";
                }
                sumaActual = parseFloat(campo_resultado.value);
            }
        } catch (ex) {
            alert('No existe el campo de la suma.');
        }
        // Validamos si seleccionamos y
        if (estaChequeado == true) {
            sumaActual = parseFloat(sumaActual) + parseFloat(puntosPorcen);
        } else {
            sumaActual = parseFloat(sumaActual) - parseFloat(puntosPorcen);
        }
        // console.log(sumaActual);
        // console.log(estaChequeado + ' ' + porcentaje + ' '  + puntos + ' ' + puntosPorcen + ' ' + sumaActual);
        campo_resultado.value = parseFloat(sumaActual).toFixed(2);
        // Parte para contar la cantidad de evidencias seleccionadas...
        var evidencias = [];
        // var porcen = [];
        // var puntosPorcen = 0;
        // var totalPuntos = 0;
        $('input.evidenciasCriterio16:checked').each(function(){
             evidencias.push(this.value);
        //     porcen = porcentaje / 100;
        //     puntosPorcen = (puntos * porcen);
        //     totalPuntos += puntosPorcen;
        });
        var cantidad = evidencias.length;
        console.log(cantidad);
        $('#txtCantidadCriterio16').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
    }

    function actualizarEvidenciasCriterio16(){
        var clave = $('#claveCriterio16').val();
        var year = $('#txtYearCriterio16').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotalCriterio16').val();
        var evidenciasCriterio16 = [];
        var puntos = 0;
        var criterio = 16;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio16){
                var existe = searchEvidenciasCriterio16.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio16){
                        puntos = puntosCriterio16.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio16:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio16').val();
                        // console.log(cantidadEvidencias);
                        if(cantidadEvidencias == 0){
                            swal({
                                type: 'warning',
                                title: 'Favor de seleccionar las evidencias.',
                                showConfirmButton: false,
                                timer: 1800
                            }).catch(swal.noop);
                        }else{
                            if(existe == 0){
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio16){
                                                var getPuntos = getEvidenciasCriterio16.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio16').modal('hide');
                                                        verTablaCriterio16(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosTransferencia",
                                    data: {
                                        token: $('#txtTokenRepo').val(),
                                        clave: clave,
                                        evidencias: serieEvidencias,
                                        id_criterio: criterio,
                                        puntos: cantidadEvidencias,
                                        total_puntos: total,
                                        year: year,
                                        id_criterio: criterio
                                    },
                                    headers: {
                                        'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                                    },
                                    success: function(data){
                                        consultarDatos({
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio16){
                                                var getPuntos = getEvidenciasCriterio16.response[0];
                                                // console.log(getPuntos.puntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionProyTec/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio16').modal('hide');
                                                        verTablaCriterio16(year, criterio);
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
