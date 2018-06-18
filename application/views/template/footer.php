<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <a href="#"><b>Pol&iacute;tica de privacidad</a></b>
    </div>
    <strong>Copyright &copy; Todos los derechos reservados
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
<script src="<?= base_url() ?>dist/js/Mode/general/General.js"></script>
<script src="<?= base_url() ?>dist/js/Mode/aspecto/Aspectos.js"></script>

<!-- bootstrap color picker -->
<script src="<?= base_url() ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>plugins/datepicker/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script>

<!-- iCheck 1.0.1 -->
<script src="<?= base_url() ?>plugins/iCheck/icheck.min.js"></script>

<!-- fullCalendar 2.2.5 -->
<script src='<?= base_url() ?>plugins/fullcalendar/lib/moment.min.js'></script>
<script src="<?= base_url() ?>plugins/fullcalendar/fullcalendar.min.js"></script>
<script src='<?= base_url() ?>plugins/fullcalendar/gcal.js'></script>
<script src='<?= base_url() ?>plugins/fullcalendar/lang/es.js'></script>

<!-- ChartJS -->
<script src="<?= base_url() ?>plugins/chartjs/2.6.0/Chart.min.js"></script>
<script src="<?= base_url() ?>plugins/chartjs/2.6.0/utils.js"></script>

<!-- bootstrap daterangepicker -->
<script src="<?= base_url() ?>plugins/daterangepicker/daterangepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?= base_url() ?>plugins/bootstrap-wysihtml5/locales/bootstrap-wysihtml5.es-ES.js"></script>

<!--To do list--> 
<script src="<?= base_url() ?>plugins/sortable/jquery.sortable.min.js"></script>


<!-- Script Modales -->
<script>

    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });

    $('#URL').on('show.bs.modal', function (e) {
        //$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        $('.debug-url').html('<center><strong>' + $(e.relatedTarget).data('href') + '</strong></center>');
    });

</script>

<!--   Tablas   -->
<script>
    //$(function () {

    /* Tabla Lista Clientes */
    $("#tablaClientes").DataTable({
        "order": [[0, "asc"], [1, "asc"], [2, "asc"]],
        "lengthChange": false,
        "columnDefs": [
            {
                "orderable": false,
                "targets": [4]
            }
        ],
        "pageLength": 10
    });

    /* Tabla Lista Campañas */
    $("#tablaCampanyas").DataTable({
        "order": [[0, "asc"], [1, "asc"], [2, "asc"]],
        "lengthChange": false,
        "columnDefs": [
            {
                "orderable": false,
                "targets": [4]
            }
        ],
        "pageLength": 10
    });

    /* Tabla Lista Campañas */
    $("#tablaUsuarios").DataTable({
        "order": [[0, "asc"], [1, "asc"], [2, "asc"]],
        "lengthChange": false,
        "columnDefs": [
            {
                "orderable": false,
                "targets": [4]
            }
        ],
        "pageLength": 10
    });

    /* Tabla Lineas Campaña */
    $("#tablaLineasCampanya").DataTable({
        "lengthChange": false,
        "pageLength": 10
    });
    /* Tabla Aspectos Campaña */
    $("#tablaAspectosCampanya").DataTable({
        "lengthChange": false,
        "columnDefs": [
            {
                "orderable": false,
                "targets": [2]
            }
        ],
        "pageLength": 10
    });


    /* Tabla Lista Fisioterapeutas */
//        $("#tablaFisioterapeutas").DataTable({
//            "order": [[0, "asc"], [1, "asc"], [2, "asc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "orderable": false,
//                    "targets": [4]
//                }
//                ],
//            "pageLength": 10
//        });

    /* Tabla Lista Fisioterapeutas Inactivos */
//        $("#tablaFisioterapeutasInactivos").DataTable({
//            "order": [[0, "asc"], [1, "asc"], [2, "asc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "orderable": false,
//                    "targets": [4]
//                }
//                ],
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

    /* Tabla Facturas del Centro */
//        $("#tablaFacturas").DataTable({
//            "order": [[0, "desc"], [1, "desc"]],
//            "lengthChange": false,
//            "columnDefs": [
//                {
//                    "targets": [0, 1, 2],
//                    "visible": true
//                }
//            ],
//            "pageLength": 10
//        });

    /* Tabla Incidencias Abiertas */
//        $("#tablaIncidenciasAbiertas").DataTable({
//            "order": [[ 2, "desc" ], [ 0, "asc" ]], 
//            "lengthChange": false,
//            "columnDefs": [
//                { 
//                    "orderable": false, 
//                    "targets": [3] 
//                }],
//            "pageLength": 10
//        });

    /* Tabla Incidencias Cerradas */
//        $("#tablaIncidenciasCerradas").DataTable({
//            "order": [[ 2, "desc" ], [ 1, "asc" ]], 
//            "lengthChange": false,
//            "columnDefs": [
//                { 
//                    "orderable": false, 
//                    "targets": [4] 
//                }],
//            "pageLength": 10
//        });


    //  });


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

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    //$(function () {

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
     * Inicializa el calendario datepicker
     */
    $('.input-datepicker').datepicker({

        format: 'dd/mm/yyyy',
        autoclose: true,
        weekStart: 1,
        todayHighlight: true,

        daysOfWeekHighlighted: '6',
        startDate: '-0d', /* Para que no deje seleccionar dias anteriores a hoy */
        language: 'es-ES'
    });

    /*
     * Ordenacion de la lista
     */
    $('.list-group-sortable').sortable({
        placeholderClass: 'list-group-item'
    });

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

    /* Para los checkboxes de reasignar paciente que tienes stilo de iCheck */
//        $('.inputiCheck').iCheck({
//          checkboxClass: 'icheckbox_flat-green',
////          radioClass: 'iradio_flat-red'
//        });

    /* Para los textarea de nueva incidencia y notificaciones */
//        $('.richTextarea').wysihtml5({
//            locale:'es-ES',
//            toolbar: {
//                "link": false,
//                "image": false
//            }
//        });

    // });

</script>
