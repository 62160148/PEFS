<?php
    /*
    * Da_pef_score_management
    * Model for
    * @author Jaraspon Seallo and Nipat Kuhoksiw
    * @Create Date 2565-03-04
    */
?>

<?php
include_once("pefs_model.php");



class Da_pef_score_management extends pefs_model
{//class Da_pef_score_management

    function construct()
    {//construct
        parent::__construct();
    }//end construct

    /*
    * update_grn_status
    * update data for summary
    * @input    -
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function update_grn_status()
    {//update_grn_status
        $sql = " UPDATE pefs_database.pef_group as up
        SET up.grp_date = ? , up.grp_status = ? 
        WHERE up.grp_id = ? ";
        $this->db->query($sql, array($this->grp_date, $this->grp_status, $this->grp_id));
    }//end update_grn_status

    /*
    * update_nom_stat
    * update data for summary
    * @input    -
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function update_nom_stat()
    {//update_nom_stat
        $sql = " UPDATE pefs_database.pef_group_nominee as nom
        SET nom.grn_status = ? 
        WHERE nom.grn_grp_id = ? ";
        $this->db->query($sql, array($this->grn_status, $this->grn_grp_id));
    }//end update_nom_stat

    /*
    * update_pass
    * update data for summary
    * @input    -
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function update_pass()
    {//update_pass
        $sql = " UPDATE pefs_database.pef_group_nominee as nom
        SET nom.grn_status = ? 
        WHERE nom.grn_grp_id = ? AND nom.grn_emp_id=?";
        $this->db->query($sql, array($this->grn_status, $this->grn_grp_id, $this->grn_emp_id));
    }//end update_pass

    /*
    * update_pass
    * update data for summary
    * @input    -
    * @output   -
    * @author   Niphat Kuhoksiw
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */
    public function update_status_edit()
    {//update_grn_status
        $sql = " UPDATE pefs_database.pef_group as up
        SET  up.grp_status_edit = ? 
        WHERE up.grp_id = ? ";
        $this->db->query($sql, array($this->grp_status_edit, $this->grp_id));
    }//end update_grn_status
}//end class Da_pef_score_management