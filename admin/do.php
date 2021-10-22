<?php


    
    //////// session of admin
    session_start();
    $session_user_type =$_SESSION['user_type'];
    //$_SESSION['user_buEmail'];
    if (is_null( $_SESSION['user_ref_id'])){
        header("location: ../index.php");
        exit();
    }else if($session_user_type!=='A'){
        header("location: ../index.php");
        exit();
    }
    ///////////////// 
    
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
                          <th width="10%">Type</th>
                           <th width="10%">Code</th>
                           <th width="20%">Description</th>
                           <th width="10%">Person Per day</th>
                           <th width="10%">Assigned Email</th>    

                           <th scope="col" width="5%">Edit</th>
                           <th scope="col" width="5%">Delete</th> 
                        </tr>
                    </thead>
                </table>
            </br>
               
   </div>        
  
   <?php include_once('includes/sidenav.php')?>
   
<div id="userModal" class="modal">
    <div class="modal-dialog">
        
        <form method="post" id="course_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <h4 class="modal-title">Add Department or Offices </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
              
                    <label>Type</label>
                     <select id="type" name="type" class="form-control">
                     <option selected="true" disabled="disabled">Please select Type</option>
                         <option value="o">Office</option>
                         <option value="d">Department</option>
                         
                     </select>
                    <br />

                 
                    <label>Short Code</label>
                    <input type="text" id="code" class="form-control" />
                    <br /> 
                    <label>Descripton</label>
                    <input type="text"  id="desc" class="form-control" />
                    <br />
                    <label>Person per Day</label>
                    <input type="text"  id="person_per_day" class="form-control" />
                    <br />
                    <label>Email to be assigned</label>    
                        <input type="text" list="email" class="form-control" name="Typelist"/>
                        <datalist id="email" name='test'>
                                         <option selected="true" disabled="disabled">Please select or type</option>
                        <?php
                                        $department_query = "SELECT user_buEmail FROM  user  WHERE user_accountStatus=1 and (user_type='T' or user_type='NT' ) ";
                                        $result = $conn->query($department_query);
                                        if ($result->num_rows >0) {
                                        while ($row=$result->fetch_assoc()) {
                                        echo "<option value='{$row["user_buEmail"]}'>{$row['user_buEmail']}</option>";
                                        }
                                        }else{
                                        echo "<option value=''>No user</option>";
                                        }
                                    ?>
                        </datalist>
                                            
                  
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
        var code= $('#code').val();
        var desc = $('#desc').val();
        var person_per_day = $('#person_per_day').val();
        var email= $('[name="Typelist"]').val();
        var operation = $('#operation').val();
        
        if(type != '' && code != '' && desc != '' & email != '' & person_per_day != '')
        {
            $.ajax({
                    type: 'POST',
                    url: './includes/do.insert_user.php',
                    //timeout: 20000,
                
                    data: {
                        'course_id':course_id,
                        'operation': operation,
                        'type': type,
                        'code':code,
                        'desc':desc,
                        'person_per_day':person_per_day,
                        'email':email
                    
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
                    url:"includes/do.fetch.inc.php",
                    type:"POST"
                    } 
            });


                
    $(document).on('click', '.update', function(){
        var course_id = $(this).attr("id");
       
        $.ajax({

            url:"./includes/do.fetch_single.inc.php",
            method:"POST",
            data:{course_id:course_id},
            dataType:"json",
            success:function(data)
            {
              
                $('#userModal').modal('show');
                $("#type").val(data.do_type);
                $('#code').val(data.department_offices__short_desc);
                $('#desc').val(data.department_offices_desc);
                $('#person_per_day').val(data.do_counter);
                $('[name="Typelist"]').val(data.ass_user_ref_id);

                $('.modal-title').text("Edit  Details");
                $('#course_id').val(data.department_offices_id);
              
                $('#action').val("Save");
                $('#operation').val("Edit");
                

               
                
            }
        })
    });
            
 });
</script>

