<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <a href="#"><b><?php echo $this->lang->line('msg_poltica_de_privacidad'); ?></a></b>
    </div>
    <strong>Copyright &copy; <a href="http://www.edisondesarrollos.es/">Edison Desarrollos</a>.</strong> <?php echo $this->lang->line('msg_all_rights_reserved'); ?>
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->

<!--jQuery 2.1.4--> 
<script src="<?= base_url() ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!--Bootstrap 3.3.5--> 
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>

<!-- InputMask -->
<script src="<?= base_url() ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="<?= base_url() ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?= base_url() ?>plugins/fastclick/fastclick.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>dist/js/demo.js"></script>

<!-- Select2 -->
<script src="<?= base_url() ?>plugins/select2/select2.full.min.js"></script>

<!-- JS's con las funciones definidas por submenu -->
<!--<script src="<?= base_url() ?>dist/js/kineActivCentro/paciente/DeportesPaciente.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/patologia/Patologia.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/pauta/PautaPaso1.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/pauta/PautaPaso3.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/pauta/ListaSesiones.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/valoracion/Valoracion.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/valoracion/EvolucionValoracion.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/evolucion/EvolucionEspecifica.js"></script>
<script src="<?= base_url() ?>dist/js/kineActivFisio/evolucion/EvolucionGeneral.js"></script>-->
<script src="<?= base_url() ?>dist/js/kineActivCentro/calendario/Calendario.js"></script>
<!--<script src="<?= base_url() ?>dist/js/kineActivFisio/ejerciciosDisponibles/EjerciciosDisponibles.js"></script>-->


<!-- bootstrap color picker -->
<script src="<?= base_url() ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>plugins/datepicker/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script>

<!-- Clockpicker -->
<script src='<?= base_url() ?>plugins/clockpicker/bootstrap-clockpicker.min.js'></script>

<!-- iCheck 1.0.1 -->
<script src="<?= base_url() ?>plugins/iCheck/icheck.min.js"></script>

<!-- fullCalendar 2.2.5 -->
<script src='<?= base_url() ?>plugins/fullcalendar/lib/moment.min.js'></script>
<script src="<?= base_url() ?>plugins/fullcalendar/fullcalendar.min.js"></script>
<script src='<?= base_url() ?>plugins/fullcalendar/gcal.js'></script>
<script src='<?= base_url() ?>plugins/fullcalendar/lang/<?php echo $this->lang->line('msg_idioma_calendario'); ?>.js'></script>

<script>
                            $(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        // put your options and callbacks here
    })

});

                        </script>
<!-- ChartJS -->
<script src="<?= base_url() ?>plugins/chartjs/2.6.0/Chart.min.js"></script>
<script src="<?= base_url() ?>plugins/chartjs/2.6.0/utils.js"></script>

<script>
    
//            var ctx = document.getElementById("myChart").getContext('2d');
//            var myChart = new Chart(ctx, {
//                type: 'line',
//                data: {
//                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//                    datasets: [{
//                            label: '# of Votes',
//                            data: [12, 19, 3, 5, 2, 3],
//                            backgroundColor: [
//                                'rgba(255, 99, 132, 0.2)',
//                            ],
//                            borderColor: [
//                                'rgba(255,99,132,1)',
//                            ],
//                            borderWidth: 1
//                        },
//                        {
//                            label: '# of Votes',
//                            data: [3, 2, 5, 3, 19, 12],
//                            backgroundColor: [
//                                'rgba(85, 219, 51, 0.2)',
//                            ],
//                            borderColor: [
//                                'rgba(85, 219, 51, 1)',
//                            ],
//                            borderWidth: 1
//                        },
//                    ]
//                },
//                options: {
//                    scales: {
//                        yAxes: [{
//                                ticks: {
//                                    beginAtZero: true
//                                }
//                            }]
//                    }
//                }
//            });
</script>

<!-- bootstrap daterangepicker -->
<!--<script src="<?= base_url() ?>plugins/daterangepicker/daterangepicker.js"></script>-->

<!-- API Google Maps -->

<!--<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAlMACPhhGeAs4gR1OsIluLpVE_Y0L5jk&callback=initMap">
</script>-->

<!--   Mapa     -->
<script>
//    function initMap() {
//
//        var Teruel = {lat: 40.3319669, lng: -1.0859651000000667};
//
//        var map = new google.maps.Map(document.getElementById('map'), {
//            zoom: 16,
//            center: Teruel
//        });
//
//        var image = 'http://localhost/KineActivCentro_v1.0/dist/img/logotras_50.png';
//        var marker = new google.maps.Marker({
//            position: Teruel,
//            map: map,
//            icon: image
//        });
//    }
</script>

