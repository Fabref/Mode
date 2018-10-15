<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Modal -->
<div class="modal modal-danger fade" id="confirm-delete" name="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"> Eliminar Usuario</h3>
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



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios
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
            } else if ($tipoMensaje == 2) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                            <label><i class="icon fa fa-ban"></i><?= $mensaje ?></label>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <!-- Lista de usuarios -->
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de Usuarios</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body"> 
                        <!-- Tabla usuarios -->
                        <?php
                        if (sizeof($usuarios) > 0) {
                            ?>
                            <table id="tablaUsuarios" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Login</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>E-mail</th>    
                                        <th>Vinculado a</th> 
                                        <th>Administrador</th> 
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($usuarios as $usuario) {
                                        ?>
                                        <tr class = "odd gradeX">
                                            <!--<td><a href="<?php //echo base_url() ?>index.php/Usuario/index/selc/<?php //echo $usuario->id_usuario; ?>"><?php //echo $usuario->login; ?></a></td>-->
                                            <td><?php echo $usuario->login; ?></td>
                                            <td><?php echo $usuario->nombre; ?></td>
                                            <td><?php echo $usuario->apellidos; ?></td>
                                            <td><?php echo $usuario->email; ?></td>
                                            <td><?php echo $this->Cliente_model->getNombreCliente($usuario->fk_cliente); ?></td>
                                            <td><?php if ($usuario->es_administrador == 1) { ?>
                                                    <i class="fa fa-check"></i>
                                                <?php } else { ?>
                                                    <i class="fa fa-times"></i>
                                                <?php } ?>
                                            </td>
                                            <td><a title="Editar Usuario" href="<?= base_url() ?>index.php/Usuario/index/cveu/<?php echo $usuario->id_usuario; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                <?php if ($usuario->es_administrador == 0) { ?>
                                                    <?php $urlEliminar1 = base_url() . "index.php/Usuario/index/eu/" . $usuario->id_usuario; ?>
                                                    <a title="Eliminar Usuario" data-toggle="modal" data-href="<?= $urlEliminar1 ?>" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <br>

                            <!-- Si no existen usuarios se muestra el siguiente mensaje -->
                            <?php
                        } else {
                            ?>
                            <div>
                                <h5>&emsp; - No existen usuarios en la Base de Datos</h5>
                            </div>
                            <?php
                        }
                        ?>
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