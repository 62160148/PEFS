<?php
    /* 
    * M_pef_item_form
    * Model for 
    * @author  
    * @Create Date  
    */
?>

<?php
include_once("Da_pef_item_form.php");

class M_pef_item_form extends Da_pef_item_form
{
    /*
	* get_item_form_by_id
	* get 
	* @input  -
	* @output -
	* @author  
	* @Create Date  
    */
    public function get_item_form_by_id()
    {
        $sql = "SELECT * FROM dbmc.position AS pos
        INNER JOIN pefs_database.pef_item_form AS itm
        ON pos.Position_ID = itm.itm_promote
        WHERE  pos.Position_ID = ?
        AND  itm.itm_year =?";
        $query = $this->db->query($sql, array($this->pos_id,$this->pos_year));
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของหัวข้อ
    

}