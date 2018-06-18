<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Item Variable
 *
 * @author Gabriel Fuertes
 */
class ItemVariable extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("dniUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', $this->lang->line('msg_session_expirada'));
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('ItemVariable_model');
            $this->load->model('General_model');
            $this->load->model('Aspecto_model');
        }
    }
    
    /**
     * Función index que redirige al resto de funciones de la Linea en 
     * base al parámetro indicado por la variable acción
     * 
     * @param string $accion
     */
    public function index($accion = FALSE, $complementario = FALSE, $complementario1 = FALSE) {

        switch ($accion) {

            /* Perfil Item */
            case 'cvci': /* Carga la vista crear item en la que se le pasa el id de la campaña */
                $this->cargarCrearItem($complementario);
                break;

            case 'ci': /* Crea el item para la campaña establecida en el complementario */
                $this->crearItem($complementario);
                break;
            
            default : /* No ejecutamos nada de momento */

                break;
        }
    }
    
    /**
     * Funcion para cargar la vista con el formulario para crear un nuevo Item Variable.
     */
    private function cargarCrearItem($fk_campana) {

        $data['fk_campana'] = $fk_campana;
        $data['aspectos'] = $this->Aspecto_model->getAspectosCampaña($fk_campana);
        
        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('ItemVariable/crearItem', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función para crear una nueva linea. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function crearItem($fk_campana) {

        $item['nombre'] = $this->input->post('nombre', TRUE);
        $item['descripcion'] = $this->input->post('descripcion', TRUE);
        $item['orden'] = $this->input->post('orden', TRUE);
        $item['fk_campana'] = $fk_campana;
        $item['fk_aspecto'] = $this->input->post('fk_aspecto', TRUE);

        $idItem = $this->ItemVariable_model->insertarItem($item);
        
        if ($idItem == null) {
            $this->session->set_flashdata('mensaje', "No se ha creado correctamente el item");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se ha creado correctamente item");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        }
        
        redirect('Campanya/index/cvec/' . $fk_campana, 'refresh');
        
        if (!empty($enviar)) {
            redirect('Campanya/index/cvec/' . $fk_campana, 'refresh');
        } else {
            redirect('ItemVariable/index/cvci/' . $fk_campana, 'refresh');
        }
    }
}
