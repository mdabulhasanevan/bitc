<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author Evan DU
 */
class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Payment_Model", "pm");
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

# Region Pay Setup

    public function Index() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Payment ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/Index');
    }

    #region Payment setup

    public function PaymentSetupIndex() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Student Payment Setup ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/PaymentSetup');
    }

    //Search Student
    public function GetStudent() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $student = $this->pm->GetStudentforSetup($request);
        echo json_encode($student);
    }
    
     public function GetStudentforPay() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $student = $this->pm->GetStudent($request);
        
        $totalDue=0;
        foreach ($student as $st) {
            if($st->DueMoney=='' || $st->DueMoney==NULL)
            {
                $st->DueMoney=0;
            }
            $totalDue=$totalDue+$st->DueMoney;           
        }
        $result=array(
            "Student"=>$student,
            "TotalDue"=>$totalDue
        );
        echo json_encode($result);
    }

    public function PaymentSetUpSave() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $student = $this->pm->PaymentSetUpSave($request);

        echo json_encode($student);
    }

    #end Region
    #region Pay Form

    public function PayFormStudent() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Pay Form Student ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/PayFormStudent');
    }
//Money Submit 
    public function PaySubmitBill() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $student = $this->pm->PaySubmitBill($request);

        echo json_encode($student);
    }

    public function GetPayHistory($StudentID) {

        $student = $this->pm->GetPayHistory($StudentID);

        echo json_encode($student);
    }

    #region Pay Report

    public function DateWisePaymentReport() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Date Wise Payment Report ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/DateWisePaymentReport1');
    }

    public function SearchAllPayHistory() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $student = $this->pm->SearchAllPayHistory($request);
        echo json_encode($student);
    }

    public function DeleteTransaction($Tid) {
        $result = $this->pm->DeleteTransaction($Tid);
        echo json_encode($result);
    }

    
    #region Due Report
    
     public function DueReportFacultySessionWise() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Due Report Faculty Session Wise";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/DueReportFacultySessionWise');
    }
    public function GetFacultySessionWiseDue() {
        $result = $this->pm->GetFacultySessionWiseDue();
        echo json_encode($result);
    }

    #region Deleted Payment
    
     public function DeletedPayment() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Deleted Payment List";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/DeletedPayment');
    
    }
    public function DeletedPaymentList() {
        $result = $this->pm->DeletedPaymentList();
        echo json_encode($result);
    }
    
     public function SemdSMSForPaySingleStudent($mobile,$message)
    {
   
      //one to one
        try{
         $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
         $paramArray = array(
         'userName' => "01636978242",
         'userPassword' => "16557",
         'mobileNumber' => $mobile,
         'smsText' => $message,
         'type' => "TEXT",
         'maskName' => '',
         'campaignName' => '',
         );
         $value = $soapClient->__call("OneToOne", array($paramArray));
         echo $value->OneToOneResult;
        } catch (Exception $e) {
         echo $e->getMessage();
        }
    }
    
    
    #region pay for single student by reg or student id or bar code
    
   public function PayForSingleStudent()
   {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Pay For Single Student ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/PayForSingleStudent');
   }
   
       public function DeleteStudentPaymentTransaction() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Pay Form Student ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Payment/DeleteStudentPaymentTransaction');
    }
}
