<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Attendance
 *
 * @author Evan DU
 */
class Attendance extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Attendance_Model", "ATM");
    }

    public function Index() {
        $data["Title"] = "Attendance ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Attendance/Index');
    }

    public function DeleteAttendance() {
        $data["Title"] = "Delete Attendance ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Attendance/DeleteAttendance');
    }

    public function AttendanceReport() {
        $data["Title"] = "Report Attendance ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Attendance/AttendanceReport');
    }

//DeleteDeleteAttendanceSingal

    public function DeleteAttendanceSingal() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->ATM->DeleteAttendanceSingal($request);
        echo json_encode($result);
    }

    public function AllAttendance() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->ATM->AllAttendance($request);
        echo json_encode($result);
    }

    public function GetStudents() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $FacultyID = $request->FacultyID;
        $SessionID = $request->SessionID;
        $Date = $request->Date;
        $SubjectID = $request->SubjectID;




        $result = $this->ATM->GetStudents($FacultyID, $SessionID, $SubjectID, $Date);
        echo json_encode($result);
    }

    public function AddAttendance() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->ATM->AddAttendance($request);
        echo json_encode($result);
    }

    public function GetSingleAttendance($SID) {
        $result = $this->ATM->GetSingleAttendance($SID);
        echo json_encode($result);
    }

    public function DayWiseAttendanceReport() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->ATM->DayWiseAttendanceReport($request->Date);
        echo json_encode($result);
    }

}
