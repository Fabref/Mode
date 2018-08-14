<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Formulario Editar Usuario
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
                <?php
            }
        }
        ?>

        <div class="box box-primary">

            <?php echo form_open('Usuario/index/au/' . $data->id_usuario); ?>

            <br>

            <div class="box-body">
                <div class="form-group">

                    <!--   Agrupacion Login, Clave y Cliente asociado  -->
                    <div class="row">

                        <!--   Campo Login   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Login</label>
                            <input name="login" id="login" type="email" 
                                   class="form-control" required
                                   value="<?= $data->login ?>">
                            <br>
                        </div>

                        <!--   Campo Clave   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Clave</label>

                            <input name="clave" id="clave" type="password" 
                                   class="form-control" required>
                            <br>
                        </div>

                        <!--   Campo Cliente   -->
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Cliente</label>

                            <select class="form-control" name="fk_cliente" id="fk_cliente">
                                <?php
                                if (isset($clientes)) {
                                    foreach ($clientes as $cliente) {
                                        ?>
                                        <option value="<?= $cliente->id_cliente ?>" <?php if ($data->fk_cliente == $cliente->id_cliente) { ?> selected="true" <?php } ?>><?= $cliente->nombre ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="<?= $cliente->id_cliente ?>"><?= $cliente->nombre ?></option>
                                <?php } ?>
                            </select>
                            <br>
                        </div>

                    </div>

                    <!--Agrupacion razón social, email y web--> 
                    <div class="row">

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Nombre</label>
                            <input name="nombre" id="nombre" type="text" 
                                   class="form-control" required
                                   value="<?= $data->nombre ?>">
                            <br>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>Apellidos</label>
                            <input name="apellidos" id="apellidos" type="text" 
                                   class="form-control" required
                                   value="<?= $data->apellidos ?>">
                            <br>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <label>E-mail</label>
                            <input name="email" id="email" type="email" 
                                   class="form-control" required
                                   value="<?= $data->email ?>">
                            <br>
                        </div>

                    </div>
                    <br>
                    <br>

                    <!--   Boton 'guardar usuario'  -->
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-6 col-sm-offset-6 col-md-offset-10">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-primary" href="javascript:window.history.back();">Volver</a>
                            <br>
                        </div>                      
                    </div>
                </div>
            </div><!-- /.box-body -->       
        </div><!-- /.box -->
    </section><!-- /.content -->
</div>

