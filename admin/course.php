<?php
    require_once ('../includes/db.inc.php');
    $connect="mysql:host={$db_servername};dbname={$db_name}";
    $connection = new PDO($connect , $db_username, $db_password );
?>


<!doctype html>
<head>
    
   
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    
	<!-- bootstrap Lib -->
   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
   
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <link rel="stylesheet" type="text/css" href="includes/DataTables/datatables.min.css"/>
 
         <script type="text/javascript" src="includes/DataTables/datatables.min.js"></script>
</head>


<body>

<?php include_once('includes/sidenav.php') ?>
  
   <div class="container-fluid"> 
                <div align="right">
                    <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-sm">Add New course</button>
                </div>
              
                <table id="table" class="table table-striped">  
                    <thead bgcolor="#6cd8dc">
                        <tr class="table-primary">
                          <th width="10%">Department</th>
                           <th width="10%">Code</th>
                           <th width="20%">Description</th>

                           <th width="20%">Student User</th>
                         

                           <th scope="col" width="5%">Edit</th>
                           <th scope="col" width="5%">Delete</th> 
                        </tr>
                    </thead>
                </table>
            </br>
               
   </div>        
  









   
<div id="userModal" class="modal " >
    <div class="modal-dialog">
        <form method="post" id="course_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Department or Offices </h4>
                </div>
                <div class="modal-body">
              
                    <label>Department</label>
                     <select id="type" name="type" class="form-control">
                     <option selected="true" disabled="disabled">Please select Type</option>
                     <?php
                                        $department_query = "SELECT * FROM department_offices  WHERE do_type='d' and do_active =1";
                                        $result = $conn->query($department_query);
                                        if ($result->num_rows >0) {
                                        while ($row=$result->fetch_assoc()) {
                                        echo "<option value='{$row["department_offices_id"]}'>{$row['department_offices_desc']}</option>";
                                        }
                                        }else{
                                        echo "<option value=''>Department not available</option>";
                                        }
                                    ?>
                         
                     </select>
                    <br />

                 
                    <label>Short Code</label>
                    <input type="text" id="code" class="form-control" />
                    <br /> 
                    <label>Descripton</label>
                    <input type="text"  id="desc" class="form-control" />
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
        var operation = $('#operation').val();
        
        if(type != '' && code != '' && desc != ''  )
        {
            $.ajax({
                    type: 'POST',
                    url: './includes/course.insert_user.php',
                    //timeout: 20000,
                
                    data: {
                        'course_id':course_id,
                        'operation': operation,
                        'type': type,
                        'code':code,
                        'desc':desc
                       
                    
                    },
                    success: function(data) { 
                       
                      alert(data);
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
                    url:"includes/course.fetch.inc.php",
                    type:"POST"
                    } 
            });


                
    $(document).on('click', '.update', function(){
        var course_id = $(this).attr("id");


       
        $.ajax({

            url:"./includes/course.fetch_single.inc.php",
            method:"POST",
            data:{course_id:course_id},
            dataType:"json",
            success:function(data)
            {
              
                $('#userModal').modal('show');
                $("#type").val(data.department_offices_id);
                $('#code').val(data.course_short_desc);
                $('#desc').val(data.course_desc);
               

                $('.modal-title').text("Edit  Details");
                $('#course_id').val(data.course_id);
              
                $('#action').val("Save");
                $('#operation').val("Edit");
                

               
                
            }
        })
    });
            
 });
</script>

