<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Formulario Nueva L&iacute;nea Presupuestaria
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

            <?php echo form_open('LineaPresupuestaria/index/cl/' . $fk_campana); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre y Fechas  -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Nombre de la l&iacute;nea presupuestaria</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" required
                                   placeholder="Nombre">
                            <br>
                        </div>

                        <!--   Campo Descripcion   -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Descripci&oacute;n</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripcion"></textarea>
                            <br>
                        </div>

                    </div>

                    <br>
                    <br>

                    <!--   Boton 'guardar'  -->
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

