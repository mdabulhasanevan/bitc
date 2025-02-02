<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post_Model
 *
 * @author Evan DU
 */
class Result_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetAllResultPdf() {
        $result = $this->db->query("SELECT rp.*, f.Name as FacultyName FROM result_pdf rp left join faculty f on f.FId=rp.FacultyID order by rp.FacultyID, rp.Year, rp.SemesterID")->result();
        return $result;
    }

   public function GetAllResultPdfForStudent($StudentID) {
        $result = $this->db->query("SELECT rp.*, f.Name as FacultyName FROM result_pdf rp left join faculty f on f.FId=rp.FacultyID left join student_tbl st on st.StudentID=$StudentID where rp.FacultyID=st.Faculty order by rp.FacultyID, rp.Year, rp.SemesterID")->result();
        return $result;
    }

    public function DeleteResultPdf($id) {
        $this->db->where(array("RID" => $id));
        $data = $this->db->get('result_pdf')->row();
        unlink("uploads/ResultPdf/" . $data->File);
        $result = $this->db->delete("result_pdf", array('RID' => $id));
        return $result;
    }

    public function UpdateResultPdf($Post) {
        $data = array(
            "FacultyID" => $Post->FacultyID,
            "SemesterID" => $Post->SemesterID,
            "Year" => $Post->Year,
            "Comment" => $Post->Comment,
            "PublishDate" => $Post->PublishDate,
        );
        $this->db->where(array('RID' => $Post->RID));
        $result = $this->db->update("result_pdf", $data);
        return $result;
    }

   

}
