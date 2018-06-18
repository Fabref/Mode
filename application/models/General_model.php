<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of general_model
 *
 * @author Gabriel Fuertes
 */
class General_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Obtiene los paises dados de alta en la BD
     * 
     * @return type los paises dados de alta
     */
    public function obtenerPaises() {
        $query = $this->db->get('pais');
        return $query->result(); 
    }
    
    
    /**
     * Obtiene las comunidades autonomas que pertenecen a un pais.
     * 
     * @param type $idPais el identificador del pais
     * @return type las ccaa del pais
     */
    public function obtenerComunidadesByPais($idPais) {
        $query = $this->db->get_where('ccaa', array('fk_pais' => $idPais));
        return $query->result(); 
    }
    
    
    /**
     * Obtiene las provincias que pertenecen a una ccaa.
     * 
     * @param type $idComunidad el identificador de la ccaa
     * @return type las provincias de la ccaa
     */
    public function obtenerProvinciasByComunidad($idComunidad) {
        $query = $this->db->get_where('provincia', array('fk_ccaa' => $idComunidad));
        return $query->result(); 
    }
    
    /**
     * Obtener todos los datos de la tabla color para poder asignarselo a un
     * fisio cuando lo creamos.
     * 
     * @return type los colores de la tabla color
     */
//    public function obtenerColores() {
//        $query = $this->db->get('color');
//        return $query->result();
//    }
    
}
