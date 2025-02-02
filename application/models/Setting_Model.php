<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Setting_Model
 *
 * @author Evan DU
 */
class Setting_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #regionBatch

    public function GetAllBatch() {
        $result = $this->db->get("batch")->result();
        return $result;
    }

    public function DeleteBatch($id) {
        $result = $this->db->delete("batch", array('BId' => $id));
        return $result;
    }

    public function AddBatch($Batch) {
        $result = $this->db->insert("batch", $Batch);
        return $result;
    }

    public function UpdateBatch($Batch) {
        $data = array(
            "BatchName" => $Batch->BatchName
        );
        $this->db->where(array('BId' => $Batch->BId));
        $result = $this->db->update("batch", $data);

        //$result = $this->db->get("batch")->result();
        return $result;
    }

    #end region
    #region Faculty

    public function GetAllFaculty() {
        $result = $this->db->get("faculty")->result();
        return $result;
    }

    public function DeleteFaculty($id) {
        $result = $this->db->delete("faculty", array('FId' => $id));
        return $result;
    }

    public function AddFaculty($Faculty) {
        $result = $this->db->insert("faculty", $Faculty);
        return $result;
    }

    public function UpdateFaculty($Faculty) {
        $data = array(
            "Name" => $Faculty->Name,
            "FullMeaning" => $Faculty->FullMeaning,
            "InCourse" => $Faculty->InCourse
        );
        $this->db->where(array('FId' => $Faculty->FId));
        $result = $this->db->update("faculty", $data);
        return $result;
    }

    #end region
    #region Session

    public function GetAllSession() {
        $result = $this->db->get("session")->result();
        return $result;
    }

    public function DeleteSession($id) {
        $result = $this->db->delete("session", array('SessionId' => $id));
        return $result;
    }

    public function AddSession($Session) {
        $result = $this->db->insert("session", $Session);
        return $result;
    }

    public function UpdateSession($Session) {
        $data = array(
            "Session" => $Session->Session
        );
        $this->db->where(array('SessionId' => $Session->SessionId));
        $result = $this->db->update("session", $data);
        return $result;
    }

    #end region
    #region ClassRoom

    public function GetAllClassRoom() {
        $result = $this->db->get("classroom")->result();
        return $result;
    }

    public function DeleteClassRoom($id) {
        $result = $this->db->delete("classroom", array('ID' => $id));
        return $result;
    }

    public function AddClassRoom($ClassRoom) {
        $result = $this->db->insert("classroom", $ClassRoom);
        return $result;
    }

    public function UpdateClassRoom($ClassRoom) {
        $data = array(
            "Name" => $ClassRoom->Name,
            "Number" => $ClassRoom->Number
        );
        $this->db->where(array('ID' => $ClassRoom->ID));
        $result = $this->db->update("classroom", $data);
        return $result;
    }

    #end region
    #region ClassTime

    public function GetAllClassTime() {
        $result = $this->db->get("routinetime")->result();
        return $result;
    }

    public function DeleteClassTime($id) {
        $result = $this->db->delete("routinetime", array('ID' => $id));
        return $result;
    }

    public function AddClassTime($ClassTime) {
        $result = $this->db->insert("routinetime", $ClassTime);
        return $result;
    }

    public function UpdateClassTime($ClassTime) {
        $data = array(
            "Time" => $ClassTime->Time,
            "EndTime" => $ClassTime->EndTime
        );
        $this->db->where(array('ID' => $ClassTime->ID));
        $result = $this->db->update("routinetime", $data);
        return $result;
    }

    #end region
    #
    #region Post

    public function GetAllPost() {
        $result = $this->db->get("post")->result();
        return $result;
    }

    public function DeletePost($id) {
        $result = $this->db->delete("post", array('PId' => $id));
        return $result;
    }

    public function AddPost($Post) {
        $result = $this->db->insert("post", $Post);
        return $result;
    }

    public function UpdatePost($Post) {
        $data = array(
            "PostName" => $Post->PostName,
        );
        $this->db->where(array('PId' => $Post->PId));
        $result = $this->db->update("post", $data);
        return $result;
    }

    #end region
    #region Role

    public function GetAllRole() {
        $result = $this->db->get("role_tbl")->result();
        return $result;
    }

    public function DeleteRole($id) {
        $result = $this->db->delete("role_tbl", array('Id' => $id));
        return $result;
    }

    public function AddRole($Role) {
        $result = $this->db->insert("role_tbl", $Role);
        return $result;
    }

    public function UpdateRole($Role) {
        $data = array(
            "Role" => $Role->Role,
        );
        $this->db->where(array('Id' => $Role->Id));
        $result = $this->db->update("role_tbl", $data);
        return $result;
    }

    #end region
    #region Semester

    public function GetAllSemester() {
        $result = $this->db->query("SELECT sm.*, fl.Name as FacultyName FROM semester sm join faculty fl on fl.FId=sm.Faculty")->result();
        return $result;
    }

    public function DeleteSemester($id) {
        $result = $this->db->delete("semester", array('ID' => $id));
        return $result;
    }

    public function AddSemester($Semester) {
        $result = $this->db->insert("semester", $Semester);
        return $result;
    }

    public function UpdateSemester($Semester) {
        $data = array(
            "Name" => $Semester->Name,
            "Faculty" => $Semester->Faculty,
        );
        $this->db->where(array('ID' => $Semester->ID));
        $result = $this->db->update("semester", $data);
        return $result;
    }

    #end region
    #
     #region Subject

    public function GetAllSubject() {
        $result = $this->db->query("SELECT sub.*, sm.Name as SemesterName, fl.Name as FacultyName FROM subjects sub LEFT JOIN faculty fl on fl.FId=sub.Faculty LEFT JOIN semester sm on sm.ID=sub.Semester order by sub.Faculty, sub.Semester, sub.Code")->result();
        // $result = $this->db->get("subjects")->result();
        return $result;
    }

    public function DeleteSubject($id) {
        $result = $this->db->delete("subjects", array('SubID' => $id));
        return $result;
    }

    public function AddSubject($Subject) {
        $result = $this->db->insert("subjects", $Subject);
        return $result;
    }

    public function UpdateSubject($Subject) {
        $data = array(
            "Name" => $Subject->Name,
            "Faculty" => $Subject->Faculty,
            "Credit" => $Subject->Credit,
            "Code" => $Subject->Code,
            "Semester" => $Subject->Semester,
             "Syllabus" => $Subject->Syllabus
        );
        $this->db->where(array('SubID' => $Subject->SubID));
        $result = $this->db->update("subjects", $data);
        return $result;
    }

    #end region
    #region PromotionList

    public function GetAllPromotionList() {
        $result = $this->db->query("SELECT semp.*, ses.Session as Session, semy.Year, fuc.Name as Faculty, sem.Name as Semester FROM semesteryearpromotions semp
left join session ses on ses.SessionId=semp.SessionID
left join semesteryear semy on semy.ID=semp.YearID
left join faculty fuc on fuc.FId=semp.FacultyID
left join semester sem on sem.ID=semp.SemesterID")->result();
        // $result = $this->db->get("subjects")->result();
        return $result;
    }

    public function DeletePromotionList($id) {
        $result = $this->db->delete("semesteryearpromotions ", array('ID' => $id));
        return $result;
    }

    public function AddPromotionList($PromotionList) {
        $this->db->where(array('SessionID' => $PromotionList->SessionID, 'FacultyID' => $PromotionList->FacultyID));
        $IsExist = $this->db->count_all_results('semesteryearpromotions');


        if ($IsExist < 1) {
            $result = $this->db->insert("semesteryearpromotions", $PromotionList);
            return $result;
        } else {
            return 0;
        }
    }

    public function UpdatePromotionList($PromotionList) {
        $data = array(
            "SessionID" => $PromotionList->SessionID,
            "FacultyID" => $PromotionList->FacultyID,
            "SemesterID" => $PromotionList->SemesterID,
             "Syllabus" => $PromotionList->Syllabus,
            "YearID" => $PromotionList->YearID,
            "ExamYear" => $PromotionList->ExamYear,
            "PassedYear" => $PromotionList->PassedYear,
            "ExamCompletedFromTo" => $PromotionList->ExamCompletedFromTo,
            "VivaProjectDefence" => $PromotionList->VivaProjectDefence,
            "ResultPublished" => $PromotionList->ResultPublished
        );
        $this->db->where(array('ID' => $PromotionList->ID));
        $result = $this->db->update("semesteryearpromotions ", $data);
        return $result;
    }

    #end region
    #region MajorSetting

    public function UpdateMajorList($mobile, $message) {

        $this->db->query("update student_tbl set Major='$message' where StudentID in($mobile)");
    }

    #end region
}
