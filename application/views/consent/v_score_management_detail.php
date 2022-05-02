<!-- 
    /*
    * v_score_management_detail
    * Display score norminee list in group
    * @input    -
    * @output   -
    * @author   Niphat Kuhoksiwt
    * @Create Date 2565-04-10
    * @Update Date 2565-04-14
    */ -->
<style>
    #list_table td,
    #list_table th {
        padding: 12px;
        text-align: center;
    }

    #list_table tr:nth-child(even) {
        background-color: #e9ecef;
    }

    #list_table tr:hover {
        background-color: #adb5bd;
    }

    #card_radius {
        border-radius: 20px;
        width: auto;
        min-height: 300px;
    }

    #list_table {
        width: 98%;
        margin-top: 20px;
        margin-left: 10px;
    }

    .button_size {
        /* width: 5px; */
        height: 40px;
        font-size: 12px;
        text-align: center;
    }

    .off {
        background: #D90437;
        border-radius: 4px;
        color: #FFFFFF;
        text-align: center;
        border: none;

    }

    .on {
        background: #0DD739;
        border-radius: 4px;
        color: #FFFFFF;
        text-align: center;
        border: none;

    }

    select {
        width: 10% !important;
        margin-left: 89.5%;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $('#on').on('click', function() {
            var button = document.getElementById("on");
            var num = $('input#num').attr("value");
            var grp_id = $(event.currentTarget).attr("data-grp_id");
            var round = document.getElementById("round").value;
            if(round == 1){
                if (button.value == 'on') {
                for(var i = 1; i <= num; i++) {
                    let elems = document.querySelector("#info"+i);
                    elems.disabled = true;
                }
                button.value = "off";
                button.innerHTML = "close";
                button.style.background = "#D90437";
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url().'/Score_management/Score_management/update_status_edit'; ?>",
                    data: {
                        'grp_id': grp_id,
                        'grp_status_edit': '2'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data.status)
                        location.reload();
                    } //if
                });
                
            } else {
                for(var i = 1; i <= num; i++) {
                    let elems = document.querySelector("#info"+i);
                    elems.disabled = false;
                }
                button.value = "on";
                button.innerHTML = "open";
                button.style.background = "#0DD739";
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url().'/Score_management/Score_management/update_status_edit'; ?>",
                    data: {
                        'grp_id': grp_id,
                        'grp_status_edit': '1'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data.status)
                        location.reload();
                    } //if
                });
                }
            }else if(round == 2){
                if (button.value == 'on') {
                for(var i = 1; i <= num; i++) {
                    let elems = document.querySelector("#info"+i);
                    elems.disabled = true;
                }
                button.value = "off";
                button.innerHTML = "close";
                button.style.background = "#D90437";
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url().'/Score_management/Score_management/update_status_edit'; ?>",
                    data: {
                        'grp_id': grp_id,
                        'grp_status_edit': '3'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data.status)
                        location.reload();
                    } //if
                });
                
            } else {
                for(var i = 1; i <= num; i++) {
                    let elems = document.querySelector("#info"+i);
                    elems.disabled = false;
                }
                button.value = "on";
                button.innerHTML = "open";
                button.style.background = "#0DD739";
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url().'/Score_management/Score_management/update_status_edit'; ?>",
                    data: {
                        'grp_id': grp_id,
                        'grp_status_edit': '1'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data.status)
                        location.reload();
                    } //if
                });
                }
            }
        });
    });
    $(document).ready(function() {
        var b = document.querySelector("select");
        //b.setAttribute("value", "1");
        //$('#round').on('change', function() {
            var round = document.getElementById("round").value;
            var grp_id = $("#round").attr("data-grp_id");
            console.log(round)
            $.ajax({
                type: "post",
                url: "<?php echo site_url().'/Score_management/Score_management/get_round'; ?>",
                data: {
                    'grp_id': grp_id,
                    'grd_round': '1'
                },
                dataType: "JSON",
                success: function(data) {
                    console.log("success")
                }
            });
       // });
    });

</script>


