let token_fondos = "";

/**
 * Notifica un Validacion,Warn,Info,Err en un contenedor
 * @param {int} Tipo notificacion, constantes
 * @param {string} id del contenedor
 * @param {string} mensaje a mostrar
 * @param {bool} colocar cursor en mensaje
 * @return {}
 */

function notificaMensaje(options, mensaje) {
    var claseTipoNotificacion = "alert-success";
    switch(options.tipoMensaje) {
        case 1:
            claseTipoNotificacion = "alert-danger";
            break;
        case 2:
            claseTipoNotificacion = "alert-warning";
            break;
        case 3:
            claseTipoNotificacion = "alert-info";
            break;
        case 4:
            claseTipoNotificacion = "alert-success";
            break;
    }
    var stringButton = "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";

    if (options.contenedorMensajes && mensaje) {
        var idNotificacion = 'notificacion-general' + Math.floor(Math.random() * (100 - 1)) + 1;
        $("#" + options.contenedorMensajes).html("<div id='" + idNotificacion + "' class='alert alert-dismissible " + claseTipoNotificacion + "'>" + stringButton + "<p style='word-break: break-word;'>" + mensaje + "</p></div>");
        var top = ($("#" + idNotificacion).offset() || { "top": NaN }).top;
        if (isNaN(top)) {
            console.warn("No se encuentra el elemento de mensajes");
            return;
        }
        if (options.idModal) {
            $("#" + options.idModal).animate({
                scrollTop: 0
            }, 500);
        } else {
            //Scroll 0 para gastos
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        }
        //window.scrollTo(0, 0);
    }
}

function confirmacion(options) {
    var defaults = {
        labelAccept: "Aceptar",
        labelCancel: "Cancelar",
        title : "Titulo..."
    };
    options = $.extend({}, defaults, options);

    var modal = '<div id="dialog-confirm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">' +
        '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
                '<div class="modal-header">' +
                    '<h5 class="modal-title" id="idModalCancelarVisitaLabel">' + options.title + '</h5>' +
                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute;top:5px;right:5px;color: white;">' +
                        '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                '</div>' +
                '<div class="modal-body">' + options.message + '</div>' +
                '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="' + options.okFunction + '()">' + options.labelAccept + '</button>' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal"> ' + options.labelCancel + '</button>' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</div>';

    $("#dialog-confirm").remove();
    $("body").append(modal);
    $('#dialog-confirm').modal('show');
}

function validarCamposRequeridos(){
	var success = true;
	var longitud = arguments.length;
	for (var i = 0; i < longitud; i++) {
		var campoEvaluar = document.getElementById(arguments[i]);

		if (!campoEvaluar) {
			console.warn("No se encuentra el elemento " + arguments[i]);
			continue;
		}

		var elementoMensaje = $(campoEvaluar).next();
		var labelSpan = $("label[for='" + arguments[i] + "'] span");

		//Reseteamos campo
		$(campoEvaluar).removeClass("form-control-error");
		//Reseteamos labelSpan
		if (labelSpan) {
			$(labelSpan).removeClass("form-text-error");
		} else {
			console.warn("No existe label para el campo " + campoEvaluar.id);
		}
		if (elementoMensaje.length > 0 && elementoMensaje[0].tagName.toUpperCase() == "SMALL" &&
			$(elementoMensaje[0]).hasClass("tooltip")) {
			elementoMensaje = $(elementoMensaje).next();
		}
		//Resetear mensaje
		if (elementoMensaje.length > 0 && elementoMensaje[0].tagName.toUpperCase() == "SMALL" &&
			$(elementoMensaje[0]).hasClass("form-text")) {

			$(elementoMensaje[0]).hide();
		} else {
			$(campoEvaluar).after("<small class='form-text'></small>");
			elementoMensaje = $(campoEvaluar).next().text('Este campo es requerido').addClass("form-text-error").hide();
		}

		var valorValidar = campoEvaluar.value;


		if (!valorValidar.trim()) {
			if (!labelSpan) {
				console.warn("No se encuentra label for " + arguments[i]);
			} else {
				$(labelSpan).addClass("form-text-error");
			}
			$(campoEvaluar).addClass("form-control-error");
			$(elementoMensaje).show();
			success = false;
		}
	}
	return success;
}

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
        contenedorMensajes: "",
        tipoMensaje: 4,
        idModal: null,
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
    console.log("Peticion a -->", ruta);
    console.log(options.data);
    console.log(options.url);

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
            swal({
                position: 'top-end',
                type: 'success',
                title: 'Se agrego correctamente el registro',
                showConfirmButton: false,
                timer: 4000
            })
            setTimeout(function(){
                window.location.href = options.url;
            }, 3000);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showLoading();
            options.fail(jqXHR, textStatus, errorThrown);
        },
        beforeSend: function(){
            showLoading(true);
        },
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

