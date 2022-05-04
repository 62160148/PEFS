<!-- 
    * v_report
    * Display report person of Performance Evaluation Factor System
    * @input    -
    * @output   -
    * @author  Chakrit and Nattakorn
    * @Create Date 2565-01-27
    * @Update Date -
-->
<style>
    table {
        text-align: center;
    }
</style>
<div class="container-fluid py-4">
    <div class="card-header" id="card_radius">
        <div class="text-end">
            <a href='#' id='download_link' onClick='javascript:ExcelReport();' class="btn btn-secondary float-right"><i class="fa fa-download"></i>&emsp;Excel</a>
        </div>
        <h2>Report Details (รายงานข้อมูลรายบุคคล)</h2>
    </div>
    <div class="card-body">
        <div class="card-header" id="card_radius" style="background-color: #F8F8F8">
            <div class="table-responsive">
                <h4> List of assessed : <?php echo $emp_data->Empname_eng . ' ' . $emp_data->Empsurname_eng; ?></h4>
                <hr class="my-4" color="gray">
                <h6 style="text-align:left">
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <b>Current Position : </b><?php echo $emp_data->Position_name; ?><br><br>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <b>Department : </b><?php echo $emp_data->Department; ?><br><br>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <b>Section code : </b><?php echo $emp_data->Sectioncode; ?><br><br>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <b>Promote to : </b><?php echo $emp_data->sec_name; ?><br><br>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <b>Presentation Date : </b><?php echo date("d/m/Y", strtotime($emp_data->grp_date)); ?>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <b>Company : </b><?php echo $emp_data->Company_shortname; ?>
                        </div>
                    </div>
                </h6>
                <hr class="my-4" color="gray">

                <h5 style="text-align:left">
                    <b>Assessors : </b><?php echo $i = count($ass_data); ?> person
                </h5>
                <br>
                <div class="row" id="count_table">
                    <div class="col-xl-12">
                        <div class="card" style="background-color: #F8F8F8">
                            <div class="table-responsive">
                                <table class="table style=" width:100%" id="example">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Employee ID</th>
                                            <th scope="col">Assessors Name</th>
                                            <th scope="col">Score</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Q & A</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_table">
                                        <?php
                                        $num = 1;
                                        $index_point = 0;
                                        for ($i = 0; $i < count($ass_data); $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $num++; ?></td>
                                                <td><?php echo $ass_data[$i]->ase_emp_id; ?></td>
                                                <td><?php echo $ass_data[$i]->Empname_eng . ' ' . $ass_data[$i]->Empsurname_eng; ?></td>
                                                <td><?php echo $point_data_only[$i]->point; ?> points</td>
                                                <td><?php echo $point_data[$i]->per_comment; ?></td>
                                                <td><?php echo $point_data[$i]->per_q_and_a; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h5 style="text-align:left">
                    <?php
                    $index_point = 0;
                    ?>
                    <b>Totally score : </b><?php echo  $point_data_only[0]->sum_total; ?> points<br><br>
                    <b>Get score : </b><?php echo $point_data_only[0]->point; ?> points<br><br>
                    <?php $percent = $point_data_only[0]->point * 100 / $point_data_only[0]->sum_total; ?>
                    <b>Total score : </b><?php echo number_format($percent, 2, '.', ''); ?> %<br><br>
                    <?php
                    if ($percent >= 60) {
                        $Judgement = 'PASS'; ?>
                        <b>Judgement : </b><span style="color:green;"><?php echo $Judgement; ?></span>
                    <?php } else {
                        $Judgement = 'NOT PASS'; ?>
                        <b>Judgement : </b><span style="color:red;"><?php echo $Judgement; ?></span>
                    <?php } ?>
                </h5>
                <br>

            </div>
        </div>
    </div>
    <div class="card-header" id="card_radius">
        <h3>
            Excel Report
        </h3>
    </div>

    <div class="row" id="count_table">
        <div class="col-xl-12">
            <div class="card">
                <div class="table-responsive" table id='myTable'>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">EmpNo.Nominee</th>
                                <th scope="col">Name-Surname Nominee</th>
                                <th scope="col">Department</th>
                                <th scope="col">Promote to</th>
                                <th scope="col">EmpNo.Assessor</th>
                                <th scope="col">Name-Surname Assessor</th>
                                <th scope="col">Position</th>
                                <th scope="col">Total score pass ≥ 60%</th>
                                <th scope="col">Result</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Q & A</th>
                            </tr>
                        </thead>
                        <tbody id="data_table">
                            <?php
                            $num = 1;
                            for ($i = 0; $i < count($ass_data); $i++) {
                            ?>
                                <tr>
                                    <td><?php echo $num++; ?></td>

                                    <td><?php echo $emp_data->grn_emp_id; ?></td>
                                    <td><?php echo $emp_data->Empname_eng . ' ' . $emp_data->Empsurname_eng; ?></td>
                                    <td><?php echo $emp_data->Department; ?></td>
                                    <td><?php echo $emp_data->sec_name; ?></td>

                                    <td><?php echo $ass_data[$i]->ase_emp_id; ?></td>
                                    <td><?php echo $ass_data[$i]->Empname_eng . ' ' . $ass_data[$i]->Empsurname_eng; ?></td>
                                    <td><?php echo $ass_data[$i]->sec_name; ?></td>

                                    <?php $percent = $point_data_only[$i]->point * 100 / $point_data_only[$i]->sum_total; ?>
                                    <td><?php echo number_format($percent, 2, '.', ''); ?> %</td>
                                    <?php
                                    if ($percent >= 60) {
                                        $Judgement = 'PASS'; ?>
                                        <td><span style="color:green;"><?php echo $Judgement; ?></span></td>
                                    <?php } else {
                                        $Judgement = 'NOT PASS'; ?>
                                        <td><span style="color:red;"><?php echo $Judgement; ?></span></td>
                                    <?php } ?>
                                    <td><?php echo $point_data[$i]->per_comment; ?></td>
                                    <td><?php echo $point_data[$i]->per_q_and_a; ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer" style="background-color: #F8F8F8">
        <center><a href="<?php echo site_url() . 'Report/Report/show_report_detail/'  . $emp_data->sec_id; ?>" class="btn btn-secondary float-center"><i class="fas fa-arrow-alt-circle-left"></i> Back</a></center>
    </div>
</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saver@1.3.3/FileSaver.js"></script>

<script>
    /*
     * ExcelReport
     * Export data to Excel
     * @input    -
     * @output   -
     * @author   Chakrit
     * @Create Date 2564-08-16
     */
    function ExcelReport() //function สำหรับสร้าง ไฟล์ excel จากตาราง
    {
        var sheet_name = "Report"; /* กำหหนดชื่อ sheet ให้กับ excel โดยต้องไม่เกิน 31 ตัวอักษร */
        var elt = document.getElementById('myTable'); /*กำหนดสร้างไฟล์ excel จาก table element ที่มี id ชื่อว่า myTable*/

        /*------สร้างไฟล์ excel------*/
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: sheet_name
        });
        XLSX.writeFile(wb, 'Performance Evaluation Factor Report Person.xlsx'); //Download ไฟล์ excel จากตาราง html โดยใช้ชื่อว่า Performance Evaluation Factor Report.xlsx
    }
</script>