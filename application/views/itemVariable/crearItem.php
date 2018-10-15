<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Nueva pregunta
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
            <?php } elseif ($tipoMensaje == 1) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-success alert-dismissable">
                            <label><i class="icon fa fa-check"></i>  <?= $mensaje ?></label>                              
                        </div>
                    </div>
                </div>
            <?php } elseif ($tipoMensaje == 3) { ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-alert alert-dismissable">
                            <label><i class="icon fa fa-exclamation-triangle"></i>  <?= $mensaje ?></label>                              
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <div class="box box-primary">

            <?php echo form_open('ItemVariable/index/ci/' . $fk_campana); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre y Fechas  -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Codigo de pregunta</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control">
                            <br>
                        </div>

                        <!--   Campo Descripcion   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Pregunta</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" placeholder="Descripcion"></textarea>
                            <br>
                        </div>
                        
                        <!-- Campo Partida -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Aspecto</label>
                            <select class="form-control" id="fk_aspecto" name="fk_aspecto">
                                <?php foreach ($aspectos as $aspecto) { ?>
                                    <option value="<?= $aspecto->id_aspecto; ?>"><?php echo $aspecto->nombre . " - " . $aspecto->descripcion; ?></option>
                                <?php } ?>
                            </select>
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

