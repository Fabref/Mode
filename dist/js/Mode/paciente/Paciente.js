/******************************************************************************/
/******************************* DEPORTES *************************************/
/******************************************************************************/


/**
 * Funcion que se ejecuta en la carga inicial de los js
 */
$().ready(function() {
    $('.pasar').click(function() {
        var option = $('#origen option:selected').sort().clone();
        var existe = false;
        
        $('#destino option').each(function() {
            if($(this).val() === option.val()) {
                existe = true;
            }
        });
        
        if( ! existe) {
            $('#destino').append(option);
        }
    });
    $('.quitar').click(function() {
        $('#destino option:selected').remove();
    });
    $('.quitartodos').click(function() {
        $('#destino').empty();
    });
    $('.submit').click(function() {
        $('#destino option').prop('selected', 'selected');
    });

});


/**
 * Funcion que muestra el modal para seleccionar los deportes del paciente
 */
function showModalSeleccionDeportes() {
    $('#modalSeleccionDeportes').modal('show');
}


/**
 * Funcion que detecta el cambio de item en la opcion "realiza algun deporte".
 * Si la nueva opcion elegida es 'SI', se mostrará el modal con los deportes a elegir.
 * Si la nueva opcion elegida es 'NO', se eliminarán los deportes que tuviera anteriormente
 *  en el textArea y se ocultara el boton para añadir deportes.
 * Tras estas acciones se invocará el submit xa que se almacenen los cambios en los deportes
 *  del paciete.
 *  
 * @param {type} selectedItem con la opcion elegida
 */
function onChangeSelectRealizaDeporte(selectedItem) {
    var realizaDeporte = selectedItem.value;
    if(realizaDeporte === "1"){
        $('#modalSeleccionDeportes').modal('show');
    } else {
        $('#btn-añadirDeporte').hide();
        $('#deportesPaciente').empty();
        $('#deportesPacienteShowed').empty();
    }
}


/**
 * Funcion que detecta el cambio de item en la opcion 'mutualista/asegurado'
 * Si la nueva opcion es 'SI', se habilitara el input del nombre de la mutua
 * Si la nueva opcion es 'NO', se borra el nombre de la mutua y se deshabilita 
 * el input.
 * @param {type} selectedItem
 * @returns {undefined}
 */
function onChangeSelectMutualista(selectedItem) {
    var esMutualista = selectedItem.value;
    if(esMutualista === "1"){
        $("#mutuaUser").prop('disabled', false);
    } else {
        $("#mutuaUser").val('');
        $("#div-nombre-mutua").removeClass("has-error");
        $("#span-error-nombre-mutua").remove();
        $("#mutuaUser").prop('disabled', true);
    }
}


/**
 * Funcion que se ejecuta al seleccionar los deportes del paciente. 
 * Obtiene los deportes seleccionados y los introduce en el campo deportes del formulario.
 * Ademas, muestra el boton "Añadir deporte..." o, en caso de que no haya sido 
 * creado porque el paciente tenia la opcion "realiza algun deportes" a 'NO', lo
 * crea.
 * 
 * En caso de que no hayan deportes seleccionados, oculta el boton para añadir deportes, 
 * cambia "realiza deporte" a 'NO' y borra los deportes que tuviera seleccionados 
 * anteriormente.
 * 
 * @param {type} nombreBtn el nombre mostrado en el boton segun el idioma del usuario
 */
function seleccionarDeportesPaciente(nombreBtn) {
    var hayDeportesSeleccionados = $('#destino option').size() > 0;

    if(hayDeportesSeleccionados) {
        $('#deportesPaciente').empty();
        $('#deportesPacienteShowed').empty();

        $('#destino option').each(function() {
                        
            $('#deportesPaciente').append($('<option>', { 
                value: $(this).val(),
                text: $(this).text(), selected: true
            }));
            $('#deportesPacienteShowed').append($('<option>', { 
                value: $(this).val(),
                text: $(this).text(), selected: true
            }));
        });

        if($('#btn-añadirDeporte').length > 0) {
            $('#btn-añadirDeporte').show();
        } else {
            $("#wrapper").append("<br><button type=\"button\" id=\"btn-añadirDeporte\" class=\"btn btn-success\" onclick=\"showModalSeleccionDeportes()\">" + nombreBtn + "</button>");
        }
        $('#modalSeleccionDeportes').modal('hide');
    } else {
        $('#btn-añadirDeporte').hide();
        $('#deportesPaciente').empty();
        $('#deportesPacienteShowed').empty();
        $('#deporte').val("0"); 
        $('#modalSeleccionDeportes').modal('hide');
    }
}


/**
 * Si el usuario cancela la accion de seleccionar un deporte, la opcion "realiza algun deporte"
 * esta a 'SI' y el paciente no tiene ningun deporte actual la pone a 'NO'
 */
