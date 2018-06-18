
/******************************************************************************/
/******************************  INFO LICENCIAS  ******************************/
/******************************************************************************/

$(document).ready(function () {

    var hoy = new Date();
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));

    /* Evento onfocusout de los input para cambiar el nombre de las licencias */
    $(".inputNombreLicencia").blur(function (e) {
        var idLicencia = $(this).attr('id').split('_')[1];

        setTimeout(function () {
            $('#labelNombreLicencia_' + idLicencia).removeClass('hidden');
            $('#divEdicionNombreLicencia_' + idLicencia).addClass('hidden');
        }, 200);
    });


    /*Evento para actualizar en la BD el nombre de las licencias de un centro */
    $(".guardarNombre").on('click', function () {
        var idLicencia = $(this).attr('id').split('_')[1];
        var nombreLicencia = $("#inputNombreLicencia_" + idLicencia).val();

        $.ajax({
            url: base_url + 'index.php/Centro/index/anlfc',
            method: 'POST',
            data: {'idLicencia': idLicencia, 'nombreNuevo': nombreLicencia},
            success: function (resultadoActualizacion) {
                var iconoEditarNombreLicencia = document.getElementById("iconoEditarNombreLicencia_" + idLicencia);

                $("#labelNombreLicencia_" + idLicencia).text(nombreLicencia + '\xa0\xa0\xa0\xa0');
                $("#labelNombreLicencia_" + idLicencia).append(iconoEditarNombreLicencia);

                if (resultadoActualizacion) {
                    $('#modalNombreLicenciaActualizado').modal('show');
                }

            }
        });
    });

});


/**
 * Activa la edicion del nombre de la licencia cambiando el lbel por un input y mostrando
 * el boton para guardar los cambios.
 * 
 * @param {type} idLicencia el identificador de la licencia que se va a modificar
 */
function activarEdicionNombreLicencia(idLicencia) {
    var nombreLicencia = $('#labelNombreLicencia_' + idLicencia).text();

    $('#labelNombreLicencia_' + idLicencia).addClass('hidden');
    $('#divEdicionNombreLicencia_' + idLicencia).removeClass('hidden');

    /* Pone en el input el nombre de la licencia. Resta 4 posiciones que son los
     * espacios en blanco que hay entre el nombre y el icono de editar */
    $('#inputNombreLicencia_' + idLicencia).val(nombreLicencia.substring(0, (nombreLicencia.length - 4)));
    $('#inputNombreLicencia_' + idLicencia).focus();
}


/******************************************************************************/
/******************************  SESIONES CENTRO  *****************************/
/******************************************************************************/

/**
 * Gestiona la visualizacion de datos al usuario de las sesiones del centro
 * por licencias.
 */
function mostrarSesionesPorLicencia() {
    $("#mostrarSesionesLicencia").css("background-color", "#e8e8e8");
    $("#mostrarSesionesFisio").css("background-color", "#f4f4f4");

    if ($("#sesionesPorLicencias").hasClass('hidden')) {
        $("#sesionesPorFisios").addClass('hidden')
        $("#sesionesPorLicencias").removeClass('hidden')
    }

}


/**
 * Gestiona la visualizacion de datos al usuario de las sesiones del centro
 * por fisios.
 */
function mostrarSesionesPorFisio() {
    $("#mostrarSesionesLicencia").css("background-color", "#f4f4f4");
    $("#mostrarSesionesFisio").css("background-color", "#e8e8e8");

    if ($("#sesionesPorFisios").hasClass('hidden')) {
        $("#sesionesPorLicencias").addClass('hidden')
        $("#sesionesPorFisios").removeClass('hidden')
    }

}



