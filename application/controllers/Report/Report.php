<?php
/*
* Report
* @input  -   
* @output -
* @author Chakrit and Nattakorn
* @Create Date 2565-01-27
*/
?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/../MainController.php");

class Report extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }
    /*
	* show_report
	* show view report
	* @input    -
	* @output   -
	* @author   Chakrit
	* @Create Date 2564-08-13
	* @Update Date 2564-08-19
	*/
    public function show_report()
    {
        $this->load->model('M_pef_group_nominee', 'grn');
        $this->load->model('M_pef_group', 'grp');
        $data['nominee'] = $this->grn->get_all_nominee()->result();
        $data['obj_year'] = $this->grp->get_year()->result();
        $this->output('consent/v_report_all', $data);
    }

    /*
	* get_report
	* get data report in year
	* @input    year
	* @output   data of report
	* @author   Chakrit
	* @Create Date 2564-08-13
	* @Update Date 2564-08-18
	*/
    public function get_report()
    {
        $year = $this->input->post('year');
        $this->load->model('M_pef_group', 'pef');
        $data = $this->pef->get_data_year($year)->result();
        echo json_encode($data);
    }

    /*
	* get_section
	* get data report in section
	* @input    -
	* @output   data of report
	* @author   Chakrit
	* @Create Date 2564-08-13
	* @Update Date 2564-08-18
	*/
    public function get_section()
    {
        $this->load->model('M_pef_section', 'pef');
        $data = $this->pef->get_all_section()->result();
        echo json_encode($data);
    }

    /*
	* show_report_detail
	* show view report detail
	* @input    sec_id
	* @output   data of report detail
	* @author   Chakrit
	* @Create Date 2564-08-15
	* @Update Date 2564-08-20
	*/
    public function show_report_detail($sec_id)
    {
        $this->load->model('M_pef_group', 'grp');
        $this->load->model('M_pef_section', 'sec');
        $this->load->model('M_pef_point_form', 'ptf');

        $this->grp->sec_id = $sec_id;
        $this->sec->sec_id = $sec_id;
        $this->ptf->sec_id = $sec_id;

        $data['sec_data'] = $this->grp->get_data_by_id()->result();
        $data['ass_data'] = $this->sec->get_ass_by_sec_id()->result();
        $data['point_data'] = $this->ptf->get_data_point()->result();
        $data['point_data_only'] = $this->ptf->get_data_point_only()->result();

        $data['count'] = '';
        for ($i = 0; $i < count($data['sec_data']); $i++) {
            $num = 0;
            for ($j = 0; $j < count($data['ass_data']); $j++) {
                $num++;
            }
            $data['count'][$i] = $num;
        }

        $this->output('consent/v_report_group', $data);
    }

    /*
	* show_report_detail_assessor
	* show view report detail assessor
	* @input    grn_id
	* @output   data of report detail assessor
	* @author   Chakrit
	* @Create Date 2564-08-15
	* @Update Date 2564-08-20
	*/
    public function show_report_detail_assessor($grn_id)
    {
        $this->load->model('M_pef_group', 'grp');
        $this->load->model('M_pef_section', 'sec');
        $this->load->model('M_pef_point_form', 'ptf');

        $this->grp->grn_id = $grn_id;
        $this->sec->grn_id = $grn_id;
        $this->ptf->grn_id = $grn_id;

        $data['emp_data'] = $this->grp->get_emp_by_id()->row();
        $data['ass_data'] = $this->sec->get_ass_by_nor_id()->result();
        $data['point_data'] = $this->ptf->get_data_point_by_nor_id()->result();
        $data['point_data_only'] = $this->ptf->get_data_point_by_nor_id_only()->result();
        $this->output('consent/v_report_person', $data);
    }



    // public function show_report_all()
    // {
    //     $this->output('consent/v_report_all');
    // }
    // public function show_report_group()
    // {
    //     $this->output('consent/v_report_group');
    // }

    // public function show_report_person()
    // {
    //     $this->output('consent/v_report_person');
    // }
}
