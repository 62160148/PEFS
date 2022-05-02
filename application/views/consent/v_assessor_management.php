<!--
    * v_assessor_management
    * display for assessor management by add or delete information
    * @input  Group name, Level, Position to promote, Type evaluation
    * @output Group assessor list
    * @author Thitima Popila
    * @author Apinya Phadungkit
    * Create date 2565-01-25   
    * Update date 2565-02-01
    * Update date 2565-03-08
    * Update date 2565-03-09
    * Update date 2565-04-18
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    <!-- CSS -->
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
    </style>
    <!-- End CSS -->

    <!-- Start Content Assessor Management -->
    <div class="container-fluid py-4">
        <div class="card-header">
            <!-- Title page -->
            <h2>Assessor Management (จัดการกรรมการ)</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <!-- ปุ่มดำเนินการเพิ่มกลุ่มกรรมการ -->
                    <main class="main-content position-relative max-height-vh-100 h-100 ">
                        <!-- Navbar -->
                        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-2 shadow-none border-radius-xl"
                            id="navbarBlur" navbar-scroll="true">
                            <div class="container-fluid py-1 px-3">
                                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                        <div class="input-group">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn bg-gradient-info btn-block mb-3"
                                                data-bs-toggle="modal" data-bs-target="#ModalAddGroup">
                                                <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Group
                                            </button>
                                            <!-- End Button trigger modal -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <!-- End Navbar -->
                        <!-- ปุ่มดำเนินการเพิ่มกลุ่มกรรมการ  -->

                        <!-- Start content in table -->
                        <div class="card-body px-0 pt-0 pb-2">
                            <table class="table align-items-center" id="list_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group</th>
                                        <th>Group Name</th>
                                        <th>Promote</th>
                                        <th>Type Evaluation </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($arr_group); $i++) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ลำดับของกลุ่มกรรมการ -->
                                                <h6 class="text-xs mb-0">
                                                    <?php echo $i + 1 ?>
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- T ของกลุ่มกรรมการ -->
                                                <h6 class="text-xs mb-0">
                                                    <?php echo 'T' . $arr_group[$i]->asp_level ?>
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ชื่อของกลุ่มกรรมการ -->
                                                <h6 class="text-xs mb-0">
                                                    <?php echo $arr_group[$i]->asp_name ?>
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ตำแหน่งของกลุ่มกรรมการ -->
                                                <h6 class="text-xs mb-0">
                                                    <?php
                                                        echo '-';
                                                        echo ' ' . $arr_group[$i]->Position_name;
                                                        echo "<br/>";
                                                    ?>
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- Type evaluation ของกลุ่มกรรมการ -->
                                                <h6 class="text-xs mb-0">
                                                    <?php echo "Type " . $arr_group[$i]->asp_type ?>
                                                </h6>
                                                <h6 class="text-xs mb-0">
                                                    <?php echo $arr_group[$i]->asp_type . ' Round evaluation' ?>
                                                </h6>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <?php
                                                if ($arr_group[$i]->asp_status == '-1') {
                                                ?>
                                            <!-- Start button trigger modal edit -->
                                            <!-- ปุ่มดำเนินการแก้ไข แบบแบบแก้ไขไม่ได้เพราะยังไม่มีการประเมิน -->
                                            <a
                                                href="<?php echo site_url() . 'Assessor_management/Assessor_management/show_assessor_management_detail/' . $arr_group[$i]->asp_id; ?>">
                                                <!-- ปุ่มดำเนินการแก้ไข -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#ModalDeleteAssessor">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            <!-- End button trigger modal edit-->

                                            <!-- Start button trigger modal delete -->
                                            <!-- ปุ่มดำเนินการลบ แบบลบได้เพราะยังไม่มีการประเมิน -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#ModalDeleteGroup<?php echo $i; ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <!-- End button trigger modal delete -->
                                            <?php
                                                } else {
                                                ?>
                                            <!-- Start button trigger modal edit -->
                                            <!-- ปุ่มดำเนินการแก้ไข แบบแบบแก้ไขไม่ได้เพราะมีการประเมินแล้ว -->
                                                <!-- ปุ่มดำเนินการแก้ไข -->
                                                <button type="button" class="btn btn-secondary " disabled>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            <!-- End button trigger modal edit-->

                                            <!-- Start button trigger modal delete -->
                                            <!-- ปุ่มดำเนินการลบ แบบลบไม่ได้เพราะมีการประเมินแล้ว -->
                                            <button type="button" class="btn btn-secondary " disabled>
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <!-- End button trigger modal delete -->
                                            <?php
                                                }
                                                ?>
                                        </td>
                                    </tr>


                                    <!-- Start modal delete group assessor -->
                                    <div class="modal fade" id="ModalDeleteGroup<?php echo $i; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="ModalDeleteGroupTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="col-12 text-end">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="py-3 text-center">
                                                        <div>
                                                            <i class="fas fa-exclamation-triangle fa-8x"
                                                                style="color:#FBD418"></i>
                                                        </div>
                                                        <h4 class="text-gradient text-danger mt-4">
                                                            Confirm Delete
                                                            <br>
                                                            <?php echo "Assessor Group Name: " . $arr_group[$i]->asp_name . '?' ?>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    <!-- ปุ่มยกเลิกการลบ -->
                                                    <a href="">
                                                        <button type="button" class="btn bg-gradient-danger"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </a>
                                                    <!-- ปุ่มยืนยันการลบ -->
                                                    <a
                                                        href="<?php echo base_url() . 'Assessor_management/Assessor_management/delete_group_assessor/' . $arr_group[$i]->asp_id; ?>">
                                                        <button type="button"
                                                            class="btn bg-gradient-success">Confirm</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal delete group assessor -->
                                    <?php
                                    }
                                    ?>
                                    <!-- Start modal add group assessor -->
                                    <div class="modal fade" id="ModalAddGroup" tabindex="-1" role="dialog"
                                        aria-labelledby="ModalAddGroupTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalAddGroupLabel">Add Group</h5>&nbsp;
                                                    <i class="fas fa-user-plus fa-1x"></i>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <!-- Input Group name -->
                                                            <label for="recipient-name" class="col-form-label">Group
                                                                Name</label>
                                                            <input type="text" class="form-control" id="recipient-name"
                                                                name="group_name" placeholder="Input Group Name....">
                                                        </div>
                                                        <div class="form-group">
                                                            <!-- Select Group level -->
                                                            <label for="year" class="col-form-label">Level</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" id="group_position"
                                                                name="year" onchange="get_position(),change_type()">
                                                                <option disabled selected>Choose level please...
                                                                </option>
                                                                <option value="6">T6</option>
                                                                <option value="5">T5</option>
                                                                <option value="4">T4</option>
                                                                <option value="3">T3</option>
                                                                <option value="2">T2</option>
                                                            </select>
                                                            <br>
                                                            <div>
                                                                <!-- Choose Position to promote -->
                                                                <label for="Position"
                                                                    class="col-form-label">Position</label>
                                                                <ul class="custom-control-input" id="position_list"
                                                                    name="position_list">
                                                                </ul>
                                                                <input type="text" id="count_pos" hidden>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <!-- Type evaluation -->
                                                            <label for="recipient-name" class="col-form-label">Type
                                                                Evaluation</label><br>
                                                            <input type="text" id="type_evaluation" name="group_type"
                                                                class="form-control" disabled
                                                                value="Type 1: (1 round evaluation)">
                                                        </div>
                                                        <br>

                                                        <div class="modal-footer">
                                                            <!-- Button Cancel ยกเลิกการสร้างกลุ่มกรรมการ -->
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <!-- End Button Cancel -->

                                                            <!-- Button Submit ยืนยันการสร้างกลุ่มกรรมการ -->
                                                            <button type="button" class="btn btn-success"
                                                                onclick="add_sec()">Submit</button>
                                                            <!-- End Button Submit -->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End modal add group assessor -->

                                </tbody>
                            </table>
                        </div>
                        <!-- End content in table -->
                </div>
                <!-- End div card -->
            </div>
            <!-- End div col-12 -->
        </div>
        <!-- End div row -->
    </div>
    <!-- End Conten Assessor Management -->
