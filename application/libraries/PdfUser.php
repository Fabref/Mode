<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/third_party/fpdf/fpdf.php";

class PdfUser extends FPDF {

    public function __construct() {
        parent::__construct();
    }

    public function Header() {
        $this->Image('dist/img/logo.png', 15, 8, 25);
        $this->SetFont('Arial', 'B', 20);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

?>