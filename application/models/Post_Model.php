<?php

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
class Post_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetAllPost($User) {
        $result = $this->db->query("SELECT up.*, re.Name as TeacherName, re.Photo, f.Name as FacultyName, s.Session as SessionName FROM userpost as up
LEFT join faculty f on f.FId=up.Faculty
LEFT JOIN session s on s.SessionId=up.Session
left join registration re on re.Id=$User
WHERE up.UserID=$User ORDER BY up.PId DESC")->result();
        return $result;
    }

    public function GetAllPostforStudent($StudentID) {
        $result = $this->db->query("SELECT up.*, f.Name,  p.PostName as PostName, s.Session , re.Photo as UserPhoto, re.Name as TeacherName FROM userpost as up
LEFT join faculty f on f.FId=up.Faculty
LEFT JOIN session s on s.SessionId=up.Session
LEFT JOIN student_tbl st on st.StudentID=$StudentID
left join registration re on re.Id=up.UserID
left JOIN post p on p.PId=re.Post
WHERE up.isPublic=1 or (up.Faculty=st.Faculty and up.Session=st.SessionId) ORDER BY up.PId DESC limit 30")->result();
        return $result;
    }

    public function DeletePost($id) {
        $this->db->where(array("PId" => $id));
        $data = $this->db->get('userpost')->row();
        unlink("uploads/userpost/" . $data->Attachment);
        $result = $this->db->delete("userpost", array('PId' => $id));
        return $result;
    }

    public function UpdatePost($Post) {
        $data = array(
            "Heading" => $Post->Heading,
            "Description" => $Post->Description,
            "Faculty" => $Post->Faculty,
            "Session" => $Post->Session,
            "isPublic" => $Post->isPublic,
        );
        $this->db->where(array('PId' => $Post->PId));
        $result = $this->db->update("userpost", $data);
        return $result;
    }

    public function SubmitComment($Comment, $PId, $StudentID,$Commenter) {
        $data = array(
            "PostID" => $PId,
            "Comment" => $Comment,
            "StudentID" => $StudentID,
            "Commenter"=>$Commenter,
            "Date" => date("Y-m-d H:i:s"),
        );
        $this->db->insert("user_post_comment", $data);

        $result = $this->GetCommentSinglePost($PId);
        return $result;
    }

    public function GetCommentSinglePost($PId) {

        $where = array(
            "PostID" => $PId
        );
        $this->db->select("upc.*, st.FullName, st.Photo");
        $this->db->from('user_post_comment as upc');
        $this->db->join('student_tbl as st', 'st.StudentID=upc.StudentID', 'left');
        $this->db->where($where);
        $result = $this->db->get()->result();
        return $result;
    }

    //Delete Comment onw Student
    public function DeleteComment($CID,$PostID) {
        $this->db->delete("user_post_comment", array("CID" => $CID));
        $result = $this->GetCommentSinglePost($PostID);
        return $result;
    }

}
