<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Aspecto
 *
 * @author Gabriel Fuertes
 */
class Aspecto extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("dniUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', "La sesión ha expirado");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('Aspecto_model');
            $this->load->model('Linea_model');
            $this->load->model('General_model');
            $this->load->model('AspectoTieneLinea_model');
            $this->load->model('Campanya_model');
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
            case 'cvca': /* Carga la vista crear aspecto en la que se le pasa el id de la campaña */
                $this->cargarCrearAspecto($complementario);
                break;

            case 'ca': /* Crea el aspecto para la campaña establecida en el complementario */
                $this->crearAspecto($complementario);
                break;

            case 'cvapa': /* Añade linea nueva al aspecto para la campaña establecida en el complementario y al aspecto con complementario1 */
                $this->cargarAñadirPartidaAspecto($complementario, $complementario1);
                break;

            case 'gla': /* guarda la linea nueva al aspecto ya creado */
                $this->guardarLineaAspecto($complementario, $complementario1);
                break;

            case 'cvllpa': /* carga la vista del listado de lineas presupuestarias del aspecto */
                $this->cargarListaLineasPresupuestariasAspectos($complementario);
                break;

            default : /* No ejecutamos nada de momento */

                break;
        }
    }

    /**
     * Funcion para cargar la vista con el formulario para crear un nuevo aspecto.
     */
    private function cargarCrearAspecto($fk_campana) {

        $data['fk_campana'] = $fk_campana;

        $data['lineas'] = $this->Linea_model->getLineasCampaña($fk_campana);

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('aspecto/crearAspecto', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función para crear un nuevo aspecto. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function crearAspecto($fk_campana) {

        $aspecto['nombre'] = $this->input->post('nombre', TRUE);
        $aspecto['descripcion'] = $this->input->post('descripcion', TRUE);
        $aspecto['fk_campana'] = $fk_campana;

        $idaspecto = $this->Aspecto_model->insertarAspecto($aspecto);

        if ($idaspecto == null) {
            $this->session->set_flashdata('mensaje', "No se ha creado correctamente el aspecto");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se ha creado correctamente el aspecto");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        }

        redirect('Campanya/index/cvec/' . $fk_campana, 'refresh');
    }

    /**
     * Cargo la vista de añadir más lineas al aspecto de una campaña
     * 
     * @param type $fk_campana
     * @param type $fk_aspecto
     */
    public function cargarAñadirPartidaAspecto($fk_campana, $fk_aspecto) {
        $data['fk_campana'] = $fk_campana;
        $data['fk_aspecto'] = $fk_aspecto;

        $data['lineas'] = $this->Linea_model->getLineasCampaña($fk_campana);
        $data['aspecto'] = $this->Aspecto_model->getAspecto($fk_aspecto);

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('aspecto/crearLineaAspecto', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función para crear un nuevo aspecto. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function guardarLineaAspecto($fk_campana, $fk_aspecto) {

        $importe = $this->input->post('importe', TRUE);

        $aspectoTieneLinea['fk_linea_presupuestaria'] = $this->input->post('fk_linea_presupuestaria', TRUE);

        $enviar = $this->input->post('enviar', TRUE);

        $aspectoTieneLinea['fk_aspecto'] = $fk_aspecto;
        $aspectoTieneLinea['importe'] = $importe;

        $id = $this->AspectoTieneLinea_model->insertarAspectoTieneLinea($aspectoTieneLinea);

        if ($id == null) {
            $this->session->set_flashdata('mensaje', "No se ha asociado correctamente la linea presupuestaria al aspecto");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se ha creado correctamente la linea presupuestaria al aspecto");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        }

        if (!empty($enviar)) {
            redirect('Campanya/index/cvec/' . $fk_campana, 'refresh');
        } else {
            redirect('Aspecto/index/cvapa/' . $fk_campana . '/' . $fk_aspecto, 'refresh');
        }
    }

    /**
     * Cargamos la vista de las lineas presupuestarias asociadas al aspecto
     * 
     * @param type $idaspecto El identificador del aspecto que queremos conocer sus lineas
     * 
     */
    private function cargarListaLineasPresupuestariasAspectos($idaspecto) {
        $lineas = $this->AspectoTieneLinea_model->getLineasAspecto($idaspecto);

        $lineasP = array();
        $aspectos = array();

        if ($lineas > 0) {
            foreach ($lineas as $linea) {
                $linea = $this->Linea_model->getLineaPresupuestaria($linea->fk_linea_presupuestaria);
                array_push($lineasP, $linea->nombre);
                $aspecto = $this->Aspecto_model->getAspecto($idaspecto);
                array_push($aspectos, $aspecto->nombre);
            }
        } else {
            $aspecto = $this->Aspecto_model->getAspecto($idaspecto);
            array_push($aspectos, $aspecto->nombre);
        }

        $data['lineas'] = $lineas;
        $data['lineaP'] = $lineasP;
        $data['aspecto'] = $aspectos;
        $data['idcampanya'] = $aspecto->fk_campana;
        $data['estado'] = $this->Campanya_model->getEstado($aspecto->fk_campana);

        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('aspecto/listarLineasAspecto', $data);
        $this->load->view('template/footer');
    }

}
