<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentAuth_Model
 *
 * @author Evan DU
 */
class StudentAuth_Model extends CI_Model {
    #Region Login And Aproval

    public function LoginApproval($RegNo, $Password) {
        $this->db->select('FullName,StudentID,RegNo');
        $this->db->from('student_tbl');
        $this->db->where(array('RegNo' => $RegNo, 'Password' => $Password));
        $query = $this->db->get()->row();
        return $query;
    }

    // who is login
    public function LoginHistory($query) {
        $this->load->helper('date');
        $data = array(
            'SID' => $query->StudentID,
            'RegNo' => $query->RegNo,
            'Date' => date(DATE_RSS, time(1140153693, 'UP6', TRUE)),
            'IP' => $this->get_IP_address()
        );
        $this->db->insert('StudentLoginHistory', $data);
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

    public function GetOneStudent($id) {
        $data = array('StudentID' => $id);

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
        $this->db->join('semester as semesterX', 'semesteryearpromotions.SemesterID=semesterX.ID', 'left');
        $this->db->join('major as maz', 'maz.ID=st.Major', 'left');


        $result = $this->db->get();

        return $result->row();
    }

    function AllClassMates($id) {
        $data = array(
            'StudentID' => $id
        );
        $this->db->select('Faculty,SessionId');
        $result = $this->db->get_where('student_tbl', $data)->row();

        $data2 = array(
            'Faculty' => $result->Faculty,
            'SessionId' => $result->SessionId
        );

        $this->db->select('st.RegNo, st.FullName,ot2.Name as BloodGroup, st.Photo, st.DateOfBirth');
        $this->db->from('student_tbl as st');
        $this->db->join('other as ot2', 'ot2.Id = st.BloodGroup', 'left');
        $this->db->where($data2);
        $this->db->order_by("st.RegNo", "asc");
        $result = $this->db->get();
        return $result->result();
    }

    public function Changepassword($Password, $id) {
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
