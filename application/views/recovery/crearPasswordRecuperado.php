<?php

    $mensaje = $this->session->flashdata('mensaje');
    $tipoMensaje = $this->session->flashdata('tipoMensaje');
    
?>

<?php echo form_open('Recovery/index/rc'); ?>

<div class="login-box">
    
    <div class="login-logo">
        <a href="<?= base_url() ?>index.php">
            <img src="<?= base_url() ?>dist/img/logotras.png" >
        </a>
    </div>
    
    <div class="panel panel-default">
        
        <div class="panel-heading box-title" style="font-size:18px;letter-spacing:0.025em;line-height:23px;color:#009b82;font-family:'Poppins',sans-serif">
            <?php echo $this->lang->line('msg_nuevo_password'); ?>
        </div>
        
        <div class="panel-body">
            
            <div id="divNuevoPassARecuperar">
                
                <!-- Mensaje introducir nuevo password -->
                <p><?php echo $this->lang->line('msg_introducir_nuevo_password') . ":"; ?></p>

                <!-- Password nuevo 1 -->
                <div class="form-group has-feedback">
                    <input type="password" id="passwordNuevo1" name="passwordNuevo1" required class="form-control" placeholder="<?php echo $this->lang->line('msg_password_nuevo'); ?>">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>

                <!-- Password nuevo 2 -->
                <div class="form-group has-feedback">
                    <input type="password" id="passwordNuevo2" name="passwordNuevo2" required class="form-control" placeholder="<?php echo $this->lang->line('msg_repite_password_nuevo'); ?>">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                
                <!-- input oculto para el token -->
                <div class="form-group has-feedback">
                    <input type="password" id="token" name="token" class="form-control hidden" value="<?php echo $token; ?>">
                </div>
                
            </div>
            
            <!-- Mensaje respuesta -->
            <div id="respuestaConfirmarPassword"></div>

            <!-- Boton confirmar password -->
            <div id='divBotonConfirmar'>
                <button id="confirmarPassword" type="button" class="btn btn-primary pull-right"><?php echo $this->lang->line('btn_confirmar'); ?></button>
            </div>
            
            <!-- Boton aceptar el cambio para volver al menu principal -->
            <div id='divBotonAceptar' class="hidden">
                <a id="linkAceptarVolverMP" href="<?= base_url() ?>index.php" class="btn btn-primary pull-right"><?php echo $this->lang->line('btn_aceptar'); ?></a>
            </div>

        </div><!-- ./panel-body -->
    </div><!-- ./panel-default -->
</div><!-- /.login-box -->
