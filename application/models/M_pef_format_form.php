<?php
    /* 
    * M_pef_format_form
    * Model for 
    * @author Phatchara Khongthandee and 
    * @Create Date 2564-08-14  
    */
?>

<?php
include_once("Da_pef_format_form.php");

class M_pef_format_form extends Da_pef_format_form
{
    public function get_evaluation_form($promote){
        $sql = "SELECT *
                FROM  pefs_database.pef_format_form AS form
                INNER JOIN pefs_database.pef_item_form AS item
                ON form.for_item_id = item.itm_id
                INNER JOIN pefs_database.pef_description_form AS desform
                ON item.itm_id = desform.des_item_id
                WHERE form.for_pos_id = '$promote'";
        $query = $this->db->query($sql);
        return $query;
    }

}