<?php


      //////// session of admin
      session_start();
      $session_user_type =$_SESSION['user_type'];
      //$_SESSION['user_buEmail'];
      if (is_null( $_SESSION['user_ref_id'])){
          header("location: ../index.php");
      }else if($session_user_type!=='A'){
          header("location: ../index.php");
      }
      ///////////////// 


      require_once ('../includes/db.inc.php');
      function fetch_data($conn,$department,$start_date,$end_date,$option)  
      {  

          $output = '';  

          if($option==2)
            $sql="SELECT * FROM appointment as a 
            JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id
            JOIN user as u ON ap.user_ref_id = u.user_ref_id
            WHERE a.department_target_id=? AND ( a.apt_mode=5 or a.apt_mode=3)  and a.apt_all_status=0
            and (a.apt_scheduleDate BETWEEN ? AND ?) ";
          else

          $sql="SELECT * FROM appointment as a 
          JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id
          JOIN user as u ON ap.user_ref_id = u.user_ref_id
          JOIN department_offices as d on d.department_offices_id= a.department_target_id
           WHERE ( a.apt_mode=5 or a.apt_mode=3)  and a.apt_all_status=0
          and a.apt_scheduleDate=current_date()  ORDER BY  d.department_offices_desc ASC ,a.apt_startTime ASC
          ";
          // ORDER BY  d.department_offices_desc ASC ,a.apt_startTime ASC

          
            
          $stmt=mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: cart.php?error=stmtfailed");
            exit();
          }
       
          
          if($option==2)
             mysqli_stmt_bind_param($stmt,"sss",$department,$start_date,$end_date);	

          mysqli_stmt_execute($stmt);
          $resultData = mysqli_stmt_get_result($stmt);
          $arr = array();  
           
          $count=1;
          $counted='1';
          
          $prev= '';
          $prev_desc='';
          while($row = mysqli_fetch_assoc($resultData)){
            
            $full_name= ucfirst($row['user_firstName']).' '.ucfirst($row['user_middleName']).' '.ucfirst($row['user_lastName']);
            $sched= $row["apt_scheduleDate"].':'.$row["apt_startTime"].'-'.$row["apt_endTime"];
             $cancel='<a id="'.$row['apt_ref_id'].'" class="btn btn-warning btn-cancel">Cancel </a>';
             $apt_ref_id= $row["apt_ref_id"];
             $apt_title= $row["apt_title"];
             $user_type=$row["user_type"];
             $result= $row["apt_result"];

             switch($user_type){
              case "T": $user_type= "Teaching"; break;
              case "NT": $user_type= "Non Teaching"; break;
              case "S": $user_type= "Student"; break;
              case "V": $user_type= "Visitor"; break;

            }

        
             
         
             if ($prev === $apt_ref_id){ 

              $apt_ref_id='';
              $count--;
              $counted='';
              $cancel='';
              $apt_title='';
              $result='';
            

            } 
            if($option==1){
            $dept_name= $row["department_offices_desc"];
            $desc='<tr> <td colspan=7> <b> '.$dept_name.' </b> </td> </tr> ';
            if ($prev_desc === $dept_name){ 

               $desc='';
            
            } 
            $output .= ''.$desc.' ';
           }


            $output .= '

                      
                
                      <tr>   
                            <td>'.$counted.'</td>  
                            <td>'.$apt_ref_id.'</td>  
                            <td>'.$apt_title.'</td>  
                            <td>'.$sched.'</td>  
                            <td>'.$full_name.'</td>  
                            <td>'.$user_type.'</td>  
                            <td>'.$result.'</td>  
                            <td>'.$cancel.'</td>  
                       </tr>  
                       

                      ';  
                     
                      $count++;
                      $counted=$count;

                      $prev =  $row["apt_ref_id"]; 
                  if($option==1)
                      $prev_desc = $row["department_offices_desc"]; 


           }            
    
          $count=$count-1;
        //    $output .= '<tr>   
        //                   <td colspan="3"><b>Department/Offices:</b>'.$month.'</td>  
        //                   <td colspan="4"><b>Month:</b>'.$month.'</td>  
        //               </tr>  
        //               <tr>   
        //                   <td colspan="3"><b>Total Appointmnet: </b> '.$count.'</td>  
        //                   <td colspan="4"><b>Total Person:</b></td>  
        //               </tr>  
        //           ';  
                          
           
          return $output;  
      } 

