<?php
/* 
    * M_pef_group_nominee
    * Model for pef_group_nominee
    * @author Phatchara Khongthandee and Ponprapai Atsawanurak
    * @Create Date 2565-03-04
    */
?>

<?php
include_once("Da_pef_group_nominee.php");

class M_pef_group_nominee extends Da_pef_group_nominee
{
    /*
	* get_nominee_detail
	* get data Nominee detail from database
	* @input  group_id
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-03
    */
    public function get_nominee_detail($ass_id, $group_id)
    {
        $sql = "SELECT *
                    FROM pefs_database.pef_group_nominee AS groupno
                    INNER JOIN pefs_database.pef_group AS gr
                    ON groupno.grn_grp_id = gr.grp_id
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON gr.grp_id = grass.gro_grp_id
                    INNER JOIN pefs_database.pef_assessor AS ass
                    ON grass.gro_ase_id = ass.ase_id
                    INNER JOIN pefs_database.pef_assessor_promote AS promote
                    ON grass.gro_asp_id = promote.asp_level
                    INNER JOIN dbmc.employee
                    ON groupno.grn_emp_id = employee.Emp_ID
                    INNER JOIN dbmc.position AS position
                    ON groupno.grn_promote_to = position.Position_ID 
                WHERE gr.grp_id = $group_id AND ass.ase_emp_id = $ass_id
                GROUP BY groupno.grn_emp_id";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของ Nominee

    /*
	* get_nominee_detail_by_id
	* get data Nominee detail from database
	* @input  group_id
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-03
    */
    public function get_nominee_detail_by_id($id_assessor, $group_id)
    {
        $sql = "SELECT *
                    FROM pefs_database.pef_group_nominee AS groupno
                    INNER JOIN pefs_database.pef_group AS gr
                    ON groupno.grn_grp_id = gr.grp_id
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON gr.grp_id = grass.gro_grp_id
                    INNER JOIN pefs_database.pef_assessor AS ass
                    ON grass.gro_ase_id = ass.ase_id
                    INNER JOIN pefs_database.pef_assessor_promote AS promote
                    ON grass.gro_asp_id = promote.asp_level
                    INNER JOIN dbmc.employee
                    ON groupno.grn_emp_id = employee.Emp_ID
                    INNER JOIN dbmc.position AS position
                    ON groupno.grn_promote_to = position.Position_ID 
                WHERE gr.grp_id = $group_id AND ass.ase_id = $id_assessor
                GROUP BY groupno.grn_emp_id";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของ Nominee

    /*
	* get_nominee_by_id
	* get data Nominee from database
	* @input  id_nominee
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-03
    */
    public function get_nominee_by_id($id_nominee)
    {
        $sql = "SELECT *
                    FROM pefs_database.pef_group_nominee AS groupno
                    INNER JOIN dbmc.employee
                    ON groupno.grn_emp_id = employee.Emp_ID 
                    INNER JOIN dbmc.position 
                    ON position.Position_ID = employee.Position_ID 
                    INNER JOIN dbmc.sectioncode 
                    ON sectioncode.Sectioncode = employee.Sectioncode_ID
                    INNER JOIN dbmc.company
                    ON employee.Company_ID = company.Company_ID
                    INNER JOIN dbmc.sectioncode AS section
                    ON section.Sectioncode = employee.Sectioncode_ID
                WHERE Emp_ID = groupno.grn_emp_id AND groupno.grn_id = $id_nominee";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_nominee()
    {
        $sql = "SELECT *
                    FROM pefs_database.pef_group_nominee AS groupno
                    INNER JOIN dbmc.employee
                    ON groupno.grn_emp_id = employee.Emp_ID 
                    INNER JOIN dbmc.position 
                    ON position.Position_ID = employee.Position_ID 
                    INNER JOIN dbmc.sectioncode 
                    ON sectioncode.Sectioncode = employee.Sectioncode_ID
                    INNER JOIN dbmc.company
                    ON employee.Company_ID = company.Company_ID
                    INNER JOIN dbmc.sectioncode AS section
                    ON section.Sectioncode = employee.Sectioncode_ID";
        $query = $this->db->query($sql);
        return $query;
    }

    /*
	* get_promote_to
	* get 
	* @input  -
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-04
    */
    public function get_promote_to($id_nominee)
    {
        $sql = "SELECT *
                    FROM pefs_database.pef_group_nominee AS groupno
                    INNER JOIN dbmc.position AS position
                    ON groupno.grn_promote_to = position.Position_ID 
                WHERE groupno.grn_id = $id_nominee";

        $query = $this->db->query($sql);
        return $query;
    }

    /* Report
    * get_all_nominee
    * get data norminee
    * @input    -
    * @output   data of norminee
    * @author   Chakrit
    * @Create Date 2564-08-16
    */
    public function get_all_nominee()
    {
        $sql = "SELECT *
                FROM pefs_database.pef_group_nominee";
        $query = $this->db->query($sql);
        return $query;
    }

    /*
	* get_nominee_detail
	* get 
	* @input  -
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-03
    */
    public function get_nominee_date($group_id)
    {
        $sql = "SELECT gr.grp_date
                    FROM pefs_database.pef_group_nominee AS groupno
                    INNER JOIN pefs_database.pef_group AS gr
                    ON groupno.grn_grp_id = gr.grp_id
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON gr.grp_id = grass.gro_grp_id
                    INNER JOIN pefs_database.pef_assessor AS ass
                    ON grass.gro_ase_id = ass.ase_id
                WHERE gr.grp_id = $group_id";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของ Nominee

    

        /*
	* get_nominee_detail_admin 
	* get nominee_detail of use in result admin 
	* @input  group_id 
	* @output nominee_detail
	* @author Pontakon M.
	* @Create date 2565-04-15
    */
    public function get_nominee_detail_admin($group_id)
    {
        $sql = "SELECT grn_id
        ,grn_promote_to
        ,Emp_ID
        ,Empname_engTitle
        ,Empname_eng
        ,Empsurname_eng
 
        ,grp_position_group
        ,grp_id
        ,grn_status_done
 
        FROM pefs_database.pef_group_nominee AS groupno
        INNER JOIN pefs_database.pef_group AS gr
        ON groupno.grn_grp_id = gr.grp_id
 
        INNER JOIN dbmc.employee
        ON groupno.grn_emp_id = employee.Emp_ID
 
        WHERE gr.grp_id =  $group_id
                        
        GROUP BY groupno.grn_emp_id";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของ Nominee

    
    /*
	* get_nominee_by_employee_id
	* get nominee_detail of use in result admin but find with id_employee
	* @input  id_employee
	* @output nominee_detail
	* @author Pontakon M.
	* @Create date 2565-04-15
    */
    public function get_nominee_by_employee_id($id_employee)
    {
        $sql = "SELECT *
        FROM pefs_database.pef_group_nominee AS groupno
        INNER JOIN dbmc.employee
        ON groupno.grn_emp_id = employee.Emp_ID 
        INNER JOIN dbmc.position 
        ON position.Position_ID = employee.Position_ID 
        INNER JOIN dbmc.sectioncode 
        ON sectioncode.Sectioncode = employee.Sectioncode_ID
        INNER JOIN dbmc.company
        ON employee.Company_ID = company.Company_ID
        INNER JOIN dbmc.sectioncode AS section
        ON section.Sectioncode = employee.Sectioncode_ID
        WHERE employee.Emp_ID = $id_employee";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลรายละเอียดของ Nominee


    /*
	* get_promote_to_by_nominee_and_group_id
	* get nominee_promote of use in result admin  
	* @input  id_nominee,id_group
	* @output get nominee_promote
	* @author Pontakon M.
	* @Create date 2565-04-15
    */
    public function get_promote_to_by_nominee_and_group_id($id_nominee,$id_group)
    {
        $sql = "SELECT grn_promote_to
        FROM pefs_database.pef_group_nominee AS  gro
        WHERE gro.grn_emp_id = $id_nominee and gro.grn_grp_id=$id_group";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลรายละเอียดของตำแหน่งที่ต้องการประเมิน

}