function cancelarRealizaDeporte() {
    var realizaDeporte = $('#deporte').val();
    var hayDeportesPaciente = $('#deportesPaciente option').size() > 0;

    if(realizaDeporte === "1" && ( ! hayDeportesPaciente)) {
       $('#deporte').val("0"); 
    }
}


/**
 * Si cierra el modal sin elegir ningun deporte, se pone la opcion 'realiza deporte'
 * a 'No'.
 */
$('#modalSeleccionDeportes').on('hidden.bs.modal', function () {
    cancelarRealizaDeporte();
});


/******************************************************************************/
/************************** REASIGNAR PACIENTES *******************************/
/******************************************************************************/


/**
 * Evento para seleccionar o deseleccionar un paciente concreto y actualizar el
 * numero de pacientes seleccionados.
 */
$('.checkboxPacienteReasignarPaciente').on('ifChecked ifUnchecked', function(event){
    var numberChecked = $('.checkboxPacienteReasignarPaciente:checkbox:checked').length;
    if (numberChecked === 1) {
        $('#numeroPacientesSeleccionados').text(numberChecked + " " + Globals.seleccionado);
    } else {
        $('#numeroPacientesSeleccionados').text(numberChecked + " " + Globals.seleccionados);
    }
});


/**
 * Evento para seleccionar o deseleccionar todos los pacientes. Selecciona o deselecciona
 * todos los checkbox y actualiza el numero de pacientes seleccionados.
 */
$('#seleccionarTodosPacientes').on('ifChecked ifUnchecked', function(event){

    if(event.type === 'ifChecked') {
        $('.checkboxPacienteReasignarPaciente').prop("checked", true);
        $('.checkboxPacienteReasignarPaciente').iCheck('update');
    } else {
        $('.checkboxPacienteReasignarPaciente').prop("checked", false);
        $('.checkboxPacienteReasignarPaciente').iCheck('update');
    }
    
    var numberChecked = $('.checkboxPacienteReasignarPaciente:checkbox:checked').length;
    if (numberChecked === 1) {
        $('#numeroPacientesSeleccionados').text(numberChecked + " " + Globals.seleccionado);
    } else {
        $('#numeroPacientesSeleccionados').text(numberChecked + " " + Globals.seleccionados);
    }
});


 
/* Para saber que fisio habia previamente seleccionado y poner sus datos si se 
 * selecciona un fisio sin pacientes */
var idUltimoFisioFiltro = 'NON';

/* 
 * Filtra los pacientes por el fisio seleccionado de la tabla para reasignarlos 
 * a un nuevo fisio.
 */
$("#listaFisiosFiltroPacientes").change(function() {
    var idFisio = $("#listaFisiosFiltroPacientes option:selected").val();
//    alert(idFisio);
    
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    /* Se obtienen los pacientes asociadas al fisio seleccionado */ 
    if(idFisio !== "NON") {
        $.ajax({
            url: base_url + 'index.php/Paciente/index/gpabf',
            method: 'POST', 
            data: {'idFisio': idFisio},
            success: function(htmlPacientesFisio) {
//                alert(htmlPacientesFisio);
                
                /* Comprueba si el fisio tiene pacientes activos o no
                 * Si los tiene los muestra, si no muestra un modal indicandolo */
                if (htmlPacientesFisio.includes('checkboxPacienteReasignarPaciente')) {
                    /* Elimina e calendario anterior para poner el nuevo con los nuevos eventos */
                    $('#bodyTablaPacientesReasignarPacientes').replaceWith(htmlPacientesFisio);
            
                    reinicializarInputICheck();

                    var numeroPacientesFisio = $('.checkboxPacienteReasignarPaciente:checkbox').length;

                    /* Segun el numero de pacientes, oculta o no el div con los saltos de linea anteriores
                     * a los botones (solo a efectos de formato visual) */
                    if (numeroPacientesFisio > 6) {
                        if ($("#divSaltoLineaMuchosPacientes").hasClass("hidden")) {
                            $("#divSaltoLineaMuchosPacientes").removeClass("hidden");
                        }

                    } else {
                        if ( ! $("#divSaltoLineaMuchosPacientes").hasClass("hidden")) {
                            $("#divSaltoLineaMuchosPacientes").addClass("hidden");
                        }
                    }

                    if ($("#filtroFisios").hasClass("hidden")) {
                        $("#filtroFisios").removeClass("hidden");
                    }
                    
                    $('#seleccionarTodosPacientes').prop('checked', false);
                    $('#seleccionarTodosPacientes').iCheck('update');
                    
                    $('#numeroPacientesSeleccionados').text("0 " + Globals.seleccionados);
                    
                    idUltimoFisioFiltro = idFisio;
                    
                } else {
                    $('#modalFisioSinPacientesActivos').modal('show');
                    
                }
                
            }
        });
        
    } else {
        idUltimoFisioFiltro = idFisio;
    }
    
});


