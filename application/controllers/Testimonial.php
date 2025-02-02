<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Testimonial
 *
 * @author Evan DU
 */
class Testimonial extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Testimonial_Model", "TestM");
        $this->load->library('Pdf_report');
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function Index() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Testimonial Certificate";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view("Testimonial/Index", $data);
    }
    
    
    public function AppearedCertificateSearch() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Appired Certificate ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view("Testimonial/AppearedCertificate", $data);
    }

    public function GetTestimonial($id) {
        //$this->checkuserRole(uri_string());
        $data['Info'] = $this->TestM->GetTestInfo($id);
//        $file= "https://www.bitc.expresstechbd.com/testimonial/TestApi/$id";
//        $data['Info'] = file_get_contents($file);
        $this->load->view("Testimonial/TestimonialPdf", $data);
    }

    public function GetACertificate($id) {
        // $this->checkuserRole(uri_string());
        $data['Info'] = $this->TestM->GetTestInfo($id);
       
        $this->load->view("Testimonial/AppiredCertificatePdf", $data);
    }
    
     public function GetACertificateWithOutViva($id) {
        // $this->checkuserRole(uri_string()WithOutViva);
        $data['Info'] = $this->TestM->GetTestInfo($id);
       
        $this->load->view("Testimonial/AppiredCertificatePdfWithOutViva", $data);
    }

     public function GetACertificateProtoyon($id) {
        // $this->checkuserRole(uri_string()WithOutViva);
        $data['Info'] = $this->TestM->GetTestInfo($id);
       
        $this->load->view("Testimonial/Protoyon", $data);
    }

    
    
    
    
    
    
    
    
    public function TestApi($id) {
        // $this->checkuserRole(uri_string());
        $data = $this->TestM->GetTestInfo($id);
        echo json_encode($data);
    }

    public function GetApiData($id) {
        $file = "https://www.bitc.expresstechbd.com/testimonial/TestApi/$id";
        $data = file_get_contents($file);
//        $data = mb_substr($data, strpos($data, '{'));
//        $data = mb_substr($data, 0, -1);
//        $result = json_decode($data, true);
//        print_r($result['ResultSet']['Result'][0]);
        echo $data;
    }

}
