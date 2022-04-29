<!--
    v_result_admin_detail_from_1
    display for result_admin_to_show_nominee_of_from_with_type_from_1
    @input -
    @output -
    @author Pontakon M.
    Create date 2565-04-13
    Update date 2565-04-14
    Update date 2565-04-15
-->
<!-- CSS -->
<style>
table {
    width: 100%;
}

#card_radius {
    margin-top: 15px;
    margin-bottom: 15px;
    border-radius: 20px;
    min-height: 300px;
    width: auto;
}

thead,
tbody,
tfoot,
tr,
td,
th 
{
    border-color: inherit;
    border-style: solid;
    border-width: 1px;
}

.table tbody tr:last-child td {
    border-width: 1px;
}

#center_th td 
{
    text-align: center;
    font-weight: bold;
}

#gray 
{
    background-color: #E3E3E3;
}

#img 
{
    display: block;
    margin-left: 150px;
}

/* จัดตำแหน่งชื่อบริษัท */
.center_com 
{
    padding: 70px;
}

#set_id 
{
    width: 10px;
}

#set_button 
{
    font-size: 16px;
}

/* จัดระยะห่างระหว่างปุ่ม */
.btn 
{
    margin-right: 1rem;
    margin-left: 1rem;
}

#width_col 
{
    white-space: initial !important;
}
</style>
<!-- End CSS -->

<!-- Javascript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script type="text/javascript">
</script>
<!-- End Javascript -->

