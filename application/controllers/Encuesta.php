<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Encuesta
 *
 * @author fabre
 */
class Encuesta extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Campanya_model');
        $this->load->model('ItemVariable_model');
        $this->load->model('Cuestionario_model');
        $this->load->model('RespuestaVariable_model');
    }

    /**
     * Función index que redirige al resto de funciones de la Linea en 
     * base al parámetro indicado por la variable acción
     * 
     * @param string $accion
     */
    public function index($accion = FALSE, $complementario = FALSE, $complementario1 = FALSE) {

        switch ($accion) {

            /* Perfil Encuesta */
            case 'cvce': /* Carga la vista del formulario de la encuesta */
                $this->cargarEncuesta($complementario, $complementario1);
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

            case 'grc': /* Guarda las respuestas de la campaña */
                $this->guardarRespuestasCampaña($complementario, $complementario1);
                break;

            default : /* No ejecutamos nada de momento */
                $this->load->view('template/encuesta/header');
                $this->load->view('template/encuesta/body');
                $this->load->view('template/encuesta/footer');
                break;
        }
    }

    /**
     * Función que recibe el identificador de la encuesta y su token para cargar
     * el formulario con los items creados en la zona de administración
     * 
     * @param int $idcampanya El identificador de la campaña
     * @param string $token El token único que se genera al crear la campaña
     * 
     */
    private function cargarEncuesta($idcampanya, $token) {

        $campanya = $this->Campanya_model->getCampaña($idcampanya);



        /*
         * Si existe la campaña, su token coincide y está abierta cargamos los Item de la encuesta
         * 
         * En caso contrario mostraremos la página de error
         */
        if (isset($campanya) && ($token == $campanya->url) && ($campanya->estado == 2)) {

            $items = $this->ItemVariable_model->getItemsCampaña($idcampanya);

            $data['campanya'] = $campanya;
            $data['items'] = $items;

            $this->load->view('template/encuesta/header');
            $this->load->view('template/encuesta/body', $data);
            $this->load->view('template/encuesta/footer');
        } else {
            redirect('My404', 'refresh');
        }
    }

    /**
     * Función que guardará los resultados de campaña tras comprobar que el correo 
     * electrónico introducido no ha realizado ya la encuesta
     * 
     * @param int $id_campana El identificador de la campaña
     */
    private function guardarRespuestasCampaña($id_campana, $token) {
        $listaParametrosPost = $this->input->post();

        $email = $listaParametrosPost['email'];

        if ($this->Cuestionario_model->compruebaEmail($id_campana, $email)) {
            $this->session->set_flashdata('mensaje', "No se puede responder más de una vez al mismo cuestionario");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);
            redirect('Encuesta/index/cvce/' . $id_campana . "/" . $token, 'refresh');
        }

        $cuestionario['email'] = $email;
        $cuestionario['tipo'] = $listaParametrosPost['tipo'];
        if (isset($listaParametrosPost['otroGrupoInteres'])) {
            $genero = $listaParametrosPost['genero'];
        } else {
            $genero = NULL;
        }
        $cuestionario['genero'] = $genero;
        $cuestionario['pais'] = $listaParametrosPost['pais'];
        $cuestionario['localidad'] = $listaParametrosPost['localidad'];
        $cuestionario['grupoInteres'] = $listaParametrosPost['grupoInteres'];
        if (isset($listaParametrosPost['otroGrupoInteres'])) {
            $otroGrupoInteres = $listaParametrosPost['otroGrupoInteres'];
        } else {
            $otroGrupoInteres = NULL;
        }
        $cuestionario['otroGrupoInteres'] = $otroGrupoInteres;
        $cuestionario['numEmpleados'] = $listaParametrosPost['numeroEmpleados'];
        $cuestionario['facturacion'] = $listaParametrosPost['facturacion'];
        $cuestionario['fk_campana'] = $id_campana;

        $idCuestionario = $this->Cuestionario_model->insertarCuestionario($cuestionario);

        /* Tomo todos los ejercicios */
        foreach (array_keys($listaParametrosPost) as $parametro) {

            /* Solo si el parametro es el de un item , toma su id */
            if (strpos($parametro, "IT") !== False) {
                $idItem = explode('_', $parametro)[1];
                $valor = $listaParametrosPost['IT_' . $idItem];
                $respuestaVariable['valor'] = $valor;
                $respuestaVariable['fk_item_variable'] = $idItem;
                $respuestaVariable['fk_cuestionario'] = $idCuestionario;
                $idRespuestaVariable = $this->RespuestaVariable_model->insertarRespuestas($respuestaVariable);
            }

        }

        if (($idCuestionario == null) || ($idRespuestaVariable == null)) {
            $this->session->set_flashdata('mensaje', "No se han guardado correctamente su participación");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        } else {
            $this->session->set_flashdata('mensaje', "Se han guardado correctamente sus respuestas. Gracias por participar.");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        }

        $this->load->view('template/encuesta/header');
        $this->load->view('template/encuesta/ok');
        $this->load->view('template/encuesta/footer');
    }

}
