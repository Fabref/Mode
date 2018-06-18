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

            $this->session->set_flashdata('mensajeLogin', $this->lang->line('msg_session_expirada'));
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('Cliente_model');
            $this->load->model('General_model');
            $this->load->model('Campanya_model');
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
            
            case 'cvlc': /* Carga la vista listar clientes */
                $this->listarClientes();
                break;
            
            case 'selc': /* Seleccionar cliente */
                $this->seleccionarCliente($complementario);
                break;
            
            case 'carc': /* Carga la vista del cliente seleccionado */
                $this->cargarVistaDatosCliente($complementario);
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

        $idcliente = $this->Cliente_model->insertarCliente($cliente);
        
        if ($idcliente == null) {
            $this->session->set_flashdata('mensaje', "No se ha creado correctamente el cliente");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se ha creado correctamente el cliente");
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

        /* Actualiza las variables de sesion con los datos del paciente */
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
        
        $this->load->view('menuPrincipal/menuPrincipal',$datos);
        $this->load->view('template/footer');
    }
    
}
