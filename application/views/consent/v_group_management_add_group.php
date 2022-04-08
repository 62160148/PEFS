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
<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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
        <h2>Group Management (การเพิ่มการกลุ่มประเมิน)</h2>
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
                                    <label for="year" style="font-size:20px;">Level:
                                        <select id="group_position" name="year" onchange="get_position(),change_type(),change_button_status(),get_position_to_promote(),change_date()">
                                            <option value="-1">please select</option>
                                            <option value="6">T6</option>
                                            <option value="5">T5</option>
                                            <option value="4">T4</option>
                                            <option value="3">T3</option>
                                            <option value="2">T2</option>

                                        </select>
                                    </label>
                                </div>
                                <div class="col">
                                    <label for="year" style="font-size:20px;">Year:
                                        <select id="year" name="year" onchange="get_assessor()">

                                        </select>
                                    </label>
                                </div>


                            </div>
                            <div>
                                <label for="Position" style="font-size:20px;">Position</label>
                                <ul style="font-size:20px;" id="position_list">
                                </ul>
                            </div>
                            <div>
                                <label for="year" style="font-size:20px;">Type Evaluation</label><br>
                                <input type="text" id="type_evaluation" style="font-size:20px;" disabled value="Type 1: (1 round evaluation)">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <label for="year" style="font-size:20px;">Date Round 1 :</label><br>
                                        <input type="date" id="date" style="font-size:20px;" value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>"><br>

                                    </div><br><br>

                                </div>
                                <div class="col" id="date2">
                                    <div>
                                        <label for="year" style="font-size:20px;">Date Round 2 :</label><br>
                                        <input type="date" id="date_2" style="font-size:20px;" value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>"><br>

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

                            <button class="btn btn-primary float-right" id="btn_add_nominee" style="position: absolute; right: 0;" data-toggle="modal" data-target="#exampleModalCenter" disabled>
                                Add Nominee</button>
                            <br><br>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <input type="number" id="Emp_id_modal" style="font-size:20px;" onkeyup="get_Emp()"><br>
                                            <label for="emp_id" style="font-size:20px;">Name</label><br>
                                            <input type="text" id="showname_modal" style="font-size:20px;" disabled><br>
                                            <input type="text" id="position_nominee" hidden>
                                            <input type="text" id="department_nominee" hidden>
                                            <label for="year" style="font-size:20px;">Promote to
                                                <br> <select id="promote_nominee" name="year">
                                                    <option>please select</option>

                                                </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal" id="add">Confirm</button>
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
                                            <th style="text-align:center">Position</th>
                                            <th style="text-align:center">Department</th>
                                            <th style="text-align:center">Promote to</th>
                                            <th style="text-align:center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="nominee_data">
                                        <!-- <tr id="emp_id_1">
                                        <td style="text-align:center">1</td>
                                        <td style="text-align:center">00030</td>
                                        <td style="text-align:center">Jirayut Saifah</td>
                                        <td style="text-align:center">Officer Level</td>
                                        <td style="text-align:center">Accountant</td>
                                        <td style="text-align:center">Senior Manager</td>
                                        <td style="text-align:center"> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                    </tr> -->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-12 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-success mb-0" data-bs-toggle="modal" data-bs-target="#ModalConfirmAssessor" onclick="alert()">Submit
                </button>
            </div>
        </div>




        <script>
            $(document).ready(function() {

                const d = new Date();
                let years = d.getFullYear();
                console.log('option')
                years = years - 3
                // var x = document.getElementById("year");
                // var option = document.createElement("option");
                for (i = 0; i < 7; i++) {
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
                get_assessor().call()



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
                data_row += '<tr id="emp_' + num + '">';

                data_row += '<td id="Emp_id_' + num + '" style="text-align:center">' + empid + '</td>';
                data_row += '<td style="text-align:center" >' + empname + '</td>';
                data_row += '<td style="text-align:center">' + position + '</td>';
                data_row += '<td style="text-align:center">' + department + '</td>';
                data_row += '<td style="text-align:center" id="Promote_' + num + '">' + promote + '</td>';
                data_row += '<td style="text-align:center"> ' +
                    '<button class="btn btn-danger" onclick = "remove_row(' + num +
                    ') " >delete</button></td>';
                index_emp.push(num);
                console.log(index_emp);
                num++

                $("#nominee_data").append(
                    data_row
                );
                count_nominee++;
                console.log(count_nominee);

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
                console.log(ass_year)
                //$("#select_data").remove();
                document.getElementById("select_data").innerHTML = "";
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>Employee/Get_assessor/get_assessor_by_year ",
                    data: {
                        "years": ass_year,
                    },
                    dataType: "JSON",
                    success: function(data, status) {
                        console.log(data);
                        var count_index = 0;
                        var i = 1;
                        var data_row = '';
                        data.forEach((row, index) => {
                            data_row += '<tr id="ase_' + i + '">'
                            data_row += '<td style="text-align:center">'
                            data_row += i++;
                            data_row += '</td>'
                            data_row += '<td style="text-align:center">'
                            data_row += '<input type="checkbox" id="check_box' + index +
                                '" name="checkbox1">'
                            data_row += '</td>'
                            data_row += '<td id="ase_id_' + index +
                                '" style="text-align:center"> '
                            data_row += row.Emp_ID
                            data_row += '</td>'
                            data_row += '<td style="text-align:center">'
                            data_row += row.Empname_eng + "          " + row.Empsurname_eng
                            data_row += '</td>'
                            data_row += '<td style="text-align:center">'
                            data_row += row.Position_name
                            data_row +=
                                '<input type="text" name="pos" id=' + row
                                .Position_ID + ' style="text-align:center" value=' + row
                                .Position_ID + ' hidden>'
                            data_row += '</td>'
                            data_row += '<td style="text-align:center">'
                            data_row += row.Department
                            data_row += '</td>'

                            data_row += '</tr>'
                            count_index++
                            $("#select_data").append(data_row);
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


            /**
             * This function is used to get the position name from the database.
             */
            function get_position() {
                // $("#position_list").empty();
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
                var empname = "";
                const num = position_level_id - 1;
                // position_level_id = position_level_id - 1;
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
                            $("#promote_nominee").append('<option value=' + row.Position_name +
                                '>' + row
                                .Position_name +
                                '</option>');
                        })
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
                if (position_level_id > 4) {
                    document.getElementById("type_evaluation").value = "Type 2: (2 round evaluation)";
                } else {
                    document.getElementById("type_evaluation").value = "Type 1: (1 round evaluation)";
                }
            }

            /* Checking if the value of the select box is 0, if it is, it disables the button. If it is not, it
            enables the button. */
            function change_button_status() {
                console.log('status0')
                if (document.getElementById("group_position").value < 0) {
                    document.getElementById("btn_add_nominee").disabled = true;
                } else {
                    document.getElementById("btn_add_nominee").disabled = false;
                }


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
                if (document.getElementById("group_position").value >= 5) {
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
                var element = []
                var pos_id = []
                var sum;
                var T = document.getElementById('group_position').value;
                element = document.getElementsByName("pos");
                count_ase = []
                count_nom = []
                console.log(9999)
                console.log(document.getElementById("select_data").rows.length)
                console.log(document.getElementById("nominee_data").rows.length)
                var date = '';
                var date = document.getElementById('date').value;
                var year = document.getElementById('year').value;
                var date2 = document.getElementById('date_2').value;
                if (date == "") {
                    alert('Unavailable date');
                } else {
                    console.log(count_nominee);
                    console.log(15)
                    for (var i = 0; i < document.getElementById("select_data").rows.length; i++) {
                        if (document.getElementById('check_box' + i).checked) {
                            emp_assessor.push(document.getElementById('ase_id_' + i).innerHTML)
                            console.log(emp + "55")
                        }
                    }
                    for (var i = 0; i < document.getElementById("nominee_data").rows.length; i++) {
                        console.log(index_emp[i]);
                        emp_nominee.push(document.getElementById('Emp_id_' + index_emp[i]).innerHTML)
                        promote.push(document.getElementById('Promote_' + index_emp[i]).innerHTML)
                        pos_id[i] = element[i].getAttribute('id');
                        console.log(444)
                    }
                    console.log(date)
                    console.log(emp)
                    console.log(T)
                    console.log(emp_nominee)
                    console.log(promote)
                    console.log(pos_id)
                    console.log(11)

                    //ใช้ ajax 
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>Group_management/Group_management/insert",
                        data: {
                            "emp_assessor": emp,
                            "emp_nominee": emp_nominee,
                            "promote": promote,
                            "pos_id": pos_id,
                            "date": date,
                            "date2": date2,
                            "position_group": T,
                            "year": year,
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