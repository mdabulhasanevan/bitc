<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author Evan DU
 */
class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Post_Model", "Post");
        $this->load->model("CommonModel", "Common");
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function MyPost() {
        $this->checkuserRole(uri_string());
        $data = array(
            "Title" => "Submit Your Post",
            "Faculty" => $this->Common->GetFaculty(),
            "Session" => $this->Common->GetSession()
        );

        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Post/SubmitPost');
    }

     public function UpdatePost() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Post->UpdatePost($request);
        echo json_encode($result);
    }
     
    public function CreatePost() {
        $this->checkuserRole(uri_string());
        $data = array(
            "Title" => "Submit Post",
            "Faculty" => $this->Common->GetFaculty(),
            "Session" => $this->Common->GetSession()
        );
        if (isset($_POST['Signup'])) {
            $this->form_validation->set_rules('Heading', 'Heading', 'required');
           // $this->form_validation->set_rules('Description', 'Description', 'required');
            $this->form_validation->set_rules('Faculty', 'Faculty', 'required');
            $this->form_validation->set_rules('Session', 'Session', 'required');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path'] = './uploads/userpost/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|zip|rar|docx|';
                $config['max_size'] = 20000;
//                $config['max_width'] = 300;
//                $config['max_height'] = 300;

                $this->load->library('upload', $config);
                $this->upload->do_upload('Attachment');
                $file = $this->upload->data();
                
                
                
                $fdata = array(
                    'Heading' => $_POST['Heading'],
                   // 'Description' => nl2br($_POST['Description']),
                    'Description' => trim($_POST['Description']),
                    'Faculty' => $_POST['Faculty'],
                    'Session' => $_POST['Session'],
                    'Attachment' => $file['file_name'],
                    'UserID' => $_SESSION["id"],
                    'Date' => date("Y-m-d H:i:s"),
                    'isPublic' => $_POST['isPublic']
                );
                $this->db->insert('userpost', $fdata);
                $this->session->set_flashdata("success", "Your Post has been submited!! ");
                redirect("Post/MyPost", "refresh");
            }
        }

        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Post/CreatePost');
    }

    public function GetAllPost() {
        $UserId = $_SESSION['id'];
        $result = $this->Post->GetAllPost($UserId);
        echo json_encode($result);
    }

    public function DeletePost($id) {
        $result = $this->Post->DeletePost($id);
        echo json_encode($result);
    }

      //for post comment Submit
    public function SubmitComment()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $TeacherID = $_SESSION["id"];
        //$comment=mysql_real_escape_string($request->Comment);
        
        // 0 for Student 1 for Teacher
        $Commenter=1;
        $data = $this->Post->SubmitComment($request->Comment, $request->PId,$TeacherID,$Commenter);
        
        echo json_encode($data);
        
    }
    
    //CommentList For Single Student
     public function GetCommentSinglePost($PId) {
        $data = $this->Post->GetCommentSinglePost($PId);
        echo json_encode($data);
    }
    
    //delete Comment own Student
     public function DeleteComment($CID,$PostID) {
        $data = $this->Post->DeleteComment($CID,$PostID);
        echo json_encode($data);
    }
    
    
    
    
}