<!--   Tablas   -->
<script>
    $(function () {
//        $('#calendarioGeneral').fullCalendar({});     
        /* Tabla Lista Patologias */
//        $('#tablaPatologias').DataTable({
//            "order": [[0, "desc"]], // Se ordena por defecto por la columna 0, que esta oculta.
//            "columnDefs": [
//                {
//                    "targets": [0],
//                    "visible": false
//                }
//            ]
//        });

        /* Tabla Lista Pacientes */
        $("#tablaPacientes").DataTable();

        /* Tabla Lista Pacientes Inactivos*/
        $("#tablaPacientesInactivos").DataTable();

        /* Tabla Sesiones Pendientes */
//        $("#tablaSesionesPendientes").DataTable({
//            "order": [[1, "asc"]],
//            "searching": false,
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "orderable": false,
//                    "targets": [3, 4]
//                },
//                /* Para que ordene por la columna 2 con los datos de la columna 0 */
//                {
//                    "orderData": [0],
//                    "targets": [2]
//                },
//                {
//                    "targets": [0],
//                    "visible": false
//                }],
//            "pageLength": 10
//        });

        /* Tabla Sesiones Realizadas */
//        $("#tablaSesionesRealizadas").DataTable({
//            "order": [[0, "asc"]],
//            "searching": false,
//            "lengthChange": false,
//            "columnDefs": [{"orderable": false, "targets": [2, 3]}],
//            "pageLength": 10,
//        });

        /* Tabla Valoraciones Activas */
//        $("#tablaValoracionesActivas").DataTable({
//            "order": [[1, "asc"], [0, "asc"], [3, "asc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "orderable": false,
//                    "targets": [6]
//                },
//                /* Para que ordene por la columna 2 con los datos de la columna 0 y 1 */
//                {
//                    "orderData": [0, 1],
//                    "targets": [2]
//                },
//                {
//                    "targets": [0, 1],
//                    "visible": false
//                }],
//            "pageLength": 10
//        });

        /* Tabla Valoraciones Pendientes */
//        $("#tablaValoracionesPendientes").DataTable({
//            "order": [[1, "asc"], [0, "asc"], [3, "asc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "orderable": false,
//                    "targets": [4]
//                },
//                /* Para que ordene por la columna 2 con los datos de la columna 0 y 1 */
//                {
//                    "orderData": [0, 1],
//                    "targets": [2]
//                },
//                {
//                    "targets": [0, 1],
//                    "visible": false
//                }],
//            "pageLength": 10
//        });

        /* Tabla Valoraciones Historico */
//        $("#tablaValoracionesHistorico").DataTable({
//            "order": [[2, "asc"], [3, "asc"], [4, "desc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "orderable": false,
//                    "targets": [6]
//                },
//                /* Para que ordene por la columna 2 con los datos de la columna 0 y 1 */
//                {
//                    "orderData": [0, 1],
//                    "targets": [2]
//                },
//                {
//                    "targets": [0, 1],
//                    "visible": false
//                }],
//            "pageLength": 10
//        });

        /* Tabla Evolucion Valoracion */
//        $("#tablaEvolucionValoracion").DataTable({
//            "order": [[3, "desc"]],
//            "searching": false,
//            "lengthChange": false,
//            "columnDefs": [
//                /* Para que ordene por la columna 3 con los datos de la columna 0 */
//                {
//                    "orderData": [0],
//                    "targets": [3]
//                },
//                {
//                    "targets": [0],
//                    "visible": false
//                }
//            ],
//            "pageLength": 10
//        });

        /* Tabla Evolucion Especifica Ejercicios Concentricos */
//        $("#tablaEvolucionEspecificaConcentrica").DataTable({
//            "order": [[0, "asc"]],
//            "searching": false,
//            "lengthChange": false,
//            "pageLength": 10
//        });

        /* Tabla Evolucion Especifica Ejercicios Isometricos y Excentricos */
//        $("#tablaEvolucionEspecificaIsometricaYExcentrica").DataTable({
//            "order": [[0, "asc"]],
//            "searching": false,
//            "lengthChange": false,
//            "pageLength": 10
//        });

        /* Tabla Evolucion General Ejercicios Concentricos */
//        $("#tablaEvolucionGeneralConcentrica").DataTable({
//            "order": [[1, "asc"]],
//            "searching": false,
//            "lengthChange": false,
//            "columnDefs": [
//                /* Para que ordene por la columna 2 con los datos de la columna 0 */
//                {
//                    "orderData": [0],
//                    "targets": [2]
//                },
//                {
//                    "targets": [0],
//                    "visible": false
//                }
//            ],
//            "pageLength": 10
//        });

        /* Tabla Evolucion General Ejercicios Excentricos e Isometricos */
//        $("#tablaEvolucionGeneralIsometricaYExcentrica").DataTable({
//            "order": [[1, "asc"]],
//            "searching": false,
//            "lengthChange": false,
//            "columnDefs": [
//                /* Para que ordene por la columna 2 con los datos de la columna 0 */
//                {
//                    "orderData": [0],
//                    "targets": [2]
//                },
//                {
//                    "targets": [0],
//                    "visible": false
//                }
//            ],
//            "pageLength": 10
//        });


        /* Tabla Evolucion General Ejercicios Excentricos e Isometricos */
//        $("#tablaEjerciciosDisponibles").DataTable({
//            "order": [[0, "asc"], [1, "asc"], [2, "asc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "targets": [0, 1, 2],
//                    "visible": false
//                }
//            ],
//            "pageLength": 10
//        });


    });


