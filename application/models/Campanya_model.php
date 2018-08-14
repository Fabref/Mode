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
class Campanya_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Crea una nueva campaña en la BD
     * 
     * @param type $campanya los datos de la campaña a crear
     * 
     * @return el id de la campaña creada si se crea correctamente o null en caso contrario
     */
    public function insertarCampaña($campanya) {

        $query = $this->db->query("SELECT MAX(id_campana) AS id_campana FROM campana");

        $q = $query->row();
        $id = $q->id_campana;
        $campanya['id_campana'] = $id + 1;
        $this->db->insert('campana', $campanya);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    /**
     * Función para listar todas las campañas
     * 
     * @return object Listado de campañas, si existe alguna, 
     * si no es así devuelve NULL
     */
    public function getCampañas() {
        $query = $this->db->get('campana');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Función para listar todas las campañas de un cliente identificado por ID
     * 
     * @param int $fk_cliente El identificador del cliente
     * @return object Listado de campañas, si existe alguna, 
     * si no es así devuelve NULL
     */
    public function getCampañasCliente($fk_cliente) {
        $query = $this->db->get_where('campana', array('fk_cliente' => $fk_cliente));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    /**
     * Función para listar todas las campañas de un cliente identificado por ID
     * 
     * @param int $fk_cliente El identificador del cliente
     * @return object Listado de campañas, si existe alguna, 
     * si no es así devuelve NULL
     */
//    public function getCampañasClienteLecturaUsuario($id_usuario, $fk_cliente) {
//        
//        $sql = "SELECT * FROM campana AS c, permiso_campana AS pc WHERE c.fk_cliente = " . $fk_cliente . " AND pc.fk_usuario = " . $id_usuario . " AND pc.fk_campana = c.id_campana";
//        
//        $query = $this->db->query($sql);
//        
//        return $query;
//    }

    /**
     * Función que nos devuelve el permiso de lectura de una campaña para un usuario
     * 
     * @param int $id_usuario El identificador del usuario
     * @param int $id_campana El identificador de la campaña
     * @return int 1 si tiene permiso, 0 si no lo tiene
     */
    public function permisoLectura($id_usuario, $id_campana) {

        $sql = "SELECT permiso_lectura FROM permiso_campana WHERE fk_usuario = " . $id_usuario . " AND fk_campana = " . $id_campana;

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $q = $query->row();
            $permiso = $q->permiso_lectura;
            return $permiso;
        } else {
            return 0;
        }
    }

    /**
     * Función que nos devuelve el permiso de lectura de una campaña para un usuario
     * 
     * @param int $id_usuario El identificador del usuario
     * @param int $id_campana El identificador de la campaña
     * @return int 1 si tiene permiso, 0 si no lo tiene
     */
    public function permisoEscritura($id_usuario, $id_campana) {

        $sql = "SELECT permiso_escritura FROM permiso_campana WHERE fk_usuario = " . $id_usuario . " AND fk_campana = " . $id_campana;

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $q = $query->row();
            $permiso = $q->permiso_escritura;
            return $permiso;
        } else {
            return 0;
        }
    }

    /**
     * Función que nos dice si un usuario tiene permisos en una campaña
     * 
     * @param int $id_usuario El identificador del usuario
     * @param int $id_campana El identificador de la campaña
     * @return boolean TRUE si existe, FALSE si no
     */
    public function existeUsuarioPermisosCampana($id_campana, $id_usuario) {

        $query = $this->db->get_where('permiso_campana', array('fk_usuario' => $id_usuario, 'fk_campana' => $id_campana));

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Inserta un usuario en la tabla permisos_campaña con sus permisos
     * 
     * @param type $usuario los datos de la campaña a crear
     * 
     * @return el id de la campaña creada si se crea correctamente o null en caso contrario
     */
    public function insertaPermisosUsuarioCampana($usuario) {

        $query = $this->db->query("SELECT MAX(id_permiso_campana) AS id_permiso_campana FROM permiso_campana");

        $q = $query->row();
        $id = $q->id_permiso_campana;
        $usuario['id_permiso_campana'] = $id + 1;
        $this->db->insert('permiso_campana', $usuario);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    /**
     * Función que actualiza los permisos del usuario para la campaña
     * 
     * @param int $id_campaña El identificador de la campaña
     * @param array $permisos los permisos
     * @return object La fila de la campaña con ese id
     */
    public function actualizaPermisosUsuarioCampana($id_campaña, $permisos) {
        $query = $this->db->update('permiso_campana', $permisos, array('fk_campana' => $id_campaña));

        return $query;
    }

    /**
     * Función que nos devuelve la campaña con el ID que se le pasa
     * 
     * @param int $id_campaña El identificador de la campaña que hay que cargar
     * @return object La fila de la campaña con ese id
     */
    public function getCampaña($id_campaña) {
        $query = $this->db->get_where('campana', array('id_campana' => $id_campaña));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    /**
     * Función que actualiza la campaña con el ID que se le pasa
     * 
     * @param int $id_campaña El identificador de la campaña que hay que actualizar el estado
     * @param array $dato el nuevo estado
     * @return object La fila de la campaña con ese id
     */
    public function cambiaEstado($id_campaña, $dato) {
        $query = $this->db->update('campana', $dato, array('id_campana' => $id_campaña));

        return $query;
    }

    /**
     * Función que actualiza la campaña con el ID que se le pasa
     * 
     * @param int $id_campaña El identificador de la campaña que hay que actualizar el estado
     * @param array $dato el nuevo estado
     * @return object La fila de la campaña con ese id
     */
    public function getEstado($id_campaña) {
        $query = $this->db->get_where('campana', array('id_campana' => $id_campaña));

        $row = $query->row();

        return $row->estado;
    }

    /**
     * Función con consulta que exportara los datos de la campaña
     * 
     * @param int $id_campana El identificador de la campaña de la que vamos a exportar los datos
     * @return object Los datos de la campaña
     */
    public function esportarDatos($id_campana) {

        $sql1 = "SELECT GROUP_CONCAT(DISTINCT CONCAT('MAX(IF(nombre = ''', "
                . "nombre,''', valor, NULL)) AS \"', nombre,'\"')) "
                . "as mode FROM respuestas Where id_campana=" . $id_campana;

        $query = $this->db->query($sql1);
        $q = $query->row();
        $mode = $q->mode;
        $sql = "SELECT   id_cuestionario, email, fecha, tipo, genero, 
                pais, localidad, grupoInteres, otroGrupoInteres, facturacion, " . $mode . " 
                FROM respuestas Where id_campana=" . $id_campana . " GROUP BY id_cuestionario, email, fecha, tipo, genero, 
                pais, localidad, grupoInteres, otroGrupoInteres, facturacion";

        $query2 = $this->db->query($sql);

        return $query2->result_array();
    }

    /**
     * Función con consulta tabla distancias
     * 
     * @param int $id_campana El identificador de la campaña de la que vamos a exportar los datos
     * @return object los datos de las distancias
     */
    public function tablaDistancias($id_campana) {

        $sql1 = "SELECT GROUP_CONCAT(DISTINCT CONCAT('MAX(IF(nombre_2 = ''', "
                . "nombre_2,''', distancia, NULL)) AS \"', nombre_2,'\"')) "
                . "order by nombre_2 ASC FROM distancias_respuestas Where fk_campana=" . $id_campana;

//        $query = $this->db->query($sql1);
//        $q = $query->row();
//        $mode = $q->mode;
        $sql = "SELECT nombre_1, " . $sql1 . ", FROM distancias_aspectos WHERE fk_campana=" . $id_campana . " GROUP BY nombre_1 ORDER BY nombre_1 ASC";

        $query2 = $this->db->query($sql);

        return $query2->result_array();
    }

}
