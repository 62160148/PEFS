<!-- /*
    * v_form_management_detail
    * @input  -
    * @output -
    * @author Pontakon & Natthanit
    * @Update Date 2565-01-25
*/ -->
<!-- CSS -->  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
p,select,input {
    font-size: 0.75rem !important;
}
table,  td{
    white-space : inherit !important;

}
</style>

 


<!-- set data -->
<?php  for($i=0;$i < count($arr_des) ;$i++){ ?>

    <input type="hidden" name="des_th<?php echo $i?>" id="des_th<?php echo $arr_des[$i]->des_item_id?>" value='<?php echo $arr_des[$i]->des_description_th ?>'  >
    <input type="hidden" name="des_eng<?php echo $i?>" id="des_eng<?php echo $arr_des[$i]->des_item_id?>" value='<?php echo $arr_des[$i]->des_description_eng ?>'  >
   
<?php }?>

<!-- //hidden -->


<?php for($i=0;$i < count($arr_item) ;$i++){  //ลูปตามหัวข้อหลัก
                                    ?>

                                        <?php $count_rowspan = 0;
                                        for ($loop_rowspan = 0; $loop_rowspan < count($arr_des); $loop_rowspan++) {
                                            if ($arr_item[$i]->itm_id == $arr_des[$loop_rowspan]->des_item_id) {
                                                $count_rowspan++;
                                                
                                            }
                                           
                                        } ?>
                                         <input type="hidden" name="dataitem_num<?php echo $i?>" id="data_num<?php echo $arr_item[$i]->itm_id?>" value='<?php echo $count_rowspan ?>'  >
                                        <?php
                                    }
                                    ?>








<!-- start Form -->
<form  action="<?php echo site_url() ?>Form_Management/Form_Management/form_management_insert" method="post" enctype="multipart/form-data" name="event" >



<div class="container-fluid py-4"> <div class="card-header"  ><h2 >Form Management (จัดการแบบฟอร์ม)</h2></div>
<div class="card"  >
    <div class="card-body">
        <div class="col-12 text-end" ><button class="btn btn-md btn-primary" id="addBtn" type="button" style="background-color: #596CFF;">
            Add Item
        </button></div>

        <div class="table-responsive">
            <table class="table align-items-center" id="Nominee_file_table" style="width : 95% " >
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width : 5% ">#</th>
                        <th scope="col" style="width : 40% ">Item</th>
                        <th scope="col"style="width : 40% ">Points for observation</th>
                        <th scope="col"style="width : 5% ">weight</th>
                        <th scope="col"style="width : 10% "> Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                        <td >
                            <p>1</p>
                        </td>
                        <?php //echo count($arr_item) ?>
            
                        <td class="text-center">
                        <!-- เลือกหัวข้อ -->
                            <select name="select_item0" id="select_item0" onchange="show_selectvalue(this)" required>
                            <option  value="">please selected</option>
                            <?php for($i=0;$i < count($arr_item) ;$i++){ ?>
                                <option value="<?php echo $arr_item[$i]->itm_id ;?>"><?php echo $arr_item[$i]->itm_name; ?></option>
                            <?php }?>
                            </select>
                        </td>

                        <td style='text-align: left;' id="discrip0">
                            <!-- แสดงรายละเอียด -->
                            
                        </td>
                        
                        <td>
                            <input type="text" name="weight0" id="weight0" value=0 size='1'>
                        </td>

                        <!-- column ดำเนินการ -->
                        <td style='text-align: center;'>
                            <button class="btn btn-danger remove"
                            type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
            <!-- Confirm --><div class="col-12 text-end" >
             
            <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                                    data-target="#Modal_confirm">Submit</button>
                                    </a>
                                
        </div>
    </div>
</div>

<!-- เก็บว่ามีกี่หัวข้อ -->
<input type="hidden" name="allitem" id="allitem" value=1 size='1'>
 
