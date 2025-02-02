<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of results
 *
 * @author Evan DU
 */
class Results extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        
        $this->load->model("Result_model", "RM");
        $this->load->model("CommonModel", "Common");
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
        $data["Title"] = "Student Result ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view("Result/Index");
    }

    public function ResultPdf() {
        $this->checkuserRole(uri_string());
        $data = array(
            "Title" => "Result pdf",
            "Faculty" => $this->Common->GetFaculty(),
            "Session" => $this->Common->GetSession()
        );

        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Result/ResultPdf');
    }

    public function UpdateResultPdf() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->RM->UpdateResultPdf($request);
        echo json_encode($result);
    }

    public function CreateResultPdf() {
        $this->checkuserRole(uri_string());
        $data = array(
            "Title" => "Submit Result",
            "Faculty" => $this->Common->GetFaculty(),
           
        );
        if (isset($_POST['Add'])) {
            $this->form_validation->set_rules('FacultyID', 'FacultyID', 'required');     
            $this->form_validation->set_rules('SemesterID', 'Faculty', 'required');
         
            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './uploads/ResultPdf/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|zip|rar|docx|pdf';
                $config['max_size'] = 9000000;
//                $config['max_width'] = 300;
//                $config['max_height'] = 300;

                $this->load->library('upload', $config);
                $this->upload->do_upload('File');
                $file = $this->upload->data();

                $fdata = array(
                    'FacultyID' => $_POST['FacultyID'],                    
                    'SemesterID' => trim($_POST['SemesterID']),
                    'Comment' => $_POST['Comment'],
                    'Year' => $_POST['Year'],
                    'File' => $file['file_name'],
                    'CreatedBy' => $_SESSION["id"],                   
                    'PublishDate' => $_POST['PublishDate']
                );
                $this->db->insert('result_pdf', $fdata);
                $this->session->set_flashdata("success", "Your result has been submited!! ");
                redirect("Results/ResultPdf", "refresh");
            }
        }

        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Result/CreateResultPdf');
    }

    public function GetAllResultPdf() {
       
        $result = $this->RM->GetAllResultPdf();
        echo json_encode($result);
    }

    public function DeleteResultPdf($id) {
        $result = $this->RM->DeleteResultPdf($id);
        echo json_encode($result);
    }

}
