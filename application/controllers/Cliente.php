<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Campaña
 *
 * @author Gabriel Fuertes
 */
class Cliente extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("dniUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', "La sesión ha expirado");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('Cliente_model');
            $this->load->model('General_model');
            $this->load->model('Campanya_model');
            $this->load->model('Usuario_model');
        }
    }

    /**
     * Función index que redirige al resto de funciones del cliente en 
     * base al parámetro indicado por la variable acción
     * 
     * @param string $accion
     */
    public function index($accion = FALSE, $complementario = FALSE, $complementario1 = FALSE) {

        switch ($accion) {

            /* Perfil cliente */
            case 'cvcc': /* Carga la vista crear cliente */
                $this->cargarCrearCliente();
                break;

            case 'cc': /* Crea el cliente */
                $this->crearCliente();
                break;

            case 'ac': /* Actualiza el cliente */
                $this->actualizaCliente($complementario);
                break;

            case 'cvlc': /* Carga la vista listar clientes */
                $this->listarClientes();
                break;

            case 'selc': /* Seleccionar cliente */
                $this->seleccionarCliente($complementario);
                break;

            case 'carc': /* Carga la vista del cliente seleccionado */
                $this->cargarVistaDatosCliente($complementario);
                break;

            case 'cvec': /* Carga la vista del cliente a editar */
                $this->cargarVistaEditarCliente($complementario);
                break;

            default : /* No ejecutamos nada de momento */

                break;
        }
    }

    /**
     * Funcion para cargar la vista con el formulario para crear un nuevo cliente.
     */
    private function cargarCrearCliente() {

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('cliente/crearCliente');
        $this->load->view('template/footer');
    }

    /**
     * Función para crear un nuevo cliente. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function crearCliente() {

        $cliente['nombre'] = $this->input->post('nombre', TRUE);
        $cliente['nif'] = $this->input->post('nif', TRUE);
        $cliente['razonSocial'] = $this->input->post('rs', TRUE);
        $cliente['email'] = $this->input->post('email', TRUE);
        $cliente['web'] = $this->input->post('web', TRUE);

        /*
         * Datos del usuario Administrador del cliente
         */
        $usuario['login'] = $this->input->post('login', TRUE);
        $clave = $this->input->post('clave', TRUE);
        $usuario['clave'] = password_hash($clave, PASSWORD_DEFAULT);
        $usuario['nombre'] = $this->input->post('nombreUsuario', TRUE);
        $usuario['apellidos'] = $this->input->post('apellidos', TRUE);
        $usuario['email'] = $this->input->post('login', TRUE);
        $usuario['es_administrador'] = 1;


        /*
         * Configuracion subida archivos.
         */
        $config['upload_path'] = './LogosClientes/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_ext_tolower'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 20048;
        $config['max_width'] = 10920;
        $config['max_height'] = 10280;

        /*
         * Carga de la libreria
         */
        $this->load->library('upload', $config);

        $fichero = "logo";

        /*
         * Carga de ficheros
         */
        if (!empty($fichero)) {
            if (!$this->upload->do_upload($fichero)) {
                $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
                $this->session->set_flashdata('mensaje', $this->upload->display_errors());
                //echo $this->upload->display_errors();
                redirect('Cliente/index/cvlc', 'refresh');
                $cliente['logo'] = '';
            } else {
                $full_path = $this->upload->data();
                $cliente['logo'] = $full_path['file_name'];

                /*
                 * Tratamiento de la imagen
                 */
                $config['image_library'] = 'gd2';
                $config['source_image'] = $full_path['full_path'];
                $config['new_image'] = './LogosClientes/thumbs/' . $full_path['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 155;
                $config['height'] = 100;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
            }
        } else {
            $cliente['logo'] = '';
        }


        $idcliente = $this->Cliente_model->insertarCliente($cliente);


        if ($idcliente == null) {
            $this->session->set_flashdata('mensaje', "No se ha creado correctamente el cliente");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {

            $usuario['fk_cliente'] = $idcliente;

            $existe = $this->Usuario_model->existeUsuario($usuario['login']);

            if (empty($existe)) {
                $idusuario = $this->Usuario_model->insertarUsuario($usuario);

                if ($idusuario == null) {
                    $this->session->set_flashdata('mensaje', "No se ha creado correctamente el usuario");
                    $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
                } else {
                    $this->session->set_flashdata('mensaje', "Se ha creado correctamente el usuario y el cliente");
                    $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
                }
            } else {
                $this->session->set_flashdata('mensaje', "No se ha podido crear el usuario.<br>Ya existe un usuario con ese login en el sistema");
                $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
            }
        }
        redirect('Cliente/index/cvlc', 'refresh');
    }

    /**
     * Función para crear un nuevo cliente. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function actualizaCliente($idcliente) {

        $data = $this->Cliente_model->cargarCliente($idcliente);

        $cliente['nombre'] = $this->input->post('nombre', TRUE);
        $cliente['nif'] = $this->input->post('nif', TRUE);
        $cliente['razonSocial'] = $this->input->post('rs', TRUE);
        $cliente['email'] = $this->input->post('email', TRUE);
        $cliente['web'] = $this->input->post('web', TRUE);

        /*
         * Configuracion subida archivos.
         */
        $config['upload_path'] = './LogosClientes/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_ext_tolower'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = 2048;
        $config['max_width'] = 1920;
        $config['max_height'] = 1280;

        /*
         * Carga de la libreria
         */
        $this->load->library('upload', $config);

        $fichero = "logo";

        if (!empty($fichero)) {
            unlink('./LogosClientes/' . $data->logo);
            unlink('./LogosClientes/thumbs/' . $data->logo);
        }

        /*
         * Carga de ficheros
         */
        if (!$this->upload->do_upload($fichero)) {
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
            $this->session->set_flashdata('mensaje', $this->upload->display_errors());
            //echo $this->upload->display_errors();
            redirect('Cliente/index/cvec/' . $idcliente, 'refresh');
            $cliente['logo'] = '';
        } else {
            $full_path = $this->upload->data();
            $cliente['logo'] = $full_path['file_name'];

            /*
             * Tratamiento de la imagen
             */
            $config['image_library'] = 'gd2';
            $config['source_image'] = $full_path['full_path'];
            $config['new_image'] = './LogosClientes/thumbs/' . $full_path['file_name'];
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 155;
            $config['height'] = 100;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
        }

        $update = $this->Cliente_model->actualizarCliente($cliente, $idcliente);

        if (!$update) {
            $this->session->set_flashdata('mensaje', "No se ha actualizado correctamente el cliente");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se ha actualizado correctamente el cliente");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        }
        redirect('Cliente/index/cvlc', 'refresh');
    }

    /**
     * Función que carga la vista del listado de clientes
     */
    private function listarClientes() {

        $data['clientes'] = $this->Cliente_model->getClientes();

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('cliente/listarClientes', $data);
        $this->load->view('template/footer');
    }

    /**
     * Selecciona el cliente por el usuario. Hecho para mostrar por flash data
     * el mensaje de que ha sido seleccionado.
     * 
     * @param type $idCliente
     */
    private function seleccionarCliente($idCliente) {
        $this->session->set_flashdata('mensaje', "Paciente seleccionado correctamente");

        redirect('Cliente/index/carc/' . $idCliente, 'refresh');
    }

    /**
     * Carga la vista con los datos personales del cliente
     * 
     * @param type $idcliente
     */
    private function cargarVistaDatosCliente($idcliente) {
        $data = $this->Cliente_model->cargarCliente($idcliente);

        $cliente['id_cliente'] = $data->id_cliente;
        $cliente['nombre'] = $data->nombre;
        $cliente['nif'] = $data->nif;
        $cliente['razonSocial'] = $data->razonSocial;
        $cliente['email'] = $data->email;
        $cliente['web'] = $data->web;
        $cliente['logo'] = $data->logo;

        /* Actualiza las variables de sesion con los datos del cliente */
        $this->session->set_userdata('id_cliente', $cliente['id_cliente']);
        $this->session->set_userdata('nombreCliente', $cliente['nombre']);
        $this->session->set_userdata('nifCliente', $cliente['nif']);
        $this->session->set_userdata('razonSocialCliente', $cliente['razonSocial']);
        $this->session->set_userdata('emailCliente', $cliente['email']);
        $this->session->set_userdata('webCliente', $cliente['web']);

        $datos['num_camp'] = sizeof($this->Campanya_model->getCampañas());
        $datos['num_cli'] = sizeof($this->Cliente_model->getClientes());

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');

        $this->load->view('menuPrincipal/menuPrincipal', $datos);
        $this->load->view('template/footer');
    }

    /**
     * Carga la vista con los datos personales del cliente
     * para poder ser editados
     * 
     * @param type $idcliente
     */
    private function cargarVistaEditarCliente($idcliente) {
        $data = $this->Cliente_model->cargarCliente($idcliente);

        $cliente['id_cliente'] = $data->id_cliente;
        $cliente['nombre'] = $data->nombre;
        $cliente['nif'] = $data->nif;
        $cliente['razonSocial'] = $data->razonSocial;
        $cliente['email'] = $data->email;
        $cliente['web'] = $data->web;
        $cliente['logo'] = $data->logo;

        /* Actualiza las variables de sesion con los datos del cliente */
        $this->session->set_userdata('id_cliente', $cliente['id_cliente']);
        $this->session->set_userdata('nombreCliente', $cliente['nombre']);
        $this->session->set_userdata('nifCliente', $cliente['nif']);
        $this->session->set_userdata('razonSocialCliente', $cliente['razonSocial']);
        $this->session->set_userdata('emailCliente', $cliente['email']);
        $this->session->set_userdata('webCliente', $cliente['web']);

        $datos['num_camp'] = sizeof($this->Campanya_model->getCampañas());
        $datos['num_cli'] = sizeof($this->Cliente_model->getClientes());
        $datos['data'] = $data;

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('cliente/editarCliente', $datos);
        $this->load->view('template/footer');
    }

}
