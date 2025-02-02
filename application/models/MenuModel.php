<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuModel
 *
 * @author Evan DU
 */
class MenuModel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    #region AdminMenu
    public function GetAllAdminMenu() {
        $result = $this->db->query("SELECT asub.*,  rt.Role as RollName, IF(asub.isHide>0, 'Yes','No') as isHideStatus, IF(asub.isForSuper>0, 'Yes','No') as isForSuperStatus FROM adminmenu asub  join role_tbl rt on rt.Id=asub.Role order by asub.Sort asc")->result();
        //$result = $this->db->get("adminmenu")->result();
        return $result;
    }

    public function DeleteAdminMenu($id) {
        $result = $this->db->delete("adminmenu", array('ID' => $id));
        return $result;
    }

    public function AddAdminMenu($AdminMenu) {
        $result = $this->db->insert("adminmenu", $AdminMenu);
        return $result;
    }

    public function UpdateAdminMenu($AdminMenu) {
        $data = array(
            "MenuName" => $AdminMenu->MenuName,
            "Url" => $AdminMenu->Url,
            "Icon" => $AdminMenu->Icon,
            "Sort" => $AdminMenu->Sort,
            "isHide" => $AdminMenu->isHide,
            "Role" => $AdminMenu->Role,
            "isForSuper" => $AdminMenu->isForSuper
        );
        $this->db->where(array('ID' => $AdminMenu->ID));
        $result = $this->db->update("adminmenu", $data);
        return $result;
    }

    #end region
    #
    #region AdminSubMenu
    public function GetAllAdminSubMenu() {
        $result = $this->db->query("SELECT asub.*, ad.MenuName as MainMenu, rt.Role as RollName, IF(asub.isHide>0, 'Yes','No') as isHideStatus, IF(asub.isForSuper>0, 'Yes','No') as isForSuperStatus FROM adminsubmenu1 asub join adminmenu ad on ad.ID=asub.MainMenuID join role_tbl rt on rt.Id=asub.Role")->result();
        //$result = $this->db->get("adminsubmenu1")->result();
        return $result;
    }

    public function GetAllMainMenu() {
        $result = $this->db->get("adminmenu")->result();
        return $result;
    }

    public function DeleteAdminSubMenu($id) {
        $result = $this->db->delete("adminsubmenu1", array('ID' => $id));
        return $result;
    }

    public function AddAdminSubMenu($AdminSubMenu) {
        $result = $this->db->insert("adminsubmenu1", $AdminSubMenu);
        return $result;
    }

    public function UpdateAdminSubMenu($AdminSubMenu) {
        $data = array(
            "MenuName" => $AdminSubMenu->MenuName,
            "Url" => $AdminSubMenu->Url,
            "Icon" => $AdminSubMenu->Icon,
            "Sort" => $AdminSubMenu->Sort,
            "isHide" => $AdminSubMenu->isHide,
            "Role" => $AdminSubMenu->Role,
            "isForSuper" => $AdminSubMenu->isForSuper,
            "MainMenuID" => $AdminSubMenu->MainMenuID
        );
        $this->db->where(array('ID' => $AdminSubMenu->ID));
        $result = $this->db->update("adminsubmenu1", $data);
        return $result;
    }

    #end region
}
