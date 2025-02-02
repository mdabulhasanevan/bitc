<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Attendance_Model
 *
 * @author Evan DU
 */
class Attendance_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function AllAttendance($search) {

        $data = array();
        if ($search->FacultyID != null) {
            $data['FacultyID'] = $search->FacultyID;
        }
        if ($search->SessionID != null) {
            $data['at.SessionID'] = $search->SessionID;
        }
        if ($search->SemesterID != null) {
            $data['SemesterID'] = $search->SemesterID;
        }
        if ($search->SubjectID != null) {
            $data['SubjectID'] = $search->SubjectID;
        }
        
        //Fot Hide InActive Student
        //$data['IsNotActive'] = 0;
        
//        if ($search->Date != null) {
//            $new_date_format = date('Y-m-d', strtotime($search->Date));
//            $data['Date'] = $new_date_format;
//        }

        $date1 = NULL;
        $date2 = NULL;

        //formating data
        if ($search->Date != null && $search->Date2 != null) {
            $new_date_format = date('Y-m-d', strtotime($search->Date));
            $date1 = $new_date_format;

            $new_date_format2 = date('Y-m-d', strtotime($search->Date2));
            $date2 = $new_date_format2;
        }

        $this->db->select('
              at.isAttend,
    at.StudentID,
    st.RegNo,
    at.Date,
    f.Name as Faculty,
    s.Name as Semester,
    sub.Name as Subject,
   
    ses.Session as Session,
    st.FullName as Name,
    st.StudentInsID');
        $this->db->from('attendance as at');
        $this->db->where($data);

        if ($date1 != NULL && $date2 != NULL) {
            $this->db->where('Date >=', $date1);
            $this->db->where('Date <=', $date2);
        }

        $this->db->join('faculty as f', 'f.FId= at.FacultyID', 'left');
        $this->db->join('semester as s', 's.ID=at.SemesterID', 'left');
        $this->db->join('subjects as sub', 'sub.SubID=at.SubjectID', 'left');
        $this->db->join('session as ses', 'ses.SessionId=at.SessionID', 'left');
        $this->db->join('student_tbl as st', 'st.StudentID=at.StudentID', 'left');
   

        $this->db->group_by("st.StudentID");
        
        $this->db->order_by('st.RegNo', 'ASC');
         $this->db->order_by('st.Date', 'ASC');
        $result = $this->db->get();

//        $result = $this->db->query("SELECT a.isAttend,a.StudentID, a.Date, f.Name as Faculty, s.Name as Semester, sub.Name as Subject, ses.Session as Session , st.FullName as Name,st.StudentInsID
//FROM attendance as a
//left JOIN faculty f on f.FId= a.FacultyID 
//LEFT JOIN semester s on s.ID=a.SemesterID 
//left JOIN subjects sub on sub.SubID=a.SubjectID
//LEFT join session ses on ses.SessionId=a.SessionID
//LEFT JOIN student_tbl st on st.StudentID=a.StudentID");
        

        //Only Main table data will retrive fo show pivote data in attendance table html
        $this->db->where($data);

        if ($date1 != NULL && $date2 != NULL) {
            $this->db->where('Date >=', $date1);
            $this->db->where('Date <=', $date2);
        }
        $result2 = $this->db->get('attendance as at');

        //Only Main table data will retrive for show Date in attendance table html
        $this->db->where($data);

        if ($date1 != NULL && $date2 != NULL) {
            $this->db->where('Date >=', $date1);
            $this->db->where('Date <=', $date2);
        }

        $this->db->select('at.Date as Date,re.Name as Teacher,at.ClassCount');
        $this->db->from('attendance as at');

        $this->db->join('registration as re', 're.Id=at.TeacherID', 'left');
        $this->db->group_by("Date");
        $OnlyDate = $this->db->get();


        $data = array(
            'GroupData' => $result->result(),
            'AllData' => $result2->result(),
            'OnlyDate' => $OnlyDate->result()
        );
        return $data;
    }
   