<!-- html -->
<!-- Evaluation form -->
<div class="container-fluid py-4">
    <div class="card" id="border-radius">
        <div class="card-header">
            <h2>Result (ผลคะแนนการประเมิน) </h2> 
        </div>
        <div class="card-body">
            <!-- Logo บริษัท -->
            <div class="row">
                <div class="col-sm-4">
                    <img src="<?php echo base_url() . 'assests\template\soft-ui-dashboard-main/assets/img/denso_1.png' ?>"
                        width="150" height="150">
                </div>
                <!-- ชื่อบริษัท -->
                <div class="col-sm-8 center_com">
                    <h4><?php echo $arr_nominee[0]->Company_name ?></h4>
                </div>
            </div>
            <!-- ชื่อกรรมการ และวันประเมิน -->
            <div class="row">
                <div class="col-sm-6">
                    <h6>Assessor Name :
                        <?php echo $obj_assessor[0]->Empname_eng. ' ' . $obj_assessor[0]->Empsurname_eng?></h6>
                </div>
                <div class="col-sm-6">
                    
                    <h6>Date : 
                        <?php
                            $newDate = date("d/m/Y", strtotime($arr_per[0]->per_date));
                            // echo $obj_group[0]->grp_date;
                            echo $newDate;
                        ?>
                    </h6>
                </div>
            </div>

            <!-- Start data Nominee form evaluation -->
            <div class="table-responsive">
                <!-- Start form evaluation -->
                <form action="action=<?php echo site_url() ?>Evaluation/Evaluation/insert_evaluation_form" method="post"
                    enctype="multipart/form-data" name="evaluation">
                    <table class="table table-bordered table-sm">
                        <tr id="Manage">
                            <th colspan="5" id="gray">
                                <center><b>Stretch Assignment Evaluation Form
                                        (<?php echo $obj_promote[0]->Position_name?>) </b>
                        </tr>
                        <tbody>
                            <tr id="Manage">
                                <!-- ชื่อ-นามสกุล Nominee -->
                                <th width="50px" id="gray">Name - Surname</th>
                                <td colspan="2">
                                    <?php echo $arr_nominee[0]->Empname_eng. ' ' . $arr_nominee[0]->Empsurname_eng?>
                                </td>
                                <!-- ตำแหน่ง Nominee -->
                                <th width="40px" id="gray">Position</th>
                                <td>
                                    <?php echo $arr_nominee[0]->Position_name?>
                                </td>
                            </tr>
                            <tr id="Manage">
                                <!-- แผนก Promote to -->
                                <th width="40px" id="gray">Promote to</th>
                                <td colspan="2">
                                    <?php echo $obj_promote[0]->Position_name?>
                                </td>
                                <!-- แผนก Nominee -->
                                <th width="40px" id="gray">Department/Section</th>
                                <td>
                                    <?php echo $arr_nominee[0]->Department?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End table data Nominee -->
                    <br>

                    <!-- Start evaluation form -->
                    <div class="table-responsive">
                        <!-- Start table evaluation form -->
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr id="center_th">
                                    <td rowspan="2" width="300px" id="width_col"
                                        style="vertical-align:middle;text-align: center;">ITems</td>
                                    <td rowspan="2" width="800px" id="width_col"
                                        style="vertical-align:middle;text-align: center;">Points for observation</td>
                                    <td style="vertical-align:middle;text-align: center;">% weight</td>
                                    <td style="vertical-align:middle;text-align: center;">Rating(B)</td>
                                    <td width="100px" style="vertical-align:middle;text-align: center;">Score</td>
                                </tr>
                                <tr id="center_th">
                                    <td>(A)</td>
                                    <td>[Fill score 1-5]</td>
                                    <td>(AxB)</td>
                                </tr>
                                <!--เริ่ม ตารางหัวข้อลงคะแนน-->
                                <?php $count_discription = 0;  //จำนวนหัวข้อย่อยจริงๆเป็นของอันเก่าไม่ต้องทำแต่ขี้เกียจแก้
                                $count_itm = 1; //จำนวนหัวข้อหลัก
                                $weight = 0;
                                $total=0;
                                $total_weight=0;
                                $total_percent=0;
                                for ($i = 0; $i < count($arr_des); $i++) {
                                    $weight =  $weight + $arr_des[$i]->des_weight;
                                } //นับคะแนนเต็ม
                                // print_r($count_itm);
                                ?>
                                <input type="hidden" id="count_form" value='<?php echo count($arr_item) ?>'>
                                <?php 
                                for ($i = 0; $i < count($arr_item); $i++) { //ลูปตามหัวข้อหลัก?>
                                <?php $count_rowspan = 0;
                                    for ($loop_rowspan = 0; $loop_rowspan < count($arr_des); $loop_rowspan++) {
                                        if ($arr_des[$loop_rowspan]->des_item_id == $arr_item[$i]->itm_id) {
                                            $count_rowspan++;
                                        }
                                    } //นับ discription เพื่อกำหนด rowspan ?>
                                    
                                    <input type="hidden" value="<?php echo $count_rowspan; ?>" name="row[]"
                                        id="dis_row_<?php echo  $i ; ?>">
                                    <?php $loop_dis = 1;
                                    while ($loop_dis <= $count_rowspan) { ?>
                                        <tr>
                                            <!--แสดง Item -->
                                            <?php if ($loop_dis === 1) { ?>
                                                <td rowspan="<?php echo $count_rowspan; ?>"
                                                    style="vertical-align:middle;text-align: center; width: 50px;" id="width_col">
                                                    <?php echo $arr_item[$i]->itm_name; ?>
                                                    <br><?php echo $arr_item[$i]->itm_item_detail; ?></b>
                                                </td>
                                            <?php } ?>

                                            <!-- แสดง Disription -->
                                            <td id="width_col">
                                                <?php $pos = strrpos($arr_des[$count_discription]->des_description_eng, "."); //ตัดประโยคโดยหา"."
                                                    echo substr($arr_des[$count_discription]->des_description_eng, 0, $pos + 1); ?>
                                                    <br>
                                                <?php echo substr($arr_des[$count_discription]->des_description_eng, $pos + 1, strlen($arr_des[$count_discription]->des_description_eng)) ?>
                                                <?php echo $arr_des[$count_discription]->des_description_th ?>
                                            </td>

                                            <!-- แสดง % Weight -->
                                            <td style="vertical-align:middle;text-align: center;">
                                                <?php echo $arr_des[$count_discription]->des_weight;
                                                 $total +=$arr_des[$count_discription]->des_weight*5; ?>
                                            </td>
                                        
                                            <!-- แสดง point -->
                                            <td style="vertical-align:middle;text-align: center;">
                                               <?php echo $arr_point[$count_discription]->ptf_point;
                                               $total_weight +=$arr_point[$count_discription]->ptf_point*$arr_des[$count_discription]->des_weight;?>
                                            </td>
                                                

                                            <!-- แสดง Score -->
                                            <td colspan="2" style="vertical-align:middle;text-align: center;">
                                                <?php echo $arr_point[$i]->ptf_point*$arr_des[$count_discription]->des_weight;
                                                $total_percent +=$arr_point[$i]->ptf_point*$arr_des[$count_discription]->des_weight;?>
                                            </td>
                                               
                                        <?php $count_discription++;
                                        $loop_dis++; ?>
                                    <?php } ?>
                                    <!-- end loop while -->
                                    
                                    </tr>
                                <?php } ?>
                                 
                                <tr>
                                    <!-- แสดง total -->
                                    <td colspan="2" align='right'><b>Total</b></td>
                                    <!-- แสดง total   -->
                                    <td align='center'><?php echo  $total; ?></td>
                                    <!-- แสดง point รวม -->
                                    <td align='center'>
                                    <?php echo  $total_weight ; ?>
                                    </td>
                                    <!-- แสดงเปอร์เซ็นคะแนนรวมทั้งหมด -->
                                    <td align='center'>
                                   <?php echo  number_format( ($total_weight/$total*100) , 2) ;  ?>%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End table evaluation form -->
                        <br>

                        <!-- Comment -->
                        <div class="form-group">
                            <label for="comment"><b style="font-size: 15px;">Comment :</b></label>
                            <textarea class="form-control" rows="5" id="comment" type="text" name="comment"
                                disabled> <?php echo $arr_per[0]->per_comment ; ?> </textarea>
                        </div>
                        <br>
                        <!-- Q/A -->
                        <div class="form-group">
                            <label for="QnA"><b style="font-size: 15px;">Q/A :</b></label>
                            <textarea class="form-control" rows="5" id="QnA" type="text" name="QnA"
                            disabled><?php echo $arr_per[0]->per_q_and_a  ?> </textarea>
                        </div>
                        <br>
                       

                        <!-- Back button -->
                        <a class="nav-link" href="<?php echo site_url() . 'Result/Result/show_result_group'; ?>">
                        <div class="col-6 text-end">
                            <button type="button" class="btn bg-gradient-secondary mb-0" data-bs-toggle="modal"
                                data-bs-target="#Modal_confirm">Back
                            </button>
                        </div>
                                            </a>
                    </div>
                </form>
                <!-- End form evaluation -->
            </div>
            <!-- End data form evaluation -->
        </div>
        <!-- End class card-body -->
    </div>
    <!-- End class card -->
</div>
<!-- End class container -->
<!-- End html -->