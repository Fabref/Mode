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
class Cliente_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Crea una nueva campaña en la BD
     * 
     * @param type $cliente los datos del cliente a crear
     * 
     * @return el id del cliente creado si se crea correctamente o null en caso contrario
     */
    public function insertarCliente($cliente) {
        
        $query = $this->db->insert('cliente', $cliente);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    
    /**
     *  Función para obtener todos los clientes
     * 
     * @return los datos de los clientes 
     */
    public function getClientes() {
        $query = $this->db->get("cliente");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    
    /**
     * Función para obtener los datos de un cliente en base a su id
     * 
     * @param int $id_cliente el identificador del cliente
     * @return object La fila con los datos del cliente con el id indicado
     */
    public function cargarCliente($id_cliente) {
        $query = $this->db->get_where('cliente', array('id_cliente' => $id_cliente));
        
        return $query->row();
    }
    
    /**
     * Función que devuelve el nombre de un cliente en base a su ID
     * 
     * @param int $id_cliente El id del cliente
     * @return string Nombre del cliente
     */
    public function getNombreCliente($id_cliente) {
        $query = $this->db->get_where('cliente', array('id_cliente' => $id_cliente));
        
        return $query->row('nombre');
    }
}
