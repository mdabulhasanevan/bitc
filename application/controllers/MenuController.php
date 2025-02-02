<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuController
 *
 * @author Evan DU
 */
class MenuController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("MenuModel", "Setting");
    }
     //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }
    
    #region AdminMenu
    public function AdminMenu() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "AdminMenu ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/AdminMenu');
    }

    public function GetAllAdminMenu() {
        $result = $this->Setting->GetAllAdminMenu();
        echo json_encode($result);
    }

    public function DeleteAdminMenu($id) {
        $result = $this->Setting->DeleteAdminMenu($id);
        echo json_encode($result);
    }

    public function AddAdminMenu() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddAdminMenu($request);
        echo json_encode($result);
    }

    public function UpdateAdminMenu() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateAdminMenu($request);
        echo json_encode($result);
    }

    #end Region
    #region AdminSubMenu

    public function AdminSubMenu() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "AdminSubMenu ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/AdminSubMenu');
    }

    public function GetAllMainMenu() {
        $result = $this->Setting->GetAllMainMenu();
        echo json_encode($result);
    }

    public function GetAllAdminSubMenu() {
        $result = $this->Setting->GetAllAdminSubMenu();
        echo json_encode($result);
    }

    public function DeleteAdminSubMenu($id) {
        $result = $this->Setting->DeleteAdminSubMenu($id);
        echo json_encode($result);
    }

    public function AddAdminSubMenu() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddAdminSubMenu($request);
        echo json_encode($result);
    }

    public function UpdateAdminSubMenu() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateAdminSubMenu($request);
        echo json_encode($result);
    }

    #end Region
}
