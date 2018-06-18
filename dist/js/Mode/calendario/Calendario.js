///* Variable global para coger el id de la sesion para modificar el horario */
//var idSesionSeleccionadaConEvento;




/**
 * Funcion que se ejecuta en la carga inicial de los js
 */
$().ready(function() {
    
    /* 
     * Inicializa el calendario de las sesiones que tiene el centro
     */ 
    var hoy = new Date();
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    $('#calendarioGeneral').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',
        allDaySlot: false,
        scrollTime: '08:00:00',
        slotDuration: '00:30:00',
        slotLabelInterval: '00:30:00', 
        defaultDate: hoy,
        selectable: true,
        selectHelper: true,
        timeFormat: 'H(:mm)',
        eventLimit: true,
        fixedWeekCount: false,
        events: base_url + 'index.php/Calendario/index/gsbc',

        eventClick: function(event, jsEvent, view) {
            var descripcionEventoSeleccionado = event.description;
            $('#descripcion_sesion_calendario_general').html(descripcionEventoSeleccionado);
            
            /* Se suma 11 xq es la longitud de 'idSesion_1' */
            var indiceInicioIdSesion = descripcionEventoSeleccionado.indexOf("idSesion_") + 9;
            var indiceFinIdSesion = descripcionEventoSeleccionado.indexOf("_idSesion");

            idSesionSeleccionadaConEvento = descripcionEventoSeleccionado.substring(indiceInicioIdSesion, indiceFinIdSesion);
//            alert(idSesionSeleccionadaConEvento);
            $('#modalInfoSesionCalendario').modal('show');
        }
    });

});


$( ".selectListaFisiosCalendario" ).change(function() {
    var idFisioSeleccionado = $(".selectListaFisiosCalendario option:selected").val();

    if(idFisioSeleccionado !== "NON") {
    
        var hoy = new Date();
        var url = window.location.href;
        var base_url = url.substr(0, url.indexOf("index"));

        $.ajax({
            url: base_url + 'index.php/Calendario/index/gscff',
            method: 'POST', 
            data: {'idFisio': idFisioSeleccionado},
            success: function(eventos) {
    //            alert(eventos);
                $("#filtroFisios").removeClass("hidden");


                var eventosArray = $.parseJSON(eventos);
                
                /* Elimina e calendario anterior para poner el nuevo con los nuevos eventos */
                $('#calendarioGeneral').replaceWith('<div id="calendarioGeneral"></div>');

                $('#calendarioGeneral').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultView: 'month',
                    allDaySlot: false,
                    scrollTime: '08:00:00',
                    slotDuration: '00:30:00',
                    slotLabelInterval: '00:30:00', 
                    defaultDate: hoy,
                    selectable: true,
                    selectHelper: true,
                    timeFormat: 'H(:mm)',
                    eventLimit: true,
                    fixedWeekCount: false,
                    events: eventosArray,

                    eventClick: function(event, jsEvent, view) {
                        var descripcionEventoSeleccionado = event.description;
                        $('#descripcion_sesion_calendario_general').html(descripcionEventoSeleccionado);

                        /* Se suma 11 xq es la longitud de 'idSesion_1' */
                        var indiceInicioIdSesion = descripcionEventoSeleccionado.indexOf("idSesion_") + 9;
                        var indiceFinIdSesion = descripcionEventoSeleccionado.indexOf("_idSesion");

                        idSesionSeleccionadaConEvento = descripcionEventoSeleccionado.substring(indiceInicioIdSesion, indiceFinIdSesion);
//                        alert(idSesionSeleccionadaConEvento);
                        
                        $('#modalInfoSesionCalendario').modal('show');
                    }

                });

                eventosArray = null;

            }
        });
    }
});


/**
 * Gestiona la eliminacion del filtro del calendario y vuelve a mostrar todas las
 * sesiones del centro.
 */
function eliminarFiltroCalendario() {
    var hoy = new Date();
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));
    
    $.ajax({
        url: base_url + 'index.php/Calendario/index/gsbc',
        method: 'POST', 
        success: function(eventos) {
//            alert(eventos);
            $("#filtroFisios").addClass("hidden");
            
            /* Resetea el campo de los fisios */
            $('.selectListaFisiosCalendario').val('NON').trigger('change');

            var eventosArray = $.parseJSON(eventos);
            
            /* Elimina e calendario anterior para poner el nuevo con los nuevos eventos */
            $('#calendarioGeneral').replaceWith('<div id="calendarioGeneral"></div>');

            $('#calendarioGeneral').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                allDaySlot: false,
                scrollTime: '08:00:00',
                slotDuration: '00:30:00',
                slotLabelInterval: '00:30:00', 
                defaultDate: hoy,
                selectable: true,
                selectHelper: true,
                timeFormat: 'H(:mm)',
                eventLimit: true,
                fixedWeekCount: false,
                events: eventosArray,

                eventClick: function(event, jsEvent, view) {
                    var descripcionEventoSeleccionado = event.description;
                    $('#descripcion_sesion_calendario_general').html(descripcionEventoSeleccionado);

                    /* Se suma 11 xq es la longitud de 'idSesion_1' */
                    var indiceInicioIdSesion = descripcionEventoSeleccionado.indexOf("idSesion_") + 9;
                    var indiceFinIdSesion = descripcionEventoSeleccionado.indexOf("_idSesion");

                    idSesionSeleccionadaConEvento = descripcionEventoSeleccionado.substring(indiceInicioIdSesion, indiceFinIdSesion);
//                    alert(idSesionSeleccionadaConEvento);
                    $('#modalInfoSesionCalendario').modal('show');
                }
                
            });
            
            eventosArray = null;
            
        }
    });
    
}