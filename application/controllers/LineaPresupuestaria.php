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
class LineaPresupuestaria extends CI_Controller{
    
    function __construct() {
        parent::__construct();

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("dniUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', "La sesión ha expirado");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('Linea_model');
            $this->load->model('General_model');
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

            /* Perfil Linea */
            case 'cvcl': /* Carga la vista crear linea en la que se le pasa el id de la campaña */
                $this->cargarCrearLinea($complementario);
                break;

            case 'cl': /* Crea el linea para la campaña establecida en el complementario */
                $this->crearLinea($complementario);
                break;
            
            default : /* No ejecutamos nada de momento */

                break;
        }
    }
    
    /**
     * Funcion para cargar la vista con el formulario para crear una nueva linea.
     */
    private function cargarCrearLinea($fk_campana) {

        $data['fk_campana'] = $fk_campana;
        
        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('linea/crearLinea', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función para crear una nueva linea. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function crearLinea($fk_campana) {

        $linea['nombre'] = $this->input->post('nombre', TRUE);
        $linea['descripcion'] = $this->input->post('descripcion', TRUE);
        $linea['fk_campana'] = $fk_campana;

        $idlinea = $this->Linea_model->insertarLinea($linea);
        
        if ($idlinea == null) {
            $this->session->set_flashdata('mensaje', "No se ha creado correctamente la linea");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se ha creado correctamente la linea");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        }
        redirect('Campanya/index/cvec/' . $fk_campana, 'refresh');
    }
}
