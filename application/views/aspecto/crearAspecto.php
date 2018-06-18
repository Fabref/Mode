<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Formulario Nuevo Aspecto
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

            <?php echo form_open('Aspecto/index/ca/' . $fk_campana); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre y Descripción  -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label>Nombre del aspecto</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" required
                                   placeholder="Nombre">
                            <br>
                        </div>

                        <!--   Campo Descripcion   -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label>Descripci&oacute;n</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripcion"></textarea>
                            <br>
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <!--   Boton 'guardar'  -->
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-10">
                        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar">
                        <!--<input type="submit" class="btn btn-warning" id="mas" name="mas" value="Guardar y añadir más">-->
                        <a class="btn btn-primary" href="javascript:window.history.back();">Volver</a>
                        <br>
                    </div>                      
                </div>
            </div><!-- /.box-body -->       
        </div><!-- /.box -->
    </section><!-- /.content -->
</div>

