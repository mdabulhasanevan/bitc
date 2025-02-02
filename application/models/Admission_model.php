<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admission_model
 *
 * @author Evan DU
 */
class Admission_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    
     public function GetStudent($search) {

      $result=  $this->db->query("SELECT ad.*, f.Name as FacultyName, s.Session as SessionName, ot.Name as Gender, ot2.Name as ReligionName, g.Group as SSCGroup, g2.Group as HSCGroup, b.BoardName as SSCBoard, b2.BoardName as HSCBoard FROM admissionreg as ad 
left join faculty f on f.FId=ad.Faculty
left join session s on s.SessionId=ad.SessionId
left join other ot on ot.Id=ad.Gender
left join other ot2 on ot2.Id=ad.Religion
left JOIN groupnametbl g on g.GroupId=ad.ssc_group
left join groupnametbl g2 on g2.GroupId=ad.hsc_group
left join board b on b.ID=ad.ssc_board
left join board b2 on b2.ID=ad.hsc_board
WHERE ad.Faculty=$search->Faculty");

        return $result->result();
    }
    
     public function DeleteStudent($id) {
       
        $m = $this->db->delete('admissionreg', array('RID' => $id));
        return $m;
    }
}
