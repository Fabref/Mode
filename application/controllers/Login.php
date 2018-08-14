<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();

        $this->load->model('Administrador_model');
        $this->load->model('Usuario_model');
    }

    /**
     * Función index que redirige al resto de funciones del login en 
     * base al parámetro indicado por la variable acción
     * 
     * @param string $accion
     */
    public function index($accion = FALSE) {

        switch ($accion) {

            case 'clogin': /* Realiza el control del login */
                $this->comprobarLogin();
                break;

            default : /* Carga la pantalla del login de la APP */
                $this->load->view('template/headerLogin');
                $this->load->view('login/login');
                $this->load->view('template/footerLogin');
                break;
        }
    }

    /**
     * Comprueba si los datos introducidos para loguearse son correctos
     */
    public function comprobarLogin() {
        $mail = $this->input->post('mail', TRUE);
        $pass = $this->input->post('pass', TRUE);

        // Comprueba si existe el usuario, devolviendo su salt en caso de que exista
        $saltAdministrador = $this->Administrador_model->existeAdministrador($mail);
        $saltUsuario = $this->Usuario_model->existeUsuario($mail);
       // echo $saltAdministrador . "<br>" . $saltUsuario;



        if (isset($saltAdministrador) && password_verify($pass, $saltAdministrador)) {

            $infoAdministrador = $this->Administrador_model->getInfoAdministrador($mail);


            /* Se añade la info del usuario a variables de session */
            $this->session->set_userdata('idUsuario', $infoAdministrador->idadministrador);
            $this->session->set_userdata('nombreUsuario', $infoAdministrador->nombre);
            $this->session->set_userdata('dniUsuario', $infoAdministrador->dni);
            $this->session->set_userdata('mailUsuario', $mail);
            $this->session->set_userdata('superUser', 1);

            redirect('General/index/mp', 'refresh');
        } else if (isset($saltUsuario) && password_verify($pass, $saltUsuario)) {
            
            $infoUsuario = $this->Usuario_model->getInfoUsuario($mail);
            
            /* Se añade la info del usuario a variables de session */
            $this->session->set_userdata('idUsuario', $infoUsuario->id_usuario);
            $this->session->set_userdata('id_cliente', $infoUsuario->fk_cliente);
            $this->session->set_userdata('loginUsuario', $infoUsuario->login);
            $this->session->set_userdata('nombreUsuario', $infoUsuario->nombre);
            $this->session->set_userdata('apellidosUsuario', $infoUsuario->apellidos);
            $this->session->set_userdata('fk_cliente', $infoUsuario->fk_cliente);
            $this->session->set_userdata('es_administrador', $infoUsuario->es_administrador);
//            $this->session->set_userdata('puede_editar', $infoUsuario->puede_editar);
//            $this->session->set_userdata('puede_consultar', $infoUsuario->puede_consultar);
            $this->session->set_userdata('mailUsuario', $mail);
            
            redirect('Usuario/index/mp', 'refresh');
            
        } else {
//            $msg = "Usuario y/o password err&oacute;neos" . $mail . " " . $pass . " " . $saltUsuario;
            $msg = "Usuario y/o password err&oacute;neos";
            $this->session->set_flashdata('mensajeErrorLogin', $msg);
            redirect('Login/index', 'refresh');
        }
    }

    /**
     * Función para cerrar la sesión del usuario 
     */
    public function cerrarSesion() {
        $this->session->sess_destroy();

        //$msg = "La sesi&oacute;n ha finalizado";
        $this->session->set_flashdata('mensajeLogin', "La sesi&oacute;n ha finalizado");
        redirect('Login/index', 'refresh');
    }

}
