<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/third_party/fpdf/fpdf.php";

class Pdf extends FPDF {

    public function __construct() {
        parent::__construct();
        
        $this->CI =& get_instance();

        $idioma = $this->CI->utils->comprobarIdiomaNavegador();
        $this->CI->lang->load("message", $idioma);
    }

    public function Header() {
        $this->Image('dist/img/logo.png', 15, 8, 25);
        $this->SetFont('Arial', 'B', 30);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode($this->CI->lang->line('msg_pagina')) . ' ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

?>
