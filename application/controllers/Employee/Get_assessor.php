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

class Get_assessor extends MainController
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
    function get_group_level()
    {
        $this->load->model('M_pef_employee', 'emp');
        $data = $this->emp->get_group_level()->result();
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
    function get_assessor_by_year()
    {

        $this->load->model('M_pef_assessor', 'ass');
        $this->ass->ase_year = $this->input->post('years');
        $this->ass->ase_sec_id = $this->input->post('pos');
        $data = $this->ass->get_assessor_by_year()->result();
        // echo $data['assessor'];
        //print_r($data);
        echo json_encode($data);
    }
    function  get_sec_by_ase()
    {

        $this->load->model('M_pef_assessor', 'ass');
        $data = $this->ass->get_sec_by_ase()->result();
        // echo $data['assessor'];
        //print_r($data);
        echo json_encode($data);
    }
    function get_assessor_by_group()
    {

        $this->load->model('M_pef_assessor', 'ass');
        $this->ass->gro_grp_id = $this->input->post('group_id');
        $this->ass->gro_ase_id = $this->input->post('ase_id');
        $data = $this->ass->get_assessor_by_group()->result();
        // echo $this->input->post('ase_id');
        // $num = 0;
        // // echo $data[0]->gro_ase_id;
        // for ($i = 0; $i < count($data); $i++) {
        //     if ($data[$i]->gro_ase_id == $this->input->post('ase_id')) {
        //         $num++;
        //     }
        // }
        // if ($num == 0) {
        //     $data = '0';
        //     echo json_encode($data);
        // } else {
        //     $data = $this->input->post('ase_id');
        //     echo json_encode($data);
        // }

        echo json_encode($data);
        //echo $data;
        // print_r($data);

    }
    function get_group_by_year()
    {

        $this->load->model('M_pef_group', 'grp');
        $this->grp->grp_year = $this->input->post('years');
        $data = $this->grp->get_group_by_year()->result();
        // echo $data['assessor'];
        echo json_encode($data);
    }
}
// 