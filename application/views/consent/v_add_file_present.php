<!--
    /*
    * v_add_file_present
    * display Management file present of Nominee list
    * @author Chakrit
    * input Array of nominee group (emp_nominee)
    * output Input file of present to nominee
    * @Create date : 2564-01-27
    * @Update date : -
*/
<!-- CSS -->
<style>
#Nominee_file_table td,
#Nominee_file_table th {
    padding: 8px;
    text-align: center;
}

#Nominee_file_table tr:nth-child(even) {
    background-color: #e9ecef;
}

#Nominee_file_table tr:hover {
    background-color: #adb5bd;
}

#card_radius {
    margin-left: 14px;
    margin-right: 15px;
    border-radius: 20px;
    width: auto;
    min-height: 300px;
}

#Nominee_file_table {
    width: 98%;
    margin-top: 20px;
    margin-left: 10px;
}

div.b {
    text-align: left;

}

div.a {
    text-align: center !important;

}
</style>
<div class="container-fluid py-4">
    <div class="card-header">
        <h2>Add File Nominee (เพิ่มไฟล์นำเสนอผลงาน)</h2>
        <h6>
            Please Input File PDF Only
            (กรุณานำเข้าไฟล์ชนิด PDF เท่านั้น)
        </h6>
    </div>

    <!-- Table group Nominee list -->
    <div class="card-body" id="card_radius">
        <div class="table-responsive">
            <table class="table align-items-center" id="Nominee_file_table" id="list_table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nominee ID</th>
                        <th scope="col">Nominee Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Department</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <?php for ($i = 0; $i < count($emp_nominee); $i++) { ?>
                    <tr>
                        <td class="text-center">
                            <h6 class="text-xs text-secondary mb-0">
                                <?php echo ($i + 1); ?>
                            </h6>
                        </td>
                        <td>
                            <h6 class="text-xs text-secondary mb-0">
                                <?php echo $emp_nominee[$i]->Emp_ID  ?>
                            </h6>
                        </td>
                        <td>
                            <h6 class="text-xs text-secondary mb-0">
                                <?php echo $emp_nominee[$i]->Empname_eng . ' ' . $emp_nominee[$i]->Empsurname_eng ?>
                            </h6>
                        </td>
                        <td>
                            <h6 class="text-xs text-secondary mb-0">
                                <?php echo $emp_nominee[$i]->Pos_shortName  ?>
                            </h6>
                        </td>
                        <td>
                            <h6 class="text-xs text-secondary mb-0">
                                <?php echo $emp_nominee[$i]->Department ?>
                            </h6>
                        </td>
                        <!-- column ดำเนินการ -->
                        <td style='text-align: center;'>

                            <!-- ปุ่มดำเนินการ -->
                            <?php
                            // ตรวจสอบว่ามีไฟล์หรือยัง
                            $check = 0;
                            foreach ($emp_file as $row) {
                                if ($row->fil_emp_id == $emp_nominee[$i]->Emp_ID) {
                                    $check++;
                                }
                                // if 
                            }
                            // foreach 
                            // ยังไม่มีไฟล์จะเพิ่มไฟล์
                            if ($check == 0) { ?>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#modalAddfile<?php echo $i ?>"> <i
                                    class="fas fa-file-upload"></i></button>
                            <?php  }
                            // i
                            //เคยมีไฟล์แล้วจะอัปเดต
                            else { ?><button type="button" class=" btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#edit_modal_file<?php echo $i ?>">
                                <i class=" fas fa-file-upload"></i></button>
                            <?php  } ?>
                            <!-- else -->


                            <!-- Modal insert-->
                            <div class="modal fade" id="modalAddfile<?php echo $i ?>" role="dialog">
                                <form
                                    action="<?php echo site_url() ?>File_present_management/File_present_management/insert_file_nominee"
                                    method="post" enctype="multipart/form-data"
                                    onSubmit="JavaScript:return fncSubmit();" name="present">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
<br>
                                            <div class="b">
                                                <h4 class="modal-title">&emsp;Attachment :</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="file" name="fil" class="form-control" required=""
                                                    accept="application/pdf">
                                                <input type="text" name="Emp_ID"
                                                    value="<?php echo $emp_nominee[$i]->Emp_ID ?>" hidden>
                                                <br>
                                                <button type="submit" class="btn btn-success" 
                                                    onclick="show_message_success()">Upload This File
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal edit -->
                            <div class="modal fade" id="edit_modal_file<?php echo $i ?>" role="dialog">
                                <form
                                    action="<?php echo site_url() ?>File_present_management/File_present_management/edit_file_nominee"
                                    method="post" enctype="multipart/form-data"
                                    onSubmit="JavaScript:return fncSubmit();" name="present">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="b">
                                                <h4 class="modal-title">&emsp;Attachment :</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="file" name="fil" class="form-control" required=""
                                                    accept="application/pdf">
                                                <input type="text" name="Emp_ID"
                                                    value="<?php echo $emp_nominee[$i]->Emp_ID ?>" hidden>
                                                <br>
                                                <button type="submit" class="btn btn-success"
                                                    onclick="show_message_success()">Upload This File</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    console.log("years");
    //$("#myTable").DataTable();
    const d = new Date();
    let years = d.getFullYear();
    years = years - 2
    console.log(years);


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
    get_group();
});
</script>
<script>
function get_group() {
    var group_year = document.getElementById("year").value;
    console.log(group_year)
    //$("#select_data").remove();
    document.getElementById("group_data").innerHTML = "";
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Employee/Get_assessor/get_group_by_year ",
        data: {
            "years": group_year,
        },
        dataType: "JSON",
        success: function(data, status) {
            console.log(data);
            var count_index = 0;
            var i = 0;
            var data_row = '';
            data.forEach((row, index) => {
                const date = new Date(row.grp_date)
                const result = date.toLocaleDateString('th-TH', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    weekday: 'long',
                })
                console.log(i);
                console.log(row.grp_id);
                data_row += '<tr id="ase_' + i + '">'
                data_row += '<td style="text-align:center">'
                data_row += i + 1;
                data_row += '</td>'
                data_row += '<td style="text-align:center">'
                data_row += "T" + row.grp_position_group
                data_row += '</td>'
                data_row += '<td id="ase_id_' + i++ +
                    '" style="text-align:center"> '
                data_row += result
                data_row += '</td>'
                data_row += '<td style="text-align:center">'
                data_row += row.sec_name
                data_row += '</td>'

                data_row += '<td style="text-align:center">'
                data_row +=
                    "<button type='button' onclick='edit_group(" + row.grp_id +
                    ")' class='btn btn-warning'>"
                data_row += " <i class = 'fa fa-pencil '> </i>"
                data_row += "</button>"
                data_row +=
                    "<button type='button' onclick='delete_group(" + row.grp_id +
                    ")' class='btn btn-danger'>"
                data_row += " <i class = 'fa fa-trash '> </i>"
                data_row += "</button>"
                data_row += '</td>'
                data_row += '</tr>'
                $("#group_data").append(data_row);
                count_index++
                index++
            })
            for (var i = 0; i < data.d.length; i++) {

            }
            i++

            count = count_index;
            $("#myTable").DataTable();
        },
        error: function(error) {
            console.log('error');
        }

    });

}
</script>