<input type="hidden" name="pos_id"  value='<?php echo $pos_id  ?>'  >
</form >
<script>

     $(document).ready(function(){
        $("#p"+0+"").hide();
        $("input[id='weight"+0+"']").hide();

        // $("#p").hide();
        // $("input[name='weight[]']").hide();


  //====================
  var rowIdx = 1;
  var i=1;
    $('#addBtn').on('click', function () {
  // Adding a row inside the tbody.

  $('#tbody').append(`<tr id="R${++rowIdx}">
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Points for observation</th>
                    <th scope="col">weight</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody id="tbody">

            <td >
        <p>${rowIdx}</p>    
        </td>


 

                    <td class="text-center">
                    <select name="select_item${i}" id="select_item${i}" onchange="show_selectvalue(this)" required>
                    <option  value="">please selected</option>
                    <?php for($i=0;$i < count($arr_item) ;$i++){ ?>
        <option value="<?php echo $arr_item[$i]->itm_id ;?>"><?php echo $arr_item[$i]->itm_name; ?></option>
        <?php } ?>
    </select>

                    </td>
                    <td style='text-align: left;' id="discrip${i}">
 
                    
                    </td>
                    <td>
                    <input type="text" name="weight${i}" id="weight${i}"  value=0 size='1'>
                    </td>
                    <!-- column ดำเนินการ -->
                    <td style='text-align: center;'>
                    <button class="btn btn-danger remove"
                type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
            </td>
                        <!-- ปุ่มดำเนินการ -->
                        </td>
                </tr>`);

                $("#p"+i+"").hide();
                 $("input[id='weight"+i+"']").hide();
                 i++;
                 document.getElementById("allitem").value = rowIdx;

    });

        // jQuery button click event to remove a row.
        $('#tbody').on('click', '.remove', function () {
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
        // Iterating across all the rows
        // obtained to change the index
        child.each(function () {
            // Getting <tr> id.
            var id = $(this).attr('id');
            // Getting the <p> inside the .row-index class.
            var idx = $(this).children('.row-index').children('p');
            // Gets the row number from <tr> id.
            var dig = parseInt(id.substring(1));
            // Modifying row index.
            idx.html(`Row ${dig - 1}`);
            // Modifying row id.
            $(this).attr('id', `R${dig - 1}`);
        });
        // Removing the current row.
        $(this).closest('tr').remove();
        // Decreasing total number of rows by 1.
        rowIdx--;
        document.getElementById("allitem").value = rowIdx;
        });
});





function show_selectvalue (select){
                var id=select.id;    //รับ id ของ select มา
                var num = id.substr(11);  //ตัดค่าเอาเลข
                
                var mylist = document.getElementById(id);  //รับ select
                var item = mylist.options[mylist.selectedIndex].value; //รับผล select
                if(item == ""){
                    $("#p_th"+num+"").hide();
                    $("#p_eng"+num+"").hide();
                    $("input[id='weight"+num+"']").hide();
                }else{ 
                    var name_th = "des_th"+ item; //รับตั้งเพื่อเอาค่า
                    var name_eng = "des_eng"+ item; //รับตั้งเพื่อเอาค่า
                    var des_th =  document.getElementById(name_th).value; // เอาค่า
                    var des_eng =  document.getElementById(name_eng).value; // เอาค่า
                   
                    //var des ="des"+ item;
                    // console.log(id);
                    // console.log(num);
                    // console.log(mylist);
                    //console.log(item);
                    //console.log(name);
                    //console.log(des);
                    delete_descript (num);
                    create_descript (num,0);
                   //document.getElementById("p_th"+num).innerHTML = des_th;
                   // document.getElementById("p_eng"+num).innerHTML = des_eng;
                    document.getElementById("des"+num).value = item;
                    
                    //$("#p_th"+num+"").show();
                    //$("#p_eng"+num+"").show();
                    $("input[id='weight"+num+"']").show();
                    
                    var data_num = "data_num"+ item; //รับตั้งเพื่อเอาค่า
                    var mynum =  document.getElementById(data_num).value;
                    document.getElementById("p_th"+num).innerHTML = des_th;
                    document.getElementById("p_th"+num).innerHTML += "<br>"+des_eng;
                    var engname =  document.getElementById(name_eng).name;
                    var namenum =  engname.substr(7);
                    //console.log(des_th);
                    
                    if(mynum>1){
                        
                        for(i=1;i<mynum;i++){   
                            console.log(namenum);
                            justnum = parseInt(namenum);
                            justnum = justnum+i;
                            console.log(justnum);
                            name_th = "des_th"+ justnum; //รับตั้งเพื่อเอาค่า
                            name_eng = "des_eng"+ justnum; //รับตั้งเพื่อเอาค่า
                            console.log(name_th);
                            console.log(name_eng);
                            des_th =  document.getElementsByName(name_th); // เอาค่า
                            des_eng =  document.getElementsByName(name_eng); // เอาค่า
                           
                             document.getElementById("p_th"+num).innerHTML += "<hr>"+des_th[0].value;
                             document.getElementById("p_th"+num).innerHTML += "<br>"+des_eng[0].value;
                        }   

                    }
                    
                    
                   
                    //$("#"+name_th).hide();

                   
                }
}

//สร้าง _descript
function create_descript (i,loop){
    $('#discrip'+i).append(`
                    <p id="p_th${i}"></p>
                    <p id="p_eng${i}"></p>
                    <input type="hidden" name="des${i}" id="des${i}" value=1 size='1'>
                    `);


}

//ลบ _descript
function delete_descript (num){
     //$("#data_num"+num).remove();
    $("#p_th"+num).remove();
    $("#p_eng"+num).remove();
    $("#des"+num).remove();
 
}  

// for(i=0;i<=2;i++){
//                         des_th=des_th+"<br>"+des_eng;
//                         if(i!=2){
//                             des_th= des_th+"<hr>";
//                         }
//                     }
    </script>