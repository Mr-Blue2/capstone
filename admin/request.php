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
    <title>Request</title>

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

   <div class="container"> 
                <table id="request_table" class="table table-striped" align="center">  
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
                            
                           <th scope="col" width="5%">Approve</th>
                           <th scope="col" width="5%">Edit</th>
                           <th scope="col" width="5%">Delete</th>
                        </tr>
                    </thead>
                </table>
            </br>    
   </div>        
 </body>
 </html>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){

    var dataTable = $('#request_table').DataTable({
        "paging":true,
        "processing":true,
        "serverSide":true,
        "order": [],
        "info":true,
        "ajax":{
            url:"includes/request_fetch.inc.php",
            type:"POST"
               },
        "columnDefs":[
            {
                "targets":[9,10,11,12],
                "orderable":false,
            },
        ],    
    });
    
});
</script>