function procesarResponse(data, options) {
    if (options.contenedorMensajes) {
        if ($("#" + options.contenedorMensajes)) {
            $("#" + options.contenedorMensajes).html("");
        }
    }
    if(!data){
        console.error('No existe el objeto data');
        return;
    }
    if(!options.dataType){
        data= JSON.parse(data);
    }
    if(!data.isOk && data.mensaje){
        //Error
        options.tipoMensaje = 1;
        notificaMensaje(options, data.mensaje);
        options.err(data);
        return;
    }
    if(data.isOk){
        if(data.showMessage){
            notificaMensaje(options, data.mensaje);
        }
        options.ok(data);
        return;
    }
}

var zero = {
    validarCamposRequeridos: function () {
        var success = true;
        var longitud = arguments.length;
        for (var i = 0; i < longitud; i++) {
            var campoEvaluar = document.getElementById(arguments[i]);

            if (!campoEvaluar) {
                console.warn("No se encuentra el elemento " + arguments[i]);
                continue;
            }

            var elementoMensaje = $(campoEvaluar).next();
            var labelSpan = $("label[for='" + arguments[i] + "'] span");

            //Reseteamos campo
            $(campoEvaluar).removeClass("form-control-error");
            //Reseteamos labelSpan
            if (labelSpan) {
                $(labelSpan).removeClass("form-text-error");
            } else {
                console.warn("No existe label para el campo " + campoEvaluar.id);
            }
            if (elementoMensaje.length > 0 && elementoMensaje[0].tagName.toUpperCase() == "SMALL" &&
                $(elementoMensaje[0]).hasClass("tooltip")) {
                elementoMensaje = $(elementoMensaje).next();
            }
            //Resetear mensaje
            if (elementoMensaje.length > 0 && elementoMensaje[0].tagName.toUpperCase() == "SMALL" &&
                $(elementoMensaje[0]).hasClass("form-text")) {

                $(elementoMensaje[0]).hide();
            } else {
                $(campoEvaluar).after("<small class='form-text'></small>");
                elementoMensaje = $(campoEvaluar).next().text('Este campo es requerido').addClass("form-text-error").hide();
            }

            var valorValidar = campoEvaluar.value;


            if (!valorValidar.trim()) {
                if (!labelSpan) {
                    console.warn("No se encuentra label for " + arguments[i]);
                } else {
                    $(labelSpan).addClass("form-text-error");
                }
                $(campoEvaluar).addClass("form-control-error");
                $(elementoMensaje).show();
                success = false;
            }
        }
        return success;
    },
    correoValido: function(correo) {
        var patron = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{1,18})$/;
        return patron.test(correo);
    },
    convertirMayus: function () {
        var longitud = arguments.length;
        for (var i = 0; i < longitud; i++) {
            var campoEvaluar = document.getElementById(arguments[i]);
            $(campoEvaluar).on("blur", function () {
                $(this).val($(this).val().toUpperCase());
            });
            $(campoEvaluar).css("text-transform", "uppercase");
        }
    },
    validarCaracteres: function (expresion, event) {
        if (event.type === "keypress") {
            var tecla = (document.all) ? event.keyCode : event.which;
            if (tecla === 8) {
                return true;
            };
            var result = String.fromCharCode(tecla);
            event.returnValue = expresion.test(result);
            return expresion.test(result);
        } else if (event.type === "blur") {
            var elemento = document.getElementById(event.target.id);
            if (!expresion.test(elemento.value)) {
                var cadena = elemento.value;
                var nuevaCadena = "";
                for (var i = 0; i < cadena.length; i++) {
                    if (expresion.test(cadena.charAt(i))) {
                        nuevaCadena += cadena.charAt(i);
                    }
                }
                elemento.value = nuevaCadena;
            }
        }
    },
    colocarSoloNumeros: function () {
        var i;
        for (i = 0; i < arguments.length; i++) {
            $("#" + arguments[i]).on("keypress", function (event) {
                return zero.validarCaracteres(/^([0-9])*$/, event);
            }).on("blur", function () {
                var expresionNum = /^([0-9])*$/;
                if (!expresionNum.test(this.value)) {
                    var expresionReplace = /[^0-9]/g;
                    this.value = this.value.replace(expresionReplace, "");
                }
            });
        }
    },
    generarId: function (){
        var date = new Date();
        var components = [
            date.getYear(),
            date.getMonth(),
            date.getDate(),
            date.getHours(),
            date.getMinutes(),
            date.getSeconds(),
            date.getMilliseconds()
        ];

        var id = components.join("-");
        console.log(id);
        return id;
    },
    joinDate: function(date, options, separator) {
        function format(m) {
           let f = new Intl.DateTimeFormat('es', m);
           return f.format(date);
        }
        return options.map(format).join(separator);
     }
}
