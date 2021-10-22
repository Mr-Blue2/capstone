<?php

     // connection
     require_once 'db.inc.php';
     require_once 'func.inc.php';
     
    require_once 'email_config.php';

  if(isset($_POST['bu_email']))   {
    
     if (isset($_FILES['file']['name'])){
             
  

            $bu_email = $_POST['bu_email'];
            $last_name=$_POST['last_name'];
            $first_name=$_POST['first_name'];
            $middle_name=$_POST['middle_name'];
            $gender=$_POST['gender'];
            $contact_num=$_POST['contact_num'];
            $department=$_POST['department'];
            $message=$_POST['message'];
            $date_sched=$_POST['date_sched'];
            $user_type='V';
            $user_ref_id=get_random_figures(isset($user_ref_id));
            $apt_ref_id=get_random_figures(isset($apt_ref_id));
            date_default_timezone_set('Asia/Manila');
            $currentTime = date('Y-m-d H:i:s');
            $apt_mode=5; /// for viitor
            $start_time=$_POST['start_time'];
            $end_time=$_POST['end_time'];
        

            trim($department);
            $code =explode (",", $department); 
            $with_list=$_POST['with_list'];
            if($with_list===''){
                 $with_list_count=1;
            }else{
            
                $withlist_array = explode(",", $with_list);
                $with_list_count = count($withlist_array) + 1;
                
            }
           
            // dcode 1 kung kay ninpo ma appt

            //bu mail sya yung ma appt or creator

            $check = checkIfAptFull($conn,$date_sched,$code[0],$with_list_count);
            
            $value=getUserRefId($conn,trim($bu_email));

            //email

            $subject= "Visitor Request";
            
            $title="Visitor";
            $creator= ucfirst($first_name).' '.ucfirst($middle_name).' '.ucfirst($last_name);
            $final_time=$date_sched .'('.$start_time.'-'.$end_time.')';
            $participants=$with_list;



$body= '
  
<style>
/* -------------------------------------
    INLINED WITH htmlemail.io/inline
------------------------------------- */
/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 620px) {
  table[class=body] h1 {
    font-size: 28px !important;
    margin-bottom: 10px !important;
  }
  table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
    font-size: 16px !important;
  }
  table[class=body] .wrapper,
        table[class=body] .article {
    padding: 10px !important;
  }
  table[class=body] .content {
    padding: 0 !important;
  }
  table[class=body] .container {
    padding: 0 !important;
    width: 100% !important;
  }
  table[class=body] .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
  }
  table[class=body] .btn table {
    width: 100% !important;
  }
  table[class=body] .btn a {
    width: 100% !important;
  }
  table[class=body] .img-responsive {
    height: auto !important;
    max-width: 100% !important;
    width: auto !important;
  }
}

/* -------------------------------------
    PRESERVE THESE STYLES IN THE HEAD
------------------------------------- */
@media all {
  .ExternalClass {
    width: 100%;
  }
  .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
    line-height: 100%;
  }
  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }
  #MessageViewBody a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
  }
  .btn-primary table td:hover {
    background-color: #34495e !important;
  }
  .btn-primary a:hover {
    background-color: #34495e !important;
    border-color: #34495e !important;
  }
}
</style>
</head>
<body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
  <tr>
    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
    <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
      <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

        <!-- START CENTERED WHITE CONTAINER -->
        <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

          <!-- START MAIN CONTENT AREA -->
          <tr>
            <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                <tr>
                <td align="center"><img src="https://fv9-1.failiem.lv/thumb_show.php?i=wwrhsj4jz&view" width="60%"></td>
                </tr>
                
                <tr>
                  <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                    <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-top: 1px solid #ff7802;">Title:
                      <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #009BDE">'.$title.'</small></p>

                    <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; ">Status:
                      <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #ff7802;;">Requesting</small></p>

                    <p style="font-family: sans-serif; font-size: 17px; font-weight: normal; margin: 0; Margin-bottom: 15px; font-style: italic; color: #009BDE;">'.$creator.'
                      <small style="font-family: sans-serif; font-size: 16px; color: #ff7802;;">is requesting an appointment</small></p>

                    <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; ">Message:
                     <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #009BDE">'.$message.'</small></p>

                    <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #ff7802; font-style: italic;"><a href="" style=" color:#ff7802;"> More Appointment Details</a></p>

                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Schedule &nbsp;<small style="color: #009BDE;">'.$final_time.'</small></p>

                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-bottom: 1px solid #ff7802;"></p>

        

                    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-bottom: 1px solid #ff7802;">With :'.$participants.'</p>
                    
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                      <tbody>
                        <tr>
                          <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                              <tbody>
                                <tr>
                                  <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;">
                                    <!-- <a href="http://htmlemail.io" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">LOGIN NOW</a> -->
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                </tr>

              </table>
            </td>
          </tr>

        <!-- END MAIN CONTENT AREA -->
        </table>

';

           
            // work in progress


    if($check==="Y"){

                       if(is_null($_FILES['file']['name'])){
                                    echo "no_file_uploaded";
                                
                            }
                                // file upload
                        else  if(isset($_FILES['file']['name'])){
                                /* Getting file name */
                                $filename = $_FILES['file']['name'];
                                /* Location */
                                $location = "../uploads/visitor/".$filename;
                                $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                                $imageFileType = strtolower($imageFileType);
                            
                                /* Valid extensions */
                                $valid_extensions = array("jpg","jpeg","png","pdf");
                            
                                if( $_FILES["file"]["size"]>500000 ){
                                    echo "File size big";
                                }
                                else if(!in_array(strtolower($imageFileType), $valid_extensions)) {
                                    echo "Not valid extension";
                                }else if(  move_uploaded_file($_FILES['file']['tmp_name'],$location)) {

                                    
                                //////////emailinh part
                                             $recipient_arr=[];
                                            array_push($recipient_arr,trim($code[1]));
                                             
                                            emailMultiple($subject,$body,$recipient_arr);  
                                      
                                            insertVisitor($conn,$user_type,$user_ref_id,$bu_email,$last_name,$first_name,$middle_name,$gender,$_FILES['file']['name']);// name
                                            insertVisitorAppt($conn,$apt_ref_id,$currentTime,$user_ref_id,$date_sched,$message,$apt_mode,$code[0],$with_list_count,$start_time,$end_time);// apt solo  
                                            insertAppointmentVisitorParticipant($conn,$apt_ref_id,$bu_email,$value);
                                            insertAppointmentVisitorParticipant($conn,$apt_ref_id,$code[1],$value); 
                                            echo "You have successfully made an appointment. Please wait for an email for updates.";
                                       
                            
                                }

                        }

    }else{
        echo  "Sorry slot remaining  for {$date_sched} is  good for {$check} only. ";
    }
         
    

}else{
    echo "No file Uploadded";
}


  }else{
    header("Location: ../home.php");
    exit();
  }
?>