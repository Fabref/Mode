<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Administrador_model
 *
 * @author Gabriel Fuertes
 */
class Administrador_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Funcion para obtener el nombre de un usuario segun su identificador
     * 
     * @param type $idAdministrador el identificador del adminstrador
     * 
     * @return type los datos del administrador
     */
    public function obtenerNombreAdministrador($idAdminstrador) {
        $query = $this->db->get_where('administrador', array('idadministrador' => $idAdminstrador));
        return $query->row()->nombre; 
    }
    
    /**
     * Funcion que comprueba si existe un administrador dado de alta en la BD con un NIF 
     * y, si existe, devuelve su 'salt'
     * 
     * @param string $nif
     * @return string la salt del administrador si existe. Si no existe, devuelve null.
     */
    public function existeAdministrador($dni) {
        $query = $this->db->get_where('administrador', array('mail' => $dni));
        if ($query->num_rows() > 0) {
            return $query->row('salt');
        } else {
            return null;
        }
    }
    
    /**
     *  Función que devuelve la info del administrador 
     * 
     * @param string $dni
     * @return object_row
     */
    public function getInfoAdministrador($dni) {
        $query = $this->db->get_where('administrador', array('mail' => $dni));
        return $query->row();
    }
    
    /**
     * Modifica los datos del usuario con los nuevos dados
     * 
     * @param type $usuario los nuevos datos del centro
     * @param type $idUsuario el identificador del centro a modificar
     */
    public function modificarUsuario($usuario, $idUsuario) {
        $this->db->where('idadministrador', $idUsuario);
        $this->db->update('administrador', $usuario);
    }
    
    /**
     *  Función que obtiene la salt del usuario para proceder al cambio de contraseña
     * 
     * @param type $idadministrador el identificador del usuario
     * @return type la salt del usuario
     */
    public function getSaltFrom($idadministrador) {
        $query = $this->db->get_where('administrador', array('idadministrador' => $idadministrador));
        return $query->row()->salt;
    }
    
    
    /**
     *  Función que actualiza la contraseña del usuario
     * 
     * @param type $idAdministrador el identificador del usuario
     * @param type $password la contraseña codificada
     * @return type true si se ha cambiado correctamente o False en caso contrario
     */
    public function actualizarContraseñaCentro($idAdministrador, $password) {
        
        $info['salt'] = $password; 
        $this->db->where('idadministrador', $idAdministrador);
        $this->db->update('administrador', $info);
        
        if($this->db->affected_rows() > 0) {
            return True;
        } else {
            return False;
        }
    }
    
    
    /**************************************************************************/
    /************************** RECUPERACION PASSWORD *************************/
    /**************************************************************************/
    
    /**
     * Función que almacena el token para la recuparacion de la contraseña del
     * usuario
     * 
     * @param type $dni el nif del usuario
     * @param type $token el token a almacenar
     * @return type true si se ha cambiado correctamente o False en caso contrario
     */
    public function guardarTokenRecuperacionPass($dni, $token) {
        
        $info['token_recuperar_pass'] = $token; 
        $info['fecha_token_recuperar_pass'] = date("Y-m-d H:i:s"); 
        
        $this->db->where('mail', $dni);
        $this->db->update('administrador', $info);
        
        if($this->db->affected_rows() > 0) {
            return True;
        } else {
            return False;
        }
    }
    
    
    /**
     * Obtiene la fecha de creacion del token para ver si ha expirado o no.
     * 
     * @param type $token el token del que obtener la fecha
     * 
     * @return type la fecha de creacion del token
     */
    public function getFechaTokenRecuperarPassByToken($token) {
        $query = $this->db->get_where('administrador', array('token_recuperar_pass' => $token));
        
        if ($query->row() == null) {
            return null;
        } else {
            return $query->row('fecha_token_recuperar_pass');
        }
    }
    
    
    /**
     * Función que actualiza la contraseña del centro por el token de 
     * recuperacion
     * 
     * @param type $token el token de recuperacion asociado a un centro
     * @param type $password la contraseña del centro codificada
     * @return type true si se ha cambiado correctamente o False en caso contrario
     */
    public function actualizarContraseñaByToken($token, $password) {
        
        $infoCentro['salt'] = $password; 
        $this->db->where('token_recuperar_pass', $token);
        $this->db->update('centro', $infoCentro);
        
        if($this->db->affected_rows() > 0) {
            return True;
        } else {
            return False;
        }
    }
    
    
    /**
     * Resetea los campos del token y la fecha de creacion del mismo. Hecho tras
     * comprobar que el token esta expirado y cuando se restaura la contraseña del 
     * usuario
     * 
     * @param type $token el token del usuario para recuperar la contraseña
     * @return boolean true si se realiza correctamente o false en caso contrario
     */
    public function resetearTokenRecuperacionPass($token) {
        
        $infoFisio['token_recuperar_pass'] = null; 
        $infoFisio['fecha_token_recuperar_pass'] = null; 
        
        $this->db->where('token_recuperar_pass', $token);
        $this->db->update('centro', $infoFisio);
        
        if($this->db->affected_rows() > 0) {
            return True;
        } else {
            return False;
        }
    }
}
