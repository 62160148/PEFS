<?php
/*
* Group_management
* @input  -   
* @output -
* @author Jirayut Saifah
* @Create Date 2565-01-26
*/
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../MainController.php");

class Group_management extends MainController
{
    /**
     * This function displays the group management page
     */
    public function show_group_management()
    {
        $this->load->model('M_pef_group', 'pef');
        $data['group'] = $this->pef->get_group()->result();
        //print_r($data);
        $this->output('consent/v_group_management', $data);
    }

    public function add_group()
    {
        // $this->load->model('M_pef_employee', 'emp');
        // $position_level_id = 1;
        // $this->emp->asp_level = $position_level_id;
        // $data['employee'] = $this->emp->get_position()->result();
        //print_r($data);
        // $this->output('consent/v_group_management_add_group', $data);
        $this->output('consent/v_group_management_add_group');
    }
    /* A function that is used to get the group detail. */
    public function edit_group($id)
    {
        $data['id'] = $id;
        $this->load->model('M_pef_employee', 'emp');
        $this->emp->gro_grp_id = $id;
        $data['asp_id'] = $this->emp->get_asp_id()->result();
        // print_r($data['asp_id']);
        $data['asp_id'] = $data['asp_id'][0]->gro_asp_id;
        // echo $data['asp_id'];
        $this->output('consent/v_group_management_edit_group', $data);
        //$this->output('consent/v_group_management_add_group');
    }
    public function get_group_detail()
    {
        $this->load->model('M_pef_group', 'pef');
        $this->pef->grp_id =  $this->input->post('grp_id');
        $data = $this->pef->get_group_detail()->result();
        echo json_encode($data);
        //$this->output('consent/v_group_management_add_group');
    }
    /*
	* insert
	* insert group to database
    * @input information data
	* @output -
	* @author Jirayut Saifah
	* @Create Date 2564-8-13
	*/
    function insert()
    {
        $this->load->model('Da_pef_group', 'ped');
        $this->load->model('M_pef_group', 'pef');
        $this->load->model('M_pef_employee', 'emp');
        $date[0] = $this->input->post('date');
        echo $date[0];
        $position_group = $this->input->post('position_group');
        $assessor = $this->input->post('emp_assessor');
        $nominee = $this->input->post('emp_nominee');
        $pos = $this->input->post('promote');
        //echo  $this->input->post('promote');
        $this->ped->grp_date = $date[0];
        $this->ped->grp_date = $date[0];
        echo $this->input->post('year');
        $this->ped->grp_year = $this->input->post('year');
        $this->ped->grp_position_group = $position_group;
        $this->ped->insert_group();
        $group_id = $this->pef->get_group_id()->result();
        if ($position_group > 4) {
            $this->ped->grd_grp_id = $group_id[0]->grp_id;
            $this->ped->grd_date = $date[0];
            $this->ped->grd_round = '1';
            $this->ped->insert_group_schedule();
        } else {
            $date[1] = $this->input->post('date2');
            for ($i = 0; $i <= 1; $i++) {
                $this->ped->grd_grp_id = $group_id[0]->grp_id;
                $this->ped->grd_date = $date[$i];
                $this->ped->grd_round = $i + 1;
                $this->ped->insert_group_schedule();
            }
        }
        for ($i = 0; $i < sizeof($assessor); $i++) {
            $this->ped->gro_grp_id = $group_id[0]->grp_id;
            $this->ped->gro_asp_id = $position_group;
            $this->ped->gro_ase_id = $assessor[$i];
            $this->ped->insert_assessor();
        }
        for ($i = 0; $i < sizeof($nominee); $i++) {
            $this->ped->grn_grp_id = $group_id[0]->grp_id;
            $this->ped->grn_emp_id = $nominee[$i];
            $this->ped->grn_status_done = -1;
            $this->ped->grn_status_result = -1;
            $this->emp->Position_name = $pos[$i];
            // print_r($pos);
            // $pos_id = $this->emp->get_position_id()->row();
            // print_r($pos_id);
            // echo $pos_id->Position_ID;
            $this->ped->grn_promote_to = $pos[$i];
            $this->ped->insert_nominee();
        }

        // $data['obj_sec'] = $this->pef->get_section()->result();
        // $this->output('consent/v_group_list', $data);
        $data = "insert_success";
        echo json_encode($data);

        //redirect('consent/v_group_management');
    }
    function delete_group($id)
    {
        $this->load->model('Da_pef_group', 'ped');
        $this->ped->grn_grp_id = $id;
        $this->ped->grp_id = $id;
        $this->ped->gro_grp_id = $id;
        $this->ped->grd_grp_id = $id;
        $this->ped->delete_group();
        $this->ped->delete_group_assessor();
        $this->ped->delete_group_nominee();
        $this->ped->delete_group_schedule();
        // $this->load->model('M_pef_group', 'pef');
        // $data['group'] = $this->pef->get_group()->result();
        // $this->output('consent/v_group_management', $data);
        // $this->show_group_management();
        redirect('Group_management/Group_management/show_group_management');
    }
    function edit()
    {
        $this->load->model('Da_pef_group', 'ped');
        $this->load->model('M_pef_group', 'pef');
        $this->load->model('M_pef_employee', 'emp');
        $date[0] = $this->input->post('date');
        echo $date[0];
        $position_group = $this->input->post('position_group');
        $assessor = $this->input->post('emp_assessor');
        $nominee = $this->input->post('emp_nominee');
        print_r($assessor);
        $pos = $this->input->post('promote');
        $asp_id = $this->input->post('asp_id');
        print_r($pos);
        $group = $this->input->post('grp_id');
        $this->ped->grn_grp_id = $group;
        $this->ped->grp_id = $group;
        $this->ped->gro_grp_id = $group;
        $this->ped->grd_grp_id = $group;
        $this->ped->delete_group();
        $this->ped->delete_group_assessor();
        $this->ped->delete_group_nominee();
        $this->ped->delete_group_schedule();
        $date[0] = $this->input->post('date');
        echo $date[0];
        $position_group = $this->input->post('position_group');
        $assessor = $this->input->post('emp_assessor');
        $nominee = $this->input->post('emp_nominee');
        $pos = $this->input->post('promote');
        $this->ped->grp_date = $date[0];
        echo $this->input->post('year');
        $this->ped->grp_year = $this->input->post('year');
        $this->ped->grp_position_group = $position_group;
        $this->ped->insert_group();
        $group_id = $this->pef->get_group_id()->result();
        if ($position_group > 4) {
            $this->ped->grd_grp_id = $group_id[0]->grp_id;
            $this->ped->grd_date = $date[0];
            $this->ped->grd_round = '1';
            $this->ped->insert_group_schedule();
        } else {
            $date[1] = $this->input->post('date2');
            for ($i = 0; $i <= 1; $i++) {
                $this->ped->grd_grp_id = $group_id[0]->grp_id;
                $this->ped->grd_date = $date[$i];
                $this->ped->grd_round = $i + 1;
                $this->ped->insert_group_schedule();
            }
        }
        for ($i = 0; $i < sizeof($assessor); $i++) {
            $this->ped->gro_grp_id = $group_id[0]->grp_id;
            $this->ped->gro_asp_id = $position_group;
            $this->ped->gro_ase_id = $assessor[$i];
            $this->ped->insert_assessor();
        }
        for ($i = 0; $i < sizeof($nominee); $i++) {
            $this->ped->grn_grp_id = $group_id[0]->grp_id;
            $this->ped->grn_emp_id = $nominee[$i];
            $this->emp->Position_name = $pos[$i];
            $this->ped->grn_status_done = -1;
            $this->ped->grn_status_result = -1;
            // echo $pos[$i];
            // $pos_id = $this->emp->get_position_id()->row();
            $this->ped->grn_promote_to = $pos[$i];
            $this->ped->insert_nominee();
        }

        // $data['obj_sec'] = $this->pef->get_section()->result();
        // $this->output('consent/v_group_list', $data);
        $data = "insert_success";
        echo json_encode($data);
    }
}