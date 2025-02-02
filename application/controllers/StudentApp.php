<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentApp
 *
 * @author Evan DU
 */
class StudentApp extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["Student_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('StudentAuth/login');
        }

        $this->load->model("StudentAuth_Model", "StudentAuthM");
        $this->load->model("Attendance_Model", "ATM");
        $this->load->model("Routine_model", "RM");
        $this->load->model('News_model', 'm');
        $this->load->model("Payment_Model", "pm");
        $this->load->model("Post_Model", "Post");
        $this->load->model("CommonModel", "CM");
        $this->load->model("Library_Model", "LM");
        $this->load->model("Result_model", "Result");
    }

    public function index() {

        $data["Title"] = "Student Dashboard";
        $id = $_SESSION["StudentID"];

        $data["Info"] = $this->StudentAuthM->GetOneStudent($id);

        $this->load->view('Include/LeftMenuStudent', $data);
        $this->load->view('StudentLogin/dashboard');
        $this->load->view('Include/RightMenuStudent', $data);
    }

    public function GetSingleAttendance($SID) {
        $result = $this->ATM->GetSingleAttendance($SID);
        echo json_encode($result);
    }

    public function GetAllClassRoutineFacultyWise($id) {
        $results = $this->RM->GetAllClassRoutineFacultyWise($id);
        echo json_encode($results);
    }

    public function AllNitice() {
        $data = $this->m->GetAllNewsWithBreaking();
        echo json_encode($data);
    }

    public function AllClassMates($id) {
        $data = $this->StudentAuthM->AllClassMates($id);
        echo json_encode($data);
    }

    public function Changepassword() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $StudentID = $_SESSION["StudentID"];
        $data = $this->StudentAuthM->Changepassword($request->Password, $StudentID);
        echo json_encode($data);
    }

    public function GetPayHistory($StudentID) {

        $student = $this->pm->GetPayHistory($StudentID);

        echo json_encode($student);
    }

    #Submit Post Region for student

    public function GetAllPost() {
        $StudentId = $_SESSION['StudentID'];
        $result = $this->Post->GetAllPostforStudent($StudentId);
        echo json_encode($result);
    }

    //for post comment Submit
    public function SubmitComment() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $StudentID = $_SESSION["StudentID"];


        // 0 for Student 1 for Teacher
        $Commenter = 0;

        $data = $this->Post->SubmitComment($request->Comment, $request->PId, $StudentID, $Commenter);

        echo json_encode($data);
    }

    //CommentList For Single Student
    public function GetCommentSinglePost($PId) {
        $data = $this->Post->GetCommentSinglePost($PId);
        echo json_encode($data);
    }

    //delete Comment own Student
    public function DeleteComment($CID, $PostID) {
        $data = $this->Post->DeleteComment($CID, $PostID);
        echo json_encode($data);
    }

    //Book Library
    public function GetAllBookList() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->LM->GetAllBookListForStudentSide($request);
        echo json_encode($result);
    }

    public function RequestForBook($BId) {
        $result = $this->LM->RequestForBook($BId);

        echo json_encode($result);
    }

    public function CalcelRequestForBook($RId) {
        $result = $this->LM->CalcelRequestForBook($RId);
        echo json_encode($result);
    }

    public function GetRequestedAllBook() {
        $result = $this->LM->GetRequestedAllBook();
        echo json_encode($result);
    }

    public function GetDeliveredAllBookForStudent() {
        $result = $this->LM->GetDeliveredAllBookForStudent();
        echo json_encode($result);
    }

    public function GetReturnedAllBook() {
        $result = $this->LM->GetReturnedAllBookForStudent();
        echo json_encode($result);
    }

    public function GetAllCommon() {

        $result = $this->CM->GetAllCommon();
        echo json_encode($result);
    }

    #end region
    #result

    public function GetAllResultPdf() {

        $StudentID = $_SESSION["StudentID"];
        $result = $this->Result->GetAllResultPdfForStudent($StudentID);
        echo json_encode($result);
    }

    #common

    public function GetAllCommonField() {
        $result = $this->LM->GetAllCommonField();
        echo json_encode($result);
    }

}
