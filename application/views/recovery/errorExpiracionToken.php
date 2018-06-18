
<div class="login-box">
    
    <div class="login-logo">
        <a href="<?= base_url() ?>index.php">
            <img src="<?= base_url() ?>dist/img/logotras.png" >
        </a>
    </div>
    
    <div class="panel panel-default">
        
        <div class="panel-heading box-title" style="font-size:18px;letter-spacing:0.025em;line-height:23px;color:#009b82;font-family:'Poppins',sans-serif">
            <?php echo $this->lang->line('msg_periodo_expirado'); ?>
        </div>
        
        <div class="panel-body">
            
            <p class="text-red text-justified">
                <b>
                    <i class="icon fa fa-ban"></i>
                    &nbsp;&nbsp;<?php echo $mensajeErrorRecuperacion; ?>
                    <br>
                    <?php echo $this->lang->line('msg_iniciar_nueva_recuperacion'); ?>
                </b>
            </p>
            
            <br>
            
            <!-- Boton recuperar password -->
            <div id='divBotonRecuperar'>
                <a id="recuperarPassTokenExpirado" href="<?= base_url() ?>index.php/recovery/index/cvsrc" class="btn btn-primary pull-right"><?php echo $this->lang->line('msg_recuperar_password'); ?></a>
            </div>
            
             <!-- enlace para obtener la url del login cuando pase 1 minuto desde q se muestra el mnsaje de token expirado --> 
            <div id='divBotonVolver' class="hidden">
                <a id="linkVolverMPTE" href="<?= base_url() ?>index.php" class="btn btn-primary"><?php echo $this->lang->line('btn_volver'); ?></a>
            </div>

        </div><!-- ./panel-body -->
    </div><!-- ./panel-default -->
</div><!-- /.login-box -->
