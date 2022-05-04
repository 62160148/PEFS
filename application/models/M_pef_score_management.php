<?php
    /* 
    * M_pef_score_management
    * Model for pef_score_management
    * @author Jaraspon Seallo and Nipat Kuhoksiw
    * @Create Date 2565-03-04
    * @Update Date 2565-04-17
    */
?>

<?php
include_once("Da_pef_score_management.php");

class M_pef_score_management extends Da_pef_score_management
{//class M_pef_score_management

    /*
    * get_score_management_list
    * get score_management list
    * @input    -
    * @output   -
    * @author Jaraspon Seallo
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_score_management_list()
    {
        $sql = "SELECT * FROM pefs_database.pef_group AS gro
                    INNER JOIN pefs_database.pef_group_assessor AS gss
                    ON gss.gro_grp_id = gro.grp_id
                    INNER JOIN pefs_database.pef_assessor_promote AS promote
                    ON gss.gro_asp_id =  promote.asp_level
                    INNER JOIN pefs_database.pef_assessor_position AS position
                    ON promote.asp_id = position.gap_asp_id
                    INNER JOIN dbmc.position AS pos
                    ON position.gap_promote = pos.Position_ID
                    GROUP BY gro.grp_id
                ";
                
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลกลุ่มการประเมินของกรรมการ

    /*
    * get_score_management_list_date
    * get score management list_date
    * @input    -
    * @output   -
    * @author Jaraspon Seallo
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_score_management_list_date()
    {
        $sql = "SELECT *
        FROM pefs_database.pef_group AS grp 
        INNER JOIN pefs_database.pef_group_schedule AS sec
        ON grp.grp_id = sec.grd_grp_id
        ";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลวันที่กลุ่มการประเมินของกรรมการ

    /*
    * get_evaluation
    * get data for summary in performance form
    * @input    id
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_evaluation($id)
    {
        $sql = "SELECT *
			FROM pefs_database.pef_performance_form
			WHERE per_emp_id=$id
			";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าการประเมิน

    /*
    * get_group
    * get data for summary in gruop, section
    * @input    -
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_group()
    {
        $sql = "SELECT *
			FROM pefs_database.pef_group AS grp 
            INNER JOIN pefs_database.pef_section AS sec
            ON grp.grp_position_group = sec.sec_id
			WHERE grp_date = ?";
        $query = $this->db->query($sql, array($this->grp_date));
        return $query;
    }//คืนค่ากลุ่มการประเมิน

    /*
    * get_group_by_id
    * get data for summary in group, section
    * @input    id
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_group_by_id($id)
    {
        $sql = "SELECT * FROM pefs_database.pef_group AS gro
        INNER JOIN pefs_database.pef_group_assessor AS gss
        ON gss.gro_grp_id = gro.grp_id
        INNER JOIN pefs_database.pef_assessor_promote AS promote
        ON gss.gro_asp_id =  promote.asp_level
        INNER JOIN pefs_database.pef_assessor_position AS position
        ON promote.asp_id = position.gap_asp_id
        INNER JOIN dbmc.position AS pos
        ON position.gap_promote = pos.Position_ID
			WHERE grp_id=$id
			";
    $query = $this->db->query($sql);
    return $query;
    }//คืนค่ากลุ่มโดยไอดี

    /*
    * get_assessor
    * get data for summary in assessor
    * @input    id
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_assessor($id)
    {
        $sql = "SELECT *
			FROM pefs_database.pef_group_assessor 
			WHERE gro_grp_id=$id
			";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่ากรรมการ

    /*
    * get_nominee
    * get data for summary in group_nominee, employee
    * @input    id
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_nominee($id)
    {
        $sql = "SELECT *
			FROM pefs_database.pef_group_nominee AS nom
            INNER JOIN dbmc.employee AS emp
            ON nom.grn_emp_id=emp.Emp_ID
			WHERE nom.grn_grp_id=$id
			";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าผู้ถูกประเมิน

    /*
    * get_nominee_by_id
    * get data for summary in group_nominee, performance_form
    * @input    id
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_nominee_by_id($id)
    {
        $sql = "SELECT *
			FROM pefs_database.pef_group_nominee AS nom 
            INNER JOIN pefs_database.pef_performance_form AS per
            ON nom.grn_emp_id=per.per_emp_id
           
			WHERE grn_emp_id=$id
			";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าผู้ถูกประเมินโดยไอดี

    /*
    * get_form
    * get data for summary in group_nominee, performance_form
    * @input    id
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    function get_form($id)
    {
        $sql = "SELECT *
			FROM pefs_database.pef_group_nominee AS nom 
            INNER JOIN pefs_database.pef_performance_form AS per
            ON nom.grn_emp_id=per.per_emp_id
			WHERE grn_grp_id=$id
			";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าแบบฟอร์ม

    /*
    * get_ass_by_grp_id
    * get data assessor, group, nominee
    * @input    id
    * @output   get data assessor, group, nominee
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_ass_by_grp_id($id)
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_assessor AS ass
                INNER JOIN pefs_database.pef_group_assessor AS gro
                ON ass.ase_id = gro.gro_ase_id 
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_id = gro.gro_grp_id
                WHERE grp.grp_id = $id";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่ากลุ่มการประเมินของกรรมการโดยไอดี

    /*
    * get_data_point_by_nor_id
    * get data point_form, nominee, group
    * @input    id
    * @output   get data point_form, nominee, group
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_data_point_by_grp_id($id)
    {
        $sql = "SELECT sum(ptf_point*des_weight) AS point,grn_emp_id,sum((ptf_per_id*5)*des_weight) AS sum_total
                FROM pefs_database.pef_point_form AS poi
                INNER JOIN pefs_database.pef_performance_form AS pfm
                ON poi.ptf_per_id = pfm.per_id
                INNER JOIN pefs_database.pef_format_form AS pff
                ON poi.ptf_for_id = pff.for_id
 				INNER JOIN pefs_database.pef_description_form AS pdf
                ON pff.for_des_id = pdf.des_item_id
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON pfm.per_emp_id = grn.grn_emp_id
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                WHERE grp.grp_id = $id
                GROUP BY grn.grn_emp_id";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าคะแนนโดยกลุ่มไอดี

    /*
    * get_data_by_id
    * get data by id
    * @input    id
    * @output   get data point_form, nominee, group
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_data_by_id($id)
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_group AS grp
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_id = grp.grp_position_group
                INNER JOIN dbmc.employee AS emp
                ON emp.Emp_ID = grn.grn_emp_id
                INNER JOIN dbmc.position AS pos
                ON pos.Position_ID = emp.Position_ID
                INNER JOIN dbmc.sectioncode AS scode
                ON emp.Sectioncode_ID = scode.Sectioncode
                INNER JOIN dbmc.company AS com
                ON emp.Company_ID = com.Company_ID
                WHERE sec.sec_id = $id";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลโดยไอดี

}//end class M_pef_score_management