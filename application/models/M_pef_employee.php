<?php
/*
	* M_pef_group.php
    * M_pef_group group data
    * @Jirayut Saifah
    * @Create Date 2564-08-13
*/
defined('BASEPATH') or exit('No direct script access allowed');

include_once("Da_pef_employee.php");


class M_pef_employee extends Da_pef_employee
{ //class M_ttp_login

    public function __construct()
    {
        parent::__construct();
    } //function construct

    /*
* get_assessor
* get assessor detail from database
* @input sec_level
* @output assessor detail 
* @author Jirayut Saifah
* @Create Date 2564-08-25
*/
    function get_assessor()
    { //check User_login and Pass_login in database
        $sql =
            "SELECT *
			FROM pefs_database.pef_assessor AS ass 
            INNER JOIN dbmc.employee AS emp
            ON ass.ase_emp_id=emp.Emp_ID
            INNER JOIN dbmc.sectioncode AS sec
            ON emp.Sectioncode_ID=sec.Sectioncode
            INNER JOIN pefs_database.pef_section AS section
            ON ass.position_level=section.sec_id
			WHERE section.sec_id=?";
        $query = $this->db->query($sql, array($this->position_level));
        return $query;
    } //end  get_group
    /*
* get_section
* get section detail from database
* @input 
* @output section detail 
* @author Jirayut Saifah
* @Create Date 2564-08-25
*/
    function get_section()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_section
			";
        $query = $this->db->query($sql);
        return $query;
    } //end get_section
    /*
* get_name_emp
* get employee detail from database
* @input Emp_ID
* @output employee detail
* @author Jirayut Saifah
* @Create Date 2564-08-25
*/
    public function get_name_emp()
    {
        $sql =
            "SELECT *
        FROM dbmc.employee AS emp INNER JOIN dbmc.sectioncode AS sec
        ON emp.Sectioncode_ID=sec.Sectioncode
        INNER JOIN dbmc.position AS pos
        ON emp.Position_ID=pos.Position_ID
        WHERE Emp_ID = ? ";
        $query = $this->db->query($sql, array($this->Emp_ID));
        return $query;
    }
    /*
* get_section_by_emp
* get section detail from database
* @input Position_Level
* @output section detail
* @author Jirayut Saifah
* @Create Date 2564-08-25
*/
    public function get_section_by_emp()
    {
        $sql =
            "SELECT *
        FROM dbmc.sectioncode WHERE Position_Level=?
       ";
        $query = $this->db->query($sql, array($this->Position_Level));
        return $query;
    }


    /*
* get_emp_detail
* get emp detail in database
* @input  -
* @output - 
* @author Jirayut Saifah
* @Create Date 2564-07-29
*/
    public function get_emp_detail($id)
    {
        $sql =
            "SELECT *
        FROM dbmc.employee  AS emp INNER JOIN dbmc.company AS com
        WHERE Emp_ID = $id AND emp.Company_ID=com.Company_ID";
        $query = $this->db->query(
            $sql,
            array()
        );
        return $query;
    }

    /*
* get_emp
* get Emp_ID in database
* @input  -
* @output - 
* @author Niphat Kuhokciw
* @Create Date 2564-07-28
*/
    public function get_emp()
    { //get Emp_ID
        $sql = "SELECT * 
            FROM dbmc.employee AS emp
            INNER JOIN dbmc.group_secname AS gsec 
            ON gsec.Sectioncode = emp.Sectioncode_ID
            INNER JOIN dbmc.position AS pos
            ON pos.Position_ID = emp.Position_ID
            INNER JOIN dbmc.sectioncode AS sec
            ON sec.Sectioncode = emp.Sectioncode_ID
            INNER JOIN pefs_database.user_login AS ulog
            ON emp.Emp_ID = ulog.Enp_ID
            WHERE emp.Emp_ID=?";
        $query = $this->db->query($sql, array($this->Emp_ID));
        return $query;
    } //end get_emp
    /*
* get_position
* get section detail from database
* @input Position_Level
* @output section detail
* @author Jirayut Saifah
* @Create Date 2564-08-25
*/
    public function get_position()
    {
        $sql =
        "SELECT *
                FROM pefs_database.pef_assessor_promote AS pro
                INNER JOIN pefs_database.pef_assessor_position AS position
                ON pro.asp_id = position.gap_asp_id
                INNER JOIN dbmc.position AS pos
                ON position.gap_promote = pos.Position_ID
                WHERE pro.asp_level=?
       ";
        $query = $this->db->query($sql, array($this->asp_level));
        // $query = $this->db->query($sql, array());
        return $query;
    }
    public function get_group_level()
    {
        $sql =
            "SELECT *
                FROM pefs_database.pef_assessor_promote 
       ";
        $query = $this->db->query($sql, array());
        // $query = $this->db->query($sql, array());
        return $query;
    }
    public function get_position_id()
    {
        $sql =
            "SELECT *
                FROM dbmc.position WHERE Position_name=?
       ";
        $query = $this->db->query($sql, array($this->Position_name));
        // $query = $this->db->query($sql, array());
        return $query;
    }
    public function get_position_name()
    {
        $sql =
            "SELECT *
                FROM dbmc.position WHERE Position_ID=?
       ";
        $query = $this->db->query($sql, array($this->Position_ID));
        // $query = $this->db->query($sql, array());
        return $query;
    }
    public function get_assessor_by_year()
    {
        $sql =
            "SELECT *
        FROM pefs_database.pef_assessor WHERE ase_year=?
       ";
        $query = $this->db->query($sql, array($this->ase_year));
        return $query;
    }
    function get_asp_id()
    {

        $sql =
            "SELECT gro_asp_id
             FROM pefs_database.pef_group_assessor 
             WHERE gro_grp_id=?
       ";
        $query = $this->db->query($sql, array($this->gro_grp_id));
        return $query;
    }
}//end class M_pef_group 