/**
 * Gestiona la eliminacion del filtro del cambio de pacientes de fiiso y vuelve 
 * a mostrar todos los pacientes del centro.
 */
function eliminarFiltroCambiarPacientesFisio() {
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    $.ajax({
        url: base_url + 'index.php/Paciente/index/gpabc',
        method: 'POST', 
        success: function(htmlPacientesCentro) {
//            alert(htmlPacientesCentro);
            /* Elimina e calendario anterior para poner el nuevo con los nuevos eventos */
            $('#bodyTablaPacientesReasignarPacientes').replaceWith(htmlPacientesCentro);

            var numeroPacientesFisio = $('.checkboxPacienteReasignarPaciente:checkbox').length;

            /* Segun el numero de pacientes, oculta o no el div con los saltos de linea anteriores
             * a los botones (solo a efectos de formato visual) */
            if (numeroPacientesFisio > 6) {
                if ($("#divSaltoLineaMuchosPacientes").hasClass("hidden")) {
                    $("#divSaltoLineaMuchosPacientes").removeClass("hidden");
                }

            } else {
                if ( ! $("#divSaltoLineaMuchosPacientes").hasClass("hidden")) {
                    $("#divSaltoLineaMuchosPacientes").addClass("hidden");
                }
            }

            if ( ! $("#filtroFisios").hasClass("hidden")) {
                $("#filtroFisios").addClass("hidden");
            }
            
            $('#listaFisiosFiltroPacientes').val('NON').trigger('change');
            idUltimoFisioFiltro = 'NON';
            
            $('#seleccionarTodosPacientes').prop('checked', false);
            $('#seleccionarTodosPacientes').iCheck('update');
                    
            $('#numeroPacientesSeleccionados').text("0 " + Globals.seleccionados);
            reinicializarInputICheck();
        }
    });
}


/**
 * Si cierra el modal 'fisio sin pacientes activos' sin dar a aceptar, se pone la
 * ejecuta la opcion igual que si pulsara aceptar
 */
$('#modalFisioSinPacientesActivos').on('hidden.bs.modal', function () {
    restaurarPacientesAnteriorFisio();
});


/**
 * Reinicializa los css de los input iCheck tras la actualizacion de pacientes
 * debido al filtrado de fisios, ya que si no no se carga el css sobre los input.
 * Ademas se tiene que recargar el js xq si no no funcionan los eventos de los
 * inputs.
 */
function reinicializarInputICheck() {
    $('.inputiCheck').iCheck({
        checkboxClass: 'icheckbox_flat-green',
    });
    
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    /* Recarga el fichero Paciente.js con un timestamp en la url para evitar problemas de cache */
    var head= document.getElementsByTagName('head')[0];
    var script= document.createElement('script');
    script.type= 'text/javascript';
    script.src= base_url + '/dist/js/kineActivCentro/paciente/Paciente.js?cachebuster=' + new Date().getTime();
    head.appendChild(script);
}


/**
 * Restaura el filtro de fisios al ultimo despues de seleccionar un fisio sin
 * pacientes activos. Esto propaga el evento onchange del select para obtener 
 * la info de los pacientes del fisio
 */
function restaurarPacientesAnteriorFisio() {
    $('#listaFisiosFiltroPacientes').val(idUltimoFisioFiltro).trigger('change');
}


/**
 * Evento para seleccionar o deseleccionar un fisio concreto y actualizar el
 * numero de fisios seleccionados.
 */
$('.checkboxFisiosReasignarPacientes').on('ifChecked ifUnchecked', function(event){
    var numberChecked = $('.checkboxFisiosReasignarPacientes:checkbox:checked').length;
    if (numberChecked === 1) {
        $('#numeroFisiosSeleccionados').text(numberChecked + " " + Globals.seleccionado);
    } else {
        $('#numeroFisiosSeleccionados').text(numberChecked + " " + Globals.seleccionados);
    }
});


/**
 * Evento para seleccionar o deseleccionar todos los pacientes. Selecciona o deselecciona
 * todos los checkbox y actualiza el numero de pacientes seleccionados.
 */
$('#seleccionarTodosFisios').on('ifChecked ifUnchecked', function(event){

    if(event.type === 'ifChecked') {
        $('.checkboxFisiosReasignarPacientes').prop("checked", true);
        $('.checkboxFisiosReasignarPacientes').iCheck('update');
    } else {
        $('.checkboxFisiosReasignarPacientes').prop("checked", false);
        $('.checkboxFisiosReasignarPacientes').iCheck('update');
    }
    
    var numberChecked = $('.checkboxFisiosReasignarPacientes:checkbox:checked').length;
    if (numberChecked === 1) {
        $('#numeroFisiosSeleccionados').text(numberChecked + " " + Globals.seleccionado);
    } else {
        $('#numeroFisiosSeleccionados').text(numberChecked + " " + Globals.seleccionados);
    }
});

