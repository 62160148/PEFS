<?php
/*
* Assessor_management
* Controller for Group Assessor module   
* @author Thitima Popila and Apinya Phadungkit
* @Create Date 2565-01-25
* @Update Date 2565-03-04
* @Update Date 2565-04-18
*/
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../MainController.php");

class Assessor_management extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
	* show_assessor_management
	* display view assessor group management
	* @input  -
	* @output  Assessor group list
	* @author  Thitima Popila and Apinya Phadungkit
	* @Create  Date 2565-01-25
    * @Update  Date 2565-03-09
    * @Update  Date 2565-04-18
    */
    public function show_assessor_management()
    {
        $this->load->model('M_pef_assessor_promote', 'mpo');

        $this->load->model('M_pef_assessor_position', 'map');
        $data['arr_group'] = $this->mpo->get_group_assessor_all()->result();
        $data['arr_position'] = $this->map->get_position_all()->result();
        // print_r($data['arr_position']);
        // print_r($data);
        $this->output('consent/v_assessor_management', $data);
        
    }//แสดงหน้า v_assessor_management แสดงรายการของกลุ่มของกรรมการทั้งหมด

    
    /*
	* show_assessor_management_detail
	* display view assessor group management detail
	* @input  id
	* @output  Assessor list in group
	* @author  Apinya Phadungkit
	* @Create  Date 2565-01-25
    * @Update  Date 2565-03-09
    * @Update  Date 2565-04-18
    */
    public function show_assessor_management_detail($id) // id มาจาก asp_id
    {
        // echo $id; 
        $this->load->model('M_pef_assessor_promote', 'gass');
        $data['arr_ass'] = $this->gass->get_assessor_list($id)->result();
        $data['arr_t'] = $this->gass->get_level($id)->result();
        $data['sec'] = $this->gass->get_sec($id)->result();
        $data['id'] = $id;
        // $this->add_assessor($id);
    
        $this->output('consent/v_assessor_management_detail', $data);
    }//แสดงหน้า v_assessor_management_detail ที่แสดงรายชื่อกรรมการที่อยู่ในกลุ่มกรรมการนั้นๆ

    /*
	* delete_group_assessor
	* delete group_assessor in database
	* @input   id
	* @output  All group assessor list 
	* @author  Thitima Popila and Apinya Phadungkit
	* @Create  Date 2565-03-08
    * @Update  Date 2565-03-08
    * @Update  Date 2565-04-18
    */
    public function delete_group_assessor($id)
    {
        //delete assessor promote in database
        $this->load->model('Da_pef_assessor_promote', 'dpef');
        $this->dpef->asp_id = $id;
        $this->dpef->delete();

        //delete assessor position in database
        $this->load->model('Da_pef_assessor_position', 'dpo');
        $this->dpo->gap_asp_id = $id;
        $this->dpo->delete();

        // echo $id;
        redirect('Assessor_management/Assessor_management/show_assessor_management');
    }//ลบกลุ่มของกรรมการ


    /*
	* search_by_employee_id
	* search employee detail by ase_emp_id
	* @input ase_emp_id
	* @output employee name
	* @author Apinya Phadungkit
	* @Create Date 2566-02-30
	*/
    function search_by_employee_id()
    {

        $ase_emp_id = $this->input->post('ase_emp_id');
        $this->load->model('M_pef_assessor', 'emp');
        $this->emp->Emp_ID = $ase_emp_id;
        $data = $this->emp->get_name_emp()->result();

        echo json_encode($data);
    }//ส่ง ase_emp_id เข้ามา เพื่อส่งชื่อของพนักงานกลับไป (ค้นหาพนักงานเพื่อเพิ่มในกลุ่มกรรมการ)


    /*
	* add_assessor
	* add_assessor data into model
	* @input ase_year,ase_emp_id,ase_gro_id,ase_sec_id 
	* @output -
	* @author ApinyaPhadungkit
	* @Create Date 2565-03-30
    * @Update  Date 2565-04-18
	*/
    function add_assessor($ase_gro_id)
    {
        $year = (new DateTime)->format("Y");
        //insert 
        $this->load->model('Da_pef_assessor', 'dass');
        $this->dass->ase_year = $year;
        $this->dass->ase_emp_id = $this->input->post('ase_emp_id');
        $this->dass->ase_asp_id = $ase_gro_id;
        $this->dass->ase_sec_id = $this->input->post('sec');
        // echo $ase_gro_id;
        $this->dass->insert();

        $this->load->model('Da_pef_user_login', 'dlog');
        $this->dlog->User_login = $this->input->post('ase_emp_id');
        $this->dlog->User_emp_id = $this->input->post('ase_emp_id');
        $this->dlog->User_pass_login = $this->input->post('ase_emp_id');
        $this->dlog->User_Role = '1';
        $this->dlog->insert_login();
        redirect('Assessor_management/Assessor_management/show_assessor_management_detail/'.$ase_gro_id);
    }//เพิ่มรายการของกรรมการในกลุ่มกรรมการ
    
    /*
	* delete_assessor
	* delete_assessor
	* @input   ase_emp_id
	* @output  assessor list 
	* @author  Apinya Phadungkit
	* @Create  Date 2565-04-11
    * @Update  Date 2565-04-18
    */
    public function delete_assessor($emp_id,$ase_gro_id)
    {
        // $ase_gro_id = $this->input->post('group_id');
        $this->load->model('Da_pef_assessor', 'dpef');
        $this->dpef->ase_emp_id = $emp_id;
        $this->dpef->delete();
        // echo $emp_id;
        redirect('Assessor_management/Assessor_management/show_assessor_management_detail/'.$ase_gro_id);
    }//ลบรายการของกรรมการออกจากกลุ่มกรรมการ



    /*
	* add_group_assessor
	* add_group_assessor data into model
	* @input asp_name,asp_level,asp_type,pos,gap_asp_id,gap_promote
	* @output -
	* @author ApinyaPhadungkit
	* @Create Date 2565-04-15
    * @Update  Date 2565-04-18
	*/
    function add_group_assessor()
    {
        $this->load->model('Da_pef_assessor_promote', 'dpro');
        $this->load->model('Da_pef_assessor_position', 'dpos');

        $group_name = $this->input->post('group_name');
        $group_level = $this->input->post('group_level');
        $group_type = $this->input->post('group_type');
        $pos = $this->input->post('pos');
        // $count_pos = $this->input->post('count_pos');

        if($group_type == "Type 2: (2 round evaluation)"){
            $type = '2';
        }else {
            $type = '1';
        }

        //insert asp_name,asp_level,asp_type in pef_assessor_promote database
        $this->dpro->asp_name = $group_name;
        $this->dpro->asp_level = $group_level;
        $this->dpro->asp_type = $type;
        $this->dpro->insert();

        $this->load->model('M_pef_assessor_promote', 'pas');
        $max = $this->pas->get_id_max()->row();

        echo $group_name;
        echo $group_level;
        echo $type;
    
        for ($i = 0; $i < sizeof($pos); $i++) {

            //insert gap_asp_id,gap_promote in pef_assessor_position database 
            $this->dpos->gap_asp_id = $max->asp_id;
            $this->dpos->gap_promote = $pos[$i];
            $this->dpos->insert();
        }

        $data = "insert_success";
        echo json_encode($data);

    }//เพิ่มกลุ่มของกรรมการ


}