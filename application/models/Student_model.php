<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student
 *
 * @author Evan DU
 */
class Student_model extends CI_Model {

    public function __construct() {
        parent::__construct();
//        if (!isset($_SESSION["User_loged"])) {
//            $this->session->set_flashdata("successErr", "Please login first. ");
//            redirect('Auth/login');
//        }
    }

    public function GetAllCommonField() {
        $data = array(
            "branch" => $this->db->get('branch')->result(),
            "faculty" => $this->db->get('faculty')->result(),
              "group" => $this->db->get('groupnametbl')->result(),
            "session" => $this->db->get('session')->result(),
            "batch" => $this->db->get('batch')->result(),
            "section" => $this->db->get('section')->result(),
            "Other" => $this->db->get('other')->result(),
            "board" => $this->db->get('board')->result(),
            "district" => $this->db->get('district')->result(),
            "thana" => $this->db->get('thana')->result(),
             "semester" => $this->db->get('semester')->result(),
            "semesterYear" => $this->db->get('semesteryear')->result(),
            "major" => $this->db->get('major')->result(),
            "paytype" => $this->db->get('paytype')->result()
        );

        return $data;
    }

    public function AddStudent($Student) {
        $Student->Photo="Default.jpg";
         $Pass=111111;
        //hashing
       $Student->Password = md5($Pass);
        
        $this->db->insert('student_tbl', $Student);
       $InsID =$this->db->insert_id();
       
        
        $this->db->where(array('StudentID' =>$InsID ));
        $result = $this->db->get('student_tbl');
        return $result->row();
    }
    
    public function CheckRoll($CollegeRoll,$Faculty,$SessionId) {
       
       $where= array(
            
            "Faculty"=>$Faculty,
            "SessionId"=>$SessionId,
               "CollegeRoll"=>$CollegeRoll
        );
        $this->db->where($where);
         $IsExist = $this->db->count_all_results('student_tbl');
        if ($IsExist >0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function UpdateStudentPhoto($Photo, $StudentID) {

        $resultUp = $this->db->query("UPDATE `student_tbl` SET `Photo` = '$Photo' WHERE `student_tbl`.`StudentID` = $StudentID");

        $this->db->select('Photo');
        $this->db->where(array('StudentID' => $StudentID));
        $result = $this->db->get('student_tbl', 1);
        return $result->row();
    }

    public function UpdateStudent($Student) {
        $this->db->where(array('StudentID' => $Student->StudentID));
        $this->db->update('student_tbl', $Student);

        $this->db->where(array('StudentID' => $Student->StudentID));
        $result = $this->db->get('student_tbl', 1);
        return $result->row();
    }

    public function GetStudent($search) {

        $data = array();
        if ($search->Faculty != null) {
            $data['st.Faculty'] = $search->Faculty;
        }
        if ($search->SessionId != null) {
            $data['st.SessionId'] = $search->SessionId;
        }
        if ($search->Batch != null) {
            $data['Batch'] = $search->Batch;
        }
        if ($search->StudentInsID != null) {
            //$data['StudentInsID'] = $search->StudentInsID; this is temporary. after some days it will be change
             $data['RegNo'] = $search->StudentInsID;
        }

        $this->db->select('*,
    f.Name AS FacultyName,
    b.BatchName AS BatchName,
    ss.Session AS SessionName,
    br.Branch AS BranchName,
    sc.Section AS SectionName,
    ot.Name AS GenderName,
    ot2.Name AS BloodGroupName,
    ot3.Name AS ReligionName,
    boards.BoardName AS SSCBoardName,
    boardh.BoardName AS HSCBoardName,
    ds1.DistrictName as PreZilaName,
    ds2.DistrictName as parZilaName,
    tn1.PsName as PreThana,
    tn2.PsName as ParThana,
    semesterX.Name as SemesterName,
    maz.Major as MajorName');

        $this->db->from('student_tbl as st');
        $this->db->where($data);

        $this->db->join('faculty as f', 'f.FId = st.Faculty', 'left');
        $this->db->join('batch as b', 'b.BId = st.Batch', 'left');
        $this->db->join('session as ss', 'ss.SessionId = st.SessionId', 'left');
        $this->db->join('section as sc', 'sc.SectionId = st.SectionId', 'left');
        $this->db->join('branch as br', 'br.BranchId = st.BranchID', 'left');
        $this->db->join('other as ot', 'ot.Id = st.Gender', 'left');
        $this->db->join('other as ot2', 'ot2.Id = st.BloodGroup', 'left');
        $this->db->join('other as ot3', 'ot3.Id = st.Religion', 'left');
        $this->db->join('board as boards', ' boards.ID = st.ssc_board', 'left');
        $this->db->join('board as boardh', ' boardh.ID = st.hsc_board', 'left');
        $this->db->join('district as ds1', 'ds1.DistrictId=st.PreZila', 'left');
        $this->db->join('district as ds2', 'ds2.DistrictId=st.ParZila', 'left');
        $this->db->join('thana as tn1', 'tn1.PsId=st.PreThana', 'left');
        $this->db->join('thana as tn2', 'tn2.PsId=st.ParThana', 'left');
        $this->db->join('semesteryearpromotions as semesteryearpromotions', 'semesteryearpromotions.FacultyID=f.FId AND semesteryearpromotions.SessionID=ss.SessionId', 'left');
        $this->db->join('semester as semesterX', 'semesteryearpromotions.SemesterID=semesterX.ID','left');
         $this->db->join('major as maz', 'maz.ID=st.Major', 'left');
        
        $this->db->order_by("StudentInsID", "asc");

        $result = $this->db->get();


        return $result->result();
    }

    function GetSingleStudent($id) {
        $data = array(
            'StudentID' => $id
        );
        $result = $this->db->get_where('student_tbl', $data);

        return $result->row();
    }

    public function DeleteStudent($id) {
        unlink("uploads/students/".$new_name); 
        $m = $this->db->delete('student_tbl', array('StudentID' => $id));
        return m;
    }
    
    public function GetPhotoNameAndUnlink($id) {
         $this->db->select('Photo');
        $m = $this->db->get('student_tbl', array('StudentID' => $id));
        $OldPhotoName=$m->row()->Photo;
        
        if ($OldPhotoName!="Default.jpg") {
           $url = base_url("uploads/students/$OldPhotoName");
           if(@getimagesize($url))
           {
               unlink("uploads/students/" . $OldPhotoName);
           }
                
        }
        
        return $m->row();
    }
    
     public function PasswordSetDefault($id) {
        $Password=111111;
        //hashing
        $PasswordHash = md5($Password);

        $data = array(
            "Password" => $PasswordHash
        );
        $this->db->where(array('StudentID' => $id));
        $result = $this->db->update("student_tbl", $data);

        return $result;
    }


}
