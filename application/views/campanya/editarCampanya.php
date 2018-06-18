<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Campa&ntilde;a
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

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Nombre y Fechas  -->
                    <div class="row">

                        <!--   Campo Nombre   -->
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Nombre de la campa&ntilde;a</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" readonly
                                   value="<?= $campanya->nombre ?>">
                            <br>
                        </div>

                        <!--   Campo Fecha apertura   -->
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <label>Fecha de apertura</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="fechaApertura" name="fechaApertura" 
                                       readonly class="form-control input-date"
                                       value="<?= $campanya->fechaInicio ?>">
                            </div>
                            <br>
                        </div>

                        <!--   Campo Fecha cierre   -->
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <label>Fecha de cierre</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="fechaCierre" name="fechaCierre" 
                                       readonly class="form-control input-date"
                                       value="<?= $campanya->fechaFin ?>">
                            </div>
                            <br>
                        </div>
                    </div>

                    <!--Agrupacion grupo de interés y descripción--> 
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Grupos de inter&eacute;s</label>
                            <textarea class="form-control" id="grupos" name="grupos" rows="3" readonly><?= $campanya->grupos ?></textarea>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Descripci&oacute;n</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" readonly><?= $campanya->descripcion ?></textarea>
                        </div>

                    </div>
                    <br>
                    <br>

                    <!-- Agrupacion para Linea presupuestaria, aspecto e items -->
                    <div class="row">
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <h2>Linea presupuestaria</h2>
                            <?php if (sizeof($lineas) > 0) { ?>
                                <table id="tablaLineasCampanya" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($lineas as $linea) {
                                            ?>
                                            <tr class = "odd gradeX">
                                                <td><?php echo $linea->nombre; ?></a></td>
                                                <td><?php echo $linea->descripcion; ?></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div>
                                    <h5>&emsp; - No existen lineas presupuestarias</h5>
                                </div>
                            <?php } ?>
                            <br>
                            <br>
                            <?php if ($campanya->estado == 1) { ?>
                                <a title="A&ntilde;adir nueva l&iacute;nea presupuestaria" href="<?= base_url() ?>index.php/LineaPresupuestaria/index/cvcl/<?php echo $campanya->id_campana; ?>"><i class="fa fa-plus"></i></a>&nbsp;&nbsp;        
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <h2>Aspectos</h2>
                            <?php if (sizeof($aspectos) > 0) { ?>
                                <table id="tablaAspectosCampanya" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Importe</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($aspectos as $aspecto) {
                                            ?>
                                            <tr class = "odd gradeX">
                                                <td><?php echo $aspecto->nombre; ?></td>
                                                <?php if (sizeof($importeTotalAspecto) > 0) { ?>
                                                    <td><?php echo $importeTotalAspecto[$i] . " &euro;"; ?></td>
                                                <?php } else { ?>
                                                    <td>0 &euro;</td>
                                                <?php } ?>
                                                <td>
                                                    <?php if ($campanya->estado == 1) { ?>
                                                        <a title="A&ntilde;adir nueva partida a aspecto" href="<?= base_url() ?>index.php/Aspecto/index/cvapa/<?php echo $campanya->id_campana; ?>/<?php echo $aspecto->id_aspecto; ?>"><i class="fa fa-plus"></i></a>&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <a title="Listar l&iacute;neas presupuestarias del aspecto" href="<?= base_url() ?>index.php/Aspecto/index/cvllpa/<?php echo $aspecto->id_aspecto; ?>"><i class="fa fa-list"></i></a>&nbsp;&nbsp;</td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div>
                                    <h5>&emsp; - No existen aspectos</h5>
                                </div>
                            <?php } ?>
                            <br>
                            <br>
                            <?php if ($campanya->estado == 1) { ?>
                                <a title="A&ntilde;adir nuevo aspecto" href="<?= base_url() ?>index.php/Aspecto/index/cvca/<?php echo $campanya->id_campana; ?>"><i class="fa fa-plus"></i></a>&nbsp;&nbsp;
                            <?php } ?>
                            <button class="btn-primary">Importe: <?= $importeAspectos ?> &nbsp;&euro;</button>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <h2>Items Variables <small>Nombre - Aspecto</small></h2>

                            <?php if (sizeof($items) > 0) { ?>

                                <?php echo form_open('ItemVariable/index/oi/' . $campanya->id_campana); ?>
                                <ul class="todo-list list-group list-group-sortable" id="wrapperListaEjerciciosFaseProtocolo">
                                    <?php
                                    $j = 0;
                                    foreach ($items as $item) {
                                        ?>
                                        <li class="<?php echo $item->id_item_variable; ?>">
                                            <input checked="checked" type="checkbox" id="it-<?php echo $item->id_item_variable; ?>" name="it-<?php echo $item->id_item_variable; ?>" class="hidden inputiCheck checkboxIT">
                                            <span id="moveCursorIT_<?php $item->id_item_variable ?>" class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <span id="nombreIT_<?php echo $item->nombre; ?>" class="text" style="width: 22em">
                                                <?php echo $item->nombre; ?>&nbsp;-&nbsp;<?php echo $aspectoItem[$j]; ?>
                                            </span>
                                        </li>
                                        <?php
                                        $j++;
                                    }
                                    ?>
                                </ul>
                                <br>
                                <!-- Boton Continuar -->
                                <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-6">
                                    <button type="submit" class="btn btn-primary pull-right">Ordenar</button> 
                                </div>
                            <?php } else { ?>
                                <div>
                                    <h5>&emsp; - No existen Items</h5>
                                </div>
                            <?php } ?>
                            <br>
                            <br>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <center>
                                <?php if (empty($this->session->userdata('loginUsuario'))) { ?>
                                    <?php if ($campanya->estado == 1) { ?>
                                        <a href="<?= base_url() ?>index.php/Campanya/index/cec/<?= $campanya->id_campana ?>/2"><button class="btn btn-success">Lanzar Campaña</button></a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php if ($campanya->estado == 2) { ?>
                                        <a href="<?= base_url() ?>index.php/Campanya/index/cec/<?= $campanya->id_campana ?>/3"><button class="btn btn-danger">Cerrar Campaña</button></a>
                                    <?php } ?>

                                    <?php if ($campanya->estado == 3) { ?>
                                        <a href="<?= base_url() ?>index.php/Campanya/index/cvrc/<?php echo $campanya->id_campana; ?>" class="btn btn-primary"><i class="fa fa-area-chart"></i>&nbsp;Ver resultados</a>
                                        <?php
                                    }
                                } else {
                                    if ($this->session->userdata('puede_editar') == 1) {
                                        if ($campanya->estado == 1) {
                                            ?>
                                            <a href="<?= base_url() ?>index.php/Campanya/index/cec/<?= $campanya->id_campana ?>/2"><button class="btn btn-success">Lanzar Campaña</button></a>&nbsp;&nbsp;
                                        <?php } if ($campanya->estado == 2) { ?>
                                            <a href="<?= base_url() ?>index.php/Campanya/index/cec/<?= $campanya->id_campana ?>/3"><button class="btn btn-danger">Cerrar Campaña</button></a>
                                            <?php
                                        }
                                        if ($this->session->userdata('puede_consultar') == 1) {
                                            if ($campanya->estado == 3) {
                                                ?>
                                                <a href="<?= base_url() ?>index.php/Campanya/index/cvrc/<?php echo $campanya->id_campana; ?>" class="btn btn-primary"><i class="fa fa-area-chart"></i>&nbsp;Ver resultados</a>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </center>
                        </div>
                    </div>

                </div>

                <div class = "row">
                    <div class = "col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-10">
                    <!--<a type = "submit" class = "btn btn-primary" href = "<?= base_url() ?>index.php/Campanya/index/cvec/<?= $idcampanya ?>">Volver</a> -->
                        <a class = "btn btn-primary" href = "javascript:window.history.back();">Volver</a>
                        <!--<input type = "submit" class = "btn btn-warning" id = "mas" name = "mas" value = "Guardar y añadir más"> -->
                        <br>
                    </div>
                </div>
            </div><!--/.box-body -->
        </div><!--/.box -->
    </section><!--/.content -->
</div>