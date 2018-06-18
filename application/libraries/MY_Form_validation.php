<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Libreria con las funciones utilizadas para la validacion de los formularios
 */
class My_Form_validation extends CI_Form_validation {

    /**
     * Comprueba que la cadena recibida solo contenga letras y espacios en blanco.
     * Admite acentos y letras españolas.
     * 
     * @param type $str la cadena a validar
     * @return type true si solo contiene letras y espacios en blanco y false en caso contrario
     */
    public function alpha_space($str) {
       return ( ! preg_match("#[^\p{L}\s ]#u", $str) == 0) ? FALSE : TRUE;
    } 


    /**
     * Comprueba que la fecha introducida tenga el formato correcto dd/mm/aaaa
     * 
     * @param type $date la fecha a comprobar
     * @return type true si la fecha tiene el fomrato correcto, false en caso contrario
     */
    public function check_date_format($date){
        return ( ! preg_match("/^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$/", $date)) ? FALSE : TRUE;
    }


    /**
     * Comprueba que la fecha recibida no sea igual o superior a la actual.
     * 
     * @param type $fechaNacimiento la fecha a validar
     * @return type true si la fecha es anterior al dia de hoy, false en caso contrario
     */
    public function check_if_date_is_previous_today($fechaNacimiento) {
        $fecha = $this->CI->utils->convertirAFechaFormatoBD($fechaNacimiento);
        $datetime1 = new DateTime($fecha);
        $datetime2 = new DateTime('now');
        return ($datetime1->format('Y-m-d') >= $datetime2->format('Y-m-d')) ? FALSE : TRUE;
    }


    /**
     * Comprueba si el la cadena recibida como dni o nie tiene el formato adecuado.
     * Admite que la letra sea minscula, xq la convierte automaticamente.
     * 
     * @param type $dni la cadena a validar
     * @return type true si tiene el formato adecuado y false en caso contrario
     */
    public function check_dni_nie_format($dni) {
        return ( ! preg_match("/^([0-9]{8}[A-Z]|[X|Y|Z][0-9]{7}[A-Z])/i", $dni)) ? FALSE : TRUE;
    }


    /**
     * Comprueba si la letra que acompaña al dni o nie recibido es correcta.
     * 
     * @param type $dni el dni o nie a validar
     * @return boolean true si la letra es valida y false en caso contrario
     */
    public function check_dni_nie_letter($dni) {
        $validacion = $this->CI->utils->validar_dni_nie($dni);
        if($validacion != 'OK') {
            $this->CI->form_validation->set_message('check_dni_nie_letter', 
                'Letra del ' . $this->CI->lang->line('msg_dni') 
                . ' incorrecta, la letra debería ser la \'' . $validacion  . '\'');
            return false; 
        } else {
            return true;
        }
    }    


    /**
     * Comprueba si el DNI que esta intentado almacenar ya existe en la BD para 
     * otro paciente.
     * 
     * @param type $dni el dni del paciente
     * @param type $idPaciente el id del paciente
     * @return type true si existe el dni asociado a otro paciente, false en caso contrario
     */
    public function check_dni_paciente_exists($dni, $idPaciente) {
        $this->CI->load->model('Paciente_model');
        return ($this->CI->Paciente_model->comprobarDniPacienteDuplicado($dni, $idPaciente)) ? FALSE : TRUE;
    }

    
    /**
     * Comprueba que la lateralidad sea la correcta para la articulacion seleccionada.
     * 
     * @param type $lateralidad la lateralidad de la articulacion (derecha o izquierda)
     * @param type $codigoArticulacion el codigo de la articulacion
     * @return boolean true si la lateralidad es correcta para la articulacion o false en caso contrario
     */
    public function check_hemicuerpo_by_articulacion($lateralidad, $codigoArticulacion) {
        if((($codigoArticulacion == "HOM") || ($codigoArticulacion == "ROD") || ($codigoArticulacion == "CAD")) && ($lateralidad == 0)){
            return FALSE;
        }

        return TRUE;
    }
    
    
    /**
     * Comprueba que el hemicuerpo tenga un valor seleccionado.
     * 
     * @param type $hemicuerpo el hemicuerpo seleccionado (derecho izquierdo o ambos)
     * @return boolean true si se ha seleccionado un valor para el hemicuerpo o false en caso contrario
     */
    public function check_selected_hemicuerpo($hemicuerpo) {
        if($hemicuerpo == "NON") {
            return FALSE;
        }

        return TRUE;
    }
    
    
    /**
     * Comprueba que la articulacion tenga un valor seleccionado.
     * 
     * @param type $articulacion la articulacion seleccionada
     * @return boolean true si se ha seleccionado un valor para la articulacion o false en caso contrario
     */
    public function check_selected_articulacion($articulacion) {
        if($articulacion == "NON") {
            return FALSE;
        }

        return TRUE;
    }
    
    
    /**
     * Comprueba que la cadena recibida tenga el formato de hora correcto (hh:mm).
     * 
     * @param type $time la cadena a validar
     * @return type true el formato es correcto, false en caso contrario
     */
    public function check_time_format($time) {
        return ( ! preg_match("/^([0-9]{2}\:[0-9]{2})$/", $time)) ? FALSE : TRUE;
    }
    
