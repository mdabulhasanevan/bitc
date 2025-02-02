<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of academic
 *
 * @author Evan DU
 */
class academic extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('News_model', 'm');
        $this->load->model('User_Model', 'user');

        $this->load->model('CommonModel', 'c');
        $_SESSION['visitor'] = $this->c->SetGetVisitor();
    }

    public function teacher() {
        $data = $this->m->NewsAndTitle($Title = "Teacher's List ");
        $data['Teacher'] = $this->user->GetTeacherUser();

        $this->load->view("Include/Header", $data);
        $this->load->view("academic/teacher");
        $this->load->view("Include/Footer");
    }

    public function student() {
        $data = $this->m->NewsAndTitle($Title = "Student ");
        $this->load->view("Include/Header", $data);
        $this->load->view("academic/student_info");
        $this->load->view("Include/Footer");
    }

    public function holidays() {
        $data = $this->m->NewsAndTitle($Title = "Holidays ");
        $this->load->view("Include/Header", $data);
        $this->load->view("academic/holidays_calender");
        $this->load->view("Include/Footer");
    }

    public function academic() {
        $data = $this->m->NewsAndTitle($Title = "Academic ");
        $this->load->view("Include/Header", $data);
        $this->load->view("academic/academic_calender");
        $this->load->view("Include/Footer");
    }

    public function rules_regulation() {
        $data = $this->m->NewsAndTitle($Title = "Rules and Regulations ");
        $this->load->view("Include/Header", $data);
        $this->load->view("academic/rules_regulations");
        $this->load->view("Include/Footer");
    }

    public function class_routine() {
        $data = $this->m->NewsAndTitle($Title = "Class Routine ");

        $this->load->view("Include/Header", $data);
        $this->load->view("academic/class_routine");
        $this->load->view("Include/Footer");
    }

    public function staff() {
        
        $data = $this->m->NewsAndTitle($Title = "All Staffs ");
        $data['staff'] = $this->user->GetStaffUser();

        
        $this->load->view("Include/Header", $data);
        $this->load->view("academic/office_staff");
        $this->load->view("Include/Footer");
    }
    
     public function syllabus() {
        $data = $this->m->NewsAndTitle($Title = "All Syllabus ");

        $this->load->view("Include/Header", $data);
        $this->load->view("academic/syllabus");
        $this->load->view("Include/Footer");
    }
}
