<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentAuth
 *
 * @author Evan DU
 */
class StudentAuth extends CI_Controller{
   public function __construct() {
        parent::__construct();
        $this->load->model("CommonModel", "Common");
        $this->load->model("StudentAuth_Model", "StudentAuthM");
    }

    
 
    public function login() {
        $data = array(
            "Title" => "Student Login",
        );

        if (isset($_POST["Signin"])) {
            $this->form_validation->set_rules('RegNo', 'RegNo', 'required');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE) {

                $RegNo = $_POST['RegNo'];
                //hashing
                $Password = md5($_POST['Password']);

                $student = $this->StudentAuthM->LoginApproval($RegNo, $Password);
                
                //login check complete now add login history and load menu
                if ($student != null && $student->StudentID) {
                    
                    //this is for login history
                    $this->StudentAuthM->LoginHistory($student);
                  
                    $this->session->set_flashdata("success", "You are successfully loged in. ");
                    setcookie('loginCookieStudent', TRUE, time() + (86400 * 30), "/");
                    
              
                    $_SESSION["Student_loged"] = TRUE;
                    $_SESSION["FullName"] = $student->FullName;
                    $_SESSION["StudentID"] = $student->StudentID;

                    redirect("StudentApp/index");
                } else {
                    $this->session->set_flashdata("successErr", "No such account exist. ");
                }
            }
        }

        $this->load->view('StudentLogin/login', $data);
    }

    
   
    
    public function logout() {
        // set the expiration date to one hour ago
        setcookie("loginCookieStudent", "", time() - 3600);
        
        unset($_SESSION["Student_loged"]);
        //session_destroy();
        redirect("StudentAuth/login");
    }

    public function Restricted() {
        $data["Title"] = "Restricted Page";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('user/Restricted');
    }
}
