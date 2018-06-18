<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $this->lang->line('msg_contacto'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small Boxes -->

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-envelope"></i>

                        <h3 class="box-title"><?php echo $this->lang->line('msg_formulario_de_contacto'); ?></h3>

                    </div>
                    
                    <?php
                    if (isset($tipoMensaje)) {
                        if ($tipoMensaje == MENSAJE_REALIZADO_OK) {
                            ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-success alert-dismissable">
                                            <label><i class="icon fa fa-check"></i><?= $mensaje ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="alert alert-danger alert-dismissable">
                                            <label><i class="icon fa fa-warning"></i><?= $mensaje ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm">
                                        <?php
                                        $attributes = array('class' => "form-horizontal");
                                        echo form_open('General/index/envc', $attributes);
                                        ?>
                                        <fieldset>
                                            <legend class="text-center header"><?php echo $this->lang->line('msg_contacte'); ?></legend>

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user fa-3x"></i></span>
                                                <div class="col-md-9">
                                                    <input id="nombre" name="nombre" type="text" placeholder="<?php echo $this->lang->line('msg_nombre'); ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user fa-3x"></i></span>
                                                <div class="col-md-9">
                                                    <input id="apellidos" name="apellidos" type="text" placeholder="<?php echo $this->lang->line('msg_apellidos'); ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-envelope-o fa-3x"></i></span>
                                                <div class="col-md-9">
                                                    <input id="email" name="email" type="email" placeholder="<?php echo $this->lang->line('msg_email'); ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-phone-square fa-3x"></i></span>
                                                <div class="col-md-9">
                                                    <input id="telefono" name="telefono" type="text" placeholder="<?php echo $this->lang->line('msg_telefono'); ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-question fa-3x"></i></span>
                                                <div class="col-md-9">
                                                    <input id="asunto" name="asunto" type="text" placeholder="<?php echo $this->lang->line('msg_asunto'); ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-pencil-square-o fa-3x"></i></span>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" id="mensaje" name="mensaje" placeholder="<?php echo $this->lang->line('msg_texto_consulta'); ?>" rows="7" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-primary btn-lg"><?php echo $this->lang->line('btn_enviar'); ?></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="box-footer clearfix">
                                            <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                                                <i class="fa fa-arrow-circle-right"></i></button>
                                        </div>-->
                </div>
            </div>
        </div> <!-- /.row -->
    </section>
</div> <!-- /.content-wrapper -->

