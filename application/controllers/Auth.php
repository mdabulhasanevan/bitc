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
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("CommonModel", "Common");
        $this->load->model("User_Model", "User");
    }

    
    public function register() {
        $Post = $this->Common->GetPost();
        $Role = $this->Common->GetRole();
        $data = array(
            "Title" => "Signup",
            "Posts" => $Post,
            "Roles" => $Role
        );
        if (isset($_POST['Signup'])) {
            $this->form_validation->set_rules('Name', 'Name', 'required');
            $this->form_validation->set_rules('Email', 'Email', 'required');
            $this->form_validation->set_rules('Mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('Address', 'Address', 'required');
            $this->form_validation->set_rules('DOB', 'Date of Birth', 'required');
            $this->form_validation->set_rules('Role', 'Role', 'required');
              $this->form_validation->set_rules('MyOrder', 'MyOrder', 'required');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('ConPassword', 'Confirm Password', 'required|min_length[6]|matches[Password]');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './uploads/users/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 200;
                $config['max_width'] = 300;
                $config['max_height'] = 300;

                $this->load->library('upload', $config);
                $this->upload->do_upload('Photo');
                $file = $this->upload->data();
                $fdata = array(
                    'Name' => $_POST['Name'],
                    'Post' => $_POST['Post'],
                    'AcademicQualification' => $_POST['AcademicQualification'],
                    'Email' => $_POST['Email'],
                    'Mobile' => $_POST['Mobile'],
                    'Address' => $_POST['Address'],
                    'DOB' => $_POST['DOB'],
                    'Role' => $_POST['Role'],
                    'MyOrder' => $_POST['MyOrder'],
                    'CreateDate' => date('Y-m-d'),
                    'Password' => md5($_POST['Password']),
                    'Photo' => $file['file_name'],
                    'IsActive' => 1
                );
                $this->db->insert('registration', $fdata);
                $this->session->set_flashdata("success", "Your Account has been registered!! you can now login");
                redirect("Service/UserList", "refresh");
            }
        }

        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('user/register');
    }

    public function login() {
        $data = array(
            "Title" => "Login",
        );

        if (isset($_POST["Signin"])) {
            $this->form_validation->set_rules('Email', 'Email', 'required');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE) {

                $Email = $_POST['Email'];
                $Password = md5($_POST['Password']);

                $user = $this->User->LoginApproval($Email, $Password);
                
//login check complete now add login history and load menu
                if ($user != null && $user->Email) {
                    
                    //this is for login history
                    $this->User->LoginHistory($user);
                    $menu = $this->User->AdminMenu($user);

                    $this->session->set_flashdata("success", "You are successfully loged in. ");
                   // setcookie('loginCookie', TRUE, time() + (86400 * 30), "/");
                    
                    
                    $_SESSION["Menu1"] = $menu['Menu1'];
                    $_SESSION["Menu2"] = $menu['Menu2'];
                    $_SESSION["User_loged"] = TRUE;
                    $_SESSION["Name"] = $user->Name;
                    $_SESSION["id"] = $user->Id;
                     $_SESSION["Photo"] = $user->Photo;

                    redirect("user/index");
                } else {
                    $this->session->set_flashdata("successErr", "No such account exist. ");
                }
            }
        }

        $this->load->view('user/login', $data);
    }

    public function logout() {
        // set the expiration date to one hour ago
       // setcookie("loginCookie", "", time() - 3600);
        
        unset($_SESSION["User_loged"]);
        session_destroy();
        redirect("Auth/login");
    }

    public function Restricted() {
        $data["Title"] = "Restricted Page";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('user/Restricted');
    }

}
