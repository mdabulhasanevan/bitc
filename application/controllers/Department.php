<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of department
 *
 * @author Evan DU
 */
class department Extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('News_model', 'm');
        $this->load->model('CommonModel', 'c');
        $_SESSION['visitor'] = $this->c->SetGetVisitor();
    }

    public function CSE() {
        $data = $this->m->NewsAndTitle($Title = "CSE Department ");

        $this->load->view("Include/Header", $data);
        $this->load->view("department/CSE");
        $this->load->view("Include/Footer");
    }

    public function BBA() {
        $data = $this->m->NewsAndTitle($Title = "BBA Department ");

        $this->load->view("Include/Header", $data);
        $this->load->view("department/BBA");
        $this->load->view("Include/Footer");
    }

    public function MBA() {
        $data = $this->m->NewsAndTitle($Title = "MBA Department ");

        $this->load->view("Include/Header", $data);
        $this->load->view("department/MBA");
        $this->load->view("Include/Footer");
    }

    public function Diploma() {
        $data = $this->m->NewsAndTitle($Title = "Diploma Department ");

        $this->load->view("Include/Header", $data);
        $this->load->view("department/Diploma");
        $this->load->view("Include/Footer");
    }

}