    //for get student list when teacher  set attend
    public function GetStudents($Faculty, $Session,$SubjectID,$Date) {
//        $result2 = $this->db->query("SELECT StudentID,FullName, StudentInsID,RegNo, Photo, RollNO,StudentID FROM student_tbl WHERE Faculty= $Faculty AND SessionId=$Session order by RegNo");
         $result2 = $this->db->query("SELECT st.StudentID,st.FullName, st.CollegeRoll as CollegeRoll, st.RegNo as RegNo, st.Photo, st.StudentID,  isAttend FROM student_tbl  st 
left join attendance as att on att.StudentID =st.StudentID and att.SubjectID=$SubjectID and att.Date='$Date'
WHERE st.Faculty= $Faculty AND st.SessionId=$Session And IsNotActive=0   order by st.Batch,  st.CollegeRoll");
        return array(
            "Student2" => $result2->result()
        );
    }

    public function AddAttendance($data) {
// first datas value is retrive for search is exist or not bellow parametter is need for that
        $oneData = $data[0];
        $Wheredata = array(
            "FacultyID" => $oneData->FacultyID,
            "SessionID" => $oneData->SessionID,
            "SemesterID" => $oneData->SemesterID,
            "SubjectID" => $oneData->SubjectID,
            "Date" => $oneData->Date
        );

//        since paramrtter $data have some field that is not in attendance table so needed field set again in data2 variable
        $data2;
        $i = 0;
        foreach ($data as $Student) {
            $data2[$i] = array(
                "FacultyID" => $Student->FacultyID,
                "SessionID" => $Student->SessionID,
                "SemesterID" => $Student->SemesterID,
                "SubjectID" => $Student->SubjectID,
                "Date" => $Student->Date,
                "isAttend" => $Student->isAttend,
                "StudentID" => $Student->StudentID,
                "TeacherID" => $Student->TeacherID,
                "UserID" => $_SESSION["id"],
                "ClassCount" => $Student->ClassCount
                
            );
            $i++;
        }
        $this->db->where($Wheredata);
        $count = $this->db->count_all_results('attendance');

        if ($count > 0) {
           
            //first delete all then add
            $result = $this->db->delete('attendance', $Wheredata);
             $this->db->insert_batch('attendance', $data2);
            
             
             if ($this->db->affected_rows() > 0) {
                return "Added Successfully";
            } else {
                return "Added unsuccessfully";
            }
         
        } else {
//            add direct
            $this->db->insert_batch('attendance', $data2);
           
            
            if ($this->db->affected_rows() > 0) {
                return "Added Successfully";
            } else {
                return "Added unsuccessfully";
            }
        }
    }

    //in student info and student dash board
    public function GetSingleAttendance($SID) {
        $SingleAttendance = $this->db->query("SELECT COUNT(at.isAttend) as total, sum(if(at.isAttend=1,1,0)) as Attend , sum(if(at.isAttend=0,1,0)) as Absent, ceiling((sum(if(at.isAttend=1,1,0))*100)/COUNT(at.isAttend)) as Percent, `at`.`StudentID`, `f`.`Name` as `Faculty`, `s`.`Name` as `Semester`, `sub`.`Name` as `Subject`, `ses`.`Session` as `Session`, `st`.`StudentInsID` FROM `attendance` as `at` LEFT JOIN `faculty` as `f` ON `f`.`FId`= `at`.`FacultyID` LEFT JOIN `semester` as `s` ON `s`.`ID`=`at`.`SemesterID` LEFT JOIN `subjects` as `sub` ON `sub`.`SubID`=`at`.`SubjectID` LEFT JOIN `session` as `ses` ON `ses`.`SessionId`=`at`.`SessionID` LEFT JOIN `student_tbl` as `st` ON `st`.`StudentID`=`at`.`StudentID` WHERE at.`StudentID` = $SID GROUP BY `SubjectID` ORDER BY `SubjectID` DESC");
        $SingleAttendanceOnlySemester = $this->db->query("SELECT COUNT(at.isAttend) as total, sum(if(at.isAttend=1,1,0)) as Attend , sum(if(at.isAttend=0,1,0)) as Absent, `at`.`StudentID`, s.Name , CEILING((sum(if(at.isAttend=1,1,0))*100)/COUNT(at.isAttend)) as Persent FROM attendance as at LEFT JOIN semester as s ON `s`.`ID`=`at`.`SemesterID` LEFT JOIN `student_tbl` as `st` ON `st`.`StudentID`=`at`.`StudentID` WHERE at.`StudentID` = '$SID' GROUP BY at.SemesterID ORDER BY at.SemesterID DESC");
        
        $data=array(
            'SingleAttendance'=>$SingleAttendance->result(),
            'SingleAttendanceOnlySemester'=>$SingleAttendanceOnlySemester->result()
        );
        return $data;
    }

    public function DeleteAttendanceSingal($Info) {
        $data = array(
            'Date' => $Info->Date,
            'FacultyID' => $Info->FacultyID,
            'SemesterID' => $Info->SemesterID,
            'SessionID' => $Info->SessionID,
            'SubjectID' => $Info->SubjectID,
        );

        $result = $this->db->delete('attendance', $data);
        return $result;
    }
    
    public function DayWiseAttendanceReport($date)
    {
        $result=$this->db->query("SELECT att.Date as Date, sub.Name as Subject, reg.Name as Teacher, f.Name as Faculty, sem.Name as Semester, ses.Session as Session, count(att.StudentID) as Total, sum(if(att.isAttend=1,1,0)) as Attend, sum(if(att.isAttend=0,1,0)) as Absent, ((sum(if(att.isAttend=1,1,0))*100)/count(att.StudentID)) as Percent from attendance att left join subjects sub on sub.SubID=att.SubjectID left join semester sem on sem.ID=att.SemesterID LEFT join faculty f on f.FId=att.FacultyID left join session ses on ses.SessionId=att.SessionID left join registration reg on reg.Id=att.TeacherID WHERE att.Date='$date' group by att.FacultyID, att.SessionID, att.SubjectID, att.Date order by att.FacultyID, att.SessionID, att.SemesterID")->result();
        return $result;
        
    }
}
