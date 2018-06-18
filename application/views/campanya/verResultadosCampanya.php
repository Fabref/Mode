<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resultados Campa&ntilde;a
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">

            <br>

            <div class="box-body">

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
                <!-- Grafica -->
                <div class="chart" id="divGrafica">
                    <canvas id="grafica" style="height:200px"></canvas>

                    <hr>
                    <br>

                </div>

                <div class="box-group accordion" id="accordion">
                    <?php
                    $i = 0;
                    if (!empty($aspectos)) {
                        foreach ($aspectos as $aspecto) {
                            ?>
                            <!-- panel Aspecto -->
                            <div class="panel box box-info" id="panelBoxAspecto_<?php echo $aspecto->id_aspecto; ?>">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a id="collapseAs_<?php echo $aspecto->id_aspecto; ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo "_as_" . $aspecto->id_aspecto; ?>">
                                            <i class="fa fa-plus-square"></i>&nbsp;<?= $aspecto->nombre; ?>&nbsp;&nbsp;PRA: <?= number_format($aspecto->pra, 2, ',', '.') ?>&nbsp;&nbsp;Presupuesto: <?= number_format($importesAspecto[$i], 2, ",", ".") ?>
                                    </h4>
                                </div>

                                                            <!--<div id="collapse<?php //echo "_as_" . $aspecto->id_aspecto;      ?>" class="panel-collapse collapse <?php //if ($i == 0) {      ?> in <?php //}      ?>">-->
                                <div id="collapse<?php echo "_as_" . $aspecto->id_aspecto; ?>" class="panel-collapse collapse">
                                    <div class="box-body">
                                        <?php
                                        $itemsAsp = $items[$i];
                                        if (!empty($itemsAsp)) {
                                            ?>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Pregunta</th>
                                                        <th>Media</th>
                                                        <th>Desviaci&oacute;n</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($itemsAsp as $item) { ?>
                                                        <tr class = "odd gradeX">
                                                            <td><?php echo $item->nombre; ?></a></td>
                                                            <td><?php echo number_format($item->media, 2, ",", "."); ?></a></td>
                                                            <td><?php echo number_format($item->desviacion, 2, ",", "."); ?></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php } else { ?>
                                            <div>
                                                <h5>&emsp; - No existen preguntas</h5>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $i++;
                        }
                    } else {
                        ?>
                        <div>
                            <h5>&emsp; - No existen datos</h5>
                        </div>
                    <?php } ?>
                    
                </div> <!-- /.box-group accordion -->
                <br>
                <br>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <center>
                            <a href="<?= base_url() ?>index.php/Campanya/index/exp/<?= $campanya->id_campana ?>"><button class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;&nbsp;Exportar resultados</button></a>
                        </center>
                    </div>
                </div>
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
    </section><!-- /.content -->
</div>

<!-- Variables globales js para acceder a contenido php desde el fichero js -->
<script>
    var Globals = <?php
                    echo json_encode(array(
                        'baseUrl' => base_url(),
                        'desviacion' => "Desviación",
                        'media' => "Media",
                        'id_campana' => $campanya->id_campana
                    ));
                    ?>;

</script>