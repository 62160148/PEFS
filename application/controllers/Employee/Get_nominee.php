<?php
/*
* Employee
* Employee detail
* @author Jirayut Saifah
* @Create Date 2564-8-13
*/
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../MainController.php");

class Get_nominee extends MainController
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function get_position_name()
    {
        $this->load->model('M_pef_employee', 'emp');
        $this->emp->Position_ID = $this->input->post('pos_id');
        $data = $this->emp->get_position_name()->result();
        echo json_encode($data);
    }
    /*
	* search_by_employee_id
	* search employee detail by emp_id
	* @input emp_id
	* @output employee detail
	* @author Jirayut Saifah
	* @Create Date 2564-7-23
	*/
    function search_by_employee_id()
    {

        $Emp_id = $this->input->post('Emp_id');
        $this->load->model('M_pef_employee', 'emp');
        $this->emp->Emp_ID = $Emp_id;
        $data = $this->emp->get_name_emp()->result();
        echo json_encode($data);
    }
    /*
	* get_position_by_sec
	* search position detail by section id
	* @input sec_id
	* @output position detail
	* @author Jirayut Saifah
	* @Create Date 2564-8-15
	*/
    function get_position_by_sec()
    {
        $pos = $this->input->post('pos');
        $this->load->model('M_pef_employee', 'emp');
        $this->emp->sec_id = $pos;
        $data = $this->emp->get_position()->result();
        echo json_encode($data);
    }
    /*
	* get_nominee_by_id
	* search nominee detail by group
	* @input group id
	* @output nominee detail
	* @author Jirayut Saifah
	* @Create Date 2564-8-15
	*/
    function get_nominee_by_id()
    {

        $group = $this->input->post('group_id');
        $this->load->model('M_pef_group', 'emp');
        $this->emp->grn_grp_id = $group;
        $data = $this->emp->get_nominee_by_group()->result();
        $pos = $this->emp->get_pos_nominee_by_group()->result();
        // echo $data['assessor'];
        echo json_encode($data);
    }
    
    /*
	* get_position
	* search nominee detail by group
	* @input group id
	* @output nominee detail
	* @author Jirayut Saifah
	* @Create Date 2564-8-15
	*/
    function get_position()
    {
        $position_level_id = $this->input->post('position_level_id');
        $this->load->model('M_pef_employee', 'emp');
        $this->emp->asp_level = $position_level_id;
        $data = $this->emp->get_position()->result();
        // echo $data['assessor'];
        echo json_encode($data);
    }
    /*
	* get_position_id
	* search nominee detail by group
	* @input group id
	* @output nominee detail
	* @author Jirayut Saifah
	* @Create Date 2564-8-15
	*/
    function get_position_id()
    {
        $this->load->model('M_pef_employee', 'emp');
        $this->emp->Position_name = $this->input->post('position_name');
        $data = $this->emp->get_position_id()->result();
        // echo $data['assessor'];
        print_r($data);
        echo json_encode($data);
    }
}
// 