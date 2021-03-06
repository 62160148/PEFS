<?php
/* 
    * M_pef_assessor
    * Model for pef_assessor
    * @author Phatchara Khongthandee and Ponprapai Atsawanurak
    * @Create Date 2565-03-04
    */
?>

<?php
include_once("Da_pef_group.php");

class M_pef_group extends Da_pef_group
{
    /*
	* get_group_evaluation
	* get data group evaluation from database
	* @input  ass_id
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-03
    */
    public function get_group_evaluation($ass_id)
    {
        $sql = "SELECT gr_schedule.grd_date, gr_schedule.grd_round, gr_schedule.grd_grp_id, promote.asp_name, 
        gr.grp_position_group, promote.asp_type,gr.grp_id, gr.grp_status, ass.ase_emp_id, gr.grp_id, gr.grp_date
                    FROM pefs_database.pef_group AS gr
                    INNER JOIN pefs_database.pef_group_schedule AS gr_schedule
                    ON gr.grp_id = gr_schedule.grd_grp_id
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON gr.grp_id = grass.gro_grp_id
                    INNER JOIN pefs_database.pef_assessor AS ass
                    ON grass.gro_ase_id = ass.ase_id
                    INNER JOIN pefs_database.pef_assessor_promote AS promote
                    ON grass.gro_asp_id = promote.asp_level
                    WHERE ass.ase_emp_id = '$ass_id'";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของกลุ่มการประเมิน

    /*
	* get_group_date_round
	* get date evaluation 
	* @input  group_id
	* @output -
	* @author Phatchara Khongthandee and Ponprapai Atsawanurak
	* @Create Date 2565-03-03
    */
    public function get_group_date_round($group_id)
    {
        $sql = "SELECT gr_schedule.grd_date
                    FROM pefs_database.pef_group AS gr
                    INNER JOIN pefs_database.pef_group_schedule AS gr_schedule
                    ON gr.grp_id = gr_schedule.grd_grp_id
                    WHERE  gr.grp_id = '$group_id'";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลวันประเมินของแต่กลุ่มการประเมิน

    function get_group_id()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_group 
			ORDER BY pefs_database.pef_group.grp_id DESC LIMIT 1 
			";
        $query = $this->db->query($sql);
        return $query;
    } //end  
    function get_group_detail()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_group AS grp
            INNER JOIN pefs_database.pef_group_schedule AS sch
             ON grp.grp_id = sch.grd_grp_id
			WHERE grp.grp_id=? 
			";
        $query = $this->db->query($sql, array($this->grp_id));
        return $query;
    } //end  

