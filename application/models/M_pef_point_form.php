<?php
/* 
    * M_pef_point_form
    * Model for pef_point_form
    * @author Phatchara Khongthandee and Ponprapai Atsawanurak 
    * @Create Date 2565-03-14  
    */
?>

<?php
include_once("Da_pef_point_form.php");

class M_pef_point_form extends Da_pef_point_form
{

    /*
	* get_point
	* get point form evaluation
	* @input  -
	* @output point form
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak 
	* @Create Date 2565-04-10 
	*/
    function get_point()
    {
        $sql = "SELECT MAX(per_id) AS max_id
        FROM pefs_database.pef_performance_form";

        $query = $this->db->query($sql);
        return $query;
    }

    /* Report
    * get_data_point
    * get data section, point_form, nominee, group
    * @input    -
    * @output   get data section, point_form, nominee, group
    * @author   Chakrit
    * @Create Date 2565-04-11
    */
    public function get_data_point()
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_point_form AS poi
                INNER JOIN pefs_database.pef_performance_form AS pfm
                ON poi.ptf_per_id = pfm.per_id
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON pfm.per_emp_id = grn.grn_emp_id
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN pefs_database.pef_format_form AS pff
                ON poi.ptf_for_id = pff.for_id
 				INNER JOIN pefs_database.pef_description_form AS pdf
                ON pff.for_des_id = pdf.des_item_id
                WHERE sec.sec_id = ?";
        $query = $this->db->query($sql, array($this->sec_id));
        return $query;
    }

    /*
    * get_data_point_only
    * get data point_form, nominee, group
    * @input    id
    * @output   get data point_form, nominee, group
    * @author   Chakrit
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_data_point_only()
    {
        $sql = "SELECT sum(ptf_point*des_weight) AS point,grn_emp_id,sum((ptf_per_id*5)*des_weight) AS sum_total
           FROM pefs_database.pef_point_form AS poi
                INNER JOIN pefs_database.pef_performance_form AS pfm
                ON poi.ptf_per_id = pfm.per_id
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON pfm.per_emp_id = grn.grn_emp_id
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN pefs_database.pef_format_form AS pff
                ON poi.ptf_for_id = pff.for_id
 				INNER JOIN pefs_database.pef_description_form AS pdf
                ON pff.for_des_id = pdf.des_item_id
                WHERE sec.sec_id = ?";
        $query = $this->db->query($sql, array($this->sec_id));
        return $query;
    }//คืนค่าคะแนนโดยกลุ่มไอดี

    public function get_data_point_by_sec_id()
    {
        $sql = "SELECT sum(ptf_point*des_weight) AS point,grn_emp_id,sum(ptf_point*0) AS total
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
                WHERE sec.sec_id = ?
                GROUP BY grn.grn_emp_id";
        $query = $this->db->query($sql, array($this->sec_id));
        return $query;
    } //คืนค่าคะแนนโดยกลุ่มไอดี

    public function get_data_total_score_by_sec_id()
    {
        $sql = "SELECT 5*des_weight AS total,grn_emp_id
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
                WHERE sec.sec_id = ?";
        $query = $this->db->query($sql, array($this->sec_id));
        return $query;
    } 
    /* Report
    * get_data_point_by_nor_id
    * get data point_form, nominee, group, section
    * @input    -
    * @output   get data point_form, nominee, group, section
    * @author   Chakrit
    * @Create Date 2565-04-12
    */
    public function get_data_point_by_nor_id()
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_point_form AS poi
                INNER JOIN pefs_database.pef_performance_form AS pfm
                ON poi.ptf_per_id = pfm.per_id
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON pfm.per_emp_id = grn.grn_emp_id
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN pefs_database.pef_format_form AS pff
                ON poi.ptf_for_id = pff.for_id
 				INNER JOIN pefs_database.pef_description_form AS pdf
                ON pff.for_des_id = pdf.des_item_id
                WHERE grn.grn_id = ?";
        $query = $this->db->query($sql, array($this->grn_id));
        return $query;
    }

    /*
    * get_data_point_by_nor_id_only
    * get data point_form, nominee, group
    * @input    id
    * @output   get data point_form, nominee, group
    * @author   Chakrit
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function get_data_point_by_nor_id_only()
    {
        $sql = "SELECT sum(ptf_point*des_weight) AS point,grn_emp_id,sum((ptf_per_id*5)*des_weight) AS sum_total
           FROM pefs_database.pef_point_form AS poi
                INNER JOIN pefs_database.pef_performance_form AS pfm
                ON poi.ptf_per_id = pfm.per_id
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON pfm.per_emp_id = grn.grn_emp_id
                INNER JOIN pefs_database.pef_group AS grp
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN pefs_database.pef_format_form AS pff
                ON poi.ptf_for_id = pff.for_id
 				INNER JOIN pefs_database.pef_description_form AS pdf
                ON pff.for_des_id = pdf.des_item_id
                WHERE grn.grn_id = ?";
        $query = $this->db->query($sql, array($this->grn_id));
        return $query;
    }//คืนค่าคะแนนโดยกลุ่มไอดี

    public function get_point_by_nor_id()
    {
        $sql = "SELECT sum(ptf_point*des_weight) AS point,grn_emp_id,sum(ptf_point*0) AS total
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
                WHERE grn.grn_id = ?
                GROUP BY grn.grn_emp_id";
        $query = $this->db->query($sql, array($this->grn_id));
        return $query;
    } //คืนค่าคะแนนโดยกลุ่มไอดี

    public function get_data_total_score_by_nor_id()
    {
        $sql = "SELECT 5*des_weight AS total,grn_emp_id
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
                WHERE grn.grn_id = ?";
        $query = $this->db->query($sql, array($this->grn_id));
        return $query;
    } 
    /*
	* get_point_list
	* คืนค่าคะแนนของแต่ละฟอร์ม
	* @input 	$per_id
	* @output 	คืนค่าคะแนนของแต่ละฟอร์ม
	* @author 	Phatchara Khongthandee and Pontakon Mujit 
	* @Create   Date 2565-04-10
	* @Update   Date 2565-04-11
	*/
    function get_point_list($per_id)
    {
        $sql = "SELECT *
            FROM  pefs_database.pef_point_form
            WHERE pef_point_form.ptf_per_id = '$per_id' ";

        $query = $this->db->query($sql);
        return $query;
    }
    /*
	* get_point_list_round_1_assessor
	* คืนค่าคะแนนของแต่ละฟอร์ม
	* @input 	$per_id
	* @output 	คืนค่าคะแนนของแต่ละฟอร์ม
	* @author 	Thitima Popila 
	* @Create   Date 2565-04-15 
	*/
    function get_point_list_round1($per_id)
    {
        $sql = "SELECT ptf_point
            FROM  pefs_database.pef_point_form
            WHERE pef_point_form.ptf_per_id = '$per_id' AND pef_point_form.ptf_round = 1";

        $query = $this->db->query($sql);
        return $query;
    }

    /*
	* get_point_list_round_2_assessor
	* คืนค่าคะแนนของแต่ละฟอร์ม
	* @input 	$per_id
	* @output 	คืนค่าคะแนนของแต่ละฟอร์ม
	* @author 	Thitima Popila 
	* @Create   Date 2565-04-15 
	*/
    function get_point_list_round2($per_id)
    {
        $sql = "SELECT ptf_point
            FROM  pefs_database.pef_point_form
            WHERE pef_point_form.ptf_per_id = '$per_id' AND pef_point_form.ptf_round = 2";

        $query = $this->db->query($sql);
        return $query;
    }

            /*
	* get_point_list_round_2_admin
	* คืนค่าคะแนนของแต่ละฟอร์ม
	* @input 	$per_id
	* @output 	คืนค่าคะแนนของแต่ละฟอร์มแค่รอบ 2 
	* @author 	Pontakon Mujit 
	* @Create   Date 2565-04-15
	* @Update   Date 2565-04-15
	*/
    function get_point_list_round_2_admin($per_id,$nor_id,$id_assessor,$date)
    {
        $sql = "SELECT ptf_point,  ptf_per_id
        FROM  pefs_database.pef_point_form 
        INNER JOIN pefs_database.pef_performance_form as performance
         ON performance.per_id = pef_point_form.ptf_per_id 
        WHERE performance.per_emp_id = '$nor_id' AND performance.per_ase_id = '$id_assessor' AND   pef_point_form.ptf_date ='$date'
        and pef_point_form.ptf_per_id = '$per_id' and
        pef_point_form.ptf_round= '2' ";

        $query = $this->db->query($sql);
        return $query;
    }
}
