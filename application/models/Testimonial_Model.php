<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Testimonial_Model
 *
 * @author Evan DU
 */
class Testimonial_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetTestInfo($id) {
        $this->db->select('*,
    f.FullMeaning AS FacultyName,
    f.Name AS FacultyonlyName,
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
    ds2.DistrictName as ParZilaName,
    tn1.PsName as PreThana,
    tn2.PsName as ParThana,
    IF(st.Gender=1, "He", "She")as GenderStatus,
    IF(st.Gender=1, "His", "Her")as GenderStatus2,
    IF(st.Gender=1, "Son", "Daughter")as GenderStatus3,
    NOW() as DateOfPrint,
    sem.Name as SemesterStatus,
    semY.Year as SemesterYear,
    syp.ExamYear as ExamYear,
    syp.PassedYear as PassedYear,
     syp.ExamCompletedFromTo as ExamCompletedFromTo,
      syp.VivaProjectDefence as VivaProjectDefence,
       syp.ResultPublished as ResultPublished,
       
    mz.Major as MajorName
');

        $this->db->from('student_tbl as st');
        $this->db->where(array('st.StudentID' => $id));

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
        $this->db->join('semesteryearpromotions as syp', 'syp.SessionID=st.SessionId and syp.FacultyID=st.Faculty', 'left');
        $this->db->join('semester as sem', 'sem.ID=syp.SemesterID', 'left');
        $this->db->join('semesteryear as semY', 'semY.ID=syp.YearID', 'left');
        $this->db->join('major as mz', 'mz.ID=st.Major', 'left');

        return $result = $this->db->get()->row();
    }

}
