<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Evan DU
 */
class Home Extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('News_model', 'm');
        $this->load->model('RearchProject_Model', 'Re');
        $this->load->model('CommonModel', 'c');
        $this->load->model("student_model", "sm");

        $_SESSION['visitor'] = $this->c->SetGetVisitor();
    }

    public function Index() {

        $data = $this->m->NewsAndTitle($Title = "BITC- Barisal Information Technology College");
        $data["slide"]=1;
        $this->load->view("Include/Header", $data);
        $this->load->view("Home/Index");
        $this->load->view("Include/Footer");
    }

    public function AdmissionDetail() {
        $data = $this->m->NewsAndTitle($Title = "Admission ");

        $this->load->view("Include/Header", $data);
        $this->load->view("Home/admission");
        $this->load->view("Include/Footer");
    }

    public function About() {
        $data = $this->m->NewsAndTitle($Title = "About ");
        $this->load->view("Include/Header", $data);
        $this->load->view("Home/About");
        $this->load->view("Include/Footer");
    }

    public function Contact() {
        $data = $this->m->NewsAndTitle($Title = "Contact ");

        $this->load->view("Include/Header", $data);
        $this->load->view("Home/Contact");
        $this->load->view("Include/Footer");
    }

    public function research() {
        $data = $this->m->NewsAndTitle($Title = "Research and Projects ");
        $data["Research"] = $this->Re->GetAllRearchProjects();
        $this->load->view("Include/Header", $data);
        $this->load->view("Home/research");
        $this->load->view("Include/Footer");
    }

    public function notice() {
        $data = $this->m->NewsAndTitle($Title = "All Notice ");

        $this->load->view("Include/Header", $data);
        $this->load->view("Home/notice");
        $this->load->view("Include/Footer");
    }

    public function gallery() {
        $data = $this->m->NewsAndTitle($Title = "Gallery ");

        $this->load->view("Include/Header", $data);
        $this->load->view("Home/gallery");
        $this->load->view("Include/Footer");
    }

    public function NoticeOpen($Id) {
        $data = $this->m->NewsAndTitle($Title = "Open Notice");

        $rowCertain = $this->m->GetCertainNews($Id);

        $data["MyNews"] = $rowCertain;

        $this->load->view("Include/Header", $data);
        $this->load->view("Home/NoticeOpen");
        $this->load->view("Include/Footer");
    }

    public function studentofthesemester($id) {
        $data = $this->m->NewsAndTitle($Title = "Student of the Semester ");

//        This is for fb title discription and photo share
        $data["StudentId"] = $id;

        foreach ($data["SOS"] as $X) {
            if ($X->Id == $id) {
                $data["MyShareDetail"] = " Name:" . $X->FullName . " This student's Total Average Attendance is up to  " . $X->Attendance
                        . ", Result is  " . $X->Exam . ", Total Evaluation is  " . $X->Behave;
                $data["Image"] = base_url() . "uploads/students/" . $X->Photo;
            }
        }


        $this->load->view("Include/Header", $data);
        $this->load->view("Home/studentofthesemester");
        $this->load->view("Include/Footer");
    }

    public function principal() {
        $data = $this->m->NewsAndTitle($Title = "অধ্যক্ষের দুটি কথা");

        $this->load->view("Include/Header", $data);
        $this->load->view("Home/Principal");
        $this->load->view("Include/Footer");
    }

    public function GetAllClassRoutine() {
        $this->load->model("Routine_model", "RM");
        $results = $this->RM->GetAllClassRoutine();
        echo json_encode($results);
    }

    #region Admission Reg

    public function AdmissionApplyReg() {

        if (isset($_POST['Signup'])) {
            $this->load->library("form_validation");
            $this->load->helper("file");
            
            $this->form_validation->set_rules('Faculty', 'Faculty', 'required');
            $this->form_validation->set_rules('SessionId', 'SessionId', 'required');
            $this->form_validation->set_rules('FullName', 'FullName', 'required');
            $this->form_validation->set_rules('Mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('Gender', 'Gender', 'required');
            $this->form_validation->set_rules('Religion', 'Religion', 'required');
            $this->form_validation->set_rules('IsPhysicalDrawback', 'IsPhysicalDrawback', 'required');
            $this->form_validation->set_rules('Nationality', 'Nationality', 'required');

            $this->form_validation->set_rules('DateOfBirth', 'DateOfBirth', 'required');
            $this->form_validation->set_rules('Age', 'Age', 'required');
            $this->form_validation->set_rules('ssc_year', 'ssc_year', 'required');
            $this->form_validation->set_rules('ssc_group', 'ssc_group', 'required');

            $this->form_validation->set_rules('ssc_board', 'ssc_board', 'required');
            $this->form_validation->set_rules('ssc_roll', 'ssc_roll', 'required');
            $this->form_validation->set_rules('ssc_gpa', 'ssc_gpa', 'required');

            $this->form_validation->set_rules('hsc_year', 'hsc_year', 'required');
            $this->form_validation->set_rules('hsc_group', 'hsc_group', 'required');
            $this->form_validation->set_rules('hsc_board', 'hsc_board', 'required');
            $this->form_validation->set_rules('hsc_roll', 'hsc_roll', 'required');
            $this->form_validation->set_rules('hsc_gpa', 'hsc_gpa', 'required');
            
            //  $this->form_validation->set_rules('Photo', '', 'callback_file_check');

            //$this->form_validation->set_rules('Photo', 'Photo', 'required');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './uploads/admission/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 200;
//                $config['max_width'] = 300;
//                $config['max_height'] = 300;

                $this->load->library('upload', $config);
                $this->upload->do_upload('Photo');
                $file = $this->upload->data();
                $fdata = array(
                    'FullName' => $_POST['FullName'],
                    'Faculty' => $_POST['Faculty'],
                    'SessionId' => $_POST['SessionId'],
                    'Mobile' => $_POST['Mobile'],
                    'Gender' => $_POST['Gender'],
                    'Religion' => $_POST['Religion'],
                    'IsPhysicalDrawback' => $_POST['IsPhysicalDrawback'],
                    'Nationality' => $_POST['Nationality'],
                    'DateOfBirth' => $_POST['DateOfBirth'],
                    'Age' => $_POST['Age'],
                    'ssc_year' => $_POST['ssc_year'],
                    'ssc_group' => $_POST['ssc_group'],
                    'ssc_board' => $_POST['ssc_board'],
                    'ssc_roll' => $_POST['ssc_roll'],
                    'ssc_reg' => $_POST['ssc_reg'],
                    'ssc_year' => $_POST['ssc_year'],
                    'ssc_gpa' => $_POST['ssc_gpa'],
                    'hsc_year' => $_POST['hsc_year'],
                    'hsc_group' => $_POST['hsc_group'],
                    'hsc_board' => $_POST['hsc_board'],
                    'hsc_roll' => $_POST['hsc_roll'],
                    'hsc_reg' => $_POST['hsc_reg'],
                    'hsc_gpa' => $_POST['hsc_gpa'],
                    'Photo' => $file['file_name'],
                );
                $this->db->insert('admissionreg', $fdata);
                 $insert_id = $this->db->insert_id();
                 $Reference=$insert_id+1000;
                 
                 $up=array(
                     "Reference"=>$Reference
                 );
                 $this->db->where(array('RID' => $insert_id));
                 $this->db->update("admissionreg",$up);
                 
                $this->session->set_flashdata("success", "Your Registration has been submited your Reference ID is $Reference. We will contact with you soon!! ");
                redirect("Home/AdmissionApplyReg", "refresh");
            }
        }

        $data = $this->m->NewsAndTitle($Title = "Admission Registration Form");

        $data["field"] = $this->sm->GetAllCommonField();
        $this->load->view("Include/Header", $data);
        $this->load->view("Admission/registration2");
        //$this->load->view("Include/Footer");
    }

    public function GetAllCommonField() {
        $data = $this->sm->GetAllCommonField();
        echo json_encode($data);
    }

    #end region
    
     public function Result()
    {
        $data=$this->m->NewsAndTitle($Title="Results ");
         $this->load->view("Include/Header",$data); 
         $this->load->view("Home/results"); 
         $this->load->view("Include/Footer"); 
    }
    
}
