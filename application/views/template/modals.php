
<!-- Modal Deportes Paciente -->
<div class="modal fade" id="modalSeleccionDeportes" name="modalSeleccionDeportes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo $this->lang->line('msg_seleccion_deportes'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <?php echo form_open('Deporte/modificarDeportes'); ?>

                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <label><?php echo $this->lang->line('msg_deportes'); ?></label>
                                <br><br>
                                <select id="origen" name="origen[]" class="form-control select2" style="width: 100%;">
                                    <?php
                                    if(isset($listaDeportes)) {
                                        foreach ($listaDeportes as $deporte) {
                                            echo '<option value="' . $deporte->idtipo_deporte . '">' . $this->lang->line("dp_" . $deporte->idtipo_deporte) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1">
                                <br><br>
                                <input type="button" class="pasar izq btn btn-default"
                                       value="<?php echo $this->lang->line('msg_seleccionar'); ?> &raquo;">
                                <br>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1"></div>
                            <div class="col-xs-1 col-sm-1 col-md-1">
                                <br><br>
                                <input type="button" class="quitar der btn btn-default" style="width: 7.6em;" value="&laquo; <?php echo $this->lang->line('msg_quitar'); ?>">
                                <br><br>
                                <input type="button" class="quitartodos der btn btn-default" style="width: 7.6em;" value="&laquo; <?php echo $this->lang->line('msg_quitar_todos'); ?>">
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1"></div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <label><?php echo $this->lang->line('msg_deportes_seleccionados'); ?></label>
                                <br>
                                <select name="destino[]" id="destino" multiple="multiple" style="width: 100%;">
                                    <?php
                                    if(isset($deportesPaciente)) {
                                        foreach ($deportesPaciente as $deporte) {
                                            echo '<option value="' . $deporte->fk_tipo_deporte . '">' . $this->lang->line("dp_" . $deporte->fk_tipo_deporte) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <br><br><br><br><br>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cancelarRealizaDeporte()"><?php echo $this->lang->line('btn_cancelar'); ?></button>
                <button type="button" class="btn btn-primary" onclick="seleccionarDeportesPaciente('<?php echo $this->lang->line('msg_añadir_deporte');?>')"><?php echo $this->lang->line('btn_aceptar'); ?></button>
            </div>
        </div>
    </div>
</div>


<!-- Modal info sesion calendario general -->
<div class="modal fade" id="modalInfoSesionCalendario" name="modalInfoSesionCalendario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_info_sesion'); ?></h4>
      </div>
      <div class="modal-body">
          <h5 class="erer" id="descripcion_sesion_calendario_general"></h5>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary btn-ok" data-dismiss="modal" name="aaaa"><?php echo $this->lang->line('btn_aceptar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal eliminar filtro calendario -->
<div class="modal fade" id="modalEliminarFiltroCalendario" name="modalEliminarFiltroCalendario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_eliminar_filtro_calendario'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_eliminar_filtro_calendario'); ?></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-danger btn-ok" onclick="eliminarFiltroCalendario()" data-dismiss="modal"><?php echo $this->lang->line('btn_eliminar_filtro') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal baja paciente -->
<div class="modal fade" id="modalBajaPaciente" name="modalBajaPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_baja_paciente'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_baja_paciente'); ?></h5>
          <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-warning btn-ok"><?php echo $this->lang->line('btn_aceptar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal alta paciente -->
<div class="modal fade" id="modalAltaPaciente" name="modalAltaPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_alta_paciente'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_alta_paciente'); ?></h5>
          <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-primary btn-ok"><?php echo $this->lang->line('btn_aceptar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal eliminar paciente -->
<div class="modal fade" id="modalEliminarPaciente" name="modalEliminarPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_eliminar_paciente'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_eliminar_paciente'); ?></h5>
          <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-danger btn-ok"><?php echo $this->lang->line('btn_eliminar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal baja fisio -->
<div class="modal fade" id="modalBajaFisioterapeuta" name="modalBajaFisioterapeuta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_baja_fisio'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_baja_fisio'); ?></h5>
          <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-warning btn-ok"><?php echo $this->lang->line('btn_aceptar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal alta fisio -->
<div class="modal fade" id="modalAltaFisioterapeuta" name="modalAltaFisioterapeuta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_alta_fisio'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_alta_fisio'); ?></h5>
          <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-primary btn-ok"><?php echo $this->lang->line('btn_aceptar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal eliminar fisio -->
<div class="modal fade" id="modalEliminarFisioterapeuta" name="modalEliminarFisioterapeuta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_eliminar_fisio'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_eliminar_fisio'); ?></h5>
          <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-danger btn-ok"><?php echo $this->lang->line('btn_eliminar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal nombre licencia actualizado -->
<div class="modal fade" id="modalNombreLicenciaActualizado" name="modalNombreLicenciaActualizado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_nombre_kinect_actualizado'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_nombre_kinect_actualizado'); ?></h5>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('btn_aceptar') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal eliminar filtro pacientes por fisio -->
<div class="modal fade" id="modalEliminarFiltroPacientesPorFisio" name="modalEliminarFiltroPacientesPorFisio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="titl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('title_eliminar_filtro_pacientes_por_fisio'); ?></h4>
      </div>
      <div class="modal-body">
          <h5><?php echo $this->lang->line('body_eliminar_filtro_pacientes_por_fisio'); ?></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('btn_cancelar'); ?></button>
        <a class="btn btn-danger btn-ok" onclick="eliminarFiltroCambiarPacientesFisio()" data-dismiss="modal"><?php echo $this->lang->line('btn_eliminar_filtro') ?></a>
      </div>
    </div>
  </div>
</div>


<!-- Modal fisio sin pacientes activos -->
<div class="modal fade" id="modalFisioSinPacientesActivos" name="modalFisioSinPacientesActivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content panel-warning">
            <div class="modal-header panel-heading" id="titl">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><?php echo $this->lang->line('title_fisio_sin_paciente_activos') ?></b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <h5><i class="fa fa-exclamation-triangle fa-2x icon-warning" aria-hidden="true"></i></h5>
                    </div>              
                    <div class="col-md-11 col-sm-11 col-xs-11">
                        <h5 style="margin-top: 1.2em; margin-left: -1em;">&emsp;<?php echo $this->lang->line('body_fisio_sin_paciente_activos') ?></h5>
                    </div>              
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="restaurarPacientesAnteriorFisio()" data-dismiss="modal"><?php echo $this->lang->line('btn_aceptar'); ?></button>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-warning {
        color: orange;
    }
</style>


<!-- Modal limite adjuntos superado -->
<div class="modal fade" id="modalLimiteAdjuntosSuperado" name="modalLimiteAdjuntosSuperado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content panel-warning">
            <div class="modal-header panel-heading" id="titl">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><?php echo $this->lang->line('title_limite_adjuntos_superado') ?></b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <h5><i class="fa fa-exclamation-triangle fa-2x icon-warning" aria-hidden="true"></i></h5>
                    </div>              
                    <div class="col-md-11 col-sm-11 col-xs-11">
                        <h5 style="margin-top: 1.2em; margin-left: -1em;">&emsp;<?php echo $this->lang->line('body_limite_adjuntos_superado') ?></h5>
                    </div>              
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="restaurarPacientesAnteriorFisio()" data-dismiss="modal"><?php echo $this->lang->line('btn_aceptar'); ?></button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalErrorAdjuntos" name="modalErrorAdjuntos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content panel-warning">
            <div class="modal-header panel-heading" id="titl">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="titleModalErrorAdjuntos" class="modal-title"><b></b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-1">
                        <h5><i class="fa fa-exclamation-triangle fa-2x icon-warning" aria-hidden="true"></i></h5>
                    </div>              
                    <div class="col-md-11 col-sm-11 col-xs-11">
                        <h5 id="bodyModalErrorAdjuntos" style="margin-top: 1.2em; margin-left: -1em;">&emsp;<?php echo $this->lang->line('body_limite_adjuntos_superado') ?></h5>
                    </div>              
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="restaurarPacientesAnteriorFisio()" data-dismiss="modal"><?php echo $this->lang->line('btn_aceptar'); ?></button>
            </div>
        </div>
    </div>
</div>