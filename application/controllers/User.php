<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Evan DU
 */
class user extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("User_Model", "UM");
        $this->load->model("CommonModel", "CM");
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");

        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function index() {
        $this->checkuserRole(uri_string());

        $data = $this->CM->GetDashboard();
        $data["Title"] = "Dashboard";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('user/dashboard');
    }

    public function GetDashboard() {
        echo json_encode($this->CM->GetDashboard());
    }

    public function GetUserGender() {
        $data = $this->UM->GetUserGender();
        echo json_encode($data);
    }

    //login history
    public function AllLoginHistory() {
        $this->checkuserRole(uri_string());

        $data["Title"] = "All Login History";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('user/AllLoginHistory');
    }

    public function GetAllLoginHistory() {
        echo json_encode($this->UM->AllLoginHistory());
    }

    public function GetStudentLoginHistory() {
        echo json_encode($this->UM->GetStudentLoginHistory());
    }

    public function DeleteLoginHistory() {
        echo json_encode($this->UM->DeleteLoginHistory());
    }

    public function DeleteStudentLoginHistory() {
        echo json_encode($this->UM->DeleteStudentLoginHistory());
    }

    public function Changepassword() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $UserID = $_SESSION["id"];
        $data = $this->UM->Changepassword($request->Password, $UserID);
        echo json_encode($data);
    }

}
