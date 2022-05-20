let token_fondos = "";

/**
 * Notifica un Validacion,Warn,Info,Err en un contenedor
 * @param {int} Tipo notificacion, constantes
 * @param {string} id del contenedor
 * @param {string} mensaje a mostrar
 * @param {bool} colocar cursor en mensaje
 * @return {}
 */

function peticionGeneralAjax(options){
    var defaults = {
        fail: resultError,
        err: function(){},
        req: null,
        params: null,
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        data: null,
        type: 'POST',
        async: true,
        ok: function(){},
        headers: {
            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
        }
    };

    options = $.extend({}, defaults, options);
    if (options.dataType === 'json') {
        options.data = JSON.stringify(options.json);
    } else {
        options.data = options.json;
    }
    if(options.formData){
        options.data = options.json;
    }

    var ruta = options.action;

    // console.log(options.data);

    $.ajax({
        url: ruta,
        type: options.type,
        data: options.data,
        dataType: options.dataType,
        async: options.async,
        processData: false,
        contentType: options.contentType,
        headers: options.headers,
        success: function (data) {
            if(data){
                swal({
                    type: 'success',
                    text: options.mensajeConfirm,
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop)
                setTimeout(function(){
                    window.location.href = options.url;
                }, 1500);
            }else{
                alert('error');
            }
        },
        error: function (data) {
            swal({
                type: 'error',
                title: 'Hubo un error, intentelo de nuevo o envie un ticket a soporte.',
                showConfirmButton: true,
            });
        },
    });
}

function guardarMensaje(options){
    var defaults = {
        fail: resultError,
        err: function(){},
        req: null,
        params: null,
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        data: null,
        type: 'POST',
        async: true,
        ok: function(){},
        headers: {
            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
        }
    };

    options = $.extend({}, defaults, options);
    if (options.dataType === 'json') {
        options.data = JSON.stringify(options.json);
    } else {
        options.data = options.json;
    }
    if(options.formData){
        options.data = options.json;
    }

    var ruta = options.action;

    // console.log(options.data);

    $.ajax({
        url: ruta,
        type: options.type,
        data: options.data,
        dataType: options.dataType,
        async: options.async,
        processData: false,
        contentType: options.contentType,
        headers: options.headers,
        success: function (data) {
            if(data){
                swal({
                    type: 'success',
                    title: options.mensajeConfirm,
                    showConfirmButton: false,
                    timer: 1800
                }).catch(swal.noop);
            }else{
                alert('error');
            }
        },
        error: function (data) {
            swal({
                type: 'error',
                title: 'Hubo un error, intentelo de nuevo o envie un ticket a soporte.',
                showConfirmButton: true,
            });
        },
    });
}

function guardarAutomatico(options){
    var defaults = {
        fail: resultError,
        err: function(){},
        req: null,
        params: null,
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        data: null,
        type: 'POST',
        async: true,
        ok: function(){},
        headers: {
            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
        }
    };

    options = $.extend({}, defaults, options);
    if (options.dataType === 'json') {
        options.data = JSON.stringify(options.json);
    } else {
        options.data = options.json;
    }
    if(options.formData){
        options.data = options.json;
    }

    var ruta = options.action;

    // console.log(options.data);

    $.ajax({
        url: ruta,
        type: options.type,
        data: options.data,
        dataType: options.dataType,
        async: options.async,
        processData: false,
        contentType: options.contentType,
        headers: options.headers,
        success: function (data) {
            console.log("Exito");
        },
    });
}

function consultarDatos(options){
    var defaults = {
        ok: function(){},
        headers: {
            'token' : $('#txtTokenRepo').val() ? $('#txtTokenRepo').val(): ''
        }
    };

    options = $.extend({}, defaults, options);
    if (options.dataType === 'json') {
        options.data = JSON.stringify(options.json);
    } else {
        options.data = options.json;
    }
    if(options.formData){
        options.data = options.json;
    }

    var ruta = options.action;

    $.ajax({
        url: ruta,
        type: options.type,
        data: options.data,
        dataType: options.dataType,
        async: options.async,
        processData: false,
        contentType: options.contentType,
        headers: options.headers,
        success: function (data) {
            options.ok(data);
        }
    });
}

function showLoading(loading){

    if(loading && $('.loading-default').length){
        $('.btn.btn-primary').hide();
        $('.loading-default')
        .clone()
        .removeClass('loading-default')
        .addClass('loading-temp')
        .insertAfter(".btn.btn-primary")
        .show();
    }else{
        $('.btn.btn-primary').show();
        $('.loading-temp').remove();
    }
}

function resultError(jqXHR, textStatus, errorThrown){
    console.log("Error ajax ----");
    if (jqXHR.status === 0) {
        console.error('Not connect: Verify Network.');
    } else if (jqXHR.status == 404) {
        console.error('Requested page not found [404]');
    } else if (jqXHR.status == 500) {
        console.error('Internal Server Error [500].');
    } else if (textStatus === 'parsererror') {
        console.error('Requested JSON parse failed.');
    } else if (textStatus === 'timeout') {
        console.error('Time out error.');
    } else if (textStatus === 'abort') {
        console.error('Ajax request aborted.');
    } else {
        console.error('Uncaught Error: ' + jqXHR.responseText);
    }
}

function setTokenUtils(newToken){
    token_fondos = newToken;
}

function getTokenUtils(){
    return token_fondos;
}

function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode;
    return ((key >= 48 && key <= 57) || (key==8) || (key==46));
}
