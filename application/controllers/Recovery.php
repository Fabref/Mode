<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recovery extends CI_Controller {

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
        $this->load->library('Nif_Nie_Cif_Validator');
        
        $this->load->model('Administrador_model');

    }

    
    /**
     * Index que redirige a la funcion apropiada segun la accion solicitada
     * 
     * @param type $accion la accion solicitada al controller
     * @param type $complementario el paramero complementario, si existe
     */
    public function index($accion = FALSE, $complementario = FALSE) {
        
        switch ($accion) {
            
            case 'cvsrc':     /* Carga la vista para solicitar la recuperacion de la contraseña */
                $this->cargaVistaSolicitaRecuperacionContraseña();
                break;
            
            case 'vnc':     /* Validar dni usuario */
                $this->validarDNIAdministrador();
                break;
            
            case 'cvte':     /* Carga la vista de aviso de expiracion del token de recuperacion */
                $this->cargarVistaTokenExpirado($complementario);
                break;
            
            case 'cvicr':     /* Carga la vista para introducir la nueva contraseña desde el email de recuperacion */
                $this->cargarVistaIntroducirContraseñaRecuperada($complementario);
                break;
            
            case 'rc':     /* Gestiona la introduccion de la contraseña a recuperar */
                $this->recuperarContraseña();
                break;
            
        }
        
    }

    
    /*
     * Carga la vista para solicitar la recuperacion la contraseña del fisioterapeuta 
     */
    private function cargaVistaSolicitaRecuperacionContraseña() {

        $this->load->view('template/headerLogin');
        $this->load->view('recovery/solicitarRecuperacionPassword');
        $this->load->view('template/footerLogin');
    }

    
    /*
     * Comprueba que el DNI introducido por el usuario sea un DNI correcto y que
     * exista en la base de datos un centro con dicho DNI
     */
    private function validarDNIAdministrador() {

        $nifUsuario = strtoupper($this->input->post('nifRecuperarPass', TRUE));
        
        /* Comprueba si esta en blanco */
        if ($nifUsuario == "") {
            $respuesta['error'] = True;
            $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp; El campo no puede ser vacio</div>';
            
        } else {
            /* Comprueba si es valido */
            $result = $this->nif_nie_cif_validator->isValidCIF($nifUsuario);
            if ($result !== TRUE) {
                
                /* Si no tiene el formato correcto */
                if ($result === FALSE) {
                    $respuesta['error'] = True;
                    $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp; Formato incorrecto</div>';
                
                } else { /* Si el digito de control no es correcto */
                    $respuesta['error'] = True;
                    $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp; Digito de control incorrecto</div>';
                }
                
            } else {
            
                /* Comprueba si existe el usuario */
                if ($this->Administrador_model->existeAdministrador($nifUsuario) == null) {
                    $respuesta['error'] = True;
                    $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp; DNI incorrecto</div>';
        
                } else { /* Todo es correcto */

                    /*Crea el token y se almacena en la BD*/
                    $token = $this->crearToken();

                    $tokenAlmacenado = $this->Administrador_model->guardarTokenRecuperacionPass($nifUsuario, $token);
                    if ( ! $tokenAlmacenado) {
                        $error = True;
                        $mensaje = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp; Error en la recuperaci&oacute;n</div>';

                    }

                    /* Envia el email con la url de recuperacion*/
                    $infoUsuario = $this->Administrador_model->getInfoAdministrador($nifUsuario);
                    $envioEmail = $this->enviarEmailRecoveryPass($infoUsuario);
                    if ( ! $envioEmail) {
                        $error = True;
                        $mensaje = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp; Error en la recuperaci&oacute;n</div>';

                    } else {
                        $error = False;
                        $mensaje = '<div class="alert alert-success"><p style="font-size:16px;" align="justified"><i class="icon fa fa-check">&nbsp;&nbsp; Correo electr&oacute;nico de recuperaci&oacute;n enviado. Compruebe tambi&eacute;n su carpeta de SPAM</p></div>';

                    }

                    $respuesta['error'] = $error;
                    $respuesta['mensaje'] = $mensaje;
                }
            }
        }
        
        echo json_encode($respuesta);
        
    }
    
    
    /**
     * Crea un token unico para cada usuario que intenta recuperar su contraseña
     * 
     * @return type el token creado
     */
    private function crearToken() {
        return sha1(uniqid(rand(),true));
    }
    
    
    /**
     * Configura y envia el email de recuperacion de la contraseña.
     * 
     * @param $infoUsuario array con los datos del centro para enviar el email
     */
    private function enviarEmailRecoveryPass($infoUsuario) {
        //cargamos la libreria email de ci
        $this->load->library("email");
 
        //configuracion para Azure
        $configEmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'azure_1436632a551cc7dc79f4ea7b2b61ad4f@azure.com', //Su Correo Aqui
            'smtp_pass' => '@zur3P0rtalK1n3@ct1V', // Su Password aqui
            'smtp_port' => '587',
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'wordwrap' => TRUE,
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );    
 
        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configEmail);
 
        $this->email->from('recovery@kineactiv.com', "KineActiv");
        $this->email->to($infoUsuario->mail);
        $this->email->subject($this->lang->line('msg_recuperacion_password'));
        
        $html = '<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#d2d6de">
            <table width="480" cellpadding="0" cellspacing="0" border="0" bgcolor="#d2d6de" align="center" style="margin:0 auto">
            <tbody>
                <tr>
                    <td align="center" valign="top" style="padding:40px 0px 0px 0px">
                        
                        
                        <img src="http://www.kineactiv.com/images/logotras.png" >
                        
                        <br>
                        <br>
                        
                        <table cellpadding="0" cellspacing="0" border="0" align="center">
                            <tbody>
                                <tr>
                                    <td align="center" style="padding:0px 20px 0px 20px;font-weight:400;font-size:13px;letter-spacing:0.025em;line-height:26px;color:#000;font-family:\'Poppins\',sans-serif;background:white">
                                        
                                        <br>
                                        
                                        <span style="font-weight:300;font-size:24px;letter-spacing:0.025em;line-height:23px;color:#009b82;font-family:\'Poppins\',sans-serif">
                                            ' . $this->lang->line('msg_proceso_recuperacion') . '<br>
                                        </span>
                                        
                                        <p>' . $this->lang->line('msg_inicio_recuperar_password') . '.</p>

                                        <p>' . $this->lang->line('msg_confirmar_recuperar_password') . ':</p>

                                        <table width="220" height="45" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#8FBE00" style="margin:0;border-radius:3px">
                                            <tbody>
                                                <tr style="background-color: #009b82">
                                                    <td align="center" valign="middle" style="padding:5px 5px">
                                                        <a href="http://localhost/KineActivCentro_v1.1/index.php/Recovery/index/cvicr/' . $infoUsuario->token_recuperar_pass.'" 
                                                            style="font-weight:500;font-size:17px;letter-spacing:0.025em;line-height:26px;color:#fff;font-family:\'Poppins\',sans-serif;text-decoration:none" target="_blank" data-saferedirecturl="#">
                                                            ' . $this->lang->line('msg_recuperar_password') . '
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <br>
                                        
                                        <p align="justified"><strong>' . $this->lang->line('msg_pregunta_no_solicitud_recuperacion') . '</strong>&nbsp;' . $this->lang->line('msg_cuerpo_no_solicitud_recuperacion') . '.</p>

                                        <br>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="480" height="120" cellpadding="0" cellspacing="0" border="0" align="center" style="margin:0 auto">
                            <tbody>
                                <tr>
                                    <td width="280" align="left" valign="top" style="padding:18px 0px 0px 0px;font-weight:300;font-size:12px;letter-spacing:0.025em;line-height:40px;color:#000000;font-family:\'Poppins\',sans-serif">
                                        <strong>&copy; Edison Desarrollos. All rigth reserved.</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        </table>';
        
        $this->email->message($html);
 
        if($this->email->send()) {
            return TRUE;
        }
        
    }

    
    /**
     * Carga la vista para que el fisio introduzca la nueva contraseña en el sistema.
     * En caso de que el token de recuperacion haya expirado, redirige a la pantalla
     * que se lo advierte al usuario.
     * 
     * @param type $token el token de la recuperacion de la contraseña del usuario
     */
    private function cargarVistaIntroducirContraseñaRecuperada($token) {
        
        $fechaTokenRecuperarPassword = $this->Administrador_model->getFechaTokenRecuperarPassByToken($token);
        
        /* Si la fecha es null, es que el enlace de recuperacion ya no es valido */
        if ($fechaTokenRecuperarPassword == null) {
            $mensajeErrorToken = 'env';
            redirect('Recovery/index/cvte/' . $mensajeErrorToken, 'refresh');
            
        } else {
            $horaActual = new DateTime("now");

            /* Añade 5 minutos a la hora de de recuperacion del password xa mantener valido el token */
            $fechaTokenRecuperarPasswordAIncrementar = new DateTime($fechaTokenRecuperarPassword);
            $fechaTokenRecuperarPasswordMasTolerancia = $fechaTokenRecuperarPasswordAIncrementar->add(new DateInterval('PT5M'));

            if ($fechaTokenRecuperarPasswordMasTolerancia < $horaActual) {
                $this->Administrador_model->resetearTokenRecuperacionPass($token);
                
                $mensajeErrorToken = "te";
                redirect('Recovery/index/cvte/' . $mensajeErrorToken, 'refresh');

            } else {
                $infoRecuperacion['token'] = $token;

                $this->load->view('template/headerLogin');
                $this->load->view('recovery/crearPasswordRecuperado', $infoRecuperacion);
                $this->load->view('template/footerLogin');

            }
        }
        
    }
    
    
    /**
     * Carga la vista que muestra el mensaje de que el token para cambiar la 
     * contraseña ha expirado.
     */
    private function cargarVistaTokenExpirado($mensajeErrorTokenRecuperacion) {
        
        if ($mensajeErrorTokenRecuperacion === "env") {
            $infoError['mensajeErrorRecuperacion'] = $this->lang->line('msg_info_enlace_no_valido');
        } else {
            $infoError['mensajeErrorRecuperacion'] = $this->lang->line('msg_info_periodo_expirado');
        }
        
        $this->load->view('template/headerLogin');
        $this->load->view('recovery/errorExpiracionToken', $infoError);
        $this->load->view('template/footerLogin');
            
    }
    
    
    /**
     * Comprueba que las contraseñas introducidas por el usuario sean iguales y 
     * se la cambia al fisioterapeuta.
     */
    private function recuperarContraseña() {
        $token = $this->input->post('token', TRUE);
        $passwordNuevo1 = $this->input->post('passwordNuevo1', TRUE);
        $passwordNuevo2 = $this->input->post('passwordNuevo2', TRUE);
        
        /* Comprueba que la contraseña no este vacia */
        if (($passwordNuevo1 == "") || ($passwordNuevo2 == "")) { 
            $respuesta['error'] = True;
            $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp;' . $this->lang->line('msg_error_passwords_en_blanco') . '</div>';
            
        /* Comprueba que la nueva contraseña sea la misma en ambos campos */
        } else if (strcmp($passwordNuevo1, $passwordNuevo2) != 0) {
            $respuesta['error'] = True;
            $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp;' . $this->lang->line('msg_error_passwords_distintos') . '</div>';

        } else {
            $saltCentro = password_hash($passwordNuevo1, PASSWORD_DEFAULT);
            $passwordActualizado = $this->Administrador_model->actualizarContraseñaByToken($token, $saltCentro);
            
            if ($passwordActualizado) {
                $this->Administrador_model->resetearTokenRecuperacionPass($token);
                $respuesta['error'] = False;
                $respuesta['mensaje'] = '<div class="alert alert-success"><i class="icon fa fa-check">&nbsp;&nbsp;' . $this->lang->line('msg_password_cambiado_correctamente') . '</div>';
            
                
            } else {
                $respuesta['error'] = True;
                $respuesta['mensaje'] = '<div class="alert alert-danger"><i class="icon fa fa-ban">&nbsp;&nbsp;' . $this->lang->line('msg_error_cambiar_password') . '</div>';
            
            }
            
        }
            
        echo json_encode($respuesta);
    }
    
}
