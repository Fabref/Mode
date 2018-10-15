
<?php echo form_open('Login/comprobarLogin'); ?>

<div class="login-box">
    
    <div class="login-logo">
        <img src="<?= base_url() ?>dist/img/logotras.png" >
        <br>
        <p><b>MODE 
            </b>
        </p>
    </div>
    
    <div class="login-box-body">
        <p class="login-box-msg">Iniciar sesi&oacute;n para comenzar</p>

        <!-- DNI -->
        <div class="form-group has-feedback">
            <input type="email" id="mail" name="mail" class="form-control" placeholder="Email">
            <span class="fa fa-at form-control-feedback"></span>
        </div>
        
        <!-- Contraseña -->
        <div class="form-group has-feedback">
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
            <span class="fa fa-lock form-control-feedback"></span>
        </div>
        
        <!-- Boton iniciar sesion -->
        <div class="form-group has-feedback">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar sesi&oacute;n</button>
        </div>

  <?php 
        $mensajeError = $this->session->flashdata('mensajeErrorLogin');
        if (isset($mensajeError)) { ?>
            <div class="alert alert-danger alert-dismissable">
                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                <label><i class="icon fa fa-ban"></i> <?= $mensajeError ?></label>
            </div>
  <?php } ?>
        <?php 
        $mensajeLogin = $this->session->flashdata('mensajeLogin');
        if (isset($mensajeLogin)) { ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <label><i class="icon fa fa-warning"></i> <?= $mensajeLogin ?></label>
            </div>
  <?php } ?>

        <br>
        <center><a href="<?= base_url() ?>index.php/Recovery/index/cvsrc">¿Ha olvidado la contrase&ntilde;a?</a><br></center>
        
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

