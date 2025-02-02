<?php
defined('BASEPATH') OR exit('No direct script access allowed');


 class CommonLib{
    
       public function checkuserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) { redirect("Auth/Restricted");}
    }
}
