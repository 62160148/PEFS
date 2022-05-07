<?php
/*
    * Score Management
    * Controller for Score Management module
    * @author Jaraspon Seallo and Nipat 
    * @Create Date 2565-01-26
    * @Update Date 2565-04-17
    */
?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../MainController.php");

//Start class Score Management
class Score_management extends MainController
{

    public function __construct()
    { //__construct
        parent::__construct();
    } //end __construct

    /*
	* show_score_management_list
	* display view Score Management list
	* @input  -
	* @output  Score Management list
	* @author  Jaraspon Seallo
	* @Create  Date 2565-01-23
    */
    public function show_score_management_list()
    { //show_score_management_list
        $this->load->model('M_pef_score_management', 'psm');
        $data['as_group'] = $this->psm->get_score_management_list()->result();
        $data['as_group_date'] = $this->psm->get_score_management_list_date()->result();
        $this->output('consent/v_score_management', $data);
    } //show_score_management_list

    /*
* show_score_management_detail
* display view score management detail
* @input  -
* @output  Score Management Detail
* @author  Niphat Kuhoksiw
* @Create  Date 2565-04-10
*/
    public function show_score_management_detail($id)
    {
        $this->load->model('M_pef_score_management', 'pef');
        $data['count'] = '';
        $num_ass = $this->pef->get_assessor($id)->result();
        $data['as_group_date'] = $this->pef->get_score_management_list_date()->result();
        $data['assessor'] = $this->pef->get_assessor($id)->result();
        $data['form'] = $this->pef->get_form($id)->result();
        $data['nominee'] = $this->pef->get_nominee($id)->result();
        $data['group'] = $this->pef->get_group_by_id($id)->result();
        $data['ass_data'] = $this->pef->get_ass_by_grp_id($id)->result();
        $data['point_data'] = $this->pef->get_data_point_by_grp_id($id)->result();
        $data['total_score'] = $this->pef->get_data_total_score_by_grp_id($id)->result();
        $total='';
        // $data['sec_data'] = $this->pef->get_data_by_id($id)->result();

        for ($i = 0; $i < count($data['nominee']); $i++) {
            $data['per'] = $this->pef->get_evaluation($data['nominee'][$i]->Emp_ID)->result();
            $num = 0;
            for ($j = 0; $j < count($data['per']); $j++) {

                if ($data['nominee'][$i]->Emp_ID == $data['per'][$j]->per_emp_id && $data['group'][0]->grp_date == $data['per'][$j]->per_date) {
                    $num++;
                }
            }
            $data['count'][$i] = $num;
        }

        for($i = 0; $i < count($data['nominee']); $i++){
            for($j = 0; $j < count($data['total_score']); $j++){
                if($data['point_data'][$i]->grn_emp_id == $data['total_score'][$j]->grn_emp_id){
                    $data['point_data'][$i]->total += $data['total_score'][$j]->total;
                }
            }
        }

        for($i = 0; $i < count($data['nominee']); $i++){
            if(empty($data['point_data'][$i]->point)&&empty($data['point_data'][$i]->total)){
                $percent = 0;
            }else{
                $percent = $data['point_data'][$i]->point * 100 / $data['point_data'][$i]->total;
            }
            // echo $data['point_data'][$i]->percent;
            if($percent > 59 && $data['count'][$i] == count($data['assessor'])){
                $this->load->model('Da_pef_group_nominee', 'grn');
                $this->grn->grn_grp_id = $id;
                $this->grn->grn_emp_id = $data['nominee'][$i]->grn_emp_id;
                $this->grn->grn_status_result = 1;
                $this->grn->update_status_result();
            }else if($percent < 60 && $data['count'][$i] == count($data['assessor'])){
            $this->load->model('Da_pef_group_nominee', 'grn');
            $this->grn->grn_grp_id = $id;
            $this->grn->grn_emp_id = $data['nominee'][$i]->grn_emp_id;
            $this->grn->grn_status_result = 2;
            $this->grn->update_status_result();
            }
        }
        // print_r($data['point_data']);

        $this->output('consent/v_score_management_detail', $data);
    } //end show_score_management_detail

     /*
    * update_pass
    * update pass status
    * @input    -
    * @output   -
    * @author   Chakrit
    * @Create Date 2565-04-24
    */
    public function update_pass($grp_id, $emp_id)
    {
        $this->load->model('Da_pef_group_nominee', 'pef');
        $this->pef->grn_grp_id = $grp_id;
        $this->pef->grn_emp_id = $emp_id;
        $this->pef->grn_status_result = 1;
        $this->pef->update_status_result();
        Redirect('/Score_management/Score_management/show_score_management_detail/' . $grp_id);
    }

    /*
    * update_fail
    * update fail status
    * @input    -
    * @output   -
    * @author   Chakrit
    * @Create Date 2565-04-24
    */
    public function update_fail($grp_id, $emp_id)
    {
        $this->load->model('Da_pef_group_nominee', 'pef');
        $this->pef->grn_grp_id = $grp_id;
        $this->pef->grn_emp_id = $emp_id;
        $this->pef->grn_status_result = 2;
        $this->pef->update_status_result();
        Redirect('/Score_management/Score_management/show_score_management_detail/' . $grp_id);
    }

