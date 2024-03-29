<div class="table-responsive" width = "100%" id="table_refresh">
    <table id="tblCriterio15" class="table table-bordered table-striped" style="font-size:13px;">
        <caption style="font-size:13px;">Solicitud de patente (Valor del punto: 40).</caption>
        <thead>
            <tr class="text-center">
                <th scope="col" style="font-size:13px;">Clave</th>
                <th scope="col" style="font-size:13px;">Nombre</th>
                <th scope="col" style="font-size:13px;">Puntos</th>
                <th scope="col" style="font-size:13px;">Total</th>
                <th scope="col" style="font-size:13px;">Año</th>
                {{-- @if (Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-transferencia-index")) --}}
                    <th scope="col" style="font-size:13px;">Evidencias</th>
                {{-- @endif --}}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@include('estimulos.evaluaciones.direccionPosgrado.transferencia.modalEvidenciasCriterio15')

<script>
    function obtenerCriterio15(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/searchTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosCritero15){
                var datosCriterio15 = datosCritero15.response;
                // console.log(datosCritero15);
                // Codigo para guardar en el sistema...
                if(datosCriterio15.length > 0){
                    for(var i = 0; i < datosCriterio15.length; i++){
                        var dataCriterio15 = datosCriterio15[i];
                        verTablaCriterio15(year, criterio);
                        // console.log(dataCriterio15);
                        // $.ajax({
                        //     type: 'POST',
                        //     url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/saveDatosTransferencia",
                        //     data: {
                        //         token: $('#txtTokenRepo').val(),
                        //         clave: dataCriterio15.numero_personal,
                        //         nombre: dataCriterio15.nombre,
                        //         id_objetivo: 5,
                        //         id_criterio: 15,
                        //         direccion: "DPosgrado",
                        //         puntos: 0,
                        //         total_puntos: 0,
                        //         year: year,
                        //         username: dataCriterio15.username,
                        //     },
                        //     headers: {
                        //         'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
                        //     },
                        //     success: function(data){
                        //         verTablaCriterio15(year, criterio);
                        //     }
                        // });
                    }
                }else{
                    verTablaCriterio15(year, criterio);
                }
            },
        });
    }

    function verTablaCriterio15(year, criterio){
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/datosTransferencia/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(datosPosgradoCriterio15){
                // console.log(datosPosgradoCriterio15);
                var datosPosgradoCriterio15 = datosPosgradoCriterio15.response;
                var row = "";
                for(var i = 0; i < datosPosgradoCriterio15.length; i++){
                    var dataPosgradoCriterio15 = datosPosgradoCriterio15[i];
                    // console.log(dataPosgradoCriterio15);
                    var authUser = '<?= Auth::user()->usuario ?>';
                    var permissions = '<?= Auth::user()->hasPermissionTo("estimulo-evaluaciones-posgrado-transferencia-index") ?>';
                    // console.log(permissions);
                    if(dataPosgradoCriterio15.username == authUser || permissions == 1){
                        row += "<tr>";
                        row += '<th scope="row" class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio15.clave + '</td>';
                        row += '<td width="40%" style="font-size:12px;">' + dataPosgradoCriterio15.nombre.toUpperCase() + "</td>";
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio15.puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + parseInt(dataPosgradoCriterio15.total_puntos) + '</td>';
                        row += '<td class="text-center" width="10%" style="font-size:12px;">' + dataPosgradoCriterio15.year + '</td>';
                        // if(permissions == 1){
                            row += '<td class="text-center" width="10%" style="font-size:12px;"><a href="javascript:verEvidenciasCriterio15(' + dataPosgradoCriterio15.year + ', ' + dataPosgradoCriterio15.clave + ', ' + 15 +')"><i class="fa fa-edit"></i></a></td>';
                        // }
                        row += "</tr>";
                    }
                }
                if ($.fn.dataTable.isDataTable("#tblCriterio15")) {
                    tblDifusionDivulgacion = $("#tblCriterio15").DataTable();
                    tblDifusionDivulgacion.destroy();
                }
                $('#tblCriterio15 > tbody').html('');
                $('#tblCriterio15 > tbody').append(row);
                $('#tblCriterio15').DataTable({
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

    function verEvidenciasCriterio15(year, clave, criterio){
        var objetivo = 5;
        $('#txtCantidadCriterio15').val(0);
        $('#txtTotalCriterio15').val(0.00);
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/searchEvidenciasTransferencia/" + year + "/" + clave + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(dataEvidenciasCriterio15){
                // console.log(dataEvidenciasCriterio15); //Comentamos para futuras pruebas...
                $('#modalEvidenciasCriterio15').modal({backdrop: 'static', keyboard: false});
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio15){
                        puntos = puntosCriterio15.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        $('#txtValorCriterio15').val(puntos);
                        var datos = dataEvidenciasCriterio15.response;
                        var row = "";
                        $('#claveCriterio15').val(clave);
                        $('#txtYearCriterio15').val(year);
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
                            row += '<b><input type="checkbox" class="evidenciasCriterio15" name="evidenciasCriterio15[]" id="evidenciasCriterio15'+claveData.clave+'" value="'+claveData.porcentaje / 100+'" onClick="contarEvidenciasCriterio15(this.checked, '+puntos+', this.value);"> ' + claveData.clave + tipo + ' -> ' + claveData.porcentaje + '%</b>';
                            row += '</div>';
                        }
                        $("#contenedorCriterio15").html(row).fadeIn('slow');
                        consultarDatos({
                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                            type: 'GET',
                            dataType: 'json',
                            ok: function(getEvidenciasCriterio15){
                                var array = getEvidenciasCriterio15.response;
                                if(array.length > 0){
                                    var evidencias = [];
                                    var serieEvidencias = "";
                                    $('input.evidenciasCriterio15:checked').each(function(){
                                        evidencias.push(this.value);
                                    });
                                    let desmarcar = serieEvidencias.split(',');
                                    if(desmarcar != ""){
                                        for(var i = 0; i < desmarcar.length; i++){
                                            // console.log(desmarcar[i]);
                                            document.getElementById("evidenciasCriterio15"+desmarcar[i]).checked = false;
                                        }
                                    }
                                    $(".evidenciasCriterio15").prop("checked", this.checked);
                                    var dataEvidencias = getEvidenciasCriterio15.response[0];
                                    let str = dataEvidencias.evidencias;
                                    let arr = str.split(',');
                                    //dividir la cadena de texto por una coma
                                    // console.log(arr);
                                    for(var i = 0; i < arr.length; i++){
                                        // console.log(arr[i]);
                                        document.getElementById("evidenciasCriterio15"+arr[i]).checked = true;
                                    }
                                    $('#txtCantidadCriterio15').val(dataEvidencias.puntos);
                                    $('#txtTotalCriterio15').val(dataEvidencias.total_puntos);
                                }
                            },
                        });
                    },
                });
            },
        });
    }

    function contarEvidenciasCriterio15(estaChequeado, puntos, porcentaje){
        // Variables...
        var contador = 0;
        puntos = parseInt(puntos);
        porcentaje = parseFloat(porcentaje);
        var sumaActual = 0;
        var puntosPorcen = puntos * porcentaje;
        var campo_resultado = document.getElementById('txtTotalCriterio15');
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
        console.log(estaChequeado + ' ' + porcentaje + ' '  + puntos + ' ' + puntosPorcen + ' ' + sumaActual);
        campo_resultado.value = parseFloat(sumaActual).toFixed(2);
        // Parte para contar la cantidad de evidencias seleccionadas...
        var evidencias = [];
        // var porcen = [];
        // var puntosPorcen = 0;
        // var totalPuntos = 0;
        $('input.evidenciasCriterio15:checked').each(function(){
             evidencias.push(this.value);
        //     porcen = porcentaje / 100;
        //     puntosPorcen = (puntos * porcen);
        //     totalPuntos += puntosPorcen;
        });
        var cantidad = evidencias.length;
        $('#txtCantidadCriterio15').val(cantidad);
        //Parte para sacar el total de puntos dependiendo de los evidencias a los que pertenece...
    }

    function actualizarEvidenciasCriterio15(){
        var clave = $('#claveCriterio15').val();
        var year = $('#txtYearCriterio15').val();
        var cantidad = $('#txtCantidad').val();
        var total = $('#txtTotalCriterio15').val();
        var evidenciasCriterio15 = [];
        var puntos = 0;
        var criterio = 15;
        var objetivo = 5;
        consultarDatos({
            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/obtenerEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
            type: 'GET',
            dataType: 'json',
            ok: function(searchEvidenciasCriterio15){
                var existe = searchEvidenciasCriterio15.response;
                // console.log(existe);
                consultarDatos({
                    action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/puntosTransferencia/" + criterio + "/" + objetivo,
                    type: 'GET',
                    dataType: 'json',
                    ok: function(puntosCriterio15){
                        puntos = puntosCriterio15.response[0].puntos;
                        // console.log(puntos); // Comentamos para futuras pruebas...
                        var evidencias = [];
                        var serieEvidencias = "";
                        $('input.evidenciasCriterio15:checked').each(function(){
                            evidencias.push(this.value);
                        });
                        for(var i = 0; i < evidencias.length; i++){
                            var serieEvidencias = evidencias.join(',');
                        }
                        // console.log(serieEvidencias);
                        var cantidadEvidencias = $('#txtCantidadCriterio15').val();
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
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/savePuntos",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio15){
                                                var getPuntos = getEvidenciasCriterio15.response[0];
                                                // console.log(getPuntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio15').modal('hide');
                                                        verTablaCriterio15(year, criterio);
                                                    }
                                                });
                                            },
                                        });
                                    }
                                });
                            }else{
                                $.ajax({
                                    type: 'PUT',
                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosTransferencia",
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
                                            action: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/getEvidenciasTransferencia/" + clave + "/" + year + "/" + criterio,
                                            type: 'GET',
                                            dataType: 'json',
                                            ok: function(getEvidenciasCriterio15){
                                                var getPuntos = getEvidenciasCriterio15.response[0];
                                                // console.log(getPuntos.puntos);
                                                $.ajax({
                                                    type: 'PUT',
                                                    url: "{{ config('app.url') }}/estimulos/evaluaciones/DireccionPosgrado/transferencia/updateDatosPuntos",
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
                                                        $('#modalEvidenciasCriterio15').modal('hide');
                                                        verTablaCriterio15(year, criterio);
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
