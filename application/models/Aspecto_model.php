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
class Aspecto_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Crea una nuevo aspecto en la BD
     * 
     * @param type $aspecto los datos del aspecto a crear
     * 
     * @return el id del aspecto creado si se crea correctamente o null en caso contrario
     */
    public function insertarAspecto($aspecto) {
        
        $query = $this->db->insert('aspecto', $aspecto);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    
    /**
     * Función para listar todos los aspectos
     * 
     * @return object Listado de aspectos, si existe alguno, 
     * si no es así devuelve NULL
     */
    public function getAspectos() {
        $query = $this->db->get('aspecto');
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    
    /**
     * Función que nos devuelve el aspecto con el ID que se le pasa
     * 
     * @param int $id_aspecto El identificador de los aspecto que hay que cargar
     * @return object La fila de los aspectos con ese id
     */
    public function getAspecto($id_aspecto) {
        $query = $this->db->get_where('aspecto', array('id_aspecto' => $id_aspecto));
        
        return $query->row();
    }
    
    /**
     * Función que nos devuelve los aspectos con el ID de la campaña que se le pasa
     * 
     * @param int $fk_campana El identificador de la campaña que hay que cargar
     * @return object Las filas del aspecto con ese fk
     */
    public function getAspectosCampaña($fk_campana) {
        $query = $this->db->get_where('aspecto', array('fk_campana' => $fk_campana));
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
        
    }
    
    /**
     * Función que nos devuelve los aspectos con el ID de la campaña que se le pasa
     * ordenados
     * 
     * @param int $fk_campana El identificador de la campaña que hay que cargar
     * @return object Las filas del aspecto con ese fk
     */
    public function getAspectosCampañaOrdenadosNOM($fk_campana) {
        $this->db->order_by("nombre", "desc");
        $query = $this->db->get_where('aspecto', array('fk_campana' => $fk_campana));
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
        
    }
    
    /**
     * Función que carga los PRA de los aspectos de la campaña
     * 
     * @param int $id_campana El identificador de la campaña
     * @return bool Devuelve TRUE si se ejecuta correctamente la consulta y FALSE en caso contrario 
     */
    public function cargaPRAAspectos($id_campana) {
        $sql = "Update aspecto AS ASP INNER JOIN (SELECT IV.fk_aspecto, "
                . "avg(IV.media) as media, avg(IV.desviacion) as desviacion FROM "
                . "item_variable IV WHERE IV.fk_campana=" . $id_campana . " GROUP BY IV.fk_aspecto) "
                . "as CALC SET ASP.media=CALC.media, ASP.desviacion=CALC.desviacion, "
                . "ASP.pra=CALC.media*(1-0.0033*CALC.media) WHERE ASP.id_aspecto=CALC.fk_aspecto";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
}
