<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SMS
 *
 * @author Evan DU
 */
class SMS extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
         if(!isset($_SESSION["User_loged"]))
        {
             $this->session->set_flashdata("successErr","Please login first. ");
             redirect('Auth/login');
        }
       $this->load->model("CommonModel","Common");
       
    }
  //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) { redirect("Auth/Restricted");}
    }
    
    public function Index(){
         $this->checkuserRole(uri_string());
        $Post=$this->Common->GetPost();
        //$Role=$this->Common->GetRole();
       
        $data=array(
            "Title"=>"SMS Panel",
            "smsNoti"=>'',
            "Post"=>$Post
            
        );
        $this->load->view('Include/LeftMenuAdmin',$data);        
        $this->load->view("SMS/Index");
    }

//    For SMS one to many
//    How are you? Hope Well. I know you are doing somthing behind the scene
//    $Mobiles,$Message
     public function SendSmsOneToMany()
    {
    $request= json_decode(file_get_contents('php://input'));
     
       try{
        $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
        $paramArray = array(
        'userName' => "01636978242",
        'userPassword' => "16557",
        'messageText' => $request->message,
        'numberList' => $request->mobiles,
        'smsType' => "TEXT",
        'maskName' => '',
        'campaignName' => '',
        );
        $value = $soapClient->__call("OneToMany", array($paramArray));
         $data["smsNoti"]= $value->OneToManyResult;
         
          $data2=array(
                "Numbers"=>$request->mobiles,
                "SMS"=>$request->message,
                "Date"=>  date("Y/m/d H:i:s"),
                "Status"=>$data["smsNoti"],
                "SendBy"=>$_SESSION["id"]
            ); 
           $this->db->insert('sendsms',$data2);
        echo  json_encode($data["smsNoti"]);
       }
       catch (Exception $e) {
        echo  json_encode($e->getMessage());
       }

  

    }
    
 public function SendSMSOneToOne($mobile,$message)
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
    
    public function CheckBalance()
    {
     try{
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
            'userName' => "01636978242",
            'userPassword' => "16557",
            );
            $value = $soapClient->__call("GetBalance", array($paramArray));
            echo $value->GetBalanceResult;
           } catch (Exception $e) {
            echo json_encode($e->getMessage());
           }
    }
    
    public function GetSendList()
    {
     $this->db->order_by('SId', 'DESC');
     $data=$this->db->get("sendsms", 30);
     echo json_encode($data->result());
    }
        
}
