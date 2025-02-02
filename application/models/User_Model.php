<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User_Model
 *
 * @author Evan DU
 */
class User_Model extends CI_Model {
    #Region Login And Aproval

    public function LoginApproval($Email, $Password) {
        $this->db->select('Name,Id,Email,Role,Photo');
        $this->db->from('registration');
        $this->db->where(array('Email' => $Email, 'Password' => $Password, 'Role' => 1, 'IsActive' => 1));
        $query = $this->db->get()->row();
        return $query;
    }

//    menu show in admin panel
    public function AdminMenu($user) {

        //$datain is for join adminmenu with Role table
        $this->db->where(array('UserID' => $user->Id, 'WhatMenu' => 1));
        $dataIn = $this->db->get('menuroll')->row();
        if ($dataIn == NULL) {
            $where = 0;
        } else {
            $where = $dataIn->MenuID;
        }

        //sub Menu
        $this->db->where(array('UserID' => $user->Id, 'WhatMenu' => 2));
        $dataIn2 = $this->db->get('menuroll')->row();
        if ($dataIn2 == NULL) {
            $where2 = 0;
        } else {
            $where2 = $dataIn2->MenuID;
        }

        $Menu1 = $this->db->query("Select * from adminmenu where ID in($where) AND isHide=0 and isForSuper=0 order by adminmenu.Sort asc")->result();
        $Menu2 = $this->db->query("SELECT * from adminsubmenu1 where ID in($where2) AND isHide=0 AND  isForSuper=0 order by adminsubmenu1.Sort asc")->result();

        $data = array(
            "Menu1" => $Menu1,
            "Menu2" => $Menu2
        );
        return $data;
    }

// who is login
    public function LoginHistory($query) {

       // $this->load->helper('date');
        $data = array(
            'UserID' => $query->Id,
            'Email' => $query->Email,
           // 'Date' => date(DATE_RSS, time(1140153693, 'UP0', TRUE)),
            'Date' => date("Y-m-d H:i:s"),
            'IP' => $this->get_IP_address() . '/'
        );
        $this->db->insert('loginhistory', $data);
    }

    public function AllLoginHistory() {
        $this->db->order_by("ID", "desc");
        $this->db->limit(200);
        $result = $this->db->get('loginhistory')->result();
        return $result;
    }