</body>

</html>

<!-- JavaScript -->
<script>
/**
 * This function is Data Table
 */
$(document).ready(function() {
    $("#list_table").DataTable();
});

/**
 * This function is used to get the position name from the database.
 */
function get_position() {
    // $("#position_list").empty();
    var count_pos = 0;
    position_level_id = document.getElementById('group_position').value;
    document.getElementById("position_list").innerHTML = "";
    var empname = "";
    console.log(position_level_id)
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Employee/Get_nominee/get_position ",
        data: {
            "position_level_id": position_level_id,
        },
        dataType: "JSON",
        success: function(data, status) {
            var i = 0;
            console.log(data);
            data.forEach((row, index) => {
                $("#position_list").append('<input type="checkbox" id="pos' + i++ + '" value="' +
                    row.Position_ID +
                    '"><a href="#">' + ' ' + row.Position_name +
                    '</a><br></input>');

                count_pos++;
                console.log(count_pos);
                document.getElementById('count_pos').value = count_pos;
            })
        },
        error: function(error) {
            console.log('error');

        }

    });
}

/**
 * *This function changes the type of evaluation based on the position level.*
 * 
 * *This function is called when the user changes the position level.*
 */
function change_type() {
    position_level_id = document.getElementById('group_position').value;
    if (position_level_id <= 4) {
        document.getElementById("type_evaluation").value = "Type 2: (2 round evaluation)";
    } else {
        document.getElementById("type_evaluation").value = "Type 1: (1 round evaluation)";
    }
}
</script>


<script>
/**
 * This function is used to add group assessor in database.
 */
function add_sec() {
    // console.log("1111");
    var group_name = document.getElementById('recipient-name').value;
    var group_level = document.getElementById('group_position').value;
    var group_type = document.getElementById('type_evaluation').value;

    console.log(group_name);
    console.log(group_level);
    console.log(group_type);


    count_pos = document.getElementById('count_pos').value;
    pos = [];

    if (count_pos != 0) {
        for (i = 0; i < count_pos; i++) {
            if (document.getElementById("pos" + i).checked) {
                pos.push(document.getElementById("pos" + i).value)
            } //if
        }
        //for
    }
    // if

    if (group_name != "" && group_level != 0 && group_type != 0 && pos.length != 0) {
        $.ajax({
            type: "post",
            // dataType: "json",
            url: "<?php echo base_url(); ?>Assessor_management/Assessor_management/add_group_assessor",
            data: {
                "group_name": group_name,
                "group_level": group_level,
                "group_type": group_type,
                "count_pos": count_pos,
                "pos": pos
            },
            success: function(data) {
                console.log("1111");
                console.log(data);
                // Main_promote();
                window.location.href =
                    "<?php echo base_url(); ?>Assessor_management/Assessor_management/show_assessor_management";
            },
            //success
            error: function(data) {
                console.log("9999 : error");
            }
            // error
        });
        // ajax
    } // if
    else {
        $("#txt_warning_add").show();
        alert("Please fill out the information completely.");
    } // else 
}
// add_sec
</script>
<!-- End  JavaScript -->