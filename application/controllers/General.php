<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

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

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("dniUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', "La sesi&oacute;n ha caducado");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->library('Nif_Nie_Cif_Validator');

            $this->load->model('Administrador_model');
            $this->load->model('General_model');
            $this->load->model('Campanya_model');
            $this->load->model('Cliente_model');

        }
    }

    /**
     * Index que redirige a la funcion apropiada segun la accion solicitada
     * 
     * @param type $accion la accion solicitada al controller
     * @param type $complementario el paramero complementario, si existe
     */
    public function index($accion, $complementario = FALSE) {

        switch ($accion) {

            case 'mp': /* Menú principal, ocurre al click logo web */
                $this->cargarMenuPrincipal();
                break;

            case 'ct': /* Cargar vista para el formulario de contacto */
                $this->cargarContacto();
                break;

            case 'envc': /* Envia el correo de contacto a la dirección info@kineactiv.com */
                $this->enviarConsulta();
                break;

            case 'cdir': /* Cargar vista para la localización y el teléfono */
                $this->cargarDireccion();
                break;

            case 'gcbp': /* Obtiene las CCAA por pais */
                $this->getComunidadesByPais();
                break;

            case 'gpbc': /* Obtiene las Provincias por CCAA */
                $this->getProvinciasByComunidad();
                break;

            default:
                // pone pagina not found personalizada y repetir eso en todos los controller
                break;
        }
    }

    /**
     * Carga la vista del menu principal
     */
    private function cargarMenuPrincipal() {

        $data['num_camp'] = sizeof($this->Campanya_model->getCampañas());
        $data['num_cli'] = sizeof($this->Cliente_model->getClientes());
        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('menuPrincipal/menuPrincipal', $data);
        $this->load->view('template/footer');
        $this->load->view('template/closePage');
    }

    /**
     * Función para cargar la vista del formulario de contacto
     */
    private function cargarContacto() {
        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('contacto/contacto');
        $this->load->view('template/footer');
        $this->load->view('template/closePage');
    }

    /**
     * Función que nos enviará el formulario de contacto
     */
    private function enviarConsulta() {
        $nombre = $this->input->post('nombre', TRUE);
        $apellidos = $this->input->post('apellidos', TRUE);
        $email = $this->input->post('email', TRUE);
        $telefono = $this->input->post('telefono', TRUE);
        $asunto = $this->input->post('asunto', TRUE);
        $mensaje = $this->input->post('mensaje', TRUE);

        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'azure_1436632a551cc7dc79f4ea7b2b61ad4f@azure.com', //Su Correo Aqui
            'smtp_pass' => '@zur3P0rtalK1n3@ct1V', // Su Password aqui
            'smtp_port' => '587',
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'wordwrap' => TRUE,
            'charset' => 'utf-8'
        );

        $this->email->initialize($config);

        $this->email->from($email, $nombre . " " . $apellidos);
        $this->email->to('info@kineactiv.com');

        $this->email->subject($asunto);
        $this->email->message($mensaje . "<br>Telefono: " . $telefono);

        // You need to pass FALSE while sending in order for the email data
// to not be cleared - if that happens, print_debugger() would have
// nothing to output.
        //$this->email->send(FALSE);
// Will only print the email headers, excluding the message subject and body
        //echo $this->email->print_debugger();

        if (!$this->email->send()) {
            $this->session->set_flashdata('mensaje', "No se ha podido enviar el correo, por favor inténtelo más tarde o a través de otro medio.");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
            redirect('General/index/ct', 'refresh');
        } else {
            $this->session->set_flashdata('mensaje', "El correo ha sido enviado correctamente, en breve nos pondremos en contacto con usted.");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
            redirect('General/index/ct', 'refresh');
        }
    }

    /**
     * Función para cargar la vista del formulario de contacto
     */
    private function cargarDireccion() {
        $this->load->view('template/menuSuperior');
        $this->load->view('template/menuLateral');
        $this->load->view('contacto/direccion');
        $this->load->view('template/footer');
        $this->load->view('template/closePage');
    }

    /**
     * Obtiene las CCAA asociadas a un pais seleccionado. Se obtiene 
     * en formato html para ponerlo en el select de CCAA
     * 
     * Utilizado desde Jquery al editar los datos del centro
     */
    private function getComunidadesByPais() {

        $idPais = $this->input->post('idPais', TRUE);

        $htmlComunidadesFromPais = '';
        $comunidadesFromPais = $this->General_model->obtenerComunidadesByPais($idPais);

        if (isset($comunidadesFromPais)) {
            $htmlComunidadesFromPais = '<option value="NON" selected>' . $this->lang->line('msg_seleccionar_ccaa') . '</option>';

            foreach ($comunidadesFromPais as $comunidadActual) {
                $htmlComunidadesFromPais = $htmlComunidadesFromPais . '<option value="' . $comunidadActual->idccaa . '">' . $this->lang->line('ccaa_' . $comunidadActual->idccaa) . '</option>';
            }
        }

        echo $htmlComunidadesFromPais;
    }

    /**
     * Obtiene las provincias asociadas a una comunidad seleccionada. Se obtiene 
     * en formato html para ponerlo en el select de las provincias
     * 
     * Utilizado desde Jquery al crear un paciente nuevo y al ocurrir un error 
     * en la creacion del mismo
     */
    private function getProvinciasByComunidad() {

        $idComunidad = $this->input->post('idComunidad', TRUE);

        $htmlProvinciasFromComunidad = '';
        $provinciaFromComunidad = $this->General_model->obtenerProvinciasByComunidad($idComunidad);

        if (isset($provinciaFromComunidad)) {

            $htmlProvinciasFromComunidad = '<option value="NON" selected>' . $this->lang->line('msg_seleccionar_provincia') . '</option>';

            foreach ($provinciaFromComunidad as $provinciaActual) {
                $htmlProvinciasFromComunidad = $htmlProvinciasFromComunidad . '<option value="' . $provinciaActual->idprovincia . '">' . $this->lang->line('provincia_' . $provinciaActual->idprovincia) . '</option>';
            }
        }

        echo $htmlProvinciasFromComunidad;
    }

}
