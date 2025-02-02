<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author Evan DU
 */
class Exam extends CI_Controller{
     public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Routine_model", "RM");
    }
    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) { redirect("Auth/Restricted");}
    }
    public function Index() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Exam ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Exam/Index');
    }
}