    public function GetStudentLoginHistory() {
        $result = $this->db->query("SELECT slh.*, st.FullName as Name, f.Name as Faculty, s.Session as Session FROM StudentLoginHistory slh
left JOIN student_tbl st on st.StudentID=slh.SID left join faculty f on f.FId=st.Faculty left join session s on s.SessionId=st.SessionId order by ID desc LIMIT 200")->result();

        return $result;
    }

    public function DeleteLoginHistory() {
        //delete all but last 200 login
        $ID = $this->db->query("select (max(ID)-200) as ID from loginhistory")->row();
        $result = $this->db->query("DELETE FROM loginhistory where ID<$ID->ID");
        return $result;
    }

    public function DeleteStudentLoginHistory() {

        //delete all but last 400 login
        $ID = $this->db->query("select (max(ID)-400) as ID from StudentLoginHistory")->row();
        $result = $this->db->query("DELETE FROM StudentLoginHistory where ID<$ID->ID");
        return $result;
    }

    function get_IP_address() {
        foreach (array('HTTP_CLIENT_IP',
    'HTTP_X_FORWARDED_FOR',
    'HTTP_X_FORWARDED',
    'HTTP_X_CLUSTER_CLIENT_IP',
    'HTTP_FORWARDED_FOR',
    'HTTP_FORWARDED',
    'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $IPaddress) {
                    $IPaddress = trim($IPaddress); // Just to be safe

                    if (filter_var($IPaddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {

                        return $IPaddress;
                    }
                }
            }
        }
    }

    #end Region Login
    #Region User
    //    geting Only Teacher from AllUser

    public function GetTeacherUser() {
        $query = $this->db->query("SELECT registration .*, role_tbl.Role as RoleName, post.PostName as PostName FROM registration LEFT join role_tbl on registration.Role=role_tbl.Id LEFT join post on registration.Post=post.PId where Post<7 and IsActive=1  ORDER by registration.MyOrder, registration.Post  ASC");
        $rows = $query->result();
        return $rows;
    }
    //    geting Only Staff from AllUser for web page
    public function GetStaffUser() {
        $query = $this->db->query("SELECT registration .*, role_tbl.Role as RoleName, post.PostName as PostName FROM registration LEFT join role_tbl on registration.Role=role_tbl.Id LEFT join post on registration.Post=post.PId where Post>7 and IsActive=1  ORDER by registration.MyOrder, registration.Post ASC");
        $rows = $query->result();
        return $rows;
    }

//    geting user or User all are same
    public function GetUser() {
        $query = $this->db->query("SELECT registration .*, role_tbl.Role as RoleName, post.PostName as PostName FROM registration LEFT join role_tbl on registration.Role=role_tbl.Id LEFT join post on registration.Post=post.PId ORDER by registration.MyOrder, registration.Post ASC");
        $rows = $query->result();
        return $rows;
    }

    public function DeleteUser($id, $photo) {
        unlink('uploads/users/' . $photo);
        $result = $this->db->delete("registration", array('Id' => $id));
        return $result;
    }

    public function UpdateUser($User) {
//        
        $data = array(
            'Name' => $User->Name,
            'Address' => $User->Address,
            'Post' => $User->Post,
            'Email' => $User->Email,
            'Mobile' => $User->Mobile,
            'Role' => $User->Role,
            'AcademicQualification' => $User->AcademicQualification,
            'DOB' => $User->DOB,
            'IsActive' => $User->IsActive,
            'MyOrder' => $User->MyOrder
        );
        $this->db->where(array('Id' => $User->Id));
        $result = $this->db->update('registration', $data);

        return $result;
    }

    public function SavePassword($User) {

        $HashPassword = md5($User->Password1);
        $data = array(
            'Password' => $HashPassword
        );
        $this->db->where(array('Id' => $User->Id));
        $result = $this->db->update('registration', $data);

        return $result;
    }

    public function UpdateUserPhoto($Photo, $Id) {

        $resultUp = $this->db->query("UPDATE `registration` SET `Photo` = '$Photo' WHERE `registration`.`Id` = $Id");

        $this->db->select('Photo');
        $this->db->where(array('Id' => $Id));
        $result = $this->db->get('registration', 1);
        return $result->row();
    }

    public function GetPhotoNameAndUnlink($id) {
        $this->db->select('Photo');
        $m = $this->db->get('registration', array('Id' => $id));
        $OldPhotoName = $m->row()->Photo;

        if ($OldPhotoName != "Default.jpg") {
            $url = base_url("uploads/users/$OldPhotoName");
            if (@getimagesize($url)) {
                unlink("uploads/users/" . $OldPhotoName);
            }
        }

        return $m->row();
    }

    public function GetUserGender() {
        $query = $this->db->query("SELECT COUNT(Gender)as Gender FROM `registration`group by Gender");
        $rows = $query->result();
        return $rows;
    }

    #End Region User
    
    ##region Role
//for select user role for any user

    public function LoadAllMenuAndUserRole($id) {
        // WhatMenu 1 for main menu and 2 for submenu1
        //For main menu 1
        $this->db->select("MenuID");
        $this->db->where(array('UserID' => $id, 'WhatMenu' => 1));
        $dataIn1 = $this->db->get('menuroll')->row();

        //For sub menu 2
        $this->db->select("MenuID");
        $this->db->where(array('UserID' => $id, 'WhatMenu' => 2));
        $dataIn2 = $this->db->get('menuroll')->row();

        if ($dataIn1 == NULL) {
            $where1 = 0;
        } else {
            $where1 = $dataIn1->MenuID;
        }
        if ($dataIn2 == NULL) {
            $where2 = 0;
        } else {
            $where2 = $dataIn2->MenuID;
        }
        $data = array(
            "Menu" => $this->db->query("SELECT *, if((am.ID)in($where1),1,0)as Selected from adminmenu am where isForSuper=0")->result(),
            "Menu2" => $this->db->query("SELECT *, if((sm.ID)in($where2),1,0)as Selected from adminsubmenu1 sm where isForSuper=0")->result(),
            "Role" => $this->db->get_where('menuroll', array('UserID' => $id))->row(),
        );

        return $data;
    }

//save user rple after edit
    public function SaveUserRole($id, $selectedUser, $id2) {
        $this->db->where(array('UserID' => $selectedUser, 'WhatMenu' => 1));
        $countMain = $this->db->count_all_results('menuroll');

        $this->db->where(array('UserID' => $selectedUser, 'WhatMenu' => 2));
        $countSub = $this->db->count_all_results('menuroll');

        if ($id == '') {
            $id = 0;
        } if ($id2 == '') {
            $id2 = 0;
        }

        // Menu is exist
        if ($countMain > 0) {
            $this->db->set('MenuID', $id);
            $this->db->set('WhatMenu', 1);
            $this->db->where(array('UserID' => $selectedUser, 'WhatMenu' => 1));
            $x = $this->db->update('menuroll');
        } else {
            $data = array(
                'UserID' => $selectedUser,
                'MenuID' => $id,
                'WhatMenu' => 1
            );
            $this->db->insert('menuroll', $data);
        }
        //Sub Menu is exist
        if ($countSub > 0) {
            //for submenu updat
            $this->db->set('MenuID', $id2);
            $this->db->set('WhatMenu', 2);
            $this->db->where(array('UserID' => $selectedUser, 'WhatMenu' => 2));
            $x = $this->db->update('menuroll');
        } else {
            //for submenu New insert
            $data2 = array(
                'UserID' => $selectedUser,
                'MenuID' => $id2,
                'WhatMenu' => 2
            );
            $this->db->insert('menuroll', $data2);
        }

        return 'ok';
    }

//    this is for resticted page who has no parmition
    public function CheckUserRole($url) {
        $UserID = $_SESSION["id"];
        //Search for main Menu
        $this->db->where(array('UserID' => $UserID, 'WhatMenu' => 1));
        $dataIn = $this->db->get('menuroll')->row();

        //Search for Sub Menu
        $this->db->where(array('UserID' => $UserID, 'WhatMenu' => 2));
        $dataIn2 = $this->db->get('menuroll')->row();

//        set $where default value if not exist
        if ($dataIn == NULL) {
            $where = 0;
        } else {
            $where = $dataIn->MenuID;
        }
        if ($dataIn2 == NULL) {
            $where2 = 0;
        } else {
            $where2 = $dataIn2->MenuID;
        }

        $UrlList = $this->db->query("Select Url from adminmenu where ID in($where)")->result();

        $UrlListSubMenu = $this->db->query("Select Url from adminsubmenu1 where ID in($where2)")->result();

        $IsOk = FALSE;
        $IsOk2 = FALSE;
        $isExist = FALSE;
        foreach ($UrlList as $AUrl) {

            if ($AUrl->Url == $url) {
                $IsOk = TRUE;
                break;
            }
        }
//        Check Sub Menu
        foreach ($UrlListSubMenu as $BUrl) {

            if ($BUrl->Url == $url) {
                $IsOk2 = TRUE;
                break;
            }
        }
//        check both 
        if ($IsOk == true || $IsOk2 == true) {
            $isExist = true;
        }
        return $isExist;
    }

    #end Region role
    
    
    #region password Change
    public function Changepassword($Password, $id) {
        //hashing
        $PasswordHash = md5($Password);
        $data = array(
            "Password" => $PasswordHash
        );
        $this->db->where(array('Id' => $id));
        $result = $this->db->update("registration", $data);

        return $result;
    }
}
