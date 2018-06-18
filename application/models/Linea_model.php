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
class Linea_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Crea una nueva linea presupuestaria en la BD
     * 
     * @param type $linea los datos de la campaña a crear
     * 
     * @return el id de la campaña creada si se crea correctamente o null en caso contrario
     */
    public function insertarLinea($linea) {
        
        $query = $this->db->insert('linea_presupuestaria', $linea);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    
    /**
     * Función para listar todas las lineas presupuestarias
     * 
     * @return object Listado de lineas, si existe alguna, 
     * si no es así devuelve NULL
     */
    public function getLineas() {
        $query = $this->db->get('linea_presupuestaria');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    
    /**
     * Función que nos devuelve la linea presupuestaria con el ID que se le pasa
     * 
     * @param int $id_linea_presupuestaria El identificador de la lineas que hay que cargar
     * @return object La fila de la lineas con ese id
     */
    public function getLineaPresupuestaria($id_linea_presupuestaria) {
        $query = $this->db->get_where('linea_presupuestaria', array('id_linea_presupuestaria' => $id_linea_presupuestaria));
        
        return $query->row();
    }
    
    /**
     * Función que nos devuelve las lineas presupuestarias con el ID de la campaña que se le pasa
     * 
     * @param int $fk_campana El identificador de la lineas que hay que cargar
     * @return object La fila de la lineas con ese id
     */
    public function getLineasCampaña($fk_campana) {
        $query = $this->db->get_where('linea_presupuestaria', array('fk_campana' => $fk_campana));
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
        
    }
    
    
    
}