<div class="card-header" id="card_radius">
    <h2>
        Score Management Group (การจัดการคะแนนกลุ่ม)
    </h2>
    <div class="row">
        <div class="col">
            <h3>Detail Group <label for="cars" style="font-size : 20px;margin-left : 69%">Group Status:</label>
            <?php if($group[0]->grp_status_edit == 1){ 
                ?>
                <button type="button" class="float-right on" style="text-align: center;" id="on" value="on" data-grp_id="<?php echo $group[0]->grp_id ?>">
                open
                <!-- <i class="fas fa-circle" style="font-size:30px; "></i> -->
            </button>
            <?php }else if($group[0]->grp_status_edit == 2||$group[0]->grp_status_edit == 3){
                ?>
                <button type="button" class="float-right off" style="text-align: center;" id="on" value="on" data-grp_id="<?php echo $group[0]->grp_id ?>">
                close
            <?php } ?>
                
            </h3>
            <hr class="my-4" color="gray">
            <h4 class="mb-0">Group : <?php echo 'T' . $group[0]->grp_position_group ?>
                <label for="cars" style="font-size : 20px;margin-left : 80%">Select Round :</label>
                <select name="round" class="form-control" id="round" data-grp_id="<?php echo $group[0]->grp_id ?>">
                    <option value="1" >Round 1 </option>
                    <option value="2" >Round 2 </option>
                </select>
            </h4>
                <h5 class="mb-0">Group Name : <?php echo $group[0]->asp_name ?></h5>
                <h5 class="mb-0">Promote : <?php echo $group[0]->Position_name ?></h5>
                <h5 class="mb-0">Date : <?php echo date("d/m/Y", strtotime($as_group_date[0]->grd_date)) ?></h5>
                <hr class="my-4" color="gray">
        </div>


        <!-- Light table -->
        <div class="table-responsive">
            <table class="table align-items-center text-center" id="Score">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="name">#</th>
                        <th scope="col" class="sort" data-sort="name">Nominee ID</th>
                        <th scope="col" class="sort" data-sort="name">Nominee name</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                        <th scope="col">Assessor</th>
                        <th scope="col" class="sort" data-sort="completion">Summary Score</th>
                        <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody class="list text-center">
                    <?php for ($i = 0; $i < count($nominee); $i++) { ?>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="name mb-0 text-sm"><?php echo $i + 1 ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="budget">
                                <?php echo $nominee[$i]->Emp_ID ?>
                                <input type="text" id="<?php echo 'emp_id_' . $i ?>" value=" <?php echo $nominee[$i]->Emp_ID ?>" hidden onchange="get_evaluation(<?php echo $nominee[$i]->Emp_ID ?>)">
                            </td>
                            <td>
                                <span class="name mb-0 text-sm">
                                    <!-- <i class="bg-warning"></i> -->
                                    <span class="status"><?php echo $nominee[$i]->Empname_eng . ' ' . $nominee[$i]->Empsurname_eng ?></span>
                                </span>
                            </td>
                            <td>
                                <?php
                                if ($count[$i] == count($assessor)) {
                                ?>
                                    <?php if ($nominee[$i]->grn_status_result == 1) { ?>
                                        <span class="name mb-0 text-sm">
                                            <i class="bg-success"></i>
                                            <span class="status"><?php echo 'Pass' ?></span>
                                        </span>
                                    <?php }
                                    if ($nominee[$i]->grn_status_result == 2) { ?>
                                        <span class="name mb-0 text-sm">
                                            <i class="bg-danger"></i>
                                            <span class="status"><?php echo 'Fail' ?></span>
                                        </span>
                                    <?php  }
                                }
                                if ($nominee[$i]->grn_status_result != 1 && $nominee[$i]->grn_status_result != 2) { ?>
                                    <span class="name mb-0 text-sm">
                                        <span class="status"><?php echo 'Pending Assess' ?></span>
                                    </span>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="avatar-group">

                                    <span id="<?php echo 'demo_' . $i ?>" class="User"><?php echo $count[$i] ?>/<?php echo count($assessor) ?></span>
                                </div>
                            </td>
                            <td>

                                <?php
                                if ($count[$i] == count($assessor)) {
                                    if ($nominee[$i]->grn_status_done == 0 || $nominee[$i]->grn_status_done == 1 || $nominee[$i]->grn_status_result == 1 || $nominee[$i]->grn_status_result == 2) { ?>
                                        <?php
                                        $index_point = 0;
                                        ?>

                                        <b>Totally score : </b><?php echo $point_data[$i]->sum_total ; ?> points<br>
                                        <b>Get score : </b><?php echo $point_data[$i]->point; ?> points<br>
                                        <?php $percent = $point_data[$i]->point * 100 / $point_data[$i]->sum_total; ?> 
                                        <div class="d-flex align-items-center" style="margin-left:18%;">
                                            <span class="completion"><?php echo number_format($percent, 2, '.', ''); ?>
                                                %</span>
                                            <div>
                                                <?php if ($percent >= 60) { ?>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent . '%' ?>;">
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent . '%' ?>;">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        </div>
                                    <?php } else { ?>
                                        <span class="completion mr-2"><?php echo number_format(0, 2, '.', ''); ?> %</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo '0' . '%' ?>;">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </td>
                            <!-- <td>
                                <div class="dropdown">
                                    <input type="text" value="<?php echo count($nominee) ?>" id="num" hidden>
                                    <button type="button" class="btn btn-warning button_size" data-bs-toggle="modal" data-bs-target="#ModalAddGroup" id="info<?php echo $i+1 ?>" >
                                        <i class="fa fa-refresh" style="font-size:15px;"></i>
                                    </button>
                                </div>
                            </td> -->
                        </tr>
                        <div class="modal fade" id="ModalAddGroup" tabindex="-1" role="dialog" aria-labelledby="ModalAddGroupTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="ModalAddGroupLabel">Manage Group review</h2>&nbsp;
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" style="font-size:20px;">Date : </label>
                        <input type="date" id="date" style="font-size:20px;" class="form-control" value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>"><br>
                        <input type="text" id="Emp_id" name="emp_id" class="form-control" value="<?php echo $nominee[$i]->Emp_ID ?>" hidden>
                        <input type="text" id="position_group" name="position_group" class="form-control" value="<?php echo $group[0]->grp_position_group ?>" hidden>
                        <input type="text" id="group" name="group" class="form-control" value="<?php echo $nominee[$i]->grn_promote_to ?>" hidden>
                        <input type="text" id="grp_id" name="grp_id" class="form-control" value="<?php echo $group[0]->grp_id ?>" hidden>
                    </div>

                    <div class="modal-footer" style="margin-right : 29.5%">
                        <!-- ปุ่มปิด modal -->
                        <a href="">
                            <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Close</button>
                        </a>
                        <!-- ปุ่มบันทึก -->
                        <a href="">
                        <!-- <a href="<?php echo site_url() . 'Score_management/Score_management/review/';?>"> -->
                            <button type="button" class="btn bg-gradient-success">Submit</button>
                        </a>
                    </div>
            </div>
        </div>
    </div>
    <?php } ?>
    </tbody>
    </table>
    </div>
</div>
</div>

    <script>
        $(document).ready(function() {
            $('#Score').DataTable();
            console.log(999);
        });
    </script>
    </script>
    <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../../assets/js/argon.js?v=1.2.0"></script>
    <script type="text/javascript">