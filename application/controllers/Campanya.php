<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Description of Campaña
 *
 * @author Gabriel Fuertes
 */
class Campanya extends CI_Controller {

    function __construct() {
        parent::__construct();

        /* Comprueba si ha expirado la session */
        if (empty($this->session->userdata("dniUsuario"))) {

            $this->session->set_flashdata('mensajeLogin', $this->lang->line('msg_session_expirada'));
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);

            redirect(site_url(), 'refresh');
        } else {
            $this->load->model('Campanya_model');
            $this->load->model('Cliente_model');
            $this->load->model('Linea_model');
            $this->load->model('Aspecto_model');
            $this->load->model('ItemVariable_model');
            $this->load->model('General_model');
            $this->load->model('AspectoTieneLinea_model');
            $this->load->model('Usuario_model');
        }
    }

    /**
     * Función index que redirige al resto de funciones de la campaña en 
     * base al parámetro indicado por la variable acción
     * 
     * @param string $accion
     */
    public function index($accion = FALSE, $complementario = FALSE, $complementario1 = FALSE) {

        switch ($accion) {

            /* Perfil campaña */
            case 'cvcc': /* Carga la vista crear campaña */
                $this->cargarCrearCampaña();
                break;

            case 'cvvc': /* Carga la vista ver campaña */
                $this->verCampaña($complementario);
                break;

            case 'cc': /* Crea la campaña */
                $this->crearCampaña();
                break;

            case 'cvlc': /* Carga la vista listar campañas */
                $this->listarCampañas();
                break;

            case 'cvec': /* Carga la vista editar campaña */
                $this->editarCampaña($complementario);
                break;

            case 'cec': /* Cambia es estado de la campaña */
                $this->cambiaEstadoCampaña($complementario, $complementario1);
                break;

            case 'cvrc': /* Carga la vista de los resultados de la campaña */
                $this->cargarResultadosCampaña($complementario);
                break;

            case 'cdrc': /* AJAX con los datos de la gráfica para los aspectos de la campaña */
                $this->cargarResultadosGraficaCampaña($complementario);
                break;

            case 'exp': /* Exportar datos */
                $this->exportarDatos($complementario);
                break;

            case 'cvpc': /* Carga la vista de los permisos de los usuarios de la campaña */
                $this->listarPermisosUsuariosCampana($complementario, $complementario1);
                break;

            case 'cvep': /* Carga la vista del formulario para los permisos de los usuarios de la campaña */
                $this->editarPermisosUsuariosCampana($complementario, $complementario1);
                break;
            
            case 'gpu': /* Carga la vista del formulario para los permisos de los usuarios de la campaña */
                $this->guardarPermisosUsuariosCampana($complementario, $complementario1);
                break;

            default : /* No ejecutamos nada de momento */

                break;
        }
    }

    /**
     * Funcion para cargar la vista con el formulario para crear una nueva campaña.
     */
    private function cargarCrearCampaña() {

        if (!empty($this->session->userdata('id_cliente'))) {
            $this->load->view('template/menuSuperior');
            if (empty($this->session->userdata('loginUsuario'))) {
                $this->load->view('template/menuLateral');
            } else {
                $this->load->view('template/menuLateralUsuarios');
            }
            $this->load->view('campanya/crearCampanya');
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ADVERTENCIA);
            $this->session->set_flashdata('mensaje', "No puede crear una nueva campaña sin previamente haber seleccionado un cliente");

            redirect('Cliente/index/cvlc', 'refresh');
        }
    }

    /**
     * Función para crear una nueva campaña. La comprobacion de los datos
     * introducidos en el formulario se hace a traves del "form_validation"
     * aunque aún no...
     */
    private function crearCampaña() {

        $campanya['nombre'] = $this->input->post('nombre', TRUE);
        $campanya['grupos'] = $this->input->post('grupos', TRUE);
        $campanya['descripcion'] = $this->input->post('descripcion', TRUE);

        $fechaApertura = $this->input->post('fechaApertura', TRUE);
        $fechaCierre = $this->input->post('fechaCierre', TRUE);

        $campanya['fechaInicio'] = $this->utils->convertirAFechaFormatoBD($fechaApertura);
        $campanya['fechaFin'] = $this->utils->convertirAFechaFormatoBD($fechaCierre);
        $campanya['estado'] = 1;

        $campanya['fk_cliente'] = $this->session->userdata('id_cliente');

        $campanya['url'] = $this->crearToken();

        $idcampanya = $this->Campanya_model->insertarCampaña($campanya);

        if ($idcampanya == null) {
            $this->session->set_flashdata('mensaje', "No se ha creado correctamente la campa&ntilde;a");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        }
        redirect('Campanya/index/cvlc', 'refresh');
    }

    /**
     * Función para listar los usuarios y sus permisos de una campaña. 
     */
    private function listarPermisosUsuariosCampana($id_campana, $fk_cliente) {

        $usuarios = $this->Usuario_model->getUsuariosCliente($fk_cliente);

        $data['id_campana'] = $id_campana;
        $data['usuarios'] = $usuarios;

        $permisosLectura = array();
        $permisosEscritura = array();

        foreach ($usuarios as $usuario) {
            $permisoLectura = $this->Campanya_model->permisoLectura($usuario->id_usuario, $id_campana);
            $permisoEscritura = $this->Campanya_model->permisoEscritura($usuario->id_usuario, $id_campana);
            array_push($permisosEscritura, $permisoEscritura);
            array_push($permisosLectura, $permisoLectura);
        }

        $data['permisosLectura'] = $permisosLectura;
        $data['permisosEscritura'] = $permisosEscritura;
        
        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('campanya/listarPermisosUsuariosCampanya', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función que carga la vista del listado de campañas
     */
    private function listarCampañas() {

        if (empty($this->session->userdata('loginUsuario')) && empty($this->session->userdata('id_cliente'))) {
            $campanyas = $this->Campanya_model->getCampañas();
        } else {
            $campanyas = $this->Campanya_model->getCampañasCliente($this->session->userdata('id_cliente'));
            if ($this->session->userdata('es_administrador') == 1) {
//                $campanyas = $this->Campanya_model->getCampañasCliente($this->session->userdata('id_cliente'));
                $this->session->set_userdata('puede_editar', 1);
                $this->session->set_userdata('puede_consultar', 1);
            }
        }

        $clientes = array();

        if ($campanyas != NULL) {
            foreach ($campanyas as $campanya) {
                $cliente = $this->Cliente_model->getNombreCliente($campanya->fk_cliente);
                array_push($clientes, $cliente);
            }
        }


        $data['campanyas'] = $campanyas;
        $data['clientes'] = $clientes;

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('campanya/listarCampanyas', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función que carga la vista de edición de campaña con las partidas
     * aspectos e items que tenga cargados
     */
    private function editarCampaña($id_campaña) {
        $campanya = $this->Campanya_model->getCampaña($id_campaña);
        $lineas = $this->Linea_model->getLineasCampaña($id_campaña);
        $aspectos = $this->Aspecto_model->getAspectosCampaña($id_campaña);
        $items = $this->ItemVariable_model->getItemsCampaña($id_campaña);

        $importesAspectos = 0;

        $importeTotalAspecto = array();


        if ($aspectos > 0) {
            /*
             * Recorremos todos los aspectos de la campaña si existen
             */
            foreach ($aspectos as $aspecto) {
                $importesAspecto = 0;
                $lineasAsp = $this->AspectoTieneLinea_model->getLineasAspecto($aspecto->id_aspecto);
                if ($lineasAsp > 0) {
                    /*
                     * Para cada uno de los aspectos vemos su importe en las lineas asignadas
                     */
                    foreach ($lineasAsp as $importe) {
                        /*
                         * Este es el importe total del aspecto para todas sus lineas
                         */
                        $importesAspecto += $importe->importe;
                    }
                    array_push($importeTotalAspecto, $importesAspecto);
                } else {
                    array_push($importeTotalAspecto, 0);
                }
                /*
                 * Este es el importe acumulado de todos los aspectos
                 */
                $importesAspectos += $importesAspecto;
            }
        }

        $aspectosItems = array();

        if ($items > 0) {
            /*
             * Recorremos los items de la campaña
             */
            foreach ($items as $item) {
                $aspectoItem = $this->Aspecto_model->getAspecto($item->fk_aspecto);
                /*
                 * Guardamos el nombre del aspecto al que está asociado el item
                 */
                array_push($aspectosItems, $aspectoItem->nombre);
            }
        }

        $data['campanya'] = $campanya;
        $data['lineas'] = $lineas;
        $data['aspectos'] = $aspectos;
        $data['items'] = $items;
        $data['importeTotalAspecto'] = $importeTotalAspecto;
        $data['importeAspectos'] = $importesAspectos;
        $data['aspectoItem'] = $aspectosItems;
        $data['id_campana'] = $id_campaña;

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('campanya/editarCampanya', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función que carga la vista de edición de campaña con las partidas
     * aspectos e items que tenga cargados
     */
    private function verCampaña($id_campaña) {
        $campanya = $this->Campanya_model->getCampaña($id_campaña);
        $lineas = $this->Linea_model->getLineasCampaña($id_campaña);
        $aspectos = $this->Aspecto_model->getAspectosCampaña($id_campaña);
        $items = $this->ItemVariable_model->getItemsCampaña($id_campaña);

        $importesAspectos = 0;

        $importeTotalAspecto = array();

        if ($aspectos > 0) {
            /*
             * Recorremos todos los aspectos de la campaña si existen
             */
            foreach ($aspectos as $aspecto) {
                $importesAspecto = 0;
                $lineasAsp = $this->AspectoTieneLinea_model->getLineasAspecto($aspecto->id_aspecto);
                if ($lineasAsp > 0) {
                    /*
                     * Para cada uno de los aspectos vemos su importe en las lineas asignadas
                     */
                    foreach ($lineasAsp as $importe) {
                        /*
                         * Este es el importe total del aspecto para todas sus lineas
                         */
                        $importesAspecto += $importe->importe;
                    }
                    array_push($importeTotalAspecto, $importesAspecto);
                } else {
                    array_push($importeTotalAspecto, 0);
                }
                /*
                 * Este es el importe acumulado de todos los aspectos
                 */
                $importesAspectos += $importesAspecto;
            }
        }

        $aspectosItems = array();

        if ($items > 0) {
            /*
             * Recorremos los items de la campaña
             */
            foreach ($items as $item) {
                $aspectoItem = $this->Aspecto_model->getAspecto($item->fk_aspecto);
                /*
                 * Guardamos el nombre del aspecto al que está asociado el item
                 */
                array_push($aspectosItems, $aspectoItem->nombre);
            }
        }

        $data['campanya'] = $campanya;
        $data['lineas'] = $lineas;
        $data['aspectos'] = $aspectos;
        $data['items'] = $items;
        $data['importeTotalAspecto'] = $importeTotalAspecto;
        $data['importeAspectos'] = $importesAspectos;
        $data['aspectoItem'] = $aspectosItems;
        $data['id_campana'] = $id_campaña;

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('campanya/verCampanya', $data);
        $this->load->view('template/footer');
    }

    /**
     * Cambiamos el estado de la campaña a Abierto a consulta o Cerrado
     * 
     * @param int $id_campanya La campaña a cambiar
     * @param int $estado El nuevo estado de la campaña
     */
    private function cambiaEstadoCampaña($id_campanya, $estado) {
        $dato['estado'] = $estado;
        $resultado = $this->Campanya_model->cambiaEstado($id_campanya, $dato);

        $this->ItemVariable_model->cargaResumenPorPregunta($id_campanya);
        $this->Aspecto_model->cargaPRAAspectos($id_campanya);

        if ($resultado) {
            $this->session->set_flashdata('mensaje', "Se ha cambiado el estado de la campa&ntilde;a");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
        } else {
            $this->session->set_flashdata('mensaje', "No se ha cambiado el estado de la campa&ntilde;a");
            $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
        }
        redirect('Campanya/index/cvlc', 'refresh');
    }

    /**
     * Función que carga la vista con el formulario para editar los permisos de los usuarios en la campaña
     * 
     * @param int $id_usuario El usuario al que se le van a asignar o eliminar permisos
     * @param int $id_campanya El identificador de la campaña a la que le van a dar permisos al usuario
     */
    private function editarPermisosUsuariosCampana($id_usuario, $id_campanya) {
        $data['id_usuario'] = $id_usuario;
        $data['id_campanya'] = $id_campanya;

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('campanya/editarPermisosUsuario', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función que recoge los permisos de los usuarios en la campaña
     * 
     * @param int $id_usuario El usuario al que se le van a asignar o eliminar permisos
     * @param int $id_campanya El identificador de la campaña a la que le van a dar permisos al usuario
     */
    private function guardarPermisosUsuariosCampana($id_usuario, $id_campanya) {


        $permisos['permiso_escritura'] = $this->input->post('puede_editar', TRUE);
        $permisos['permiso_lectura'] = $this->input->post('puede_consultar', TRUE);

        $existe = $this->Campanya_model->existeUsuarioPermisosCampana($id_campanya, $id_usuario);

        if ($existe) {
            $actualizado = $this->Campanya_model->actualizaPermisosUsuarioCampana($id_campanya, $permisos);
            if ($actualizado) {
                $this->session->set_flashdata('mensaje', "Se han cambiado los permisos del usuario en la campa&ntilde;a");
                $this->session->set_flashdata('tipoMensaje', MENSAJE_REALIZADO_OK);
            } else {
                $this->session->set_flashdata('mensaje', "No han cambiado los permisos del usuario en la campa&ntilde;a");
                $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
            }
        } else {
            $permisos['fk_usuario'] = $id_usuario;
            $permisos['fk_campana'] = $id_campanya;
            $id = $this->Campanya_model->insertaPermisosUsuarioCampana($permisos);
            if ($id == null) {
                $this->session->set_flashdata('mensaje', "No se ha creado correctamente los permisos del usuario en la campa&ntilde;a");
                $this->session->set_flashdata('tipoMensaje', MENSAJE_DE_ERROR);
            }
        }

        redirect('Campanya/index/cvlc', 'refresh');
    }

    /**
     * Cargamos la vista con la gráfica de los resultados así como los aspectos, PRA y presupuestos
     * 
     * @param int $id_campana El identificador de la campaña a mostrar los resultados
     */
    private function cargarResultadosCampaña($id_campana) {
        $campana = $this->Campanya_model->getCampaña($id_campana);
        $items = array();
        $aspectos = $this->Aspecto_model->getAspectosCampaña($id_campana);

        $importesAspectos = 0;

        $importeTotalAspecto = array();


        if ($aspectos > 0) {
            /*
             * Recorremos todos los aspectos de la campaña si existen
             */
            foreach ($aspectos as $aspecto) {
                $importesAspecto = 0;
                $lineasAsp = $this->AspectoTieneLinea_model->getLineasAspecto($aspecto->id_aspecto);

                if ($lineasAsp > 0) {
                    /*
                     * Para cada uno de los aspectos vemos su importe en las lineas asignadas
                     */
                    foreach ($lineasAsp as $importe) {
                        /*
                         * Este es el importe total del aspecto para todas sus lineas
                         */
                        $importesAspecto += $importe->importe;
                        array_push($importeTotalAspecto, $importesAspecto);
                    }
                } else {
                    array_push($importeTotalAspecto, $importesAspecto);
                }
                /*
                 * Este es el importe acumulado de todos los aspectos
                 */
                $importesAspectos += $importesAspecto;
                /*
                 * Obtenemos los items de cada aspecto
                 */
                $itemsAspecto = $this->ItemVariable_model->getItemsAspecto($aspecto->id_aspecto);
                /*
                 * Los agregamos al array que contendrá todos los items, agrupados por aspecto
                 */
                array_push($items, $itemsAspecto);
            }
        }

        $data['campanya'] = $campana;
        $data['items'] = $items;
        $data['aspectos'] = $aspectos;
        $data['importesAspecto'] = $importeTotalAspecto;
        $data['importesAspectos'] = $importesAspectos;

        //echo json_encode($aspectos);

        $this->load->view('template/menuSuperior');
        if (empty($this->session->userdata('loginUsuario'))) {
            $this->load->view('template/menuLateral');
        } else {
            $this->load->view('template/menuLateralUsuarios');
        }
        $this->load->view('campanya/verResultadosCampanya', $data);
        $this->load->view('template/footer');
    }

    /**
     * Función AJAX para cargar los datos de la gráfica con los resultados de la encuesta
     * 
     * @param int $id_campana El identificador de la campaña con los datos a cargar
     * @return JSON Los datos de la gráfica en JSON
     */
    private function cargarResultadosGraficaCampaña($id_campana) {
//        $aspectos = $this->Aspecto_model->getAspectosCampañaOrdenadosNOM($id_campana);
        $aspectos = $this->Aspecto_model->getAspectosCampaña($id_campana);

        $aspectosGrafica = array();
        $infoGrafica = array();

        foreach ($aspectos as $aspt) {

            $nombre = " " . $aspt->nombre . " ";
            $media = $aspt->media;
            $desviacion = $aspt->desviacion;

            $aspecto['nombre'] = $nombre;
            $aspecto['media'] = number_format($media, 2);
            $aspecto['desviacion'] = number_format($desviacion, 2);

            array_push($aspectosGrafica, $aspecto);
        }

        $infoGrafica['aspectosGrafica'] = $aspectosGrafica;

        echo json_encode($infoGrafica);
    }

    /**
     * Función que exporta a un fichero excel los datos
     * 
     * @param int $id_campanya Indicamos el identificador de la campaña de la que exportaremos los datos
     * @return file Los datos exportados a fichero
     */
    private function exportarDatos($id_campanya) {
        $result = $this->Campanya_model->esportarDatos($id_campanya);

        $keys = array_keys($result[0]);


        $spreadsheet = new Spreadsheet();
        /*
         * Establecemos las propiedades del documento
         */
        $spreadsheet->getProperties()->setCreator('Sogres-Mode ')
                ->setLastModifiedBy($this->session->userdata('loginUsuario'))
                ->setTitle('Resultados de la Campaña')
                ->setSubject('Respuestas de la campaña lanzada')
                ->setDescription('Se pueden ver las respuestas de los usuarios que han realizado la camapaña');

        /*
         * Añadimos estilo a la cabecera
         */
        $styleArray = array(
            'font' => array('bold' => true,),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,),
            'borders' => array('top' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,)),
            'fill' => array(
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array('argb' => 'FFA0A0A0',), 'endcolor' =>
                array('argb' => 'FFFFFFFF',),));
        $spreadsheet->getActiveSheet()->getStyle('A1:ZZ1')->applyFromArray($styleArray);

        /*
         * Ajustamos el ancho de las celdas en base a su contenido
         */
        foreach (range('A', 'ZZ') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }

        /*
         * Cambiamos el nombre de la hoja
         */
        $spreadsheet->getActiveSheet()->setTitle('Resultados');

        /*
         * Inclusión de los datos en la Hoja Excel.
         */
        //Cabecera
        $spreadsheet->getActiveSheet()
                ->fromArray(
                        $keys, // Cabeceras
                        NULL, // Array values with this value will not be set
                        'A1'         // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
        );
        //Conjunto de datos
        $spreadsheet->getActiveSheet()
                ->fromArray(
                        $result, // Los datos de las encuestas
                        NULL, // Array values with this value will not be set
                        'A2'         // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
        );



        //$writer = new Xlsx($spreadsheet);

        $filename = 'Exportacion_resultados';

        /* Here there will be some code where you create $spreadsheet */

// redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    /**
     * Crea un token unico para cada campaña
     * 
     * @return type el token creado
     */
    private function crearToken() {
        return sha1(uniqid(rand(), true));
    }

}
