<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookLibrary
 *
 * @author Evan DU
 */
class BookLibrary extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Library_Model", "LM");
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function Index() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Book Library ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Library/Index');
    }

    //Index for Book List
    public function GetAllBookList() {
        $result = $this->LM->GetAllBookList();
        echo json_encode($result);
    }

    public function DeleteBookList($id) {
        $result = $this->LM->DeleteBookList($id);
        echo json_encode($result);
    }

    public function AddBookList() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->LM->AddBookList($request);
        echo json_encode($result);
    }

    public function UpdateBookList() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->LM->UpdateBookList($request);
        echo json_encode($result);
    }

    
    #request book

    public function Bookrequest() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Requested Book List ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Library/Book_request');
    }
    public function CalcelRequestForBook($RId) {
        $result = $this->LM->CalcelRequestForBook($RId);
        echo json_encode($result);
    }
    
    public function AcceptRequestForBook($RId) {
        $result = $this->LM->AcceptRequestForBook($RId);
        echo json_encode($result);
    }

    public function GetRequestedAllBook() {
        $result = $this->LM->GetRequestedAllBookforAdmin();
        echo json_encode($result);
    }
    
    public function GetDeliveredAllBook() {
        $result = $this->LM->GetDeliveredAllBook();
        echo json_encode($result);
    }
    
    public function GetReturnedAllBook() {
        $result = $this->LM->GetReturnedAllBook();
        echo json_encode($result);
    }
    
    public function ReturnBook($RId) {
        $result = $this->LM->ReturnBook($RId);
        echo json_encode($result);
    }
    
    #region BookMedium

    public function BookMedium() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Book Medium ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Library/BookMedium');
    }

    public function GetAllBookMedium() {
        $result = $this->LM->GetAllBookMedium();
        echo json_encode($result);
    }

    public function DeleteBookMedium($id) {
        $result = $this->LM->DeleteBookMedium($id);
        echo json_encode($result);
    }

    public function AddBookMedium() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->LM->AddBookMedium($request);
        echo json_encode($result);
    }

    public function UpdateBookMedium() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->LM->UpdateBookMedium($request);
        echo json_encode($result);
    }

    #end Region
    #region BookCategory

    public function BookCategory() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Book Category ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Library/BookCategory');
    }

    public function GetAllBookCategory() {
        $result = $this->LM->GetAllBookCategory();
        echo json_encode($result);
    }

    public function DeleteBookCategory($id) {
        $result = $this->LM->DeleteBookCategory($id);
        echo json_encode($result);
    }

    public function AddBookCategory() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->LM->AddBookCategory($request);
        echo json_encode($result);
    }

    public function UpdateBookCategory() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->LM->UpdateBookCategory($request);
        echo json_encode($result);
    }

    #end Region
    #common

    public function GetAllCommonField() {
        $result = $this->LM->GetAllCommonField();
        echo json_encode($result);
    }

}
