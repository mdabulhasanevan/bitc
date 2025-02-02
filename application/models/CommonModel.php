<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonModel
 *
 * @author Evan DU
 */
class CommonModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function SetGetVisitor() {
        $this->db->set('visitor', 'visitor+1', FALSE);
        $this->db->where('id', 1);
        $this->db->update('counter');

        $this->db->where('id', 1);
        $visitor = $this->db->get('counter', 1);
        return $visitor->row()->visitor;
    }

    public function GetPost() {
        $query = $this->db->get("post");
        $rows = $query->result();
        return $rows;
    }

    public function GetRole() {
        $query = $this->db->get("role_tbl");
        $rows = $query->result();
        return $rows;
    }

    public function GetFaculty() {
        $query = $this->db->get("faculty");
        $rows = $query->result();
        return $rows;
    }

    public function GetSession() {
        $query = $this->db->get("session");
        $rows = $query->result();
        return $rows;
    }

    public function GetAllUsers() {
        $query = $this->db->get("role_tbl");
        $rows = $query->result();
        return $rows;
    }

    public function GetAllUsersByPost($PId) {
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where(array('Post' => $PId));
        $query = $this->db->get();
        $rows = $query->result();
        return $rows;
    }

    public function GetAllStudentBasicDropDown() {
        
    }

    public function GetDashboard() {
        $data = array(
            "user" => $this->db->from("registration")->count_all_results(),
            "student" => $this->db->from("student_tbl")->count_all_results(),
            "SOS" => $this->db->from("studentofthesemester")->count_all_results(),
            "PT" => $this->db->from("researchproject")->count_all_results(),
            "Notice" => $this->db->from("breakingnews")->count_all_results(),
            "AllFacultyReport" => $this->db->query("SELECT f.Name as FacultyName, s.Session as SessionName, count(StudentID) as Total FROM student_tbl st left join faculty f on f.FId=st.Faculty left join session s on s.SessionId=st.SessionId group by st.Faculty, st.SessionId")->result(),
            "EducationalQuote"=>$this->db->query("SELECT * FROM `educational_quote` order by rand() limit 1")->row(),
            "Gender" =>$this->db->query('SELECT if(Gender=1,"Male","Female") as Gender, Count(StudentID) as Total FROM `student_tbl`  where Gender in (1,2) group by Gender')->result(),
            "GenderFacultySessionWise" =>$this->db->query('SELECT f.Name as FacultyName, s.Session as SessionName, sum(if(st.Gender=1,1,0)) as Male, sum(if(st.Gender=2,1,0)) as Female FROM student_tbl st left join faculty f on f.FId=st.Faculty left JOIN session s on s.SessionId=st.SessionId group by st.SessionId, st.Faculty ORDER by st.Faculty , st.SessionId')->result(),
           
                );

        return $data;
    }
    
    public function GetAllCommon() {
        $data = array(
            "EducationalQuote"=>$this->db->query("SELECT * FROM `educational_quote` order by rand() limit 1")->row()
        
            );

        return $data;
    }
    

}
