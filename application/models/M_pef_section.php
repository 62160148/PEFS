<?php
/*
    * M_pef_section
    * Model for pef_section
    * @author Pontakon M.
    * @Create Date 2565-04-08
*/
?>

<?php
include_once("Da_pef_section.php");

class M_pef_section extends Da_pef_section
{
        /*
	* get_all_section 
	* get_all_section
	* @input  -
	* @output section detail
	* @author Pontakon M.
	* @Create date 2565-04-08
    */
    public function get_all_section()
    {
        $sql = "SELECT * FROM pefs_database.pef_section ";
        $query = $this->db->query($sql);
        return $query;
    }  

    /*
	* get_position_by_section 
	* get_position_with_find_in_section
	* @input  -
	* @output position detail
	* @author Pontakon M.
	* @Create date 2565-04-08
    */
    public function get_position_by_section()
    {
        $sql = "SELECT * 
        FROM dbmc.position AS pos
        WHERE pos.position_level_id=?";
        $query = $this->db->query($sql, array($this->position_level_id));
        return $query;
    }

    /* Reprot
    * get_ass_by_sec_id
    * get data section, assessor, employee
    * @input    -
    * @output   get data section, assessor, employee
    * @author   Chakrit
    * @Create Date 2565-04-11
    */
    public function get_ass_by_sec_id()
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_section AS sec
                INNER JOIN pefs_database.pef_assessor AS ass
                ON ass.ase_sec_id = sec.sec_level
                INNER JOIN dbmc.employee AS emp
                ON emp.Emp_ID = ass.ase_emp_id
                WHERE sec.sec_id = ?";
        $query = $this->db->query($sql, array($this->sec_id));
        return $query;
    }

    /* Report
    * get_ass_by_nor_id
    * get data section, assessor, employee, group, nominee
    * @input    -
    * @output   get data section, assessor, employee, group, nominee
    * @author   Chakrit
    * @Create Date 2565-04-11
    */
    public function get_ass_by_nor_id()
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_section AS sec
                INNER JOIN pefs_database.pef_assessor AS ass
                ON ass.ase_sec_id = sec.sec_level
                INNER JOIN dbmc.employee AS emp
                ON emp.Emp_ID = ass.ase_emp_id
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_position_group = sec.sec_level
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON grn.grn_grp_id = grp.grp_id
                WHERE grn.grn_id = ?";
        $query = $this->db->query($sql, array($this->grn_id));
        return $query;
    }
}
