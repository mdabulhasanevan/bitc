<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student
 *
 * @author Evan DU
 */
class Student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("student_model", "sm");
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
        $this->CheckUserRole(uri_string());

        $data = array(
            "Title" => "Student List"
        );
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view("student/Index");
    }

    public function Registration() {
        $this->CheckUserRole(uri_string());

        $data = array(
            "Title" => "Student Registration"
        );
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view("student/registration");
    }

    public function CheckRoll($CollegeRoll, $Faculty, $SessionId) {

        $data = $this->sm->CheckRoll($CollegeRoll, $Faculty, $SessionId);
        echo json_encode($data);
    }

    public function GetAllCommonField() {
        $data = $this->sm->GetAllCommonField();
        echo json_encode($data);
    }

    public function SaveStudent() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $student = $this->sm->AddStudent($request);

        echo json_encode($student);
    }

    public function UpdateStudentPhoto() {

        $StudentID = $_POST['StudentID'];
        $filename = $_FILES["Img"]["name"];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
//      here we will add many thing for changing img name
        $new_name = "IMG" . rand(10, 1000) . rand(10, 1000) . $StudentID . date("Y-m-d") . rand(10, 100) . "." . $file_ext;

        $OldPhotoName = $this->sm->GetPhotoNameAndUnlink($StudentID);

        //new uploaded photo name
        //$url = base_url("uploads/students/$OldPhotoName->Photo");
//        if ($OldPhotoName!=NULL) {
////            if (@getimagesize($url)) {
////      if(read_file(base_url("uploads/students/$new_name")))
//                unlink("uploads/students/" . $OldPhotoName);
////            }
//        }
        //$PhotoFormName = $string = preg_replace('/\s+/', '', basename($_FILES["Img"]["name"]));
        
        $config['file_name'] = $new_name;
        $config['upload_path'] = './uploads/students/';
        $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG';
        $config['max_size'] = 200;
        $config['max_width'] = 500;
        $config['max_height'] = 500;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('Img')) {
            $file = $this->upload->data();


            $Photo = $new_name;
            $student = $this->sm->UpdateStudentPhoto($Photo, $StudentID);
            echo json_encode($student);
        } else {
            $student["Photo"] = $OldPhotoName;
            echo json_encode($student);
        }
    }

    public function UpdateStudent() {

        $request = json_decode(file_get_contents('php://input'));

        $student = $this->sm->UpdateStudent($request);

        echo json_encode($student);
    }

    //Search Student
    public function GetStudent() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $student = $this->sm->GetStudent($request);
        echo json_encode($student);
    }

    public function GetSingleStudent($id) {
        $student = $this->sm->GetSingleStudent($id);
        echo json_encode($student);
    }

    public function DeleteStudent($id) {
        unlink("uploads/students/" . $id . ".jpg");
        $student = $this->sm->DeleteStudent($id);
        echo json_encode($student);
    }

    public function PrintStudentInfoSingle($id) {
        // $this->checkuserRole(uri_string());
        $data['Info'] = $this->TestM->GetTestInfo($id);
        $this->load->view("student/PdfStudentInfoSingle", $data);
    }

    public function PrintStudentInfoAllSelected($batch, $faculty, $session, $studentInsId) {
        // $this->checkuserRole(uri_string());

        if ($faculty == 0) {
            $faculty = NULL;
        }
        if ($session == 0) {
            $session = NULL;
        }
        if ($batch == 0) {
            $batch = NULL;
        }
        if ($studentInsId == 0) {
            $studentInsId = NULL;
        }

        $search = array(
            'Faculty' => $faculty,
            'SessionId' => $session,
            'Batch' => $batch,
            'StudentInsID' => $studentInsId
        );

        $student = $this->sm->GetStudent($search);

        echo json_encode($student);
        //$this->load->view("Student/PdfStudentInfoAll", $student);
    }

    public function PasswordSetDefault($id) {
        $student = $this->sm->PasswordSetDefault($id);

        echo json_encode($student);
    }

    public function UcWord() {
        $this->db->select('StudentID,FullName,FatherName, MotherName');
        $result = $this->db->get('student_tbl')->result();

        
        foreach ($result as $info) {
           
            $data = array(
                "FullName" => ucwords($info->FullName),
                "FatherName" => ucwords($info->FatherName),
                "MotherName" => ucwords($info->MotherName)
            );
            $this->db->where(array('StudentID' => $info->StudentID));
            $result = $this->db->update("student_tbl", $data);
        }
         $this->db->select('StudentID,FullName,FatherName, MotherName');
        $result2 = $this->db->get('student_tbl')->result();
        
        echo json_encode($result2);
        
     //  echo  ucwords("evan hasan abul");
    }

}
