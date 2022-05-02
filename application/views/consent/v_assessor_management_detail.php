<!--
    * v_assessor_management_detail
    * display for assessor management by add or delete information
    * @input  id
    * @output Assessor list
    * @author Apinya Phadungkit
    * Create date 2565-01-25   
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

    <!-- JavaScript -->
    <script>
        //Data Table
        $(document).ready(function() {
            $("#list_table").DataTable();
        });

        //input employee id to get employee name to add assessor
        function get_Emp() {
            ase_emp_id = document.getElementById('ase_emp_id_modal').value;
            var empname = "";
            console.log(ase_emp_id)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Assessor_Management/Assessor_Management/search_by_employee_id",
                data: {
                    "ase_emp_id": ase_emp_id
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    if (data.length == 0) {
                        document.getElementById("showname_modal").value = "ไม่มีข้อมูล";
                    } else {
                        empname = data[0].Empname_eng + " " + data[0].Empsurname_eng;
                        document.getElementById("showname_modal").value = empname;
                        console.log(999)
                        console.log(empname)
                    }
                }
            });
        }
    </script>
    <!-- End JavaScript -->

    <!-- Start Content Assessor Management Detail -->
    <div class="container-fluid py-4">
        <div class="card-header">
            <!-- Title page -->
            <h2>Assessor Management (จัดการกรรมการ)</h2>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                            <?php
                                for ($i = 0; $i < count($arr_t); $i++) {
                                ?>
                                <!-- Title -->
                                <h4>Promote to T<?php echo $arr_t[0]->asp_level ?> : <?php echo $arr_t[0]->sec_name ?></h4>
                                <?php
                                }
                                ?>
                                
                            </div>
                            <div class="col-6 text-end">
                                <!-- Select Year -->
                                <!-- <div>
                                    <label for="year" style="position: absolute; right: 0;font-size:16px;">Select Year:
                                        <select id="year" name="year">
                                            <option>2021</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                        </select>
                                    </label><br><br>
                                </div> -->

                                <!-- Button trigger modal -->
                                <button type="button" class="btn bg-gradient-info btn-block mb-3" data-bs-toggle="modal" data-bs-target="#ModalAddAssessor">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Add Assessor
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Start content in table -->
                    <div class="card-body px-0 pt-0 pb-2">
                        <table class="table align-items-center" id="list_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Employee</th>
                                    <th>Assessor Name</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($arr_ass); $i++) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ลำดับของกรรมการ -->
                                                <h6 class="text-xs text-secondary mb-0"><?php echo $i + 1 ?></h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- รหัสของกรรมการ -->
                                                <h6 class="text-xs text-secondary mb-0"><?php echo $arr_ass[$i]->ase_emp_id ?></h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ชื่อและนามสกุลของกรรมการ -->
                                                <h6 class="text-xs text-secondary mb-0"><?php echo $arr_ass[$i]->Empname_eng . '  ' . $arr_ass[$i]->Empsurname_eng ?></h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ตำแหน่งของกรรมการ -->
                                                <h6 class="text-xs text-secondary mb-0"><?php echo $arr_ass[$i]->Position_name ?></h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <!-- ชื่อแผนกกรรมการ -->
                                                <h6 class="text-xs text-secondary mb-0"><?php echo $arr_ass[$i]->Department ?></h6>
                                            </div>
                                        </td>
                                        <td class="align-middle">

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteAssessor<?php echo $i; ?>">
                                                <i class="fa fa-trash"></i></button>


                                            <!-- Modal Delete Assessor-->
                                            <div class="modal fade" id="ModalDeleteAssessor<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalDeleteAssessorTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="col-12 text-end">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>


                                                        <div class="modal-body">
                                                            <div class="py-3 text-center">
                                                                <div>
                                                                    <i class="fas fa-exclamation-triangle fa-8x" style="color:#FBD418"></i>
                                                                </div>
                                                                <h4 class="text-gradient text-danger mt-4">Confirm Delete Assessor?</h4>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cancel</button>
                                                            <!-- ปุ่มดำเนินการลบ -->
                                                            <a href="<?php echo site_url() . 'Assessor_management/Assessor_management/delete_assessor' . '/' . $arr_ass[$i]->ase_emp_id . '/' . $arr_ass[$i]->ase_asp_id; ?>">
                                                                <button type="button" class="btn bg-gradient-success">Submit</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                <?php
                                }
                                ?>
                                    <!-- Modal Add Assessor-->
                                    <div class="modal fade" id="ModalAddAssessor" tabindex="-1" role="dialog" aria-labelledby="ModalAddAssessorTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalAddAssessorLabel">Add Assessor</h5>&nbsp;
                                                    <i class="fas fa-user-plus fa-1x"></i>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                                                    <form action="<?php echo site_url() . 'Assessor_Management/Assessor_Management/add_assessor' . '/' . $id; ?>" method="post">
                                                        <div class="mb-3">
                                                        
                                                            <label for="focusedinput" class="col-form-label">Employee ID</label>
                                                            <input type="text" class="form-control" name="ase_emp_id" id="ase_emp_id_modal" placeholder="Employee ID.." onkeyup="get_Emp()" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="focusedinput" class="col-form-label">Name</label>
                                                            <input type="text" class="form-control" id="showname_modal" disabled name="assessor_name">
                                                        </div>

                                                        <input type="text" class="form-control" name="sec" id="sec" value="<?php echo $sec[0]->asp_level ?>" hidden>
                                                        
                        
                                                        <div class="modal-footer">
                                                            <!-- ปุ่มดำเนินการยกเลิกการเพิ่มกรรมการ -->
                                                            <button type="button" class="btn btn-danger float-right" data-bs-dismiss="modal">Cancel</button>

                                                            <!-- ปุ่มดำเนินการเพิ่มกรรมการ -->
                                                            <button type="submit" class="btn btn-success float-right">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>
                        <!-- End content in table -->
                    </div>
                </div>
                <div class="col-12 text-end">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn bg-gradient-success mb-0" data-bs-toggle="modal" data-bs-target="#ModalConfirmAssessor">Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Assessor Management Detail -->
</body>

</html>

<!-- Modal Confirm Create Group Assessor -->
<div class="modal fade" id="ModalConfirmAssessor" tabindex="-1" role="dialog" aria-labelledby="ModalConfirmAssessorTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="col-12 text-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="py-3 text-center">
                    <div>
                        <i class="fas fa-users fa-8x" style="color:#2AA6F4"></i>
                    </div>
                    <br>
                    <h4>Confirm Create Group Assessor</h4>
                </div>
            </div>
            <div class="modal-footer">
                <!-- ปุ่มดำเนินการยกเลิกการยืนยันการเพิ่มกรรมการ -->
                <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cancel</button>

                <!-- Button trigger modal -->
                <!-- ปุ่มดำเนินการยืนยันการยืนยันการเพิ่มกรรมการ -->
                <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#ModalConfirmAssessorSuccess" id="btn_success">Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Create Group Assessor Success-->
<div class="modal fade" id="ModalConfirmAssessorSuccess" tabindex="-1" role="dialog" aria-labelledby="ModalConfirmAssessorSuccessTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="col-12 text-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="py-3 text-center">
                    <div>
                        <i class="fas fa-check-circle fa-8x" style="color:#80F04F"></i>
                    </div>
                    <br>
                    <h4>Success</h4>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo site_url() . 'Assessor_management/Assessor_management/show_assessor_management'; ?>">
                    <!-- ปุ่มดำเนินการรับทราบการเพิ่มกรรมการ -->
                    <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal">OK</button>
                </a>
            </div>
        </div>
    </div>
</div>