    /*
	* review
	* display review
	* @input  -
	* @output  review
	* @author  Niphat Kuhoksiw
	* @Create  Date 2565-04-10
    */
    // public function review()
    // { //review
    //     $this->load->model('Da_pef_group', 'pefd');
    //     $this->load->model('M_pef_group', 'pef');
    //     $this->load->model('M_pef_score_management', 'pefs');
    //     $grp_id = $this->input->post('grp_id');
    //     $date = $this->input->post('date');
    //     $emp  = $this->input->post('emp');
    //     $emp_id  = $this->input->post('emp_id');
    //     $position_group = $this->input->post('position_group');
    //     $group = $this->input->post('group');
    //     echo $grp_id;
    //     echo $date;
    //     echo $emp;
    //     echo $emp_id;
    //     echo $group;
    //     // $data['assessor'] = $this->pefs->get_assessor($grp_id)->result();        
    //     // for($i=0;$i<count($data['assessor']);$i++){ 
    //     // $this->pefd->gro_ase_id=$data['assessor'][$i]->gro_ase_id;
    //     // }
    //     echo $group;
    //     $this->pefd->grp_date = date('d/m/Y');
    //     echo $this->input->post('year');
    //     $this->pefd->grp_year = date('Y');
    //     $this->pefd->grp_position_group = $position_group;
    //     $this->pefd->insert_group();
    //     $group_id = $this->pef->get_group_id()->result();
    //     if ($position_group > 4) {
    //         $this->ped->grd_grp_id = $group_id[0]->grp_id;
    //         $this->ped->grd_date = $date[0];
    //         $this->ped->grd_round = '1';
    //         $this->ped->insert_group_schedule();
    //     } else {
    //         $date[1] = $this->input->post('date2');
    //         for ($i = 0; $i <= 1; $i++) {
    //             $this->ped->grd_grp_id = $group_id[0]->grp_id;
    //             $this->ped->grd_date = $date[$i];
    //             $this->ped->grd_round = $i + 1;
    //             $this->ped->insert_group_schedule();
    //         }
    //     }
    //         $this->pefd->grn_grp_id = $group_id[0]->grp_id;
    //         $this->pefd->grn_emp_id = $nominee[$i];
    //         $this->pefd->grn_status_done = -1;
    //         $this->pefd->grn_status_result = -1;
    //         $this->emp->Position_name = $pos[$i];
    //         $this->pefd->grn_promote_to = $pos[$i];
    //         $this->pefd->insert_nominee();
    //     for ($i = 0; $i < sizeof($assessor); $i++) {
    //         $this->pefd->gro_grp_id = $group_id[0]->grp_id;
    //         $this->pefd->gro_asp_id = $position_group;
    //         $this->pefd->gro_ase_id = $assessor[$i];
    //         $this->pefd->insert_assessor();
    //     }
    //     $this->pefd->grn_grp_id = $id;
    //     $this->pefd->grp_id = $id;
    //     $this->pefd->gro_grp_id = $id;
    //     $this->pefd->grd_grp_id = $id;
    //     $this->pefd->delete_nominee();
    //     // $this->load->model('M_pef_summary', 'pef');

    //     Redirect('/Score_management/Score_management/show_score_management_detail/' . $grp_id);
    // } //end review

    /*
	*  get_group
	* display  get_group
	* @input  -
	* @output   get_group
	* @author  Niphat Kuhoksiw
	* @Create  Date 2565-04-10
    */
    public function get_group()
    { //get_group
        $date = $this->input->post('date');
        $this->load->model('M_pef_score_management', 'pef');
        $this->pef->grp_date = $date;
        $data = $this->pef->get_group()->result();
        echo json_encode($data);
    } //end get_group

    /*
	* get_evaluation
	* display  get_evaluation
	* @input  -
	* @output  get_evaluation
	* @author  Niphat Kuhoksiw
	* @Create  Date 2565-04-10
    */
    public function get_evaluation()
    { //get_evaluation
        $id = $this->input->post('emp');
        $this->load->model('M_pef_score_management', 'pef');
        $data = $this->pef->get_evaluation($id)->result();
        echo json_encode($data);
    } //end get_evaluation
    public function update_status_edit()
    {
        $this->load->model('Da_pef_score_management', 'pef');
        $grp_id = $this->input->post('grp_id');
        $grp_status_edit = $this->input->post('grp_status_edit');
        $this->pef->grp_id = $grp_id;
        $this->pef->grp_status_edit = $grp_status_edit;
        $this->pef->update_status_edit();
        echo $grp_id;
        echo $grp_status_edit;
        $data['status'] = "success";
        echo json_encode($data);
        Redirect('/Score_management/Score_management/show_score_management_detail/' . $grp_id);
    }

    public function get_round(){
        $grp_id = $this->input->post('grp_id');
        $round = $this->input->post('grd_round');

        echo $round;
        $this->output('consent/v_score_management_detail', $round);
    }

}//End class Score_management