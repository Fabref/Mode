<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of RespuestaVariable_model
 *
 * @author fabre
 */
class RespuestaVariable_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Función para insertar las respuestas de una encuesta de una campaña
     * 
     * @param array $respuesta Array con los elemenos a insertar
     * @return int Retorna el id del último elemento insertado o NULL en caso contrario.
     */
    public function insertarRespuestas($respuesta) {
        $query = $this->db->insert('respuesta_variable', $respuesta);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
}
