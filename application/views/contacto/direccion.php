<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $this->lang->line('msg_telefono_y_direccion'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small Boxes -->

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-envelope"></i>

                        <h3 class="box-title"><?php echo $this->lang->line('msg_formulario_de_contacto'); ?></h3>

                    </div>

                    <?php
                    if (isset($tipoMensaje)) {
                        if ($tipoMensaje == MENSAJE_REALIZADO_OK) {
                            ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-success alert-dismissable">
                                            <label><i class="icon fa fa-check"></i><?= $mensaje ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-danger alert-dismissable">
                                            <label><i class="icon fa fa-warning"></i><?= $mensaje ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="box-body">



                        <section id="section-map">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-3">

                                                <h5>Oficina Principal</h5>
                                                <h4>Teruel, Aragón, España.</h4>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <div id="map"></div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <i class="fa fa-map-marker"></i>&nbsp;
                                                Avda. Sagunto 116, Edif. CEEI Aragón<br>
                                                44002 - Teruel - Aragón - España
                                                <hr>
                                                <i class="fa fa-phone"></i>&nbsp;
                                                (+34) 978 62 36 03
                                                <hr>
                                                <i class="fa fa-envelope"></i>&nbsp;
                                                <a href="mailto:info@kineactiv.com">info@kineactiv.com</a>
                                                <hr>

                                                <i class="fa fa-group"></i>&nbsp;
                                                <!-- social icons -->
                                                <a href="https://www.facebook.com/pages/KineActiv/689810661163666" target="_blank"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;
                                                <a href="https://twitter.com/KineActiv" target="_blank"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;
                                                <a href="https://www.youtube.com/channel/UCHmzoZbX-0E39zkXnptS_wA" target="_blank"><i class="fa fa-youtube-play"></i></a>&nbsp;&nbsp;
                                                <a href="https://plus.google.com/+KineActiv2015" target="_blank"><i class="fa fa-google-plus"></i></a>&nbsp;&nbsp;
                                                <a href="mailto:info@kineactiv.com"><i class="fa fa-envelope-o"></i></a>&nbsp;&nbsp;
                                                <a href="http://www.kineactiv.com" target="_blank"><i class="fa fa-globe"></i></a>
                                                <!-- social icons close -->
                                            </div>
                                            <div class="clearfix" style="background-size: cover;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </section>
                </div> <!-- ./box-body -->
                <!--                    <div class="box-footer clearfix">
                                        <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                                            <i class="fa fa-arrow-circle-right"></i></button>
                                    </div>-->
            </div>
        </div>
</div> <!-- /.row -->
</section>
</div> <!-- /.content-wrapper -->

