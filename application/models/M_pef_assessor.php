<!--
    /* 
    * M_pef_assessor
    * Model for 
    * @author Phatchara Khongthandee and Pontakon Mujit 
    * @Create Date 2564-08-14  
    */
-->
<?php
include_once("Da_pef_assessor.php");

class M_pef_assessor extends Da_pef_assessor
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_group_assessor_list($emp_id)
    {
        $sql = "SELECT * FROM pefs_database.pef_assessor AS ass
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON ass.ase_gro_id = grass.gro_ase_id
                    INNER JOIN pefs_database.pef_assessor_promote AS promote
                    ON grass.gro_asp_id =  promote.asp_id
                    INNER JOIN pefs_database.pef_assessor_position AS position
                    ON promote.asp_id = position.gap_asp_id
                WHERE  ass.ase_emp_id = '$emp_id'";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลกลุ่มการประเมินของกรรมการ

    public function get_group_detail($emp_id)
    {
        $sql = "SELECT * FROM pefs_database.pef_assessor AS ass
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON ass.ase_gro_id = grass.gro_ase_id
                    INNER JOIN pefs_database.pef_group AS gr
                    ON grass.gro_grp_id=  gr.grp_id
                    INNER JOIN pefs_database.pef_group_schedule AS schedu
                    ON gr.grp_id = schedu.grd_grp_id
                WHERE  ass.ase_emp_id = '$emp_id'";
        $query = $this->db->query($sql);
        return $query;
    }//คืนค่าข้อมูลรายละเอียดของกลุ่มการประเมินของกรรมการ

}