<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reports
 *
 * @author Evan DU
 */
class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model('CommonModel', 'c');
        $_SESSION['visitor'] = $this->c->SetGetVisitor();
        $this->load->model("Routine_model", "RM");
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function StudentMobile() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Student Mobile Number";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Reports/StudentMobile');
    }
    
    public function GuardianMobile() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Guardian Mobile Number";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Reports/GuardianMobile');
    }

}
