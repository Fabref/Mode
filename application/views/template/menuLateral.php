<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Muestra si el usuario esta seleccionado o no -->        
        <!-- Panel de usuario -->
        <div class="user-panel">
            <?php
            if ($this->session->userdata('id_cliente') == !null) {

                $id_cliente = $this->session->userdata('id_Cliente');
                $nombre = $this->session->userdata('nombreCliente');
                $nif = $this->session->userdata('nifCliente');
                $razonSocial = $this->session->userdata('razonSocialCliente');
                $email = $this->session->userdata('emailCliente');
                $web = $this->session->userdata('webCliente');
                ?>

                <div class="pull-left image">
                    <img src="<?= base_url() ?>dist/img/user_accept.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
                        <?php
                        /* Si el nombre del cliente es muy largo, lo acorta y pone puntos suspensivos al final */
                        $nombreCompleto = $nombre . " " . $razonSocial;
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
                <a href="<?= base_url() ?>index.php/General/index/mp">
                    <i class="fa fa-home"></i> <span>Inicio</span></i>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Campa&ntilde;a</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/Campanya/index/cvcc"><i class="fa fa-plus"></i>Crear nueva campa&ntilde;a</a></li>
                    <li><a href="<?= base_url() ?>index.php/Campanya/index/cvlc"><i class="fa fa-list"></i>Listar campa&ntilde;as</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/Cliente/index/cvcc"><i class="fa fa-plus"></i>Crear nuevo cliente</a></li>
                    <li><a href="<?= base_url() ?>index.php/Cliente/index/cvlc"><i class="fa fa-list"></i>Listar clientes</a></li> 
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/Usuario/index/cvcu"><i class="fa fa-plus"></i>Crear nuevo usuario</a></li>
                    <li><a href="<?= base_url() ?>index.php/Usuario/index/cvlu"><i class="fa fa-list"></i>Listar usuarios</a></li> 
                </ul>
            </li>

            <li class="header">Informaci&oacute;n General</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-phone"></i> <span>Contacto</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/General/index/ct"><i class="fa fa-envelope"></i> Formulario de contacto</a></li>
                </ul>
            </li>
        </ul>

    </section>
</aside>