<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Formulario Nueva Campa&ntilde;a
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

            <?php echo form_open_multipart('Cliente/index/cc'); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre, NIF y Logo -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Nombre del cliente</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" required
                                   placeholder="Nombre">
                            <br>
                        </div>

                        <!--   Campo nif   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>NIF</label>

                            <input name="nif" id="nif" type="text" 
                                   class="form-control" required
                                   maxlength="9"
                                   placeholder="">
                            <br>
                        </div>

                        <!-- Campo Logotipo -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Foto: </label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            <br>
                        </div>

                    </div>

                    <!--Agrupacion razón social, email y web--> 
                    <div class="row">

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Raz&oacute;n Social</label>
                            <input name="rs" id="rs" type="text" 
                                   class="form-control" required
                                   placeholder="Raz&oacute;n Social">
                            <br>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>E-mail</label>
                            <input name="email" id="emil" type="email" 
                                   class="form-control" required
                                   placeholder="email">
                            <br>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Web</label>
                            <input name="web" id="web" type="text" 
                                   class="form-control" required
                                   placeholder="web">
                            <br>
                        </div>

                    </div>
                    <br>
                    <br>

                    <!--   Boton 'guardar paciente'  -->
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

