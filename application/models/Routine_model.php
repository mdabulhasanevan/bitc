<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routine_model
 *
 * @author Evan DU
 */
class Routine_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetAllClassRoutine() {
        $routine = $this->db->query("SELECT r.DayID, r.ID, r.StartTime, r.EndTime, f.Name as Faculty, s.Name as Semester, sub.Name as Subject, cr.Number as Room, d.Name as Day, reg.Name as Teacher 
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID 
            left JOIN classroom cr on cr.ID=r.RoomID 
            left join day d on d.ID=r.DayID 
            left join registration reg on reg.Id=r.TeacherID 
            left join routinetime ruttime on ruttime.Time=r.StartTime
            order by r.RoomID ASC, r.StartTime");
       
        $FacultyWiseClassCount=$this->db->query("SELECT  r.SemesterID, r.SubjectID, r.FacultyID,  f.Name as Faculty, s.Name as Semester, sub.Name as Subject, COUNT(r.SubjectID)as ClassNumber
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID 
            left JOIN classroom cr on cr.ID=r.RoomID 
            left join day d on d.ID=r.DayID 
            left join registration reg on reg.Id=r.TeacherID 
            left join routinetime ruttime on ruttime.Time=r.StartTime
            where r.SubjectID !=null or r.SubjectID!=0
            group by r.FacultyID, r.SemesterID , r.SubjectID
              order by r.FacultyID, r.SemesterID , r.StartTime");
        
        $FacultySemester=$this->db->query("SELECT  r.SemesterID, r.SubjectID, r.FacultyID,  f.Name as Faculty, s.Name as Semester
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID            
            where r.SubjectID !=null or r.SubjectID!=0
            group by r.FacultyID, r.SemesterID 
            order by r.FacultyID,r.SemesterID , r.StartTime");
         
        $room = $this->db->get('classroom')->result();
        $day = $this->db->get('day')->result();
        $time = $this->db->get('routinetime')->result();
        $teacherClass = $this->db->query("select rg.Name , rg.Id as TeacherID, count(r.id) as numberofclass from registration rg left join routine r on r.TeacherID=rg.Id where rg.Post<7 group by rg.Id");
        $AllSubjects = $this->db->get('subjects')->result();
        
        $out = array(
            "Routine" => $routine->result(),
            "day" => $day,
            "room" => $room,
            "time" => $time,
             "AllSubjects" => $AllSubjects,
            "TeacherClass" => $teacherClass->result(),
            "FacultyWiseClassCount"=>$FacultyWiseClassCount->result(),
            "FacultyAndSemester"=>$FacultySemester->result()
        );
        return $out;
    }
    
    public function GetAllClassRoutineFacultyWise($id) {
        $routine = $this->db->query("SELECT r.DayID, r.ID, r.StartTime, r.EndTime, f.Name as Faculty, s.Name as Semester, sub.Name as Subject, cr.Number as Room, d.Name as Day, reg.Name as Teacher 
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID 
            left JOIN classroom cr on cr.ID=r.RoomID 
            left join day d on d.ID=r.DayID 
            left join registration reg on reg.Id=r.TeacherID 
            left join routinetime ruttime on ruttime.Time=r.StartTime
             left JOIN student_tbl st on st.StudentID=$id
            left join semesteryearpromotions sem on sem.SessionID=st.SessionId and sem.FacultyID=st.Faculty
            WHERE r.FacultyID=st.Faculty and r.SemesterID=sem.SemesterID
            order by r.DayID, r.RoomID ASC, r.StartTime");
       
        
        $out = array(
            "Routine" => $routine->result(),
           
        );
        return $out;
    }

    public function LoadAllFields() {

         $this->db->where('Post<', 7);
         $teacher = $this->db->get('registration')->result();
        $out = array(
            "faculty" => $this->db->get('faculty')->result(),
            "session" => $this->db->get('session')->result(),
            "semester" => $this->db->get('semester')->result(),
            "subjects" => $this->db->get('subjects')->result(),
            "day" => $this->db->get('day')->result(),
            "room" => $this->db->get('classroom')->result(),
          
            "teacher" => $teacher
        );
        return $out;
    }

    public function AddRoutine($data) {
        $DayID = $data->DayID;
        $StartTime = $data->StartTime;
        $FacultyID = $data->FacultyID;
        $SemesterID = $data->SemesterID;
        $SubjectID = $data->SubjectID;
        $TeacherID = $data->TeacherID;
        $ID = $data->ID;
        
        $whereData = array(
            'DayID' => $DayID,
            'StartTime' => $StartTime,
            'TeacherID' => $TeacherID
        );
        $whereDataFacultyCheck = array(
            'DayID' => $DayID,
            'StartTime' => $StartTime,
            'FacultyID' => $FacultyID,
            'SemesterID'=>$SemesterID
        );
        //this will check teacher is exist in this time
        $this->db->where($whereData);
        $IsExist = $this->db->count_all_results('routine');
        //this will check is faculty and semester is exist in this time
         $this->db->where($whereDataFacultyCheck);
         $IsExist2 = $this->db->count_all_results('routine');
        if ($IsExist <= 0 && $IsExist2 <= 0) {
            $this->db->query("UPDATE `routine` SET `FacultyID` = $FacultyID, SemesterID= $SemesterID, SubjectID= $SubjectID,TeacherID= $TeacherID  WHERE `ID` = $ID");
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function DeleteRoutine($id) {
        $FacultyID = 0;
        $SemesterID = 0;
        $SubjectID = 0;
        $TeacherID = 0;
        $ID = $id;
        $this->db->query("UPDATE `routine` SET `FacultyID` = $FacultyID, SemesterID= $SemesterID, SubjectID= $SubjectID,TeacherID= $TeacherID  WHERE `ID` = $ID");
    }

//for delete all data and set default value in routine table like day room time for all possible field
    public function SetRoutineDefault() {
        $this->db->query("DELETE FROM routine");
        $room = $this->db->get('classroom')->result();
        $day = $this->db->get('day')->result();
        $time = $this->db->get('routinetime')->result();

        $data = array(
        );
        foreach ($day as $da) {
            foreach ($room as $rm) {
                foreach ($time as $tm) {
                    $data['RoomID'] = $rm->ID;
                    $data['DayID'] = $da->ID;
                    $data['StartTime'] = $tm->Time;
                    $data['EndTime'] = $tm->EndTime;

                    $this->db->insert('routine', $data);
                    $data = array();
                }
            }
        }
    }
    
    public function OpenTeacherAssignClass($TeacherID)
    {
         $result = $this->db->query("SELECT r.DayID, r.ID, r.StartTime, r.EndTime, f.Name as Faculty, s.Name as Semester, sub.Name as Subject, cr.Number as Room, d.Name as Day, reg.Name as Teacher 
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID 
            left JOIN classroom cr on cr.ID=r.RoomID 
            left join day d on d.ID=r.DayID 
            left join registration reg on reg.Id=r.TeacherID 
            left join routinetime ruttime on ruttime.Time=r.StartTime
            where r.TeacherID=$TeacherID
            order by d.ID, r.RoomID ASC, r.StartTime");
       
         return $result->result();
    }
    
     public function OpenFacultyWiseClass($FacultyID,$SemesterID,$SubjectID)
    {
         $result = $this->db->query("SELECT r.ID, r.DayID, r.SubjectID, r.ID, r.StartTime, r.EndTime, f.Name as Faculty, s.Name as Semester, sub.Name as Subject, cr.Number as Room, d.Name as Day, reg.Name as Teacher 
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID 
            left JOIN classroom cr on cr.ID=r.RoomID 
            left join day d on d.ID=r.DayID 
            left join registration reg on reg.Id=r.TeacherID 
            left join routinetime ruttime on ruttime.Time=r.StartTime
            WHERE r.FacultyID=$FacultyID and r.SemesterID=$SemesterID
            
            order by r.SubjectID, r.RoomID ASC, r.StartTime");
       
         return $result->result();
    }
    
     public function AllRoutineForDashBoard($today)
    {
         $result = $this->db->query("SELECT r.ID, r.DayID, r.SubjectID, r.ID, r.StartTime, r.EndTime, f.Name as Faculty, s.Name as Semester, sub.Name as Subject, cr.Number as Room, d.Name as Day, reg.Name as Teacher 
            FROM routine as r left 
            JOIN faculty f on f.FId= r.FacultyID 
            LEFT JOIN semester s on s.ID=r.SemesterID 
            left JOIN subjects sub on sub.SubID=r.SubjectID 
            left JOIN classroom cr on cr.ID=r.RoomID 
            left join day d on d.ID=r.DayID 
            left join registration reg on reg.Id=r.TeacherID 
            left join routinetime ruttime on ruttime.Time=r.StartTime
           where d.Name='$today' and r.SubjectID !=0
            order by r.RoomID ASC, r.StartTime");
       
         return $result->result();
    }
}
