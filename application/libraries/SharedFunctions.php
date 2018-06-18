<?php

/**
 * Clase con funciones que son utilizadas desde varios controladores.
 */
class SharedFunctions {
    
    public function __construct() {
        $this->CI =& get_instance();

        $idioma = $this->CI->utils->comprobarIdiomaNavegador();
        $this->CI->lang->load("message", $idioma);
    }
    
    
    /**
     * Obtiene los ejercicios asociados a una determinada patologia. Para ello, obtiene
     * los ejercicios que estan asociados a una articulacion, pertenecen a la licencia
     * del centro y tambien a la version de la app contratada por el mismo. Ademas, se
     * obtienen los ejercicios complementarios que sin ser los de esa articulacion, se 
     * pueden utilizar para reahabilitar la articulacion afectada en la patologia.
     */
    function getHtmlEjerciciosByPatologia($idPatologia) {
        
        $this->CI->load->model('EjercicioKinect_model');
        
        $idCentro = $this->CI->session->userdata('idCentroFisio');

        $version = $this->CI->Licencia_model->obtenerVersionFromLicencia($idCentro);
        $tipoLicencia = $this->CI->Licencia_model->obtenerTipoLicenciaFromLicencia($idCentro);
        $idArticulacion = $this->CI->Patologia_model->getIdArticulacionFromPatologia($idPatologia);

        $ejerciciosKinect = $this->CI->EjercicioKinect_model->obtenerEjerciciosPatologia($idArticulacion, $version, $tipoLicencia);
        $ejerciciosKinectComplementarios = $this->CI->EjercicioKinect_model->obtenerEjerciciosComplementariosPatologia($idArticulacion, $version, $tipoLicencia);

        $listaEjerciciosPatologia = '<option value="NON" selected disabled>' . $this->CI->lang->line('msg_seleccionar_ejercicio') . '</option>';

        // Añade los ejercicios principales
        $numEjercicioActual = 1;
        foreach ($ejerciciosKinect->result() as $ejercicioActual) {
            if ($numEjercicioActual == 1) {
                $tipoEjercicioAnterior = $ejercicioActual->fk_tipo_ejercicio_kinect;
            }

            // Si cambia el tipo de ejercicio y no es el ultimo de la lista, introduce una separacion entre ellos
            if (($ejercicioActual->fk_tipo_ejercicio_kinect != $tipoEjercicioAnterior) && (($numEjercicioActual < count($ejerciciosKinect->result())))) {
                $listaEjerciciosPatologia = $listaEjerciciosPatologia . '<option disabled>-------------------------------------------------------------</option>';
            }

            $listaEjerciciosPatologia = $listaEjerciciosPatologia . '<option value="' . $ejercicioActual->idejercicio_kinect . '">' . $this->CI->lang->line("ek_" . $ejercicioActual->idejercicio_kinect) . '</option>';

            $tipoEjercicioAnterior = $ejercicioActual->fk_tipo_ejercicio_kinect;
            $numEjercicioActual++;
        }

        // Si hay ejercicios complementarios, añade una linea de separacion entre los ejercicios principales y los complementarios
        if (count($ejerciciosKinectComplementarios->result()) > 0) {
            $listaEjerciciosPatologia = $listaEjerciciosPatologia . '<option disabled>-------------------------------------------------------------</option>';
        }

        // Añade los ejercicios complementarios
        $numEjercicioCompActual = 1;
        foreach ($ejerciciosKinectComplementarios->result() as $ejercicioCompActual) {
            if ($numEjercicioCompActual == 1) {
                $articulcionEjercicioAnterior = $ejercicioCompActual->fk_articulacion;
            }

            // Si cambia el tipo de ejercicio y no es el ultimo de la lista, introduce una separacion entre ellos
            if (($ejercicioCompActual->fk_articulacion != $articulcionEjercicioAnterior) && (($numEjercicioCompActual < count($ejerciciosKinectComplementarios->result())))) {
                $listaEjerciciosPatologia = $listaEjerciciosPatologia . '<option disabled>-------------------------------------------------------------</option>';
            }

            $listaEjerciciosPatologia = $listaEjerciciosPatologia . '<option value="' . $ejercicioCompActual->idejercicio_kinect . '">' . $this->CI->lang->line("ek_" . $ejercicioCompActual->idejercicio_kinect) . '</option>';

            $articulcionEjercicioAnterior = $ejercicioCompActual->fk_articulacion;
            $numEjercicioCompActual++;
        }

        return $listaEjerciciosPatologia;
    }
    
    
    /**
     * Obtiene las CCAA asociadas a un pais seleccionado. Se obtiene 
     * en formato html para ponerlo en el select de CCAA
     * 
     * Utilizado desde Jquery al crear un paciente nuevo y al ocurrir un error 
     * en la creacion del mismo
     */
    function getComunidadesByPais($idPais = FALSE, $comunidadSeleccionada = FALSE) {

        $this->CI->load->model('General_model');
        
        if (!$idPais) {
            $calledByJquery = True;
            $idPais = $this->input->post('idPais', TRUE);
        }
        
        $htmlComunidadesFromPais = '';
        $comunidadesFromPais = $this->CI->General_model->obtenerComunidadesByPais($idPais);
        
        if (isset($comunidadesFromPais)) {
            
            if ( ! $comunidadSeleccionada || ($comunidadSeleccionada == "NON")) {
                $htmlComunidadesFromPais = '<option value="NON" selected>' . $this->CI->lang->line('msg_seleccionar_ccaa') . '</option>';
            } else {
                $htmlComunidadesFromPais = '<option value="NON" disabled>' . $this->CI->lang->line('msg_seleccionar_ccaa') . '</option>';
            }
        

            foreach ($comunidadesFromPais as $comunidadActual) {
                if (($comunidadSeleccionada != FALSE) && (strcmp($comunidadActual->idccaa, $comunidadSeleccionada) == 0)) {
                    $htmlComunidadesFromPais = $htmlComunidadesFromPais . '<option value="' . $comunidadActual->idccaa . '" selected>' . $this->CI->lang->line('ccaa_' . $comunidadActual->idccaa) . '</option>';
                } else {
                    $htmlComunidadesFromPais = $htmlComunidadesFromPais . '<option value="' . $comunidadActual->idccaa . '">' . $this->CI->lang->line('ccaa_' . $comunidadActual->idccaa) . '</option>';
                }
            }
        }
        
        /* Para distinguir entre si ha sido llamado desde JQuery o desde este controller */
        if (isset($calledByJquery)) {
            echo $htmlComunidadesFromPais;
        } else {
            return $htmlComunidadesFromPais;
        }
    }
    
    
    /**
     * Obtiene las provincias asociadas a una comunidad seleccionada. Se obtiene 
     * en formato html para ponerlo en el select de las provincias
     * 
     * Utilizado desde Jquery al crear un paciente nuevo y al ocurrir un error 
     * en la creacion del mismo
     */
    function getProvinciasByComunidad($idComunidad = FALSE, $provinciaSeleccionada = FALSE) {

        $this->CI->load->model('General_model');
        
        if (!$idComunidad) {
            $calledByJquery = True;
            $idComunidad = $this->input->post('idComunidad', TRUE);
        }
        
        $htmlProvinciasFromComunidad = '';
        $provinciaFromComunidad = $this->CI->General_model->obtenerProvinciasByComunidad($idComunidad);
        
        if (isset($provinciaFromComunidad)) {
            
            if ( ! $provinciaSeleccionada || ($provinciaSeleccionada =="NON")) {
                $htmlProvinciasFromComunidad = '<option value="NON" selected>' . $this->CI->lang->line('msg_seleccionar_provincia') . '</option>';
            } else {
                $htmlProvinciasFromComunidad = '<option value="NON" disabled>' . $this->CI->lang->line('msg_seleccionar_provincia') . '</option>';
            }
                
        
            foreach ($provinciaFromComunidad as $provinciaActual) {
                if (($provinciaSeleccionada != FALSE) && (strcmp($provinciaActual->idprovincia, $provinciaSeleccionada) == 0)) {
                    $htmlProvinciasFromComunidad = $htmlProvinciasFromComunidad . '<option value="' . $provinciaActual->idprovincia . '" selected>' . $this->CI->lang->line('provincia_' . $provinciaActual->idprovincia) . '</option>';
                } else {
                    $htmlProvinciasFromComunidad = $htmlProvinciasFromComunidad . '<option value="' . $provinciaActual->idprovincia . '">' . $this->CI->lang->line('provincia_' . $provinciaActual->idprovincia) . '</option>';
                }
            }
        }
        
        /* Para distinguir entre si ha sido llamado desde JQuery o desde este controller */
        if (isset($calledByJquery)) {
            echo $htmlProvinciasFromComunidad;
        } else {
            return $htmlProvinciasFromComunidad;
        }
    }

}
