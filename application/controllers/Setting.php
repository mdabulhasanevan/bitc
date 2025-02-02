<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Setting
 *
 * @author Evan DU
 */
class Setting extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION["User_loged"])) {
            $this->session->set_flashdata("successErr", "Please login first. ");
            redirect('Auth/login');
        }
        $this->load->model("Setting_Model", "Setting");
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
    }

    //Check User Role
    public function CheckUserRole($uri) {
        $this->load->model("User_Model", "User");
        $IsOk = $this->User->CheckUserRole($uri);
        if ($IsOk != TRUE) {
            redirect("Auth/Restricted");
        }
    }

    public function BackupRestore() {
        $this->checkuserRole(uri_string());
       
        $this->load->dbutil();
        $db_format = array('format' => 'zip', 'filename' => 'bitc_backup.sql');
        $backup = $this->dbutil->backup($db_format);
        $dbname = 'backup-on-' . date('Y-m-d') . '.zip';
        $save = 'Backup/db_backup/' . $dbname;
        write_file($save, $backup);
        force_download($dbname, $backup);
    }

    public function Index() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Setting ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Index');
    }

    #region Batch

    public function Batch() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Batch ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Batch');
    }

    public function GetAllBatch() {
        $result = $this->Setting->GetAllBatch();
        echo json_encode($result);
    }

    public function DeleteBatch($id) {
        $result = $this->Setting->DeleteBatch($id);
        echo json_encode($result);
    }

    public function AddBatch() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddBatch($request);
        echo json_encode($result);
    }

    public function UpdateBatch() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateBatch($request);
        echo json_encode($result);
    }

    #end Region
    #region Session

    public function Faculty() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Faculty ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Faculty');
    }

    public function GetAllFaculty() {
        $result = $this->Setting->GetAllFaculty();
        echo json_encode($result);
    }

    public function DeleteFaculty($id) {
        $result = $this->Setting->DeleteFaculty($id);
        echo json_encode($result);
    }

    public function AddFaculty() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddFaculty($request);
        echo json_encode($result);
    }

    public function UpdateFaculty() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateFaculty($request);
        echo json_encode($result);
    }

    #end Region
    #region Session

    public function Session() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Session ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Session');
    }

    public function GetAllSession() {
        $result = $this->Setting->GetAllSession();
        echo json_encode($result);
    }

    public function DeleteSession($id) {
        $result = $this->Setting->DeleteSession($id);
        echo json_encode($result);
    }

    public function AddSession() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddSession($request);
        echo json_encode($result);
    }

    public function UpdateSession() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateSession($request);
        echo json_encode($result);
    }

    #end Region
    #region ClassRoom

    public function ClassRoom() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "ClassRoom ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/ClassRoom');
    }

    public function GetAllClassRoom() {
        $result = $this->Setting->GetAllClassRoom();
        echo json_encode($result);
    }

    public function DeleteClassRoom($id) {
        $result = $this->Setting->DeleteClassRoom($id);
        echo json_encode($result);
    }

    public function AddClassRoom() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddClassRoom($request);
        echo json_encode($result);
    }

    public function UpdateClassRoom() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateClassRoom($request);
        echo json_encode($result);
    }

    #end Region
    #region ClassTime

    public function ClassTime() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "ClassTime ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/ClassTime');
    }

    public function GetAllClassTime() {
        $result = $this->Setting->GetAllClassTime();
        echo json_encode($result);
    }

    public function DeleteClassTime($id) {
        $result = $this->Setting->DeleteClassTime($id);
        echo json_encode($result);
    }

    public function AddClassTime() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddClassTime($request);
        echo json_encode($result);
    }

    public function UpdateClassTime() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateClassTime($request);
        echo json_encode($result);
    }

    #end Region
    #region Post

    public function Post() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Post ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Post');
    }

    public function GetAllPost() {
        $result = $this->Setting->GetAllPost();
        echo json_encode($result);
    }

    public function DeletePost($id) {
        $result = $this->Setting->DeletePost($id);
        echo json_encode($result);
    }

    public function AddPost() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddPost($request);
        echo json_encode($result);
    }

    public function UpdatePost() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdatePost($request);
        echo json_encode($result);
    }

    #end Region
    #region Semester

    public function Semester() {
		
        $this->checkuserRole(uri_string());
        $data["Title"] = "Semester ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Semester');
    }

    public function GetAllSemester() {
        $result = $this->Setting->GetAllSemester();
        echo json_encode($result);
    }

    public function DeleteSemester($id) {
        $result = $this->Setting->DeleteSemester($id);
        echo json_encode($result);
    }

    public function AddSemester() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddSemester($request);
        echo json_encode($result);
    }

    public function UpdateSemester() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateSemester($request);
        echo json_encode($result);
    }

    #end Region
    #region Role

    public function Role() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Role ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Role');
    }

    public function GetAllRole() {
        $result = $this->Setting->GetAllRole();
        echo json_encode($result);
    }

    public function DeleteRole($id) {
        $result = $this->Setting->DeleteRole($id);
        echo json_encode($result);
    }

    public function AddRole() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddRole($request);
        echo json_encode($result);
    }

    public function UpdateRole() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateRole($request);
        echo json_encode($result);
    }

    #end Region
    #region Subject

    public function Subject() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Subject ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/Subject');
    }

    public function GetAllSubject() {
        $result = $this->Setting->GetAllSubject();
        echo json_encode($result);
    }

    public function DeleteSubject($id) {
        $result = $this->Setting->DeleteSubject($id);
        echo json_encode($result);
    }

    public function AddSubject() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddSubject($request);
        echo json_encode($result);
    }

    public function UpdateSubject() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdateSubject($request);
        echo json_encode($result);
    }

    #end Region
    
      #region Promotion

    public function PromotionList() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Student Promotion ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/StudentPromotion');
    }

    public function GetAllPromotionList() {
        $result = $this->Setting->GetAllPromotionList();
        echo json_encode($result);
    }

    public function DeletePromotionList($id) {
        $result = $this->Setting->DeletePromotionList($id);
        echo json_encode($result);
    }

    public function AddPromotionList() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddPromotionList($request);
        echo json_encode($result);
    }

    public function UpdatePromotionList() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->Setting->UpdatePromotionList($request);
        echo json_encode($result);
    }

    #end Region

      #region Major

    public function MajorListSelect() {
        $this->checkuserRole(uri_string());
        $data["Title"] = "Student Major ";
        $this->load->view('Include/LeftMenuAdmin', $data);
        $this->load->view('Setting/MajorSubjectUpdate');
    }

    public function GetAllMajorList() {
        $result = $this->Setting->GetAllMajorList();
        echo json_encode($result);
    }

    public function DeleteMajorList($id) {
        $result = $this->Setting->DeleteMajorList($id);
        echo json_encode($result);
    }

    public function AddMajorList() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->Setting->AddMajorList($request);
        echo json_encode($result);
    }

    public function UpdateMajorList() {
    
        $request= json_decode(file_get_contents('php://input'));
     

        $result = $this->Setting->UpdateMajorList($request->mobiles,$request->message);
        echo json_encode($result);
    }

    #end Region

}
