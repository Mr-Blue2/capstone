<?php
    require_once ('../includes/db.inc.php');
    $connect="mysql:host={$db_servername};dbname={$db_name}";
    $connection = new PDO($connect , $db_username, $db_password );
    
?>


<!doctype html>
<head>
    <title>Department Offices</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
	<!-- bootstrap Lib -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- datatable lib -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="includes/DataTables/datatables.min.css"/>
    <script type="text/javascript" src="includes/DataTables/datatables.min.js"></script>
</head>
<body>
 
  <br> <br>
   <div class="container">      
                <div align="left">
                <a href="index.php" class="btn btn-primary " role="button" aria-pressed="true">Return</a>
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success">Add</button>
                </div>
                <table id="table" class="table table-striped">  
                    <thead bgcolor="#6cd8dc">
                        <tr class="table-primary">
                        <th width="1%">Type</th>
                           <th width="1%">Department/Offices</th>
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
  
   
<div id="userModal" class="modal">
    <div class="modal-dialog">
        
        <form method="post" id="course_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <h4 class="modal-title">Add Department or Offices </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              
                 <!-- start -->
                                            
                 <label>Type</label>
                     <select id="type" name="type" class="form-control">
                     <option selected="true" disabled="disabled">Please select Type</option>
                         <option value="T">Teaching</option>
                         <option value="NT">Non teaching</option>
                     </select>
                    <br />

                    <label>Department or Offices</label>
                    <select id="department" name="department" class="form-control">
                        <option selected="true" disabled="disabled">Please select Type</option>  
                     </select>

                 
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
                 <!-- end -->
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



 </body>
 </html>


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
        $('.modal-title').text("Add New Department");
        $('#action').val("Add");
        $('#operation').val("Add");
    });
    

    $(document).on('submit', '#course_form', function(event){
        event.preventDefault();
       
        var course_id= $('#course_id').val();

        var type = $('#type').val();
        var department= $('#department').val();


        var bu_id = $('#bu_id').val();
        var  last_name= $('#last_name').val();
        var  middle_name = $('#middle_name').val(); 
        var  first_name= $('#first_name').val();    
        var gender = $('#gender').val();  
        var bu_email = $('#bu_email').val(); 
        var contact_num = $('#contact_num').val();  
      

        var operation = $('#operation').val();
           
        if(type != '' && department != '' && bu_id != ''
        && gender != ''&& bu_email != '' && last_name != ''&& middle_name != ''&& first_name != '' )
        {
            $.ajax({
                    type: 'POST',
                    url: './includes/faculty.insert.user.php',
                    data: {
                        'type':type,
                        'course_id':course_id,
                        'operation': operation,
                        'type': type,
                        'department':department,
                        'bu_id':bu_id,
                        'last_name':last_name,
                        'middle_name':middle_name,
                        'first_name':first_name,
                        'gender':gender,
                        'bu_email':bu_email,
                        'contact_num':contact_num
                    },
                    success: function(data) { 
                        $('#course_form')[0].reset();
                        $('#userModal').modal('hide');
                        
                        dataTable.ajax.reload();
                    },
            });
        }
        else
        {
            alert("Fill up all fields");
        }
    });
            
            var dataTable = $('#table').DataTable({
                "paging":true,
                "processing":true,
                "serverSide":true,
                "order": [],
                "info":true,
                "ajax":{
                    url:"includes/faculty.fetch.inc.php",
                    type:"POST"
                    } 
            });


                
    $(document).on('click', '.update', function(){
        var course_id = $(this).attr("id");

    
        $.ajax({

            url:"./includes/faculty.fetch_single.inc.php",
            method:"POST",
            data:{course_id:course_id},
            dataType:"json",
            success:function(data)
            
            {
              

                $('#userModal').modal('show');
            
              //  $("#department").val(data.do_id);
                $("#bu_id").val(data.user_buId);
                $("#last_name").val(data.user_lastName);
                $("#first_name").val(data.user_firstName);
                $("#middle_name").val(data.user_middleName);
                $("#bu_email").val(data.user_buEmail);
                $("#department").val(data.do_id);
                $("#gender").val(data.user_gender);
                $("#contact_num").val(data.user_contactNum);
                $("#type").val(data.user_type);
             

            
           
                

                $('.modal-title').text("Edit  Details");
                $('#course_id').val(data.user_ref_id);
              
                $('#action').val("Save");
                $('#operation').val("Edit");


            }
        })
    });
            
 });
</script>

