<?php echo form_open('Recovery/validarDNIAdministrador'); ?>

<div class="login-box">
    
    <div class="login-logo">
        <a href="<?= base_url() ?>index.php">
        </a>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading box-title" style="font-size:18px;letter-spacing:0.025em;line-height:23px;color:#009b82;font-family:'Poppins',sans-serif">
            Recuperar password
        </div>
        
        <div class="panel-body">
            
            <!-- div con el campo del dni -->
            <div id="divNif">
                
                <!-- Mensaje introducir nuevo password -->
                <p>Recuperar password</p>

                <!-- Campo email -->  
                <div class="form-group">
                    <div class="form-group has-feedback">
                        <input type="email" id="emailRecuperarPass" name="emailRecuperarPass" class="form-control" required placeholder="Email">
                        <span class="fa fa-at form-control-feedback"></span>
                    </div>
                </div>
            
            </div>
            
            <!-- Mensaje respuesta -->
            <div id="respuestaRecuperarPassword"></div>

            <!-- Boton recuperar password -->
            <div id='divBotonRecuperar'>
                <button id="restaurarPassword" type="button" class="btn btn-primary pull-right">Recuperar password</button>
            </div>

            <!-- Boton volver -->
            <div id='divBotonVolver'>
                <a id="linkVolverMP" href="<?= base_url() ?>index.php" class="btn btn-primary">Volver</a>
            </div>
        
        </div>
    </div>
  
</div>

<?php echo form_close(); ?>

