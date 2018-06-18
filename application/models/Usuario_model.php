<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of Usuario_model
 *
 * @author fabre
 */
class Usuario_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Crea una nueva campaña en la BD
     * 
     * @param type $usuario los datos del usuario a crear
     * 
     * @return el id del usuario creado si se crea correctamente o null en caso contrario
     */
    public function insertarUsuario($usuario) {
        
        $query = $this->db->insert('usuario', $usuario);
        
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }
    
    /**
     *  Función para obtener todos los usuarios
     * 
     * @return los datos de los usuarios 
     */
    public function getUsuarios() {
        $query = $this->db->get("usuario");
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
    
    /**
     * Función para obtener los datos de un usuario en base a su id
     * 
     * @param int $id_usuario el identificador del usuario
     * @return object La fila con los datos del usuario con el id indicado
     */
    public function cargarUsuario($id_usuario) {
        $query = $this->db->get_where('usuario', array('id_usuario' => $id_usuario));
        
        return $query->row();
    }
    
    /**
     * Funcion que comprueba si existe un usuario dado de alta en la BD con un login 
     * y, si existe, devuelve su 'salt'
     * 
     * @param string $login
     * @return string la clave del usuario si existe. Si no existe, devuelve null.
     */
    public function existeUsuario($login) {
        $query = $this->db->get_where('usuario', array('login' => $login));
        if ($query->num_rows() > 0) {
            return $query->row('clave');
        } else {
            return null;
        }
    }
    
    /**
     *  Función que devuelve la info del usuario 
     * 
     * @param string $login
     * @return object_row
     */
    public function getInfoUsuario($login) {
        $query = $this->db->get_where('usuario', array('login' => $login));
        return $query->row();
    }
}
