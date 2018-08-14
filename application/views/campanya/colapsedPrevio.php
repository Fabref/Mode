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

                                                                                                            <!--<div id="collapse<?php //echo "_as_" . $aspecto->id_aspecto;            ?>" class="panel-collapse collapse <?php //if ($i == 0) {            ?> in <?php //}            ?>">-->
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

