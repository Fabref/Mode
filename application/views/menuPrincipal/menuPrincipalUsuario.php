<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

        <?php
        if (isset($tipoMensaje)) {
            if ($tipoMensaje == 1) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-success alert-dismissable">
                            <label><i class="icon fa fa-check"></i><?= $mensaje ?></label>
                        </div>
                    </div>
                </div>
                <?php
            } else if ($tipoMensaje == 3) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-warning alert-dismissable">
                            <label><i class="icon fa fa-warning"></i><?= $mensaje ?></label>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <!-- Small Boxes -->
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $num_camp ?></h3>

                        <p>Campa&ntilde;as</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-key"></i>
                    </div>
                    <a href="<?= base_url() ?>index.php/Campanya/index/cvlc" class="small-box-footer">M&aacute;s info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $num_usu ?></h3>

                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="<?= base_url() ?>index.php/Usuario/index/cvlu" class="small-box-footer">M&aacute;s info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </section><!-- /.content -->

</div>