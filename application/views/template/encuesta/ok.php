<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<div class="container-contact100">
    <div class="wrap-contact100">
        
        <span class="contact100-form-title">
            Encuesta 
        </span>

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
    </div>
</div>