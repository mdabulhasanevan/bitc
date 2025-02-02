<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Library_Model
 *
 * @author Evan DU
 */
class Library_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    #region Book Medium

    public function GetAllBookList() {
        $result = $this->db->query("SELECT bl.*, bm.Type as BookMedium, bc.Name as BookCategory FROM book_list bl left join bookmedium bm on bm.Id=bl.Medium left join bookcategory bc on bc.Id=bl.Subject")->result();
        return $result;
    }

    public function DeleteBookList($id) {
        $result = $this->db->delete("book_list", array('BId' => $id));
        return $result;
    }

    public function AddBookList($book_list) {
        $result = $this->db->insert("book_list", $book_list);
        return $result;
    }

    public function UpdateBookList($book_list) {
        $data = array(
            "BookName" => $book_list->BookName,
            "Description" => $book_list->Description,
            "Writer" => $book_list->Writer,
            "Addition" => $book_list->Addition,
            "Quantity" => $book_list->Quantity,
            "Available" => $book_list->Available,
            "Medium" => $book_list->Medium,
            "Subject" => $book_list->Subject
        );
        $this->db->where(array('BId' => $book_list->BId));
        $result = $this->db->update("book_list", $data);

        return $result;
    }

    #end region
    #region Book Medium

    public function GetAllBookMedium() {
        $result = $this->db->get("bookmedium")->result();
        return $result;
    }

    public function DeleteBookMedium($id) {
        $result = $this->db->delete("bookmedium", array('Id' => $id));
        return $result;
    }

    public function AddBookMedium($bookmedium) {
        $result = $this->db->insert("bookmedium", $bookmedium);
        return $result;
    }

    public function UpdateBookMedium($bookmedium) {
        $data = array(
            "Type" => $bookmedium->Type
        );
        $this->db->where(array('Id' => $bookmedium->Id));
        $result = $this->db->update("bookmedium", $data);

        //$result = $this->db->get("batch")->result();
        return $result;
    }

    #end region
    #region Book Category

    public function GetAllBookCategory() {
        $result = $this->db->get("bookcategory")->result();
        return $result;
    }

    public function DeleteBookCategory($id) {
        $result = $this->db->delete("bookcategory", array('Id' => $id));
        return $result;
    }

    public function AddBookCategory($bookcategory) {
        $result = $this->db->insert("bookcategory", $bookcategory);
        return $result;
    }

    public function UpdateBookCategory($bookcategory) {
        $data = array(
            "Name" => $bookcategory->Name
        );
        $this->db->where(array('Id' => $bookcategory->Id));
        $result = $this->db->update("bookcategory", $data);

        //$result = $this->db->get("batch")->result();
        return $result;
    }

    #end region
    #
    #student Side

    public function GetAllBookListForStudentSide($request) {
        if ($request->Subject > 0 && $request->BookName == "") {
            $where = " and bl.Subject=$request->Subject";
        } else if ($request->Subject == 0 && $request->BookName != "") {
            $where = " and bl.BookName LIKE '%$request->BookName%'";
        } else if ($request->Subject > 0 && $request->BookName != "") {
            $where = " and bl.Subject=$request->Subject and bl.BookName LIKE '%$request->BookName%'";
        } else {
            $where = "";
        }
        $StudentID = $_SESSION["StudentID"];
        $result = $this->db->query("SELECT bl.*, bm.Type as BookMedium, bc.Name as BookCategory FROM book_list bl left join bookmedium bm on bm.Id=bl.Medium left join bookcategory bc on bc.Id=bl.Subject where bl.BId not in (select br.BookID from book_request br where br.StudentID=$StudentID and Status<3) $where")->result();
        return $result;
    }

    public function RequestForBook($BId) {

        $RequestDate = date("Y/m/d");
        $StudentID = $_SESSION["StudentID"];
        $Status = 1;  //Status 1 means Requested
        //Count is the student over the limit of book like 2 books can take
        $this->db->where(array("StudentID" => $StudentID, "Status<" => 3));
        $whereCountforLimit = $this->db->count_all_results('book_request');

        //is same book requested
        $this->db->where(array("StudentID" => $StudentID, "BookID" => $BId, "Status<" => 3));
        $whereCountIsAlreadyRequested = $this->db->count_all_results('book_request');

        if ($whereCountforLimit < 2 && $whereCountIsAlreadyRequested == 0) {
            $result = $this->db->insert("book_request", array("StudentID" => $StudentID, "BookID" => $BId, "Status" => $Status, "RequestDate" => $RequestDate, "DeliveredDate" => Null, "ReturnDate" => Null));
            return array("status" => 1, "result" => $result);
        } else {
            return array("status" => 0, "result" => 0);
        }
    }

    public function GetRequestedAllBook() {
        $StudentID = $_SESSION["StudentID"];
        $result = $this->db->query("SELECT bl.*, br.RId , br.RequestDate, bm.Type as BookMedium, bc.Name as BookCategory FROM book_request br 
left join book_list bl on bl.BId=br.BookID
left join bookmedium bm on bm.Id=bl.Medium 
left join bookcategory bc on bc.Id=bl.Subject WHERE br.Status=1 and br.StudentID=$StudentID")->result();
        return $result;
    }

    public function GetDeliveredAllBookForStudent() {
        $StudentID = $_SESSION["StudentID"];
        //status 1 meand requested
        $result = $this->db->query("SELECT bl.*, st.FullName, st.SMSNotificationNo, st.RegNo, br.RId , br.DeliveredDate, DATE_ADD(br.DeliveredDate, INTERVAL 7 DAY) as ReturnDate, if(DATE_ADD(br.DeliveredDate, INTERVAL 7 DAY)<=now(),1,0) as IsOver, bm.Type as BookMedium, bc.Name as BookCategory FROM book_request br 
left join book_list bl on bl.BId=br.BookID
left join bookmedium bm on bm.Id=bl.Medium 
left join bookcategory bc on bc.Id=bl.Subject
left join student_tbl st on st.StudentID=br.StudentID where br.Status=2 and br.StudentID=$StudentID order by br.DeliveredDate ")->result();
        return $result;
    }

    public function GetReturnedAllBookForStudent() {
        $StudentID = $_SESSION["StudentID"];
        //status 3 meand returned
        $result = $this->db->query("SELECT bl.*, st.FullName, st.SMSNotificationNo, st.RegNo, br.RId , br.DeliveredDate, br.ReturnDate, bm.Type as BookMedium, bc.Name as BookCategory FROM book_request br 
left join book_list bl on bl.BId=br.BookID
left join bookmedium bm on bm.Id=bl.Medium 
left join bookcategory bc on bc.Id=bl.Subject
left join student_tbl st on st.StudentID=br.StudentID where br.Status=3 and br.StudentID=$StudentID order by br.ReturnDate")->result();
        return $result;
    }

    //Admin Side
    public function AcceptRequestForBook($RId) {

        $Available = $this->db->query("select bl.Available, bl.BId from book_list bl left join book_request br on br.BookID=bl.BId where br.RId=$RId")->row();

        if ($Available->Available > 0) {
            //if avail able is grater than zero then minus 1 and this is now available book
            $NowAvailable = ($Available->Available) - 1;
            $NewData = array(
                "Available" => $NowAvailable
            );
            //update new available book
            $this->db->where(array('BId' => $Available->BId));
            $result1 = $this->db->update("book_list", $NewData);

            //now update status
            $NewStatus = array("Status" => 2, "DeliveredDate" => date("Y/m/d"));  //status 2 means delivered
            $this->db->where(array('RId' => $RId));
            $result2 = $this->db->update("book_request", $NewStatus);
            return 1;
        } else {
            return 0;
        }


        return $result;
    }

    public function GetRequestedAllBookforAdmin() {
        //status 1 meand requested
        $result = $this->db->query("SELECT bl.*, st.FullName, st.RegNo, br.RId , br.RequestDate, bm.Type as BookMedium, bc.Name as BookCategory FROM book_request br 
left join book_list bl on bl.BId=br.BookID
left join bookmedium bm on bm.Id=bl.Medium 
left join bookcategory bc on bc.Id=bl.Subject
left join student_tbl st on st.StudentID=br.StudentID where br.Status=1 order by br.DeliveredDate")->result();
        return $result;
    }

    public function GetDeliveredAllBook() {
        //status 1 meand requested
        $result = $this->db->query("SELECT bl.*, st.FullName, st.SMSNotificationNo, st.RegNo, br.RId , br.DeliveredDate, DATE_ADD(br.DeliveredDate, INTERVAL 7 DAY) as ReturnDate,if(DATE_ADD(br.DeliveredDate, INTERVAL 7 DAY)<=now(),1,0) as IsOver, bm.Type as BookMedium, bc.Name as BookCategory FROM book_request br 
left join book_list bl on bl.BId=br.BookID
left join bookmedium bm on bm.Id=bl.Medium 
left join bookcategory bc on bc.Id=bl.Subject
left join student_tbl st on st.StudentID=br.StudentID where br.Status=2 order by br.DeliveredDate")->result();
        return $result;
    }

    public function ReturnBook($RId) {

        $Available = $this->db->query("select bl.Available, bl.BId from book_list bl left join book_request br on br.BookID=bl.BId where br.RId=$RId")->row();

        //if avail able is grater than zero then minus 1 and this is now available book
        $NowAvailable = ($Available->Available) + 1;
        $NewData = array(
            "Available" => $NowAvailable
        );
        //update new available book
        $this->db->where(array('BId' => $Available->BId));
        $result1 = $this->db->update("book_list", $NewData);

        //now update status
        $NewStatus = array("Status" => 3, "ReturnDate" => date("Y/m/d"));  //status 3 means Returned
        $this->db->where(array('RId' => $RId));
        $result2 = $this->db->update("book_request", $NewStatus);
        return 1;
    }

    public function GetReturnedAllBook() {
        //status 1 meand requested
        $result = $this->db->query("SELECT bl.*, st.FullName, st.SMSNotificationNo, st.RegNo, br.RId , br.DeliveredDate, br.ReturnDate, bm.Type as BookMedium, bc.Name as BookCategory FROM book_request br 
left join book_list bl on bl.BId=br.BookID
left join bookmedium bm on bm.Id=bl.Medium 
left join bookcategory bc on bc.Id=bl.Subject
left join student_tbl st on st.StudentID=br.StudentID where br.Status=3 order by br.ReturnDate")->result();
        return $result;
    }

    public function CalcelRequestForBook($RId) {
        $result = $this->db->delete("book_request", array('RId' => $RId));
        return $result;
    }

    #common

    public function GetAllCommonField() {
        $result = array(
            "BookMedium" => $this->db->get("bookmedium")->result(),
            "BookCategory" => $this->db->get("bookcategory")->result()
        );
        return $result;
    }

}
