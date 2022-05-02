<!-- /* The above code is adding a new row to the table. */ -->
<!--
    * v_group_management_add_group
    * display for group management
    * @input  -
    * @output -
    * @author Jirayut Saifah
    * Create date 2565-01-27   
    * Update date 
-->
<style>
select {
    width: 100% !important;
}

input {
    width: 30% !important;
}
</style>
<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<!-- bootstrap -->
<!-- Data table -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<!-- Data table -->
<!-- sweet alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="sweetalert2.all.min.js"></script>
<!-- sweet alert -->
<script>
document.getElementById("date").innerHTML = Date();

/* Using jQuery to make an AJAX call to a PHP function. */
function get_Emp() {
    Emp_id = document.getElementById('Emp_id_modal').value;
    var empname = "";
    console.log(Emp_id)
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Employee/Get_nominee/search_by_employee_id ",
        data: {
            "Emp_id": Emp_id,
        },
        dataType: "JSON",
        success: function(data, status) {
            console.log(data);
            if (data.length == 0) {
                document.getElementById("showname_modal").value = "ไม่มีข้อมูล";
            } else {
                department = data[0].Department;
                // empname = data[0].Position_name;
                empname = data[0].Empname_eng + " " + data[0].Empsurname_eng;
                position = data[0].Position_name;
                document.getElementById("showname_modal").value = empname;
                document.getElementById("position_nominee").value = position;
                document.getElementById("department_nominee").value = department;
                console.log(999)
                console.log(empname)
                console.log(position)
                // console.log(Position_ID)
                console.log(department)
            }
        }
    });
}
</script>

