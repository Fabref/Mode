<!-- Modal -->
<div class="modal modal-danger fade" id="confirm-delete" name="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"> Eliminar Campaña</h3>
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

<!-- Modal -->
<div class="modal modal-info fade" id="URL" name="URL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"> URL Campaña</h3>
            </div>
            <div class="modal-body">
                <p align="center"> La URL para realizar la encuesta es:<br><br></p>
                <p class="debug-url"></p>
                <p align="center"> RECUERDE: La encuesta sólo será accesible mientras esté abierta</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
                <!--<a class="btn btn-outline btn-ok">Cerrar</a>-->
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
            Campañas
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
                        <h3 class="box-title">Listado de campañas</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body"> 
                        <!-- Tabla clientes -->
                        <?php
                        if (sizeof($campanyas) > 0) {
                            ?>
                            <table id="tablaCampanyas" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Cliente</th>    
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    /*
                                     * Estados: 1-Edicion, 2-Abierto a consulta, 3-Cerrado a consulta, 0-Borrado/Cancelado
                                     */
                                    foreach ($campanyas as $campanya) {
                                        if ($campanya->estado != 0) {
                                            ?>
                                            <tr class = "odd gradeX">
                                                <td><?php echo $campanya->nombre; ?></a></td>
                                                <td><?php echo $campanya->fechaInicio; ?></a></td>
                                                <td><?php echo $campanya->fechaFin; ?></a></td>
                                                <!--<td><a href="<?php // echo base_url()        ?>index.php/Campanya/index/selc/<?php //echo $campanya->fk_cliente;        ?>"><?php //echo $clientes[$i];        ?></a></td>-->
                                                <td><?php echo $clientes[$i]; ?></td>
                                                <td>
                                                    <?php if (empty($this->session->userdata('loginUsuario'))) { ?>

                                                        <a title="Ver Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvvc/<?php echo $campanya->id_campana; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                                        <a title="Editar Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvec/<?php echo $campanya->id_campana; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                        <?php if ($this->session->userdata('superUser') == 1) { ?>
                                                            <a title="Permisos Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvpc/<?php echo $campanya->id_campana; ?>/<?php echo $campanya->fk_cliente; ?>"><i class="fa fa-users"></i></a>&nbsp;&nbsp;  
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($this->session->userdata('es_administrador') == 1) {
                                                            ?>
                                                            <a title="Ver Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvvc/<?php echo $campanya->id_campana; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                                            <a title="Editar Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvec/<?php echo $campanya->id_campana; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                            <a title="Permisos Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvpc/<?php echo $campanya->id_campana; ?>/<?php echo $campanya->fk_cliente; ?>"><i class="fa fa-users"></i></a>&nbsp;&nbsp;
                                                            <?php
                                                        } else {
                                                            if ($this->Campanya_model->permisoLectura($this->session->userdata('idUsuario'), $campanya->id_campana) == 1) {
                                                                ?>
                                                                <a title="Ver Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvvc/<?php echo $campanya->id_campana; ?>"><i class="fa fa-eye"></i></a>&nbsp;&nbsp; 
                                                                <?php
                                                            }
                                                            if ($this->Campanya_model->permisoEscritura($this->session->userdata('idUsuario'), $campanya->id_campana) == 1) {
                                                                ?>
                                                                <a title="Editar Campa&ntilde;a" href="<?= base_url() ?>index.php/Campanya/index/cvec/<?php echo $campanya->id_campana; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>  

                                                    <?php //$url = base_url() . "index.php/Encuesta/index/cvce/" . $campanya->id_campana . "/" . $campanya->url;     ?>
                                                    <?php $url = "http://mode.sogres.es/index.php/Encuesta/index/cvce/" . $campanya->id_campana . "/" . $campanya->url; ?>
                                                    <a title="URL Campa&ntilde;a" data-toggle="modal" data-href="<?= $url ?>" data-target="#URL" href="#"><i class="fa fa-link"></i></a>&nbsp;&nbsp;

                                                    <?php
                                                    if (empty($this->session->userdata('loginUsuario'))) {
                                                        if ($campanya->estado == 3) {
                                                            ?>
                                                            <a title="Ver Resultados" href="<?= base_url() ?>index.php/Campanya/index/cvrc/<?php echo $campanya->id_campana; ?>"><i class="fa fa-area-chart"></i></a>&nbsp;&nbsp;
                                                        <?php } ?>
                                                        <?php $urlEliminar1 = base_url() . "index.php/Campanya/index/cec/" . $campanya->id_campana . "/0"; ?>
                                                        <a title="Borrar campa&ntilde;a" data-toggle="modal" data-href="<?= $urlEliminar1 ?>" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i></a>
                                                        <?php
                                                    } else {
                                                        if ($this->Campanya_model->permisoLectura($this->session->userdata('idUsuario'), $campanya->id_campana) == 1) {
                                                            if ($campanya->estado == 3) {
                                                                ?> 
                                                                <a title="Ver Resultados" href="<?= base_url() ?>index.php/Campanya/index/cvrc/<?php echo $campanya->id_campana; ?>"><i class="fa fa-area-chart"></i></a>&nbsp;&nbsp;
                                                                <?php
                                                            }
                                                        }
                                                        if ($this->Campanya_model->permisoEscritura($this->session->userdata('idUsuario'), $campanya->id_campana) == 1) {
                                                            ?>
                                                            <?php $urlEliminar1 = base_url() . "index.php/Campanya/index/cec/" . $campanya->id_campana . "/0"; ?>
                                                            <a title="Borrar campa&ntilde;a" data-toggle="modal" data-href="<?= $urlEliminar1 ?>" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    switch ($campanya->estado) {
                                                        case 2:
                                                            ?>
                                                            &nbsp;&nbsp;<i class="fa fa-unlock"></i></a>&nbsp;&nbsp;
                                                            <?php
                                                            break;
                                                        case 3:
                                                            ?>
                                                            &nbsp;&nbsp;<i class="fa fa-lock"></i></a>&nbsp;&nbsp;
                                                            <?php
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $i++;
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
                                <h5>&emsp; - No existen campañas en la Base de Datos</h5>
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

