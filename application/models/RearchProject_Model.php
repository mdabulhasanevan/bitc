<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RearchProject_Model
 *
 * @author Evan DU
 */
class RearchProject_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
       public function GetAllRearchProjects()
    {
       $this->db->order_by('RId', 'DESC');
       $query=$this->db->get("researchproject");
         $rows = $query->result();
        return $rows;
    }
       public function AddResearch($data2)
    {
      $result= $this->db->insert('researchproject', $data2);
        //$sql = $this->db->set($data)->get_compiled_insert('researchproject');
        return $sql;
    }
    
     public function DeleteResearch($Id)
    {
       $m= $this->db->delete('researchproject', array('RId' => $Id)); 
      
        return m;
    }
    
}
