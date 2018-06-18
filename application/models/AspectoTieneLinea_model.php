<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of AspectoTieneLinea_model
 *
 * @author fabre
 */
class AspectoTieneLinea_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Obtener los importes de los aspectos de una campaña
     * 
     * @param type $id_aspecto
     * @return type el resultado de la consulta o 0 si no existen registros
     */
    public function getLineasAspecto($id_aspecto) {
        $query = $this->db->get_where('aspecto_tiene_linea_presupuestaria', array('fk_aspecto' => $id_aspecto));
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }
    
    /**
     * Crea una nueva tupla en aspecto tiene linea presupuestaria en la BD
     * 
     * @param type $datos los datos del aspecto tiene linea presupuestaria
     * 
     * @return el id de la tupla creada si se crea correctamente o null en caso contrario
     */
    public function insertarAspectoTieneLinea($datos) {
        
        $query = $this->db->insert('aspecto_tiene_linea_presupuestaria', $datos);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    
}