    function get_group()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_group AS grp
            INNER JOIN pefs_database.pef_section AS sec
            ON grp.grp_position_group = sec.sec_level
            GROUP BY grp.grp_id
			";
        $query = $this->db->query($sql);
        return $query;
    } //end  
    function get_group_by_year()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_group AS grp
            INNER JOIN pefs_database.pef_section AS sec
            ON grp.grp_position_group = sec.sec_level
            WHERE grp.grp_year=?
			";
        $query = $this->db->query($sql, array($this->grp_year));
        return $query;
    } //end  

    /* Report
    * get_year
    * get data group in year
    * @input    -
    * @output   data group in year
    * @author   Chakrit
    * @Create Date 2565-04-10
    */
    public function get_year()
    {
        $sql = "SELECT *
                FROM pefs_database.pef_group
                GROUP BY YEAR(grp_date) ";
        $query = $this->db->query($sql);
        return $query;
    }

    /* Report
    * get_data_year
    * get data section, group, nominee, position in year
    * @input    -
    * @output   get data section, group, nominee, position in year
    * @author   Chakrit
    * @Create Date 2565-04-10
    */
    public function get_data_year($year)
    {
        $sql = "SELECT *
                FROM pefs_database.pef_group AS grp
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN dbmc.position AS pos
                ON pos.Position_ID = grn.grn_promote_to
                WHERE YEAR(grp_date) = $year 
                ORDER BY sec.sec_id";
        $query = $this->db->query($sql);
        return $query;
    }

    /* Report
    * get_data_by_id
    * get data section, group, nominee, position, employee, scetion_code, company
    * @input    -
    * @output   get data section, group, nominee, position, employee, scetion_code, company
    * @author   Chakrit
    * @Create Date 2565-04-11
    */
    public function get_data_by_id()
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_group AS grp
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON grp.grp_id = grn.grn_grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN dbmc.employee AS emp
                ON emp.Emp_ID = grn.grn_emp_id
                INNER JOIN dbmc.position AS pos
                ON pos.Position_ID = emp.Position_ID
                INNER JOIN dbmc.sectioncode AS scode
                ON emp.Sectioncode_ID = scode.Sectioncode
                INNER JOIN dbmc.company AS com
                ON emp.Company_ID = com.Company_ID
                WHERE sec.sec_id = ?";
        $query = $this->db->query($sql, array($this->sec_id));
        return $query;
    }

    /* Report
    * get_emp_by_id
    * get data group, nominee, section, employee, position, section_code, company
    * @input    -
    * @output   get data group, nominee, section, employee, position, section_code, company
    * @author   Chakrit
    * @Create Date 2565-04-11
    */
    public function get_emp_by_id()
    {
        $sql = "SELECT * 
                FROM pefs_database.pef_group AS grp
                INNER JOIN pefs_database.pef_group_nominee AS grn
                ON grn.grn_grp_id = grp.grp_id
                INNER JOIN pefs_database.pef_section AS sec
                ON sec.sec_level = grp.grp_position_group
                INNER JOIN dbmc.employee AS emp
                ON emp.Emp_ID = grn.grn_emp_id
                INNER JOIN dbmc.position AS pos
                ON pos.Position_ID = emp.Position_ID
                INNER JOIN dbmc.sectioncode AS scode
                ON emp.Sectioncode_ID = scode.Sectioncode
                INNER JOIN dbmc.company AS com
                ON emp.Company_ID = com.Company_ID
                WHERE grn.grn_id = ?";
        $query = $this->db->query($sql, array($this->grn_id));
        return $query;
    }
    /*
* get_nominee_by_group
* get nominee detail from database
* @input grn_grp_id
* @output nominee detail 
* @author Jirayut Saifah
* @Create Date 2564-08-13
*/
    function get_nominee_by_group()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_group_nominee AS nom INNER JOIN dbmc.employee AS emp 
            ON emp.Emp_ID=nom.grn_emp_id
            INNER JOIN dbmc.sectioncode AS sec
            ON emp.Sectioncode_ID=sec.Sectioncode
            INNER JOIN dbmc.position AS pos
            ON pos.Position_ID = nom.grn_promote_to
            WHERE grn_grp_id =? 
			";
        $query = $this->db->query($sql, array($this->grn_grp_id));
        return $query;
    } //end  get_group
    /*
* get_pos_nominee_by_group
* get nominee detail from database
* @input grn_grp_id
* @output nominee detail 
* @author Jirayut Saifah
* @Create Date 2564-08-13
*/
    function get_pos_nominee_by_group()
    { //check User_login and Pass_login in database
        $sql = "SELECT *
			FROM pefs_database.pef_group_nominee AS nom INNER JOIN dbmc.employee AS emp 
            ON emp.Emp_ID=nom.grn_emp_id
            INNER JOIN dbmc.sectioncode AS sec
            ON emp.Sectioncode_ID=sec.Sectioncode
            INNER JOIN dbmc.position AS pos
            ON pos.Position_ID = emp.Position_ID AND emp.Position_ID=pos.Position_ID
            WHERE grn_grp_id =? 
			";
        $query = $this->db->query($sql, array($this->grn_grp_id));
        return $query;
    } //end  get_group


    /*
	* get_all_group_and_position
	* get all_group_and_position
	* @input  -
	* @output get_all_group_and_position
	* @author Pontakon M.
	* @Create date 2565-04-14
    */
    function get_all_group_and_position()
    { 
        $sql = "SELECT gr_schedule.grd_date, gr_schedule.grd_round, gr_schedule.grd_grp_id, gr.grp_position_group ,gr.grp_id, gr.grp_status, gr.grp_id, gr.grp_date
        FROM pefs_database.pef_group AS gr
        INNER JOIN pefs_database.pef_group_schedule AS gr_schedule
        ON gr.grp_id = gr_schedule.grd_grp_id
                    
 ";
        $query = $this->db->query($sql);
        return $query;
    } //end  

        /*
	* get_group_by_group_id
	* get_group
	* @input  group_id
	* @output get_group
	* @author Pontakon M.
	* @Create date 2565-04-14
    */
    function get_group_by_group_id($group_id)
    { 
        $sql = "SELECT *FROM pefs_database.pef_group as gro
        WHERE gro.grp_id =$group_id";
        $query = $this->db->query($sql);
        return $query;
    } //end  

    /*
	* get_group_evaluation
	* get data group evaluation from database
	* @input  ass_id
	* @output -
	* @author Thitima Popila
	* @Create Date 2565-04-20
    */
    public function get_group_evaluation_by_id($ass_id)
    {
        $sql = "SELECT gr_schedule.grd_date, gr_schedule.grd_round, gr_schedule.grd_grp_id, promote.asp_name, 
        promote.asp_level, promote.asp_type,gr.grp_id, gr.grp_status,  ass.ase_emp_id, gr.grp_id, gr.grp_date
                    FROM pefs_database.pef_group AS gr
                    INNER JOIN pefs_database.pef_group_schedule AS gr_schedule
                    ON gr.grp_id = gr_schedule.grd_grp_id
                    INNER JOIN pefs_database.pef_group_assessor AS grass
                    ON gr.grp_id = grass.gro_grp_id
                    INNER JOIN pefs_database.pef_assessor AS ass
                    ON grass.gro_ase_id = ass.ase_id
                    INNER JOIN pefs_database.pef_assessor_promote AS promote
                    ON grass.gro_asp_id = promote.asp_level
                    WHERE  ass.ase_emp_id = '$ass_id'
                    GROUP BY gr.grp_id";
        $query = $this->db->query($sql);
        return $query;
    } //คืนค่าข้อมูลรายละเอียดของกลุ่มการประเมิน
}