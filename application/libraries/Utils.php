<?php

/**
 * Clase con funciones genericas que son utilizadas en la aplicacion.
 */
class Utils {

    public function __construct() {
        $this->CI = & get_instance();

//        $idioma = $this->comprobarIdiomaNavegador();
//        $this->CI->lang->load("message", $idioma);
    }

    /**
     * Comprueba si un DNI o NIE es valido
     * 
     * @param type $dni el dni o nie a comprobar
     * @return string
     */
    function validar_dni_nie($dni) {
        $dni = strtoupper($dni);

        $letra = substr($dni, -1, 1);
        $numero = substr($dni, 0, 8);

        // Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
        $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);

        $modulo = $numero % 23;
        $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra_correcta = substr($letras_validas, $modulo, 1);

        if ($letra_correcta != $letra) {
            return $letra_correcta;
        } else {
            return "OK";
        }
    }

    /**
     * Función para dar formato a una fecha segun el formato de la base de datos
     * 
     * @param string $fecha la fecha a formatear
     * @return string la fecha con el formato de la BD
     */
    public function convertirAFechaFormatoBD($fecha) {
        $porciones = explode("/", $fecha);
        $dia = $porciones[0];
        $mes = $porciones[1];
        $anio = $porciones[2];

        $fecha = $anio . "-" . $mes . "-" . $dia;

        return $fecha;
    }

    /**
     * Función para dar formato a una fecha en el sistema Español
     * 
     * @param string $fecha la fecha a formatear
     * @return string la fecha con el formato dicho
     */
    public function convertirAFechaFormatoVista($fecha) {
        /* Formateo del campo fecha */
        $porciones = explode("-", $fecha);
        $anio = $porciones[0]; // porción1
        $mes = $porciones[1]; // porción2
        $dia = $porciones[2];

        $fechaDef = $dia . "/" . $mes . "/" . $anio;

        return $fechaDef;
    }

    /**
     * Función que calcula el porcentaje de uso en base a las sesiones
     * 
     * @param int $numSesiones El número de sesiones que se han realizado
     * @param int $numSesionesTarifa El número de sesiones que están contenidas dentro de la tarifa
     * @return int porcentaje de uso
     */
//    public function calcularPorcentajeUso($numSesiones, $numSesionesTarifa) {
//        if ($numSesiones != 0) {
//            return round((($numSesiones * 100) / $numSesionesTarifa));
//        } else {
//            return 0;
//        }
//    }

    /**
     * Crea una salt con el dni del paciente, la cual sera utilizada como password
     * de este
     * 
     * @param type $dni el dni del paciente
     * @return type la salt creada
     */
    public function crearPassword($dni) {
        return password_hash($dni, PASSWORD_DEFAULT);
    }

    /**
     * Comprueba el idioma del navegador
     * 
     * @return string cadena con el idioma del navegador
     */
//    public function comprobarIdiomaNavegador() {
//        $idiomas = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
//        $id = substr($idiomas, 0, 2);
//        $idioma = " ";
//
//        if ($id == 'en') {
//            $idioma = "english";
//        } else if ($id == 'es') {
//            $idioma = "spanish";
//        } else {
//            $idioma = " ";
//        }
//
//        return $idioma;
//    }

    /**
     * Obtiene la fecha actual con el formato de la BD
     * 
     * @return type la fecha actual
     */
    public function getFechaActual() {
        return date("Y-m-d");
    }

}