$(document).ready(function () {

    var hoy = new Date();
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));

    /**
     * Grafica de las sesiones del mes actual por licencia
     */
    $.ajax({
        url: base_url + 'index.php/Centro/index/gigsml',
        method: 'POST',
        success: function (infoSesionesMesPorLicenciasJson) {
//            alert(infoSesionesMesPorLicenciasJson);
            /* Convierte a array el JSON */
            var infoSesionesPorLicenciaMesActual = $.parseJSON(infoSesionesMesPorLicenciasJson);

            /* Obtiene las sesiones por licencia */
            var sesionesPorLicencias = infoSesionesPorLicenciaMesActual['infoSesionesPorLicencia'];

            /* Si no existe ninguna sesion en las licencias, hace visible el mensaje al usuario */
            var licenciasSinSesiones = infoSesionesPorLicenciaMesActual['licenciasSinSesiones'];

            if (licenciasSinSesiones) {
                $('#divMensajeLicenciasSinSesiones').removeClass('hidden');
            }

            /* Array donde se almacenan los datasets de la grafica */
            var datasetsSesionesPorLicencia = [];

            /* Crea una linea de la grafica por licencia */
            for (var i = 0; i < sesionesPorLicencias.length; i++) {
                var numeroSesiones = sesionesPorLicencias[i]['numeroSesiones'];
                var nombreLicencia = sesionesPorLicencias[i]['nombreLicencia'];
                var colorLicencia = sesionesPorLicencias[i]['colorLicencia'];

                var licencia = {
                    label: nombreLicencia,
                    data: numeroSesiones,
                    backgroundColor:
                            colorLicencia.replace("1)", "0.2)")
                    ,
                    borderColor:
                            colorLicencia
                    ,
                    borderWidth: 1
                };

                datasetsSesionesPorLicencia.push(licencia);
            }

            var barChartData = {
                labels: infoSesionesPorLicenciaMesActual['infoMesActual'],
                datasets: datasetsSesionesPorLicencia
            };

            var ctx = document.getElementById("graficaSesionesMesPorLicencias").getContext('2d');
            var graficaSesionesMesPorLicencias = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: Globals.sesionesMesActualLicencias
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
//                                display: true,
                                    display: false,
                                    labelString: "Licencias",
                                    fontStyle: 'bold'
                                }
                            }],
                        yAxes: [{
                                display: true,
                                scaleLabel: {
//                                display: true,
                                    display: false,
                                    labelString: "Sesiones",
                                    fontStyle: 'bold'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    },
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 10
                        }
                    }
                }
            });
        }
    });


    /**
     * Grafica de las sesiones del año actual por licencia
     */
    $.ajax({
        url: base_url + 'index.php/Centro/index/gigsal',
        method: 'POST',
        success: function (infoSesionesAñoPorLicenciasJson) {
//            alert(infoSesionesAñoPorLicenciasJson);
            /* Convierte a array el JSON */
            var infoSesionesAñoPorLicencias = $.parseJSON(infoSesionesAñoPorLicenciasJson);

            /* Obtiene las sesiones por licencia */
            var sesionesByLicencias = infoSesionesAñoPorLicencias['sesionesByLicencias'];

            /* Array donde se almacenan los datasets de la grafica */
            var datasetsSesionesPorLicencia = [];

            /* Crea una linea de la grafica por licencia */
            for (var i = 0; i < sesionesByLicencias.length; i++) {
                var numeroSesionesRealizadas = sesionesByLicencias[i]['numeroSesionesRealizadas'];
                var colorLicencia = sesionesByLicencias[i]['colorLicencia'];
                var nombreLicencia = sesionesByLicencias[i]['nombreLicencia'];

                var licencia = {
                    label: nombreLicencia,
                    data: numeroSesionesRealizadas,
                    backgroundColor: [
                        colorLicencia.replace("1)", "0.2)")
                    ],
                    borderColor: [
                        colorLicencia
                    ],
                    borderWidth: 1
                };

                datasetsSesionesPorLicencia.push(licencia);
            }

            var ctx = document.getElementById("graficaSesionesAnyoPorLicencias").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: infoSesionesAñoPorLicencias['meses'],
                    datasets: datasetsSesionesPorLicencia
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: Globals.sesionesAnyoActualLicencias
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            });
        }
    });


    /**
     * Grafica de las sesiones del mes actual por licencia
     */
    $.ajax({
        url: base_url + 'index.php/Centro/index/gigsmf',
        method: 'POST',
        success: function (infoSesionesMesPorFisiosJson) {
//            alert(infoSesionesMesPorFisiosJson);
            /* Convierte a array el JSON */
            var infoSesionesPorFisiosMesActual = $.parseJSON(infoSesionesMesPorFisiosJson);

            /* Obtiene las sesiones por licencia */
            var sesionesPorFisios = infoSesionesPorFisiosMesActual['infoSesionesPorFisio'];

            /* Si no existe ninguna sesion en las licencias, hace visible el mensaje al usuario */
            var fisiosSinSesiones = infoSesionesPorFisiosMesActual['fisiosSinSesiones'];
            if (fisiosSinSesiones) {
                $('#divMensajeFisiosSinSesiones').removeClass('hidden');
            }

            /* Array donde se almacenan los datasets de la grafica */
            var datasetsSesionesPorFisio = [];

            /* Crea una linea de la grafica por licencia */
            for (var i = 0; i < sesionesPorFisios.length; i++) {
                var numeroSesiones = sesionesPorFisios[i]['numeroSesiones'];
                var nombreFisio = sesionesPorFisios[i]['nombreFisio'];
                var colorFisio = sesionesPorFisios[i]['colorFisio'];

                var fisio = {
                    label: nombreFisio,
                    data: numeroSesiones,
                    backgroundColor:
                            colorFisio.replace("1)", "0.2)")
                    ,
                    borderColor:
                            colorFisio
                    ,
                    borderWidth: 1
                };

                datasetsSesionesPorFisio.push(fisio);
            }

            var barChartData = {
                labels: infoSesionesPorFisiosMesActual['infoMesActual'],
                datasets: datasetsSesionesPorFisio
            };

            var ctx = document.getElementById("graficaSesionesMesPorFisios").getContext('2d');
            var graficaSesionesMesPorFisios = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: Globals.sesionesMesActualFisios
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
//                                display: true,
                                    display: false,
                                    labelString: "Fisios",
                                    fontStyle: 'bold'
                                }
                            }],
                        yAxes: [{
                                display: true,
                                scaleLabel: {
//                                display: true,
                                    display: false,
                                    labelString: "Sesiones",
                                    fontStyle: 'bold'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    },
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 10
                        }
                    }
                }
            });
        }
    });


    /**
     * Grafica de las sesiones del año actual por fisios
     */
    $.ajax({
        url: base_url + 'index.php/Centro/index/gigsaf',
        method: 'POST',
        success: function (infoSesionesAñoPorFisiosJson) {
//            alert(infoSesionesAñoPorFisiosJson);
            /* Convierte a array el JSON */
            var infoSesionesAñoPorFisios = $.parseJSON(infoSesionesAñoPorFisiosJson);

            /* Obtiene las sesiones por licencia */
            var sesionesByFisios = infoSesionesAñoPorFisios['sesionesByFisios'];

            /* Array donde se almacenan los datasets de la grafica */
            var datasetsSesionesPorFisio = [];

            /* Crea una linea de la grafica por licencia */
            for (var i = 0; i < sesionesByFisios.length; i++) {
                var numeroSesionesRealizadas = sesionesByFisios[i]['numeroSesionesRealizadas'];
                var colorFisio = sesionesByFisios[i]['colorFisio'];
                var nombreFisio = sesionesByFisios[i]['nombreFisio'];

                var fisio = {
                    label: nombreFisio,
                    data: numeroSesionesRealizadas,
                    backgroundColor: [
                        colorFisio.replace("1)", "0.2)")
                    ],
                    borderColor: [
                        colorFisio
                    ],
                    borderWidth: 1
                };

                datasetsSesionesPorFisio.push(fisio);
            }

            var ctx = document.getElementById("graficaSesionesAnyoPorFisios").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: infoSesionesAñoPorFisios['meses'],
                    datasets: datasetsSesionesPorFisio
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: Globals.sesionesAnyoActualFisios
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            });
        }
    });
});

