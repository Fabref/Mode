<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Cuestionario_model
 *
 * @author fabre
 */
class Cuestionario_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Función que comprueba si existe el correo insertado en la encuesta de una campaña
     * 
     * @param int $id_campana El identificador de la campaña
     * @param string $mail El email a comprobar
     * 
     * @return bool TRUE si existe y FALSE en caso contrario
     */
    public function compruebaEmail($id_campana, $mail) {
        $query = $this->db->get_where('cuestionario', array('fk_campana' => $id_campana, 'email' => $mail));
        
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Función que guarda los datos del cuestionario
     * 
     * @param array $cuestionario Los datos a insertar en el cuestionario
     */
    public function insertarCuestionario($cuestionario) {
        
        $query = $this->db->insert('cuestionario', $cuestionario);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    
}