?> 
   
      <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


      <!-- -alert plugin -->
   <link rel="stylesheet" href="../assets/css/jquery-confirm.min.css" />
    <title>Report</title>
  </head>
  <body>
  
  <?php  include_once('includes/sidenav.php') ?>
  <!-- SELECT DISTINCT(DATE_FORMAT(apt_scheduleDate,'%b %Y')) as archive_dt FROM appointment WHERE apt_scheduleDate < CURRENT_DATE() -->
  <!-- SELECT * FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id JOIN user as u ON ap.user_ref_id = u.user_ref_id -->
        <div class="container" >
      

          <form class="form-group" action="appointments.php" method="GET">
          <br>
          <input class="btn btn-danger " type="submit" name="btn-today" value="All Today">  
          <br>
                <div class="form-row">
                <div class="col">
                            <label>Department</label>
                            <select id="department" name="department" class="form-control">
                                            <!-- <option selected="true" disabled="disabled">Please select Department</option>   -->
                                                <!-- deparment choices -->
                                            <?php
                                                    $department_query = "SELECT * FROM department_offices  WHERE do_active=1";
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
                </div>
                <div class="col">
                       <label>Start Date</label>
                        <input id="sched_date" name="sched_date" class="form-control" type="date">
                </div>
                <div class="col">
                       <label>End Date</label>
                        <input  name="end_sched_date" class="form-control" type="date">
                </div>

                <div class="col">
                       <br>
                       <input class="btn btn-primary btn-lg" type="submit" name="btn-report" value="Check">  
                </div>
            </div>
                  
                                                    
          </form>
      </div>


      <div class="container">  
                <div class="table-responsive" style="width:900px;">  
                     <table class="table table-bordered">  
                          <tr>  
                              <th width="2%">No.</th> 
                
                               <th width="7%">ID</th>  
                               <th width="35%">Title/Purpose</th>  
                               <th width="15%">Sched</th>  
                               <th width="35%">Names</th>  
                               <th width="5%">Type</th>  
                               <th width="30%">Extra</th>  
                               <th width="30%">Cancel</th>  
                               
                          </tr>  
                     <?php  
                         if(isset($_GET['btn-report'])){
                          $start_date = $_GET['sched_date'];
                          $end_date = $_GET['end_sched_date'];
                          $department = $_GET['department'];
                          echo  fetch_data($conn,$department,$start_date,$end_date,2);
                        }

                        if(isset($_GET['btn-today'])){
                            $start_date = $_GET['sched_date'];
                            $end_date = $_GET['end_sched_date'];
                            $department = $_GET['department'];
                            echo  fetch_data($conn,$department,$start_date,$end_date,1);
                          }
                    
                     ?>  
                     </table>  
                     <br />  
                     
                     
                </div>  
               
     </div>  
                          

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../assets/js/jquery-confirm.min.js"></script>


    <script>

      
    $(document).ready(function(){
              
              $(".btn-cancel").click(function(e){
                 // alert($(this).attr('id'));
                  e.preventDefault();

                  var cancel_id =$(this).attr('id');

                    $.confirm({
                    title: 'Why force cancel?',
                    content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Enter something here</label>' +
                    '<textarea rows="4" cols="50" class="name form-control" required id="reason"> </textarea>' +
                    '</div>' +
                    '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function () {
                                var reason = $("#reason").val();
                                if(!reason){
                                    $.alert('provide a valid name');
                                    return false;
                                }

                                $.ajax({
                                        type: 'POST',
                                    
                                        url: './includes/appointment.inc.php',
                                        data: {
                                            'cancel_id':cancel_id,
                                            'reason':reason
                                        },
                                        success: function(data) {
                                            location.reload();
                                           
                                          
                                        }
                                    });
                                
                            }
                        },
                        cancel: function () {
                            //close
                        },
                    },
                    onContentReady: function () {
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });
              });
    });

    </script>
  </body>
</html>

<!-- SELECT * FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id JOIN user as u ON ap.user_ref_id = u.user_ref_id WHERE a.department_target_id=36 AND ( a.apt_mode=5 or a.apt_mode=3) and DATE_FORMAT(a.apt_scheduleDate,'%b %Y')='Oct 2021' -->

