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
class CommonCtrl extends CI_Controller {
    public function __construct() {
        parent::__construct();
       $this->load->model("CommonModel","Common");
       
    }

    public function GetPost(){
        $Post=$this->Common->GetPost();
         echo json_encode($Post); 
    }
    public function GetAllUsers($PId){
        $Post=$this->Common->GetAllUsersByPost($PId);
         echo json_encode($Post); 
    }
    
    public function GetAllRole() {
        $result = $this->Common->GetRole();
        echo json_encode($result);
    }
    
}
