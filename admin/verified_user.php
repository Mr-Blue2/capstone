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


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

      
	<!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
   




    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>



    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <script src="includes/DataTables/Editor-2021-10-07-2.0.5/js/dataTables.editor.min.js"></script>
    
    
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

     

</head>
<body>


<div class="container">
     <table id="example" class="table table-striped">
        <thead bgcolor="#6cd8dc">
            <tr class="table-primary">
                <th>First name</th>
                <th>Last name</th>
                <th>Location</th>
                <th>Department</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="table-primary">
                <th>First name</th>
                <th>Last name</th>
                <th>Location</th>
                <th>Department</th>
            </tr>
        </tfoot>
    </table>
</div>


    
</body>
</html>




<script>

var editor; // use a global for the submit and return data rendering in the examples
 
 $(document).ready(function() {
     editor = new $.fn.dataTable.Editor( {
         ajax: "includes/getusers.php",
         table: "#example",
         fields: [ {
                 label: "First name:",
                 name:  "users.user_firstName"
             }, {
                 label: "Last name:",
                 name:  "users.user_lastName"
             }, {
                 label: "Department:",
                 name:  "users.site",
                 type:  "select"
             }, {
                 label: "Course:",
                 name:  "user_dept.dept_id",
                 type:  "select"
             }
         ]
     } );
  
    //  $('#example').DataTable( {
    //      dom: "Bfrtip",
    //      ajax: {
    //          url: "../php/joinLinkTable.php",
    //          type: 'POST'
    //      },
    //      columns: [
    //          { data: "users.first_name" },
    //          { data: "users.last_name" },
    //          { data: "sites.name" },
    //          { data: "dept.name" }
    //      ],
    //      select: true,
    //      buttons: [
    //          { extend: "create", editor: editor },
    //          { extend: "edit",   editor: editor },
    //          { extend: "remove", editor: editor }
    //      ]
    //  } );
 } );
</script>