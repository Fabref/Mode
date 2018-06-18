<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Usuario
 *
 * @author Gabriel Fuertes
 */
class Usuario extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("mailUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', $this->lang->line('msg_session_expirada'));
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('Campanya_model');
            $this->load->model('Cliente_model');
            $this->load->model('Linea_model');
            $this->load->model('Aspecto_model');
            $this->load->model('ItemVariable_model');
            $this->load->model('General_model');
            $this->load->model('AspectoTieneLinea_model');
            $this->load->model('Usuario_model');
        }
    }

    /**
     * Función principal que deriva al resto de métodos de la clase Usuario
     * 
     * @param string $accion Abreviatura con la acción a realizar
     */
    public function index($accion) {
        switch ($accion) {

            /* Perfil usuario */
            case 'mp': /* Carga el menú principal del usuario */
                $this->cargarMenuPrincipal();
                break;

            case 'cvcu': /* Carga la vista crear usuario */
                $this->cargarCrearUsuario();
                break;

            case 'cvvu': /* Carga la vista ver usuario */
                $this->verUsuario($complementario);
                break;

            case 'cu': /* Crea usuario */
                $this->crearUsuario();
                break;

            case 'cvlu': /* Carga la vista listar usuarios */
                $this->listarUsuarios();
                break;

            default : /* No ejecutamos nada de momento */

                break;
        }
    }

    /**
     * Función que carga el menú principal del usuario, en el que se mostrarán 
     * las campañas creadas y los usuarios
     */
    private function cargarMenuPrincipal() {
        $data['num_camp'] = sizeof($this->Campanya_model->getCampañasCliente($this->session->idUsuario));
        $data['num_usu'] = sizeof($this->Usuario_model->getUsuarios());

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateralUsuarios');
        $this->load->view('menuPrincipal/menuPrincipalUsuario', $data);
        $this->load->view('template/footer');
        $this->load->view('template/closePage');
    }

    /**
     * Función que carga la vista del formulario de crear un usuario
     */
    private function cargarCrearUsuario() {

//        if (!empty($this->session->userdata('id_cliente'))) {
//            $this->load->view('template/menuSuperior');
//            $this->load->view('template/menuLateral');
//            $this->load->view('campanya/crearCampanya');
//            $this->load->view('template/footer');
//        } else {
//            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);
//            $this->session->set_flashdata('mensaje', "No puede crear una nueva campaña sin previamente haber seleccionado un cliente");
//
//            redirect('Cliente/index/cvlc', 'refresh');
//        }

        if (!empty($this->session->userdata('loginUsuario'))) {
            $cliente = $this->Cliente_model->cargarCliente($this->session->userdata('id_cliente'));
            $data['cliente'] = $cliente;
        } else {
            $data['clientes'] = $this->Cliente_model->getClientes();
        }

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('usuario/crearUsuario', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función para crear un nuevo usuario. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function crearUsuario() {

        $usuario['login'] = $this->input->post('login', TRUE);
        $clave = $this->input->post('clave', TRUE);
        $usuario['clave'] = password_hash($clave, PASSWORD_DEFAULT);
        $usuario['nombre'] = $this->input->post('nombre', TRUE);
        $usuario['apellidos'] = $this->input->post('apellidos', TRUE);
        $usuario['email'] = $this->input->post('email', TRUE);
        $usuario['fk_cliente'] = $this->input->post('fk_cliente', TRUE);

        if (empty($this->session->userdata('loginUsuario'))) {
            $usuario['es_administrador'] = 1;
            $usuario['puede_editar'] = 1;
            $usuario['puede_consultar'] = 1;
        } else {
            $usuario['es_administrador'] = 0;
            $puede_editar = $this->input->post('puede_editar', TRUE);
            if (empty($puede_editar)) {
                $puede_editar = 0;
            }
            $puede_consultar = $this->input->post('puede_consultar', TRUE);
            if (empty($puede_consultar)) {
                $puede_consultar = 0;
            }
            $usuario['puede_editar'] = $puede_editar;
            $usuario['puede_consultar'] = $puede_consultar;
        }

        $existe = $this->Usuario_model->existeUsuario($usuario['login']);

        if (empty($existe)) {
            $idusuario = $this->Usuario_model->insertarUsuario($usuario);

            if ($idusuario == null) {
                $this->session->set_flashdata('mensaje', "No se ha creado correctamente el usuario");
                $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
            } else {
                $this->session->set_flashdata('mensaje', "Se ha creado correctamente el usuario");
                $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
            }
        } else {
            $this->session->set_flashdata('mensaje', "No se ha podido crear el usuario.<br>Ya existe un usuario con ese login en el sistema");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        }
        redirect('Usuario/index/cvlu', 'refresh');
    }

    /**
     * Función que carga la vista del listado de usuarios
     */
    private function listarUsuarios() {

        $data['usuarios'] = $this->Usuario_model->getUsuarios();

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('usuario/listarUsuarios', $data);
        $this->load->view('template/footer');
    }

}
