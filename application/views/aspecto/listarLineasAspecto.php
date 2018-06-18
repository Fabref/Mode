<!-- Modal -->
<div class="modal modal-danger fade" id="confirm-delete" name="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"> Eliminar L&iacute;nea Presupuestaria del Aspecto</h3>
            </div>
            <div class="modal-body">
                <p align="center"> Los datos serán eliminados de la base de datos de manera permanente.<br><br>
                    ¿Realmente desea continuar con el proceso?</p>
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-outline btn-ok">Eliminar</a>
            </div>
        </div>
    </div>
</div>


<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de l&iacute;neas asignadas al aspecto
        </h1>
    </section>

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

        <!-- Lista de lineas -->
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de L&iacute;neas Presupuestarias</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body"> 

                        <?php if (sizeof($lineas) > 0) { ?>
                            <!-- Tabla lineas y aspectos -->

                            <table id="tablaLineasAspecto" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre del Aspecto</th>
                                        <th>Nombre L&iacute;nea Presupuestaria</th>
                                        <th>Importe</th>
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if (!empty($lineas)) {
                                        foreach ($lineas as $linea) {
                                            ?>
                                            <tr class = "odd gradeX">
                                                <td><?php echo $aspecto[$i]; ?></a></td>
                                                <td><?php echo $lineaP[$i]; ?></a></td>
                                                <td><?php echo $linea->importe; ?></a></td>
                                                <td>
                                                    <?php if ($estado == 1) { ?>
                                                        <?php $urlEliminar1 = base_url() . "index.php/Aspecto/index/elpa/" . $linea->idaspecto_tiene_linea_presupuestaria; ?>
                                                        <a data-toggle="modal" data-href="<?= $urlEliminar1 ?>" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                        <?php } else { ?>
                            <div>
                                <h5>&emsp; - No existen lineas</h5>
                            </div>
                        <?php } ?>
                        <!--   Boton 'guardar'  -->
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-10">
                                <!--<a type="submit" class="btn btn-primary" href="<?= base_url() ?>index.php/Campanya/index/cvec/<?= $idcampanya ?>">Volver</a>-->
                                <a class="btn btn-primary" href="javascript:window.history.back();">Volver</a>
                                <!--<input type="submit" class="btn btn-warning" id="mas" name="mas" value="Guardar y añadir más">-->
                                <br>
                            </div>                      
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div>