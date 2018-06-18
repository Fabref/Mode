<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of my404
 *
 * @author Gabriel
 */
class My404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->output->set_status_header('404');
        //$data['content'] = 'error_404'; // View name 
        $this->load->view('error/404_personal_page'); //loading in my template 
    }

}
