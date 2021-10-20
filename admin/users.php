<?php
    require_once ('../includes/db.inc.php');


    $connect="mysql:host={$db_servername};dbname={$db_name}";
    
    $connection = new PDO($connect , $db_username, $db_password );
    


?>


<!doctype html>
<head>
    
    <title>Server Side Ajax CURD data table with Boostrap model</title>

    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    
	<!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
   
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <link rel="stylesheet" type="text/css" href="includes/DataTables/datatables.min.css"/>
 
         <script type="text/javascript" src="includes/DataTables/datatables.min.js"></script>
</head>



<body>


  
   <div class="container-md"> 
                <div align="right">
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Add user</button>
                </div>
              
                <table id="course_table" class="table table-striped">  
                    <thead bgcolor="#6cd8dc">
                        <tr class="table-primary">
                          <th width="1%">Type</th>
                           <th width="1%">Department/Offices</th>
                           <th width="1%">Course</th>
                           <th width="1%">Year</th>
                           <th width="1%">Block</th>
                           <th width="10%"> Id</th>  
                           <th width="10%">Last Name</th>  
                           <th width="10%">First Name</th>  
                           <th width="10%">Middle Name</th>  
                           <th width="10%">Bu Email</th>  
                           <th width="1%">Gender</th>  
                           <th width="1%">Num</th>  
                            
                           <th scope="col" width="5%">Edit</th>
                           <th scope="col" width="5%">Delete</th>
                        </tr>
                    </thead>
                </table>
            </br>
               
   </div>        
   
   <div class="container-md"> 
                <div align="right">
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Add user</button>
                </div>
              
                <table id="course_table" class="table table-striped">  
                    <thead bgcolor="#6cd8dc">
                        <tr class="table-primary">
                          <th width="1%">Type</th>
                           <th width="1%">Department/Offices</th>
                           <th width="1%">Course</th>
                           <th width="1%">Year</th>
                           <th width="1%">Block</th>
                           <th width="10%"> Id</th>  
                           <th width="10%">Last Name</th>  
                           <th width="10%">First Name</th>  
                           <th width="10%">Middle Name</th>  
                           <th width="10%">Bu Email</th>  
                           <th width="1%">Gender</th>  
                           <th width="1%">Num</th>  
                            
                           <th scope="col" width="5%">Edit</th>
                           <th scope="col" width="5%">Delete</th>
                        </tr>
                    </thead>
                </table>
            </br>
               
   </div> 
 </body>
 </html>


<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="course_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
              
                    <label>Type</label>
                     <select id="type" name="type" class="form-control">
                     <option selected="true" disabled="disabled">Please select Type</option>
                         <option value="S">Student</option>
                         <option value="T">Teaching</option>
                         <option value="NT">Non teaching</option>
                     </select>
                    <br />

                    <label>Department or Offices</label>
                    <select id="department" name="department" class="form-control">
                        <option selected="true" disabled="disabled">Please select Type</option>  
                             
                     </select>

                     <label>Course</label>
                    <select id="course" name="course" class="form-control">
                        <option selected="true" disabled="disabled">Please select Course</option>  
                     </select>
                     <br /> 
                    <label>Year</label>
                    <input type="text" name="year" id="year" class="form-control" />
                    <br />
                    <label>Block</label>
                    <input type="text" name="block" id="block" class="form-control" />
                    <br /> 
                    <label>BU ID</label>
                    <input type="text" name="bu_id" id="bu_id" class="form-control" />
                    <br /> 
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" />
                    <br />
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" />
                    <br />
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" class="form-control" />
                    <br />
                    
                    <label>Gender</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="m">Male</option>  
                        <option value="f">Female</option>  
                        <option value="n">Non-binary</option>  
                     </select>
                    <br /> 
                    <label>Bu email</label>
                    <input type="text" name="bu_email" id="bu_email" class="form-control" />
                    <br /> 
                    <label> Contact Number</label>
                    <input type="text" name="contact_num" id="contact_num" class="form-control" />
                    <br /> 
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="course_id" id="course_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){


    //
    
      $("#type").on("change",function(){
        var type = $(this).val();

        if(type.trim()=='T' || type.trim()=='NT' ){
             $("#year").val('NA');
             $("#block").val('NA');
        }else{
            $("#year").val('');
             $("#block").val('');
        }
        window.alert(type);
        if (type) {
                $.ajax({
            url :"./includes/action.inc.php",
            type:"POST",
            timeout: 1000,
            cache:false,
            data:{'type':type},
            success:function(data){
                $("#department").html(data);
               
                $('#course').html('<option value="">Unavailable</option>');
         }
         });
        }else{
       $('#department').html('<option value="">Select Department</option>');
        }
     });



      ///dep
      // department course choices
      $("#department").on("change",function(){
        var departmentId = $(this).val();
        if (departmentId) {
         $.ajax({
       url :"./includes/action.inc.php",
       type:"POST",
       timeout: 1000,
       cache:false,
       data:{'departmentId':departmentId},
       success:function(data){
           $("#course").html(data);
           
         }
         });
        }else{
       $('#course').html('<option value="">Select Course</option>');
        }
     });



    $('#add_button').click(function(){
        $('#course_form')[0].reset();
        $('.modal-title').text("Add Course Details");
        $('#action').val("Add");
        $('#operation').val("Add");
    });
    
    var dataTable = $('#course_table').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"includes/fetch.inc.php",
            type:"POST"
               },
        "columnDefs":[
            {
                "targets":[9,10,11,12],
                "orderable":false,
            },
        ],    
    });


    $(document).on('submit', '#course_form', function(event){
        event.preventDefault();
        var type = $('#id').val();
        var department= $('#department').val();
        var course = $('#course').val();
        var year = $('#year').val();
        var block = $('#block').val(); 
        var bu_id = $('#bu_id').val();
        
        var  last_name= $('#last_name').val();
        var  middle_name = $('#middle_name').val(); 
        var  first_name= $('#first_name').val();    


        var gender = $('#gender').val();  
        var bu_email = $('#bu_email').val(); 
        var contact_num = $('#bu_email').val();       
        
        if(type != '' && department != '' && course != ''
        && year != '' && block != '' && bu_id != ''
        && gender != ''&& bu_email != '' && last_name != ''&& middle_name != ''&& first_name != '' )
        {
            $.ajax({
                url:"includes/insert_user.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    window.alert(data);
                    $('#course_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        }
        else
        {
            alert("Fill up all fields");
        }
    });
    
    $(document).on('click', '.update', function(){
        var course_id = $(this).attr("id");

        $.ajax({
            url:"includes/fetch_single.inc.php",
            method:"POST",
            data:{course_id:course_id},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                 $('#id').val(data.user_ref_id);
                $('#course').val(data.user_ref_id);
                // $('#students').val(data.students);
                // $('.modal-title').text("Edit Course Details");
                // $('#course_id').val(course_id);
                // $('#action').val("Save");
                // $('#operation').val("Edit");
            }
        })
    });
    
    // $(document).on('click', '.delete', function(){
    //     var course_id = $(this).attr("id");
    //     if(confirm("Are you sure you want to delete this user?"))
    //     {
    //         $.ajax({
    //             url:"delete.php",
    //             method:"POST",
    //             data:{course_id:course_id},
    //             success:function(data)
    //             {
    //                 dataTable.ajax.reload();
    //             }
    //         });
    //     }
    //     else
    //     {
    //         return false;   
    //     }
    // });
    
    
});
</script>