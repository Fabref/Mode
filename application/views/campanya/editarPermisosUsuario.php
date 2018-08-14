<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Formulario Permisos de Usuario
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php
        if (isset($tipoMensaje)) {
            if ($tipoMensaje == 2) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                            <label><i class="icon fa fa-ban"></i>  <?= $mensaje ?></label>                              
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <div class="box box-primary">

            <?php echo form_open('Campanya/index/gpu/' . $id_usuario . '/' . $id_campanya); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <div class="row">

                            <div class="col-xs-3 col-sm-3 col-md-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="puede_editar" id="puede_editar" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Permisos de Edici&oacute;n</label>
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="puede_consultar" id="puede_consultar" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Permisos de Consulta</label>
                                </div>
                                <br>
                            </div>

                        </div>
                    <br>
                    <br>

                    <!--   Boton 'guardar usuario'  -->
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-10">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-primary" href="javascript:window.history.back();">Volver</a>
                            <br>
                        </div>                      
                    </div>
                </div>
            </div><!-- /.box-body -->       
        </div><!-- /.box -->
    </section><!-- /.content -->
</div>

