<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentoftheSemester
 *
 * @author Evan DU
 */
class StudentoftheSemester_model extends CI_Model {

    public function GetAllStudentsoftheSemester() {
        $SOS = $this->db->query("SELECT sos.*, st.FullName, f.Name as Facult, st.RollNo, ss.Session, st.Photo as Photo FROM studentofthesemester sos left JOIN student_tbl st on st.RegNo=sos.StudentID LEFT JOIN faculty f ON f.FId = st.Faculty LEFT JOIN session ss ON ss.SessionId = st.SessionId WHERE sos.isShow=1 order by Id desc");

        return $SOS->result();
    }

    public function DeleteStudent($id) {
        $SOS = $this->db->delete('studentofthesemester', array('Id' => $id));
        return $SOS;
    }

    public function AddStudentoftheSemester($data) {
        $SOS = $this->db->insert('studentofthesemester', $data);
        return $SOS;
    }

    function SearchStudent($StudentID) {

        $this->db->select('st.FullName,
    f.Name AS FacultyName,
    b.BatchName AS BatchName,
    ss.Session AS SessionName');

        $this->db->from('student_tbl as st');
        $this->db->where('RegNo', $StudentID);

        $this->db->join('faculty as f', 'f.FId = st.Faculty', 'left');
        $this->db->join('batch as b', 'b.BId = st.Batch', 'left');
        $this->db->join('session as ss', 'ss.SessionId = st.SessionId', 'left');
        $result = $this->db->get();
        return $result->row();
    }

    

}
