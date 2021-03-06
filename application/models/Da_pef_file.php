<?php
/*
	* Da_pef_file_present.php
    * add file present nominee
    * @Author : Ponprapai and Thitima
    * @Create Date : 2564-08-13
    * @Update Date : 2564-08-14 
*/
defined('BASEPATH') or exit('No direct script access allowed');

include_once('pefs_model.php');

class Da_pef_file extends pefs_model
{ //class Da_pef_addfile


    public function __construct()
    {
        parent::__construct();
    }

    /*
	* insert_file
	* insert file location, Employee id in database
	* @input    fil_name and Emp_ID
	* @output   fil_id
	* @author   Ponprapai and Thitima
	* @Create Date 2564-08-13
	*/
    function insert_file()
    {
        $sql = "INSERT INTO pefs_database.pef_file(fil_location,fil_emp_id,fil_year) 
        VALUES (?,?,?)";

        $this->db->query($sql, array($this->fil_location, $this->fil_emp_id, $this->fil_year));
    }

    /*
	* update_file
	* update file location
	* @input    fil_name and Emp_ID
	* @output   New fil_name and Emp_ID
	* @author   Ponprapai and Thitima
	* @Create Date 2564-08-14 
	*/
    function update_file()
    {
        $sql = "UPDATE pefs_database.pef_file
        SET fil_location= ?
        WHERE fil_emp_id = ?";

        $this->db->query($sql, array($this->fil_location, $this->fil_emp_id));
    }
}//end class Da_pef_addfile