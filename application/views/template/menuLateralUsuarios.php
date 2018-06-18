<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Muestra si el usuario esta seleccionado o no -->        
        <!-- Panel de usuario -->
        <div class="user-panel">
            <?php
            if ($this->session->userdata('idUsuario') == !null) {

                $id_cliente = $this->session->userdata('fk_cliente');
                $login = $this->session->userdata('loginUsuario');
                $nombre = $this->session->userdata('nombreUsuario');
                $apellidos = $this->session->userdata('apellidosUsuario');
                $email = $this->session->userdata('mailUsuario');
                $id_usuario = $this->session->userdata('idUsuario');
                $es_administrador = $this->session->userdata('es_administrador');
                ?>

                <div class="pull-left image">
                    <img src="<?= base_url() ?>dist/img/user_accept.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
                        <?php
                        /* Si el nombre del cliente es muy largo, lo acorta y pone puntos suspensivos al final */
                        $nombreCompleto = $nombre . " " . $apellidos;
                        if (strlen($nombreCompleto) <= 24) {
                            echo $nombreCompleto;
                        } else {
                            echo substr($nombreCompleto, 0, 19) . "...";
                        }
                        ?>
                    </p>    
                    <a href="#"><i class="fa fa-circle text-success"></i> Cliente seleccionado</a>
                </div>

                <?php
            } else {
                ?>
                <div class="pull-left image">
                    <img src="<?= base_url() ?>dist/img/user_delete.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Seleccione un cliente</p>
                    <a href="#"><i class="fa fa-circle text-danger"></i> Cliente no seleccionado</a>
                </div>
                <?php
            }
            ?>

        </div>

        <!-- Menu lateral de opciones -->
        <ul class="sidebar-menu">    
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Campa&ntilde;a</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($es_administrador == 1) { ?>
                        <li><a href="<?= base_url() ?>index.php/Campanya/index/cvcc"><i class="fa fa-plus"></i>Crear nueva campa&ntilde;a</a></li>
                    <?php } ?>
                    <li><a href="<?= base_url() ?>index.php/Campanya/index/cvlc"><i class="fa fa-list"></i>Listar campa&ntilde;as</a></li>
                </ul>
            </li>

            <?php if ($es_administrador == 1) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Usuario</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url() ?>index.php/Usuario/index/cvcu"><i class="fa fa-plus"></i>Crear nuevo usuario</a></li>
                        <li><a href="<?= base_url() ?>index.php/Usuario/index/cvlu"><i class="fa fa-list"></i>Listar usuarios</a></li> 
                    </ul>
                </li>
            <?php } ?>
        </ul>

    </section>
</aside>