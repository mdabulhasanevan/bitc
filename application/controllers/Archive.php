<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of archive
 *
 * @author Evan DU
 */
class archive extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('News_model','m');
         $this->load->model('CommonModel', 'c');
        $_SESSION['visitor'] = $this->c->SetGetVisitor();
    }
    
     public function Ex_Teacher()
    {
        $data=$this->m->NewsAndTitle($Title="Ex Teacher ");
         $this->load->view("Include/Header",$data); 
         $this->load->view("archive/Ex_Teacher"); 
         $this->load->view("Include/Footer"); 
    }
    public function Magazine()
    {
       $data=$this->m->NewsAndTitle($Title="Magazine ");
         $this->load->view("Include/Header",$data); 
         $this->load->view("archive/Magazine"); 
         $this->load->view("Include/Footer"); 
    }
    public function Ex_Students()
    {
        $data=$this->m->NewsAndTitle($Title="Ex Student ");        
     
         $this->load->view("Include/Header",$data); 
         $this->load->view("archive/Ex_Students"); 
         $this->load->view("Include/Footer"); 
    }
}
