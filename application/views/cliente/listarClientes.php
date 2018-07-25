<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes
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

        <!-- Lista de clientes -->
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de clientes</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body"> 
                        <!-- Tabla clientes -->
                        <?php
                        if (sizeof($clientes) > 0) {
                            ?>
                            <table id="tablaClientes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Nombre</th>
                                        <th>NIF</th>
                                        <th>Raz&oacute;n Social</th>
                                        <th>E-mail</th>    
                                        <th>Web</th> 
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($clientes as $cliente) {
                                        ?>
                                        <tr class = "odd gradeX">
                                            <td>
                                                <?php if ($cliente->logo != NULL) { ?>
                                                 <img src="<?= base_url() ?>LogosClientes/thumbs/<?php echo $cliente->logo; ?>">
                                                <?php } else { echo "No existe Logotipo"; } ?>
                                            </td>
                                            <td><a href="<?= base_url() ?>index.php/Cliente/index/selc/<?php echo $cliente->id_cliente; ?>"><?php echo $cliente->nombre; ?></a></td>
                                            <td><a href="<?= base_url() ?>index.php/Cliente/index/selc/<?php echo $cliente->id_cliente; ?>"><?php echo $cliente->nif; ?></a></td>
                                            <td><a href="<?= base_url() ?>index.php/Cliente/index/selc/<?php echo $cliente->id_cliente; ?>"><?php echo $cliente->razonSocial; ?></a></td>
                                            <td><a href="<?= base_url() ?>index.php/Cliente/index/selc/<?php echo $cliente->id_cliente; ?>"><?php echo $cliente->email; ?></a></td>
                                            <td><a href="<?= base_url() ?>index.php/Cliente/index/selc/<?php echo $cliente->id_cliente; ?>"><?php echo $cliente->web; ?></a></td>
                                            <td><a title="Editar Cliente" href="<?= base_url() ?>index.php/Cliente/index/cvec/<?php echo $cliente->id_cliente;; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <br>

                            <!-- Si no existen clientes se muestra el siguiente mensaje -->
                            <?php
                        } else {
                            ?>
                            <div>
                                <h5>&emsp; - No existen clientes en la Base de Datos</h5>
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