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
class ItemVariable_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Crea una nuevo item en la BD
     * 
     * @param type $item los datos del item a crear
     * 
     * @return el id del item creado si se crea correctamente o null en caso contrario
     */
    public function insertarItem($item) {

        $query = $this->db->insert('item_variable', $item);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    /**
     * Función para listar todos los item
     * 
     * @return object Listado de item, si existe alguno, 
     * si no es así devuelve NULL
     */
    public function getItems() {
        $query = $this->db->get('item_variable');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Función que nos devuelve el item con el ID que se le pasa
     * 
     * @param int $id_item El identificador de los item que hay que cargar
     * @return object La fila de los item con ese id
     */
    public function getItem($id_item) {
        $query = $this->db->get_where('item_variable', array('id_item_variable' => $id_item));

        return $query->row();
    }

    /**
     * Función que nos devuelve los item con el ID de la campaña que se le pasa
     * 
     * @param int $fk_campana El identificador de la campaña que hay que cargar
     * @return object Las filas del item con ese fk
     */
    public function getItemsCampaña($fk_campana) {
        $this->db->order_by('orden', 'ASC');
        $query = $this->db->get_where('item_variable', array('fk_campana' => $fk_campana));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    
    /**
     * Función que nos devuelve los item con el ID de la campaña que se le pasa
     * 
     * @param int $fk_campana El identificador de la campaña que hay que cargar
     * @return object Las filas del item con ese fk
     */
    public function getItemsAspecto($fk_aspecto) {
        $query = $this->db->get_where('item_variable', array('fk_aspecto' => $fk_aspecto));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 0;
        }
    }

    /**
     * Funcion que carga los resúmenes por pregunta una vez cerrada la encuesta
     * 
     * @param int $id_campana El identificador de la campaña de la que se han dado respuestas
     * @return bool Devuelve TRUE si se ha ejecutado la consulta correctamente o FALSE en caso contrario
     */
    public function cargaResumenPorPregunta($id_campana) {
        $sql = "Update item_variable AS ITVAR INNER JOIN (SELECT "
                . "RV.fk_item_variable, avg(RV.valor) as media, STD(RV.valor) "
                . "as desviacion FROM respuesta_variable RV "
                . "inner join cuestionario C on RV.fk_cuestionario=C.id_cuestionario "
                . "WHERE C.fk_campana=" . $id_campana . " "
                . "GROUP BY RV.fk_item_variable) as CALC "
                . "SET ITVAR.media=CALC.media, ITVAR.desviacion=CALC.desviacion "
                . "WHERE ITVAR.id_item_variable=CALC.fk_item_variable;";
        
        $query = $this->db->query($sql);

        return $query;
    }
    
    /**
     * Funcion que actualiza el orden de los items
     * 
     * @param int $id_item_variable El identificador del item a ordenar
     * @param int $orden El nuevo orden que tiene el item
     * 
     */
    public function actualizarOrdenItem($id_item_variable, $orden) {
        $this->db->where('id_item_variable', $id_item_variable);
        $this->db->update('item_variable', array('orden' => $orden));
    }

}
