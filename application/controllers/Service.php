<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Service
 *
 * @author Evan DU
 */
class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model('News_model', 'm');
        $this->load->model('User_Model', 'user');
        $this->load->model('RearchProject_Model', 'Re');
        $this->load->model('StudentoftheSemester_model', 'sos');
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function NewsCreate() {
        $this->checkuserRole(uri_string());

        $NewsAll = $this->m->GetAllNews();

        $Title = "All Notice";
        $data = array(
            "Title" => $Title,
            "NewsAll" => $NewsAll,
            "Headline" => "",
            "Detail" => ""
        );
        if (isset($_POST["Create"])) {
            $this->form_validation->set_rules('Headline', 'Headline', 'required');
            $this->form_validation->set_rules('Detail', 'Detail', 'required');
//            $this->form_validation->set_rules('Attachment', 'Attachment','required');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|zip|rar|docx|';
                $config['max_size'] = 20000;

                $this->load->library('upload', $config);
                $this->upload->do_upload('Attachment');
                $file = $this->upload->data();

                $data2 = array(
                    "Headline" => $_POST["Headline"],
                    "Detail" => $_POST["Detail"],
                    "Date" => date('Y-m-d'),
                    "Other" => $file['file_name'],
                    "NewsType" => $_POST["Type"]
                );

                $this->db->insert('breakingnews', $data2);
                $data = array(
                    "data" => $this->session->flashdata("success", "News added successfully")
                );

                redirect("Service/NewsCreate", $data);
            }
            $data["Headline"] = $_POST["Headline"];
            $data["Detail"] = $_POST["Detail"];
        }

        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/NewsCreate');
    }

    public function GetAllNews() {
        $data = $this->m->GetAllNews();
        echo json_encode($data);
    }

    public function DeleteNews($id, $File) {
        $Message = $this->m->DeleteNews($id, $File);
        echo json_encode($Message);
    }

    public function HideNews($id, $IsHide) {
        $Message = $this->m->HideNews($id, $IsHide);
        echo json_encode($Message);
    }

    #region User List Teacher and Other

    public function UserList() {
        $this->checkuserRole(uri_string());

        $data["Title"] = "User List";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/UserList');
    }
    
     public function UserDelete() {
        $this->checkuserRole(uri_string());

        $data["Title"] = "User List";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/UserDelete');
    }
    
     public function UserView() {
        $this->checkuserRole(uri_string());

        $data["Title"] = "User List";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/UserView');
    }
    
     public function UserRole() {
        $this->checkuserRole(uri_string());

        $data["Title"] = "User List";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/UserRole');
    }

    
    
    
    public function GetUserList() {
        $data = $this->user->GetUser();
        echo json_encode($data);
    }

    public function DeleteUser($id, $photo) {
        $data = $this->user->DeleteUser($id, $photo);
        echo json_encode($data);
    }

    public function UpdateUser() {
        $request = json_decode(file_get_contents('php://input'));
        $data = $this->user->UpdateUser($request);
        echo json_encode($data);
    }

    public function SavePassword() {
        $request = json_decode(file_get_contents('php://input'));
        $data = $this->user->SavePassword($request);
        echo json_encode($data);
    }

    public function UpdateUserPhoto() {

        $Id = $_POST['Id'];
        $filename = $_FILES["Img"]["name"];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
//      here we will add many thing for changing img name
        $new_name = "IMG" . rand(10, 1000) . rand(10, 1000) . $Id . date("Y-m-d") . rand(10, 100) . "." . $file_ext;

        $OldPhotoName = $this->user->GetPhotoNameAndUnlink($Id);

        $config['file_name'] = $new_name;
        $config['upload_path'] = './uploads/users/';
        $config['allowed_types'] = 'gif|jpg|png|GIF|JPG|PNG';
        $config['max_size'] = 200;
        $config['max_width'] = 500;
        $config['max_height'] = 500;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('Img')) {
            $file = $this->upload->data();


            $Photo = $new_name;
            $user = $this->user->UpdateUserPhoto($Photo, $Id);
            echo json_encode($user);
        } else {
            $user["Photo"] = $OldPhotoName;
            echo json_encode($user);
        }
    }

    public function LoadAllMenuAndUserRole($id) {
        $data = $this->user->LoadAllMenuAndUserRole($id);
        echo json_encode($data);
    }

    public function SaveUserRole() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $data = $this->user->SaveUserRole($request->MenuID, $request->selectedUser, $request->MenuID2);
        echo json_encode($data);
    }

#region Research 

    public function ResearchandProjects() {
        $this->checkuserRole(uri_string());
        $data = array(
            'Title' => "Research and Projects"
        );
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/ResearchandProjects');
    }

    public function GetAllRearchProjects() {

        $data = $this->Re->GetAllRearchProjects();
        echo json_encode($data);
    }

    public function AddResearch() {
        //$Research= json_decode(file_get_contents('php://input'),TRUE);
        //  $request = json_decode($Research);
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $this->Re->AddResearch($request);

        echo json_encode($request);
    }

    public function DeleteResearch($id) {
        $Message = $this->Re->DeleteResearch($id);
        echo json_encode($Message);
    }

#End Region
#region Studentofthesemester   

    public function studentofthesemester() {
        $this->checkuserRole(uri_string());
        $data = array(
            'Title' => "Student of the semester"
        );
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Service/studentofthesemester');
    }

    public function GetAllStudentsoftheSemester() {
        $data = $this->sos->GetAllStudentsoftheSemester();
        echo json_encode($data);
    }

    public function DeleteStudent($id) {
        $data = $this->sos->DeleteStudent($id);
        echo json_encode($data);
    }

    public function AddStudentoftheSemester() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $data = $this->sos->AddStudentoftheSemester($request);
        echo json_encode($data);
    }

    public function SearchStudent($StudentID) {
        $data = $this->sos->SearchStudent($StudentID);
        echo json_encode($data);
    }

    #end region
}
