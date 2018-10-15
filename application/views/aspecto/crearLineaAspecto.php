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

            <?php echo form_open('Aspecto/index/gla/' . $fk_campana . '/' . $fk_aspecto); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre y Fechas  -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label>Nombre del aspecto</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" readonly
                                   value="<?= $aspecto->nombre; ?>">
                            <br>
                        </div>

                        <!--   Campo Descripcion   -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label>Descripci&oacute;n</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripcion" readonly><?= $aspecto->descripcion ?></textarea>
                            <br>
                        </div>
                    </div>

                    <!-- Agrupacion Partida e Importe -->

                    <div class="row">
                        <!-- Campo Partida -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label>Partida Presupuestaria</label>
                            <select class="form-control" id="fk_linea_presupuestaria" name="fk_linea_presupuestaria">
                                <?php foreach ($lineas as $linea) { ?>
                                    <option value="<?= $linea->id_linea_presupuestaria; ?>"><?php echo $linea->nombre . " - " . $linea->descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!--   Campo Importe   -->
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <label>Importe</label>

                            <input name="importe" id="importe" type="text" 
                                   class="form-control" required
                                   placeholder="Importe">
                            <br>
                            <br>
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <!--   Boton 'guardar'  -->
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-8">
                        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar">
                        <input type="submit" class="btn btn-warning" id="mas" name="mas" value="Guardar y añadir más">
                        <a class="btn btn-primary" href="javascript:window.history.back();">Volver</a>
                        <br>
                    </div>                      
                </div>
            </div><!-- /.box-body -->       
        </div><!-- /.box -->
    </section><!-- /.content -->
</div>

