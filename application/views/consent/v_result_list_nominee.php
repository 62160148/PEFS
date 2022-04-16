<!--
    v_result_group_assessor
    display for review list
    @input -
    @output -
    @author Ponprapai Atsawanurak and Phatchara Khongthandee
    Create date 2565-01-25
    Update date 2565-01-28
-->
<!-- CSS -->
<style>
#list_table td,
#list_table th {
    padding: 8px;
    text-align: center;
}

#list_table tr:nth-child(even) {
    background-color: #e9ecef;
}

#list_table tr:hover {
    background-color: #adb5bd;
}

#card_radius {
    margin-top: 15px;
    margin-left: 14px;
    margin-right: 15px;
    margin-bottom: 15px;
    border-radius: 20px;
    min-height: 300px;
    width: auto;
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
</style>
<!-- End CSS -->

<!-- JavaScript -->

<!-- End JavaScript -->

<head>
    <meta charset="utf-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</head>
<div class="container-fluid py-4">
    <div class="card" id="card_radius">
        <div class="card-header">
            <h2>Result (ผลคะแนนการประเมิน)</h2>
        </div> 
        <h2>Promote to T<?php  echo $arr_nominee[0]->grp_position_group ?></h2>
        <!-- End cara header -->
        <div class="card-body">
            <!-- Start Table Result List -->
            <div class="table-responsive">
                <table class="table align-items-center" id="list_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee ID</th>
                            <th>Name Nominee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($arr_nominee); $i++) { ?>
                        <tr>
                            <!-- # -->
                            <td>
                                <h6 class="text-xs text-secondary mb-0">
                                    <?php echo $i+1 ?>
                                </h6>
                            </td>
                            <!-- Group Level -->
                            <td>
                                <h6 class="text-xs text-secondary mb-0"><?php echo $arr_nominee[$i]->Emp_ID ?></h6>
                            </td>
                     
                            <td>

                                <?php echo $arr_nominee[$i]->Empname_engTitle." ".$arr_nominee[$i]->Empname_eng." ".$arr_nominee[$i]->Empsurname_eng ; ?>

                            </td>
                            <!-- Action -->
                            <td>
                                <a
                                    href="<?php echo site_url() . 'Result_admin/Result_admin/show_result_all_assessor/' . $arr_nominee[$i]->Emp_ID."/".$arr_nominee[$i]->grp_id; ?>">
                                    <button type="button" class="btn btn-xs button_size"
                                        style="background-color: #596CFF;">
                                        <i class="fas fa-search text-white"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table Result List-->
        </div>
        <!-- End card body-->
    </div>
    <!-- End card-->
</div>
<!-- End class container -->


<!-- JavaScript -->
<!-- Data Table -->
<script>
$(document).ready(function() {
    $("#list_table").DataTable();
});
</script>
<!-- End Data Table -->
<!-- End JavaScript -->