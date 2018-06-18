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

            <?php echo form_open('Campanya/index/cc'); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre y Fechas  -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Nombre de la campa&ntilde;a</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" required
                                   placeholder="Nombre">
                            <br>
                        </div>

                        <!--   Campo Fecha apertura   -->
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <label>Fecha de apertura</label>

                            <div class="input-group date input-datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="fechaApertura" name="fechaApertura" 
                                       required class="form-control input-date"
                                       placeholder="dd/mm/yyyy">
                            </div>
                            <br>
                        </div>

                        <!--   Campo Fecha cierre   -->
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <label>Fecha de cierre</label>

                            <div class="input-group date input-datepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="fechaCierre" name="fechaCierre" 
                                       required class="form-control input-date"
                                       placeholder="dd/mm/yyyy">
                            </div>
                            <br>
                        </div>
                    </div>

                    <!--Agrupacion grupo de interés y descripción--> 
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Grupos de inter&eacute;s</label>
                            <textarea class="form-control" id="grupos" name="grupos" rows="3" placeholder="Grupos de interés de la campaña"></textarea>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Descripci&oacute;n</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Texto descriptivo de la campaña"></textarea>
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