/******************************************************************************/
/******************************  FACTURAS CENTRO  *****************************/
/******************************************************************************/

$(document).ready(function () {
    var url = window.location.href;
    var base_url = url.substr(0, url.indexOf("index"));

    //alert (base_url);
    /**
     * Grafica de las sesiones del año actual por licencia
     */
    $.ajax({
        url: base_url + 'index.php/Centro/index/gigfac',
        method: 'POST',
        success: function (infoFacturasAñoPorCentroJson) {
            //alert(infoFacturasAñoPorCentroJson);
            /* Convierte a array el JSON */
            var infoFacturasAñoPorCentro = $.parseJSON(infoFacturasAñoPorCentroJson);
            /* Busca en espacio del documento donde ingresar la gráfica */
            var ctx = document.getElementById("graficaFacturasAnyoPorCentro");
            //var data = JSON.stringify(infoFacturasAñoPorCentro)
            //alert(data);
            /* Crea la gráfica */
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: infoFacturasAñoPorCentro['meses'],
                    datasets: [{
                            label: 'Total Facturas',
                            data: infoFacturasAñoPorCentro['total'],
                            backgroundColor: [
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                                'rgba(71, 147, 8, 0.3)',
                            ],
                            borderColor: [
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                                'rgba(71, 147, 8, 1)',
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        }
    });
});