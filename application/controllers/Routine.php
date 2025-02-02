<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routine
 *
 * @author Evan DU
 */
class Routine extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Routine_model", "RM");
       // $this->load->library('CommonLib','cmnlib');
    }
    
    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) { redirect("Auth/Restricted");}
    }
    
    public function Index() {
         $this->checkuserRole(uri_string());
        $data["Title"] = "Add Class Routine";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Routine/ClassRoutine');
    }
public function MyClasses() {
         $this->checkuserRole(uri_string());
        $data["Title"] = "My Class Routine";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Routine/MyClasses');
    }
   
    public function GetAllClassRoutine() {
        $results = $this->RM->GetAllClassRoutine();
        echo json_encode($results);
    }
    
     public function AllRoutineForDashBoard($today) {
        $results = $this->RM->AllRoutineForDashBoard($today);
        echo json_encode($results);
    }

    public function LoadAllFields() {
        $results = $this->RM->LoadAllFields();
        echo json_encode($results);
    }

    public function AddRoutine() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $results = $this->RM->AddRoutine($request);
        if ($results == 1) {
            echo json_encode("Added Successfully");
        } else {
           echo json_encode( "Added Unsuccessful Teacher or Faculty is Already have Booked for the Time in this day."); 
        }
       
    }

    public function SetRoutineDefault() {
        $results = $this->RM->SetRoutineDefault();
    }

    public function DeleteRoutine($id) {
        $results = $this->RM->DeleteRoutine($id);
    }
    
    public function OpenTeacherAssignClass($TeacherID)
    {
         $results = $this->RM->OpenTeacherAssignClass($TeacherID);
         echo json_encode($results);
    }
     public function OpenFacultyWiseClass($FacultyID,$SemesterID,$SubjectID)
    {
         $results = $this->RM->OpenFacultyWiseClass($FacultyID,$SemesterID,$SubjectID);
         echo json_encode($results);
    }

}