</script>

<!--   Modales   -->
<script>
//    $('#modalEliminarPatologia').on('show.bs.modal', function (e) {
//        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
//    });
//
//
//    $('#modalAltaPatologia').on('show.bs.modal', function (e) {
//        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
//        //     $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
//    });
//
//
//    $('#modalEliminarSesionPendiente').on('show.bs.modal', function (e) {
////        $('#sesionAEliminar').text($(this).find('.btn-ok').attr('href'));
////        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
////        $('.debug-url').html($(this).find('.btn-ok').attr('href'));
//        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
//    });
//
//
//    $('#modalEliminarValoracion').on('show.bs.modal', function (e) {
//        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
//    });


    $('#modalInfoSesionCalendario').on('show.bs.modal', function (e) {
        var descripcion = Object.values($(this).find('.erer').html());
        var descripcionFormateada = descripcion.join("").toString();
        /* Si la sesion esta realizada no muestra boton cambiar horario, si no lo esta, si lo muestra */
        if (descripcionFormateada.indexOf("Fecha realización") !== -1) {
            if (!$(this).find('#cambiarHorarioSesionCalendarioGeneral').hasClass("hidden")) {
                $(this).find('#cambiarHorarioSesionCalendarioGeneral').addClass("hidden");
            }
        } else {
            if ($(this).find('#cambiarHorarioSesionCalendarioGeneral').hasClass("hidden")) {
                $(this).find('#cambiarHorarioSesionCalendarioGeneral').removeClass("hidden");
            }
        }
    });

    $('#modalEliminarPaciente').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#modalAltaPaciente').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#modalBajaPaciente').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#modalEliminarFisioterapeuta').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#modalAltaFisioterapeuta').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#modalBajaFisioterapeuta').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<!--   Select2 elements   -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        $('.select2SinBusqueda').select2({
            minimumResultsForSearch: -1 // Desactiva la barra de busqueda del select2
        });
        
    });

</script>


<script>


    $(function () {
        /*
         * Inicializa la mascara de las fechas y horas
         */
        $(".input-hour").inputmask("hh:mm", {"alias": "hh:mm", "placeholder": "hh:mm"});
        $(".input-date").inputmask("dd/mm/yyyy", {"alias": "dd/mm/yyyy", "placeholder": "dd/mm/yyyy"});


        /*
         * Inicializa los relojes de hora 
         */
//        $('.clockpicker').clockpicker({
//            placement: 'bottom',
//            align: 'left',
//            autoclose: true
//        });


        /*
         * Inicializa el calendario datepicker del paso3 de la pauta
         */
//        $('.input-datepicker-pauta').datepicker({
//            format: 'dd/mm/yyyy',
//            autoclose: true,
//            weekStart: 1,
//            todayHighlight: true,
//
//            daysOfWeekHighlighted: '6',
//            startDate: '-0d', /* Para que no deje seleccionar dias anteriores a hoy */
//            language: 'es-ES'
//        });

        /*
         * Inicializa los calendarios datepicker de la app (salvo fecha nacimiento paciente que no lleva)
         */
//        $('.input-datepicker').datepicker({
//            format: 'dd/mm/yyyy',
//            autoclose: true,
//            weekStart: 1,
//            todayHighlight: true,
//
//            daysOfWeekHighlighted: '6',
//            language: 'es-ES'
//        });


        //Date range picker
//        $('#reservation').daterangepicker();
    });
</script>