    /**
     * Comprueba que la cadena introducida sea numérica
     * 
     * @param type $string la cadena a comprobar
     * @return type true si la cadena tiene el formato correcto, false en caso contrario
     */
    public function check_numeric($string){
        return ( ! preg_match("/^([0-9])$/", $string)) ? FALSE : TRUE;
    }
    
    
    /**
     * Comprueba si el DNI que esta intentado almacenar ya existe en la BD
     * 
     * @param type $nif el nif del centro
     * @param type $idCentro el id del centro
     * @return type true si existe el nif asociado a otro centro, false en caso contrario
     */
    public function check_nif_exists($nif, $idCentro) {
        $this->CI->load->model('Centro_model');
        return ($this->CI->Centro_model->comprobarNifDuplicado($nif, $idCentro)) ? FALSE : TRUE;
    }
    
    
    /**
     * Comprueba que el NIF tenga el formato correcto
     * 
     * @param type $nif el nif del centro
     * @return type true si es correcto o false en caso contrario
     */
    public function check_nif_format($nif) {
        $this->CI->load->library('Nif_Nie_Cif_Validator');
        
        $result = $this->CI->nif_nie_cif_validator->isValidCIF($nif);
        if ($result === TRUE) {
            return TRUE;
        } else {
            if ($result === FALSE) {
                return FALSE;
            } else {
                $this->CI->form_validation->set_message('check_nif_format', 
                'Dígito de control del ' . $this->CI->lang->line('msg_nif') 
                . ' incorrecto. El dígito debería ser \'' . $result  . '\'');
                return FALSE;
            }
        }
    }
    
    
    /**
     * Comprueba que el pais tenga un valor seleccionado.
     * 
     * @param type $pais el pais seleccionado
     * @return boolean true si se ha seleccionado un valor para el pais o false en caso contrario
     */
    public function check_selected_pais($pais) {
        if($pais == "NON") {
            return FALSE;
        }

        return TRUE;
    }
    
    
    /**
     * Comprueba que el pais tenga un valor seleccionado.
     * 
     * @param type $ccaa la ccaa seleccionada
     * @return boolean true si se ha seleccionado un valor para la ccaa o false en caso contrario
     */
    public function check_selected_ccaa($ccaa) {
        if($ccaa == "NON") {
            return FALSE;
        }

        return TRUE;
    }
    
    
    /**
     * Comprueba que la provincia tenga un valor seleccionado.
     * 
     * @param type $provincia la provincia seleccionada
     * @return boolean true si se ha seleccionado un valor para la provincia o false en caso contrario
     */
    public function check_selected_provincia($provincia) {
        if($provincia == "NON") {
            return FALSE;
        }

        return TRUE;
    }
    
    
    /**
     * Comprueba si el la cadena recibida como $telefono tiene el formato adecuado.
     * Admite cadenas formadas exclusivamente por numeros.
     * 
     * @param type $telefono la cadena a validar
     * @return type true si tiene el formato adecuado y false en caso contrario
     */
    public function check_number_phone($telefono) {
        return ( ! preg_match("/^[0-9]*$/", $telefono)) ? FALSE : TRUE;
    }
}
