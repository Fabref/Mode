<?php

/*
 * Fichero con la definicion de las reglas de validacion de todos los formularios
 *  de la aplicacion
 */

$this->CI = & get_instance();

$idioma = $this->CI->utils->comprobarIdiomaNavegador();
$this->CI->lang->load("message", $idioma);

$config = array(
    'modificarCentro' => array(
        array(
            'field' => 'nombre',
            'label' => $this->CI->lang->line('msg_nombre'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'nifCentro',
            'label' => $this->CI->lang->line('msg_nif'),
            'rules' => 'required|alpha_numeric|check_nif_format|'
                     . 'check_nif_exists[' . $this->CI->session->userdata('idCentro') . ']'
        ),
        array(
            'field' => 'pais',
            'label' => $this->CI->lang->line('msg_pais'),
            'rules' => 'check_selected_pais'
        ),
        array(
            'field' => 'comunidadAutonoma',
            'label' => $this->CI->lang->line('msg_comunidad_autonoma'),
            'rules' => 'check_selected_ccaa'
        ),
        array(
            'field' => 'provincia',
            'label' => $this->CI->lang->line('msg_provincia'),
            'rules' => 'check_selected_provincia'
        ),
        array(
            'field' => 'poblacion',
            'label' => $this->CI->lang->line('msg_poblacion'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'direccion',
            'label' => $this->CI->lang->line('msg_direccion'),
            'rules' => 'required'
        ),
        array(
            'field' => 'codigoPostal',
            'label' => $this->CI->lang->line('msg_codigo_postal'),
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'telefono',
            'label' => $this->CI->lang->line('msg_telefono'),
            'rules' => 'check_number_phone'
        ),
        array(
            'field' => 'mail',
            'label' => $this->CI->lang->line('msg_email'),
            'rules' => 'valid_email'
        )
    ),
    
    'modificarOCrearPaciente' => array(
        array(
            'field' => 'nombre',
            'label' => $this->CI->lang->line('msg_nombre'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'apellido1',
            'label' => $this->CI->lang->line('msg_apellido1'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'apellido2',
            'label' => $this->CI->lang->line('msg_apellido2'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'fecha',
            'label' => $this->CI->lang->line('msg_fecha_nacimiento'),
            'rules' => 'required|check_date_format|check_if_date_is_previous_today'
        ),
        array(
            'field' => 'dni',
            'label' => $this->CI->lang->line('msg_dni'),
            'rules' => 'required|alpha_numeric|check_dni_nie_format|'
                     . 'check_dni_nie_letter|check_dni_paciente_exists[' . $this->CI->session->userdata('idPaciente') . ']'
        ),
        array(
            'field' => 'pais',
            'label' => $this->CI->lang->line('msg_pais'),
            'rules' => 'check_selected_pais'
        ),
        array(
            'field' => 'comunidadAutonoma',
            'label' => $this->CI->lang->line('msg_ccaa'),
            'rules' => 'check_selected_ccaa'
        ),
        array(
            'field' => 'provincia',
            'label' => $this->CI->lang->line('msg_provincia'),
            'rules' => 'check_selected_provincia'
        ),
        array(
            'field' => 'poblacion',
            'label' => $this->CI->lang->line('msg_poblacion'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'direccion',
            'label' => $this->CI->lang->line('msg_direccion'),
            'rules' => 'required'
        ),
        array(
            'field' => 'codigoPostal',
            'label' => $this->CI->lang->line('msg_codigo_postal'),
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'telefono',
            'label' => $this->CI->lang->line('msg_telefono'),
            'rules' => 'check_number_phone'
        ),
        array(
            'field' => 'correoElectronico',
            'label' => $this->CI->lang->line('msg_email'),
            'rules' => 'valid_email'
        )
    ),
    
    'modificarOCrearFisioterapeuta' => array(
        array(
            'field' => 'nombre',
            'label' => $this->CI->lang->line('msg_nombre'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'apellido1',
            'label' => $this->CI->lang->line('msg_apellido1'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'apellido2',
            'label' => $this->CI->lang->line('msg_apellido2'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'fecha',
            'label' => $this->CI->lang->line('msg_fecha_nacimiento'),
            'rules' => 'required|check_date_format|check_if_date_is_previous_today'
        ),
        array(
            'field' => 'dni',
            'label' => $this->CI->lang->line('msg_dni'),
            'rules' => 'required|alpha_numeric|check_dni_nie_format|'
                     . 'check_dni_nie_letter'
//                     . 'check_dni_nie_letter|check_dni_fisio_exists[' . $this->CI->session->userdata('idPaciente') . ']'
        ),
        array(
            'field' => 'pais',
            'label' => $this->CI->lang->line('msg_pais'),
            'rules' => 'check_selected_pais'
        ),
        array(
            'field' => 'comunidadAutonoma',
            'label' => $this->CI->lang->line('msg_ccaa'),
            'rules' => 'check_selected_ccaa'
        ),
        array(
            'field' => 'provincia',
            'label' => $this->CI->lang->line('msg_provincia'),
            'rules' => 'check_selected_provincia'
        ),
        array(
            'field' => 'poblacion',
            'label' => $this->CI->lang->line('msg_poblacion'),
            'rules' => 'required|alpha_space'
        ),
        array(
            'field' => 'direccion',
            'label' => $this->CI->lang->line('msg_direccion'),
            'rules' => 'required'
        ),
        array(
            'field' => 'codigoPostal',
            'label' => $this->CI->lang->line('msg_codigo_postal'),
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'telefono',
            'label' => $this->CI->lang->line('msg_telefono'),
            'rules' => 'required|check_number_phone'
        ),
        array(
            'field' => 'correoElectronico',
            'label' => $this->CI->lang->line('msg_email'),
            'rules' => 'required|valid_email'
        )
    )
);

