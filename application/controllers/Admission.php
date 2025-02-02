<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admission
 *
 * @author Evan DU
 */
class admission extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        
        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Admission_model", "am");
//       
    }

      //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) { redirect("Auth/Restricted");}
    }
    public function AdmissionList() {
        $this->checkuserRole(uri_string());
         $data["Title"] = "Admission Reg List";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Admission/AdmissionList');
    }
    
    //Search Student
    public function GetStudent() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $student = $this->am->GetStudent($request);
        echo json_encode($student);
    }
    public function DeleteStudent($id,$photo) {
        unlink("uploads/admission/" . $photo);
        $student = $this->am->DeleteStudent($id);
        echo json_encode($student);
    }

}
