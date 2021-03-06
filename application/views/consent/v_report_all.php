<!-- 
    * v_report
    * Display report of Performance Evaluation Factor System
    * @input    -
    * @output   -
    * @author  Chakrit and Nattakorn
    * @Create Date 2565-01-27
    * @Update Date -
-->

<style>
    td {
        text-align: center !important;
    }

    th {
        text-align: center !important;
    }
</style>


<div class="container-fluid py-4">
    <div class="card-header">
        <h2> Report (รายงานข้อมูล)</h2>
    </div>
    <div class="card-header" id="card_radius">
        <h3 style="text-align:center">
            Performance Evaluation Factor System
        </h3>
        <div class="row">
            <div class="col-lg-10"></div>
            <div class="col-lg-2">
                <div class="form-group">

                    <label class="form-control-label">Select Year</label>

                    <select name="position" id="year" class="form-select" aria-label="Default select example" onchange="show_all_data()">
                        <?php for ($i = 0; $i < count($obj_year); $i++) {
                            if (date("Y", strtotime($obj_year[$i]->grp_date)) == date("Y")) { ?>
                                <option selected value="<?php echo date("Y", strtotime($obj_year[$i]->grp_date)) ?>">
                                    <?php echo date("Y", strtotime($obj_year[$i]->grp_date)); ?>
                                </option>
                            <?php } //if
                            else { ?>
                                <option value="<?php echo date("Y", strtotime($obj_year[$i]->grp_date)) ?>">
                                    <?php echo date("Y", strtotime($obj_year[$i]->grp_date)); ?>
                                </option>
                        <?php } //else
                        } //for 
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" id="count_assessed">
            <!-- <div class="col-xl-1"></div> -->

            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Must Assess</p>
                                <h5 class="font-weight-bolder mb-0" id="total_nominee">

                                </h5>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                    <i class="ni ni-single-copy-04" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-nowrap">People</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Number of people all that must assess  -->
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Assessed</p>
                                <span class="font-weight-bolder mb-0" id="total_have">

                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                            <span class="text-nowrap">People</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Number of people assessed -->
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Not Assessed</p>
                                <span class="font-weight-bolder mb-0" id="total_have_not">

                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                                    <i class="fas fa-user-alt-slash"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                            <span class="text-nowrap">People</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- The number of people who have not been assessed  -->
            <div class="row">
                <br>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pass</p>
                                <span class="font-weight-bolder mb-0" id="total_pass">

                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                    <i class="ni ni-check-bold"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                            <span class="text-nowrap">People</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Number of people who passed the assessment  -->
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Fail</p>
                                <span class="font-weight-bolder mb-0" id="total_fail">

                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                    <i class="fas fa-times"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                            <span class="text-nowrap">People</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Number of people who fail in the assessment -->
            <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body shadow">
                        <div class="row">
                            <div class="col">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Assessed / Yearly</p>
                                <span class="font-weight-bolder mb-0" id="total_yearly">

                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                            <span class="text-nowrap">People</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Number of people (assessed / yearly)  -->
        </div>
        <br>
        <div class="row" id="count_graph">
            <!-- <div class="col-xl-1"></div> -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <!-- <div class="col-lg-6"> -->
                            <h4 class="text-black mb-0">The graph shows the results of the assessment of each position</h4>
                            <!-- </div> -->

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- The graph shows the results of the assessment of each position -->
        <div class="row">
                <br>
        </div>
        <div class="row" id="count_table">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <!-- <div class="col-lg-6"> -->
                            <h4 class="text-black mb-0">The table shows the reports of each position</h4>
                            <!-- </div> -->

                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Assessed</th>
                                    <th scope="col">Not Assessed</th>
                                    <th scope="col">Pass</th>
                                    <th scope="col">Fail</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody id="data_table">

                            </tbody>
                            <tfoot>
                                <td colspan="2" align="right">Total :</td>
                                <td id='sum_total'></td>
                                <td id='assess_total'></td>
                                <td id='not_assess_total'></td>
                                <td id='pass_total'></td>
                                <td id='fail_total'></td>
                                <td></td>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saver@1.3.3/FileSaver.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    var section = [];
    $(document).ready(function() {
        // $("#count_assessed").hide();
        // $("#count_graph").hide();
        // $("#count_table").hide();
        // $("#count_export").hide();
        show_table();
        show_data_table();
        show_all_data();
    });

    /*
     * show_chart
     * display chart with data
     * @input    -
     * @output   -
     * @author   Chakrit
     * @Create Date 2564-08-20
     */

    function show_chart(label, data_pass, data_fail) {
        var bar_charts = document.getElementById("myChart");
        var myChart = new Chart(bar_charts, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: 'NOT PASS',
                    data: data_fail,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'PASS',
                    data: data_pass,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    }

    /*
     * show_all_data
     * display all data report
     * @input    -
     * @output   -
     * @author   Chakrit
     * @Create Date 2564-08-16
     */
    function show_all_data() {
        var year = document.getElementById('year').value;
        var have = 0;
        var have_not = 0;
        var pass = 0;
        var fail = 0;

        const label = [];
        var check = '';
        const data_pass = [];
        const data_fail = [];
        var count_pass = 0;
        var count_fail = 0;
        const label_sec = [];
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() ?>Report/Report/get_report",
            dataType: "JSON",
            data: {
                "year": year
            },
            success: function(data_charts) {
                console.log(year);
                data_charts.forEach((row, index) => {
                    row.sec_level = 'T' + row.sec_level;

                    if (index == 0) {
                        label.push(row.sec_level);
                        label_sec.push(row.sec_id);
                        check = row.sec_level;
                    } else if (check != row.sec_level) {
                        label.push(row.sec_level);
                        label_sec.push(row.sec_id);
                        check = row.sec_level;
                    }

                    if (row.grn_status_done == '-1') {
                        have_not++;
                    } else if (row.grn_status_done == '0' || row.grn_status_done == '1') {
                        have++;
                    }

                    if (row.grn_status_result == '1') {
                        pass++;
                    } else if (row.grn_status_result == '2') {
                        fail++;
                    }
                });
                // forEach data_charts
                label_sec.forEach((row_label, index) => {
                    data_charts.forEach((row, index) => {
                        if (row_label == row.sec_id) {
                            if (row.grn_status_result == '1') {
                                count_pass++;
                            } else if (row.grn_status_result == '2') {
                                count_fail++;
                            }
                        }
                    });
                    data_pass.push(count_pass);
                    data_fail.push(count_fail);
                    count_pass = 0;
                    count_fail = 0;
                });
                // forEach label
                $("#count_assessed").show();
                $("#count_graph").show();
                $("#count_table").show();

                show_chart(label, data_pass, data_fail);
                show_data_table(data_charts);
                $('#total_nominee').text(have_not + have);
                $('#total_have').text(have);
                $('#total_have_not').text(have_not);
                $('#total_pass').text(pass);
                $('#total_fail').text(fail);
                $('#total_yearly').text(have_not + have + pass + fail);

            },
            error: function(res) {

            }
        });

    }

    /*
     * show_table
     * display table report
     * @input    -
     * @output   -
     * @author   Chakrit
     * @Create Date 2564-08-28
     */
    function show_table() {
        $.get("<?php echo base_url(); ?>Report/Report/get_section", function(data) {
            var obj = JSON.parse(data);
            var data_row = '';
            obj.forEach((row, index) => {
                data_row += '<tr>';
                data_row += '<td text-align: center>' + (index + 1) + '</td>';
                data_row += '<td>' + "Promote to T" + row.sec_level + '</td>';
                data_row += '<td text-align: center id="sum_' + index + '"></td>';
                data_row += '<td text-align: center id="assess_' + index + '"></td>';
                data_row += '<td text-align: center id="not_assess_' + index + '"></td>';
                data_row += '<td text-align: center id="pass_' + index + '"></td>';
                data_row += '<td text-align: center id="fail_' + index + '"></td>';
                data_row += '<td><a href="<?php echo site_url() ?>Report/Report/show_report_detail/' + row.sec_id + ' ">'
                data_row += '<button type="button" class="btn bg-gradient-info btn-block mb-3">'
                data_row += '<i class="fas fa-search"></i></button></a></td>'
                data_row += '</tr>';
                section.push(row.sec_id);
            });
            // forEach obj
            $('#data_table').html(data_row);
        });
    }

    /*
     * show_data_table
     * display data in table report
     * @input    -
     * @output   -
     * @author   Chakrit
     * @Create Date 2564-08-18
     */
    function show_data_table() {
        var sum_total = 0;
        var assess_total = 0;
        var not_assess_total = 0;
        var pass_total = 0;
        var fail_total = 0;
        var sum = [];
        var assess = [];
        var not_assess = [];
        var pass = [];
        var fail = [];
        var total = 0;
        var have = 0;
        var have_not = 0;
        var pass_check = 0;
        var fail_check = 0;
        var assess_check = 0;
        var not_assess_check = 0;
        var group = '';

        var year = document.getElementById('year').value;

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() ?>Report/Report/get_report",
            dataType: "JSON",
            data: {
                "year": year
            },
            success: function(data_charts) {
                section.forEach((row_sec, index_sec) => {
                    data_charts.forEach((row, index) => {
                        if (row_sec == row.sec_id) {
                            group = row.sec_id;
                            if (row.grn_status_done == '-1') {
                                have_not++;
                            } else if (row.grn_status_done == '0' || row.grn_status_done == '1') {
                                have++;
                            }

                            if (row.grn_status_result == '1') {
                                pass_check++;
                            } else if (row.grn_status_result == '2') {
                                fail_check++;
                            }
                            total++;
                        } //if
                    });
                    // forEach data_charts
                    if (total != 0) {
                        sum.push(total);
                    } else {
                        sum.push(0);
                    }
                    //sum
                    if (have != 0) {
                        assess.push(have);
                    } else {
                        assess.push(0);
                    }
                    //assess
                    if (have_not != 0) {
                        not_assess.push(have_not);
                    } else {
                        not_assess.push(0);
                    }
                    //not assess
                    if (pass_check != 0) {
                        pass.push(pass_check);
                    } else {
                        pass.push(0);
                    }
                    //pass
                    if (fail_check != 0) {
                        fail.push(fail_check);
                    } else {
                        fail.push(0);
                    }
                    //fail
                    total = 0;
                    have = 0;
                    have_not = 0;
                    pass_check = 0;
                    fail_check = 0;
                });
                // forEach section
                for (i = 0; i < 5; i++) {
                    $("#sum_" + i).text(sum[i]);
                    $("#assess_" + i).text(assess[i]);
                    $("#not_assess_" + i).text(not_assess[i]);
                    $("#pass_" + i).text(pass[i]);
                    $("#fail_" + i).text(fail[i]);
                    sum_total += sum[i];
                    assess_total += assess[i];
                    not_assess_total += not_assess[i];
                    pass_total += pass[i];
                    fail_total += fail[i];
                }

                $("#sum_total").text(sum_total);
                $("#assess_total").text(assess_total);
                $("#not_assess_total").text(not_assess_total);
                $("#pass_total").text(pass_total);
                $("#fail_total").text(fail_total);
            },
            error: function(res) {}
        });

    }
</script>