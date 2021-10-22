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
      function fetch_data($conn,$department,$month)  
      {  
          $output = '';  
          $sql="SELECT * FROM appointment as a 
          JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id
          JOIN user as u ON ap.user_ref_id = u.user_ref_id
           WHERE a.department_target_id=? AND ( a.apt_mode=5 or a.apt_mode=3)  and a.apt_all_status=0
          and DATE_FORMAT(a.apt_scheduleDate,'%b %Y') =? and a.apt_scheduleDate<current_date() ";
          //and a.apt_scheduleDate<current_date()
          
        
          $stmt=mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: cart.php?error=stmtfailed");
            exit();
          }
          mysqli_stmt_bind_param($stmt,"ss",$department,$month);	
          mysqli_stmt_execute($stmt);
          $resultData = mysqli_stmt_get_result($stmt);
          $arr = array();  
       
           $count=1;
          $counted='1';
          
          $prev= '';
          while($row = mysqli_fetch_assoc($resultData)){

            $full_name= ucfirst($row['user_firstName']).' '.ucfirst($row['user_middleName']).' '.ucfirst($row['user_lastName']);
            $sched= $row["apt_scheduleDate"].':'.$row["apt_startTime"].'-'.$row["apt_endTime"];
         
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
           
              $apt_title='';
              $result='';
            
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
                         
                       </tr>  
                       

                      ';  
                     
                      $count++;
                      $counted=$count;

                      $prev =  $row["apt_ref_id"]; 
                

        

   
          
            
         


           }            
    
          $count=$count-1;
           $output .= '<tr>   
                          <td colspan="3"><b>Department/Offices:</b>'.$month.'</td>  
                          <td colspan="4"><b>Month:</b>'.$month.'</td>  
                      </tr>  
                      <tr>   
                          <td colspan="3"><b>Total Appointmnet: </b> '.$count.'</td>  
                          <td colspan="4"><b>Total Person:</b></td>  
                      </tr>  
                  ';  
                          
           
          return $output;  
      } 



      
 if(isset($_POST["create_pdf"]))  {

  // Include the main TCPDF library (search for installation path).
  require_once('includes/tcpdf/tcpdf.php');

  // create new PDF document
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('dsadsa');
  $pdf->SetTitle('dsadsa');
  $pdf->SetSubject('dsadas');
  $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
  
  // set default header data
  $pdf->SetHeaderData('2.jpg',40, 'BUPC Appointment Scheduling System', 'Monthly Report', array(0,64,255), array(0,64,128));
  $pdf->setFooterData(array(0,64,0), array(0,64,128));
  
  // set header and footer fonts
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  
  // set default monospaced font
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
  // set margins
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  
  // set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
  // set image scale factor
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
  // set some language-dependent strings (optional)
  if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
  }
  
  // ---------------------------------------------------------
  
  // set default font subsetting mode
  $pdf->setFontSubsetting(true);
  
  // Set font
  // dejavusans is a UTF-8 Unicode font, if you only need to
  // print standard ASCII chars, you can use core fonts like
  // helvetica or times to reduce file size.
  $pdf->SetFont('dejavusans', '', 8, '', true);
  
  // Add a page
  // This method has several options, check the source code documentation for more information.
  $pdf->AddPage();
  
  // set text shadow effect
  $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
  
  // Set some content to print
  $content = '';  
      $content .= '  
                  
                 <style>
                 table, td, th {
                  border: 0.3px solid #8c8382;
                }
                 </style>
                 <br><br>
               <p>  <h4>Legend:</h4> Student(S) Teaching Faculty(T) Non Teaching (N) Visitor(V)  </p>
                 <table  class="table table-bordered">  
	              <tr style="background-color:#1EA5F7;color:white;">
                   <th width="5%">ID</th>  
                    <th width="10%">ID</th>  
                    <th width="20%">Title/Purpose</th>  
                    <th width="15%">Sched</th>  
                    <th width="35%">Names</th>  
                    <th width="5%">Type</th>  
                    <th width="10%">Extra</th> 
                 </tr>
      ';  
     $content .= fetch_data($conn,$_GET['department'],$_GET['month']);  
    $content .= '</table>';  
  
  // Print text using writeHTMLCell()
//  $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);
$pdf->writeHTML($content); 
  
  // ---------------------------------------------------------
  
  // Close and output PDF document
  // This method has several options, check the source code documentation for more information.
  ob_end_clean();
 
  $pdf->Output('example_001.pdf', 'I');



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

    <title>Report</title>
  </head>
  <body>
  
  <?php  include_once('includes/sidenav.php') ?>
  <!-- SELECT DISTINCT(DATE_FORMAT(apt_scheduleDate,'%b %Y')) as archive_dt FROM appointment WHERE apt_scheduleDate < CURRENT_DATE() -->
  <!-- SELECT * FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id JOIN user as u ON ap.user_ref_id = u.user_ref_id -->
        <div class="container" >
          <form class="form-group" action="report.php" method="GET">

                                <label>Department</label>
                                <select id="department" name="department" class="form-control" required>
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
                                  <label>Month</label>
                             <select id="month" name="month" class="form-control" required>
                                  <!-- <option selected="true" disabled="disabled">Please select Month</option>   -->
                                   
                                  <?php
                                        $department_query = " SELECT DISTINCT(DATE_FORMAT(apt_scheduleDate,'%b %Y')) as archive_dt 
                                                            FROM appointment 
                                                            WHERE apt_scheduleDate < CURRENT_DATE()  ";
                                        $result = $conn->query($department_query);
                                        if ($result->num_rows >0) {
                                        while ($row=$result->fetch_assoc()) {
                                        echo "<option value='{$row["archive_dt"]}'>{$row['archive_dt']}</option>";
                                        }
                                        }else{
                                        echo "<option value=''>Month not available</option>";
                                        }
                                    ?>
                             </select>
                                                     
                           <input class="btn btn-primary" type="submit" name="btn-report" value=" Generate Report">     
                           
                          
          </form>
      </div>


      <div class="container">  
               
                <div class="table-responsive" style="width:700px;">  
                     <table class="table table-bordered">  
                          <tr>  
                              <th width="2%">No.</th> 
                               <th width="5%">ID</th>  
                               <th width="25%">Title/Purpose</th>  
                               <th width="15%">Sched</th>  
                               <th width="35%">Names</th>  
                               <th width="5%">Type</th>  
                               <th width="30%">Extra</th>  
                          </tr>  
                     <?php  
                         if(isset($_GET['btn-report'])){
                          $month = $_GET['month'];
                          $department = $_GET['department'];
                    
                          echo  fetch_data($conn,$department,$month);
                        }
                    
                     ?>  
                     </table>  
                     <br />  
                     
                     
                </div>  
                <form method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                     </form> 
     </div>  
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<!-- SELECT * FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id JOIN user as u ON ap.user_ref_id = u.user_ref_id WHERE a.department_target_id=36 AND ( a.apt_mode=5 or a.apt_mode=3) and DATE_FORMAT(a.apt_scheduleDate,'%b %Y')='Oct 2021' -->