<?php
date_default_timezone_set("Asia/Bangkok");
?>
<div class="container-fluid py-4">
    <div class="card-header">
        <h2>Group Management (การแก้ไขกลุ่มการประเมิน)</h2>
        <input type="text" id="old_id" value="<?php echo $id ?>" hidden>
        <input type="text" id="gro_asp_id" value="<?php echo $asp_id ?>" hidden>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 style="font-size:20px;">Group</h6>
                            <div class="row">
                                <div class="col">
                                    <label for="year" style="font-size:20px;">Level :
                                        <select id="group_position" name="year" class="form-control"
                                            onchange="get_position(),change_type(),change_button_status(),get_position_to_promote(),change_date()">
                                            <option value="-1">Please select level</option>


                                        </select>
                                    </label>
                                </div>
                                <div class="col">
                                    <label for="year" style="font-size:20px;">Year :
                                        <select id="year" class="form-control" name="year" onchange="get_assessor()">

                                        </select>
                                    </label>
                                </div>
                                <div class="col">

                                    <select id="group_name" name="year" class="form-control" hidden>
                                    </select>

                                </div>


                            </div>
                            <div>
                                <label for="Position" style="font-size:20px;">Position</label>
                                <ul style="font-size:20px;" id="position_list">
                                </ul>
                            </div>
                            <div>
                                <label for="year" style="font-size:20px;">Type Evaluation</label><br>
                                <input type="text" class="form-control" id="type_evaluation" style="font-size:20px;"
                                    disabled value="Type 1: (1 round evaluation)">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <label for="year" style="font-size:20px;">Date Round 1 :</label><br>
                                        <input type="date" class="form-control" id="date" style="font-size:20px;"
                                            value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>"><br>

                                    </div><br><br>

                                </div>
                                <div class="col" id="date2">
                                    <div>
                                        <label for="year" style="font-size:20px;">Date Round 2 :</label><br>
                                        <input type="date" class="form-control" id="date_2" style="font-size:20px;"
                                            value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>"><br>

                                    </div><br><br>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 style="font-size:20px;">Assessor</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="assessor_table" class="table align-items-center justify-content-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="text-align:center">#</th>
                                            <th style="text-align:center">
                                                <input type="checkbox" onclick="select_all(this);">
                                                All
                                            </th>
                                            <th style="text-align:center">Employee ID</th>
                                            <th style="text-align:center">Assessor Name</th>
                                            <th style="text-align:center">Position</th>
                                            <th style="text-align:center">Department</th>

                                        </tr>
                                    </thead>
                                    <tbody id="select_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 style="font-size:20px;">Nominee</h6>
                        </div>
                        <div>

                            <button class="btn bg-gradient-info btn-block mb-3" id="btn_add_nominee"
                                style="position: absolute; right: 0;" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                Add Nominee</button>
                            <br><br>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Nominee</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="emp_id" style="font-size:20px;">Employee ID</label><br>
                                            <input type="number" id="Emp_id_modal" class="form-control"
                                                style="font-size:20px;" onkeyup="get_Emp()"><br>
                                            <label for="emp_id" style="font-size:20px;">Name</label><br>
                                            <input type="text" class="form-control" id="showname_modal"
                                                class="form-control" style="font-size:20px;width:100% !important"
                                                disabled><br>
                                            <input type="text" id="position_nominee" hidden>
                                            <input type="text" id="department_nominee" hidden>
                                            <label for="year" style="font-size:20px;">Promote to
                                                <br> <select id="promote_nominee" class="form-control" name="year">
                                                    <option>Please select promote</option>

                                                </select>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Cancle</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                                id="add">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="nominee_table" class="table align-items-center justify-content-center mb-0">
                                    <thead class="thead-light">
                                        <tr>

                                            <th style="text-align:center">Employee ID</th>
                                            <th style="text-align:center">Nominee Name</th>
                                            <th style="text-align:center">Department</th>
                                            <th style="text-align:center">Promote to</th>
                                            <th style="text-align:center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="nominee_data">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-12 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-success mb-0" data-bs-toggle="modal"
                    data-bs-target="#ModalConfirmAssessor" onclick="alert()">Submit
                </button>
            </div>
        </div>




        <script>
        var emp_as = [];
        $(document).ready(function() {
            var grp_id = document.getElementById("old_id").value;
            var group_id = document.getElementById("old_id").value;
            var ase_id = id;
            get_group_detail()
            get_position()
            promote = document.getElementById("promote_nominee").value;
            const d = new Date();
            $("#date2").hide();
            let years = d.getFullYear();
            console.log('option')
            years = years - 2
            // var x = document.getElementById("year");
            // var option = document.createElement("option");
            for (i = 0; i < 5; i++) {
                if (years == d.getFullYear()) {
                    var x = document.getElementById("year");
                    var option = document.createElement("option");
                    option.text = years;
                    option.value = years;
                    option.selected = true;
                    years++
                    x.add(option);
                    console.log(i)
                } else {
                    var x = document.getElementById("year");
                    var option = document.createElement("option");
                    option.text = years;
                    option.value = years;
                    years++
                    x.add(option);
                    console.log(i)
                }

            }
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_assessor/get_group_level ",
                data: {},
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    var id = document.getElementById("gro_asp_id").value
                    console.log("id =" + id)
                    data.forEach((row, index) => {
                        if (id == row.asp_level) {
                            var x = document.getElementById("group_position");
                            var option = document.createElement("option");
                            option.text = row.asp_name;
                            option.value = row.asp_level;
                            option.selected = true;
                            x.add(option);
                            console.log("id =" + id)
                        } else {
                            var x = document.getElementById("group_position");
                            var option = document.createElement("option");
                            option.text = row.asp_name;
                            option.value = row.asp_level;
                            x.add(option);
                            console.log("id =" + 4)
                        }

                        change_button_status()
                        change_type()
                        change_date()
                        get_assessor()
                        get_position_to_promote()
                    })

                }
            });
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_assessor/get_assessor_by_group ",
                data: {
                    "group_id": grp_id,
                    "ase_id": ase_id
                },
                dataType: "JSON",

                success: function(data, status) {
                    console.log('dara1')
                    console.log(data)
                    data.forEach((row, index) => {
                        emp_as.push(row.gro_ase_id)
                    });
                    get_assessor()
                }

            });
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>Employee/Get_nominee/get_nominee_by_id",
                data: {
                    "group_id": group_id
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    var i = 1;
                    var data_row = '';
                    var count_index = 0;
                    data.forEach((row, index) => {
                        var data_row = "";
                        //pos_id = get_position_id(promote);
                        //console.log(pos_id);
                        data_row += '<tr id="emp_' + num + '">';
                        data_row += '<td id="Emp_id_' + num +
                            '" style="text-align:center">' + row.Emp_ID + '</td>';
                        data_row += '<td style="text-align:center" >'
                        data_row += row.Empname_eng + " " + row
                            .Empsurname_eng +
                            '</td>';
                        data_row += '<td style="text-align:center">' + row.Department +
                            '</td>';
                        data_row += '<td style="text-align:center" id="Promote_' + num +
                            '">' + row.Position_name + '</td>';
                        data_row += '<td style="text-align:center"> ' +
                            '<button class="btn btn-danger" onclick = "remove_row(' + num +
                            ') " >delete</button></td>';
                        index_emp.push(num);
                        console.log(index_emp);
                        num++

                        $("#nominee_data").append(data_row);
                        count_nominee++;
                        console.log(count_nominee);
                    })
                    // $("#nominee_data").html(data_row)
                }
            })
            change_button_status()
            change_type()
            change_date()
            get_assessor()

            get_position_to_promote()

        });
        </script>
        <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        function select_all(source) {
            var check = document.querySelectorAll('input[name="checkbox1"]');
            for (var i = 0; i < check.length; i++) {
                if (check[i] != source) {
                    check[i].checked = source.checked
                }
            }
        }
        </script>
        <script>
        function alert() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Confirm Add Group?',
                text: "เมื่อคุณบันทึกแล้วยังสามารถแก้ไขได้ในภายหลัง",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Saved!',
                        'Your data has been Saved.',
                        'success'
                    )

                    save_data();
                    //window.location.href = "show_group_management";

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is not saved.:)',
                        'error',
                    )

                }
            })
        }
        </script>
        <!-- add nominee -->
        <script>
        var count = 0;
        var count_nominee = 0;
        var id = "Emp_id";
        var num = 1;
        var index_emp = [];
        /* The above code is adding a new row to the table. */
        $("#add").click(function() {

            empname = document.getElementById("showname_modal").value;
            empid = document.getElementById("Emp_id_modal").value;
            position = document.getElementById("position_nominee").value;
            department = document.getElementById("department_nominee").value;
            promote = document.getElementById("promote_nominee").value;

            var data_row = "";
            //pos_id = get_position_id(promote);
            //console.log(pos_id);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_nominee/get_position_name ",
                data: {
                    'pos_id': promote
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    data.forEach((row, index) => {
                        data_row += '<tr id="emp_' + num + '">';
                        data_row += '<td id="Emp_id_' + num +
                            '" style="text-align:center">' + empid + '</td>';
                        data_row += '<td style="text-align:center" >' + empname + '</td>';
                        data_row += '<td style="text-align:center">' + department + '</td>';
                        data_row += '<td style="text-align:center" id="Promote_' + num +
                            '">' + row.Position_name;;
                        data_row += '<input type="text" id="Pro_' + num + '" value="' +
                            promote + '" hidden >'
                        data_row += '</td>'
                        data_row += '<td style="text-align:center"> ' +
                            '<button class="btn btn-danger" onclick = "remove_row(' + num +
                            ') " >delete</button></td>';
                        index_emp.push(num);
                        console.log(index_emp);
                        count_nominee++;
                        num++
                        $("#nominee_data").append(data_row);
                        console.log(count_nominee);
                    })
                }
            });

        });

        /**
         * When the remove button is clicked, remove the row, remove the index from the array, and then call
         * the function that changes the group status.
         */
        function remove_row(num) {
            $("#emp_" + num).remove();
            var index = index_emp.indexOf(num);
            if (index > -1) {
                index_emp.splice(index, 1);
            }
            count_nominee--;
            console.log(index_emp)
            change_group_status().call()
        }
        </script>
        <!-- add nominee -->
        <script>
        /**
         * It gets the value of the year from the dropdown and then uses that value to query the database
         * and return the results.
         */



        function get_assessor() {
            var ass_year = document.getElementById("year").value;
            var ass_pos = document.getElementById("group_position").value;
            //var section = document.getElementById("group_position").value;
            console.log("ass_year")

            //$("#select_data").remove();
            document.getElementById("select_data").innerHTML = "";
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_assessor/get_assessor_by_year ",
                data: {
                    "years": ass_year,
                    "pos": ass_pos
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data)
                    document.getElementById("group_name").value = data[0].ase_asp_id
                    console.log(data[0].ase_asp_id);
                    var count_index = 0;
                    var i = 0;
                    var data_row = '';
                    data.forEach((row, index) => {
                        var check = 0;
                        data_row += '<tr id="ase_' + i + '">'
                        data_row += '<td style="text-align:center">'
                        data_row += i + 1;
                        data_row += '</td>'
                        data_row += '<td style="text-align:center">'
                        emp_as.forEach((row_as, index) => {
                            console.log(row.ase_emp_id)
                            console.log(row_as)
                            console.log(Object.is(Number(row_as), Number(row.ase_emp_id)))
                            if (Object.is(Number(row_as), Number(row.ase_id)) == true) {
                                check++;
                                console.log("row_as")
                            }
                        });
                        console.log(check)
                        if (check != 0) {
                            data_row += '<input type="checkbox" id="check_box_' + i +
                                '" name="checkbox1" checked>'
                        } else {
                            data_row += '<input type="checkbox" id="check_box_' + i +
                                '" name="checkbox1" >'
                        }

                        data_row += '</td>'
                        data_row += '<td id="ase_emp_id_' + i +
                            '" style="text-align:center"> '
                        data_row += row.Emp_ID
                        data_row += '<input type="text" id="ase_id_' + i++ +
                            '" name="checkbox1" value="' + row.ase_id + '" hidden>'
                        data_row += '</td>'
                        data_row += '<td style="text-align:center">'
                        data_row += row.Empname_eng + "          " + row.Empsurname_eng
                        data_row += '</td>'
                        data_row += '<td style="text-align:center">'
                        data_row += row.Position_name
                        data_row += '</td>'
                        data_row += '<td style="text-align:center">'
                        data_row += row.Department
                        data_row += '</td>'
                        data_row += '</tr>'
                        count_index++
                        index++
                        $("#select_data").html(data_row);

                        console.log(row.ase_asp_id)
                    })

                    count = count_index;
                },
                error: function(error) {
                    console.log('error');
                }

            });

        }
        /**
         * This function removes the row from the table
         */
        function get_group_detail() {
            var group_id = document.getElementById("old_id").value;
            console.log(group_id);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Group_management/Group_management/get_group_detail ",
                data: {
                    "grp_id": group_id,
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log("data");
                    console.log(data[0].grp_id);
                    console.log(group_id);
                    document.getElementById("group_position").value = data[0].grp_position_group
                    console.log(data[0].grp_position_group);
                    sessionStorage.setItem('grp_id', data[0].grp_position_group);
                    console.log(sessionStorage.getItem('grp_id'));
                    console.log(document.getElementById("group_position").value)
                    document.getElementById("year").value = data[0].grp_year
                    if (data[0].grp_position_group > 5) {
                        document.getElementById("date").value = data[0].grd_date
                        console.log(data[0].grd_date)
                    } else {
                        document.getElementById("date").value = data[0].grd_date
                        document.getElementById("date_2").value = data[1].grd_date
                        console.log(data[0].grd_date)
                        console.log(data[1].grd_date)
                    }
                }

            });

            console.log(sessionStorage.getItem('grp_id'));
            document.getElementById("group_position").value = sessionStorage.getItem('grp_id')
            console.log(document.getElementById("group_position").value)


        }

        /**
         * This function is used to get the position name from the database.
         */
        function get_position() {
            // $("#position_list").empty();
            get_assessor()
            position_level_id = document.getElementById('group_position').value;
            document.getElementById("position_list").innerHTML = "";
            var empname = "";

            console.log("position_level_id")
            console.log(document.getElementById('group_position').value)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_nominee/get_position ",
                data: {
                    "position_level_id": position_level_id,
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    data.forEach((row, index) => {
                        $("#position_list").append('<li><a href="#">' + row.Position_name +
                            '</a></li>');
                    })
                },
                error: function(error) {
                    console.log('error');
                }

            });
        }


        /**
         * This function is used to get the position name of the employee to be promoted
         */
        function get_position_to_promote() {
            $("#promote_nominee").empty();
            position_level_id = document.getElementById('group_position').value;
            console.log("position_level_id =" + position_level_id)
            var empname = "";
            const num = position_level_id;
            position_level_id = position_level_id - 1;
            console.log(position_level_id);
            console.log(num);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_nominee/get_position ",
                data: {
                    "position_level_id": num,
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    data.forEach((row, index) => {
                        $("#promote_nominee").append('<option value=' + row.Position_ID +
                            ' onclick="setpos_id(' + row.Position_ID + ')">' + row.Position_ID +
                            ' : ' + row.Position_name +
                            '</option>');
                    })

                }
            });
        }

        function get_position_id(pos) {
            var pos_name = pos
            var get_pos_id = null
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Employee/Get_nominee/get_position_id ",
                data: {
                    "position_name": pos_name,
                },
                dataType: "JSON",
                success: function(data, status) {
                    console.log(data);
                    get_pos_id = data;
                }

            });
            console.log("Position_ID");
            // console.log(get_pos_id);
            return get_pos_id;

        }



        /**
         * *This function changes the type of evaluation based on the position level.*
         * 
         * *This function is called when the user changes the position level.*
         */
        function change_type() {

            position_level_id = document.getElementById('group_position').value;
            console.log("position_level_id =" + position_level_id)
            if (position_level_id < 5) {
                document.getElementById("type_evaluation").value = "Type 2: (2 round evaluation)";
            } else {
                document.getElementById("type_evaluation").value = "Type 1: (1 round evaluation)";
            }
        }

        function setpos_id(id) {
            document.getElementById("position_id").value = id;
        }

        /* Checking if the value of the select box is 0, if it is, it disables the button. If it is not, it
        enables the button. */
        function change_button_status() {
            console.log('status0')
            // if (document.getElementById("group_position").value < 0) {
            //     document.getElementById("btn_add_nominee").disabled = true;
            // } else {
            //     document.getElementById("btn_add_nominee").disabled = false;
            // }


        }

        /* Checking if the table has any rows. If it does, it disables the dropdown. If it doesn't, it
        enables the dropdown. */
        function change_group_status() {
            if (document.getElementById("nominee_data").rows.length == 0) {
                document.getElementById("group_position").disabled = false;
                console.log(document.getElementById("nominee_data").rows.length)

            } else if (document.getElementById("nominee_data").rows.length > 0) {
                document.getElementById("group_position").disabled = true;
                console.log(document.getElementById("nominee_data").rows.length)

            }


        }

        function change_date() {
            console.log('status4')
            if (document.getElementById("group_position").value > 4) {
                $("#date2").hide();
            } else {
                $("#date2").show();
            }


        }

        /* Sending data to the server using ajax. */
        function save_data() {
            var emp_assessor = []
            var emp_nominee = []
            var promote = []
            var elem /*  */
            ent = []
            //var pos_id = []
            var sum;
            var T = document.getElementById('group_position').value;
            //element = document.getElementsByName("pos");
            count_ase = []
            count_nom = []
            console.log(9999)
            console.log(document.getElementById("select_data").rows.length)
            console.log(document.getElementById("nominee_data").rows.length)
            var date = '';
            var date = document.getElementById('date').value;
            var year = document.getElementById('year').value;
            var date2 = document.getElementById('date_2').value;
            var group_id = document.getElementById("old_id").value;
            if (document.getElementById("select_data").vale == "" && document.getElementById("nominee_data") == "") {
                alert('Unavailable date');
            } else {
                console.log(count_nominee);
                console.log(15)
                for (var i = 0; i < document.getElementById("select_data").rows.length; i++) {
                    if ($('#check_box_' + i).is(":checked")) {
                        emp_assessor.push(document.getElementById('ase_id_' + i).value)
                        console.log(emp_assessor + "55")
                    }
                }
                for (var i = 0; i < document.getElementById("nominee_data").rows.length; i++) {
                    console.log(index_emp[i]);
                    emp_nominee.push(document.getElementById('Emp_id_' + index_emp[i]).innerHTML)
                    promote.push(document.getElementById('Pro_' + index_emp[i]).value)
                    //pos_id.push(document.getElementById('pos_' + index_emp[i]).value)
                    console.log(444)
                }
                console.log(date)
                console.log(emp_assessor)
                console.log(T)
                console.log(emp_nominee)
                console.log(promote)
                console.log(year)
                console.log(11)

                //ใช้ ajax 
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>Group_management/Group_management/edit",
                    data: {
                        "emp_assessor": emp_assessor,
                        "emp_nominee": emp_nominee,
                        "promote": promote,
                        //"pos_id": pos_id,
                        "date": date,
                        "date2": date2,
                        "position_group": T,
                        "year": year,
                        "grp_id": group_id,
                    },
                    success: function(data) {
                        console.log(data);
                        window.location.href =
                            "<?php echo base_url(); ?>Group_management/Group_management/show_group_management";
                    }
                })
            }


        }
        /*  */
        </script>