<?php

    require_once 'db.inc.php';
    require_once 'func.inc.php';
    require_once 'email_config.php';


    date_default_timezone_set('Asia/Manila');
    
    require("PHPMailer/src/PHPMailer.php");
	require("PHPMailer/src/SMTP.php");
	
	$mail= new PHPMailer\PHPMailer\PHPMailer();

	// $mail->SMTPDebug = 2;
	$mail->isSMTP();
	$mail->Host="smtp.hostinger.com";
	$mail->SMTPAuth = true;
	$mail->Username ="bupcass@bupcappointmentschedulingsystem.online";
	$mail->Password = "Watatot123"; 
	$mail->SMTPSecure = "ssl";
	$mail->Port="465" ;
	$mail->From = "bupcass@bupcappointmentschedulingsystem.online";
	$mail->FromName = "BUPC Appointment System";
	$mail->isHTML(true);
	$mail->Subject ="Reminder";

    $sql= "SELECT * FROM appointment as a
            JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id 
            JOIN user as u ON u.user_ref_id = ap.user_ref_id 
            WHERE a.apt_scheduleDate =CURRENT_DATE()";
	$stmt= mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=sqlerror");
        exit();
    }
		mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $arr = array();          
        while($row = mysqli_fetch_assoc($resultData)){
                array_push($arr,$row);            
            }
           
        mysqli_stmt_close($stmt);  

     foreach($arr as $value){
        
     $full_name= ucfirst($value['user_firstName']).' '.ucfirst($value['user_middleName']).' '.ucfirst($value['user_lastName']);  
     $link= "https://bupcappointmentschedulingsystem.online/index.php";

     $date_apt_sched =new DateTime($value["apt_scheduleDate"]);
     $result_date_only = $date_apt_sched->format('M j'); 
     // time am or pm
     $date1 = new DateTime($value["apt_startTime"]);
     $start_time=$date1->format('h:i a') ;
     $date2 = new DateTime($value["apt_endTime"]);
     $end_time=$date2->format('h:i a') ;
     $final_time= $result_date_only.'('.$start_time .'-'.$end_time.')';
     $title=$value['apt_title'];
     $result= $value['apt_result'];
    

     $body='

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
                         <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-top: 1px solid #ff7802;">Hi!,
                           <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #009BDE">'.$full_name.'</small></p>
 
                         <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px;">This is a reminder you have an appointment TODAY:
                        
                        </p>
                           
                        <p style="font-family: sans-serif; font-size: 15px; font-weight: normal; margin: 0; Margin-bottom: 15px;"> <b>
                        '.$title.' - '.$final_time.' - '.$result.'  </b>
                         </p> 
 
                         <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #ff7802;">Welcome to <small style="font-family: sans-serif; font-size: 15px; color: #009BDE; font-style: italic;"> Bicol University Polangui Campus </small> Appointment Scheduling System</p>
 
                         <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-bottom: 1px solid #ff7802;">Note: Button below will not work if this message is on spam.</p>
                         
                         <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                           <tbody>
                             <tr>
                               <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                 <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                   <tbody>
                                     <tr>
                                       <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;">
                                         <a href="'.$link.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">Go to the system</a>
                                       </td>
                                     </tr>
                                   </tbody>
                                 </table>
                               </td>
                             </tr>
                           </tbody>
                         </table>
 
                         <!-- <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
                         <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Good luck! Hope it works.</p> -->
                       </td>
                     </tr>
                   </table>
                 </td>
               </tr>
 
             <!-- END MAIN CONTENT AREA -->
             </table>
 
             <!-- START FOOTER -->
             <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
               <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                 <tr>
                   <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                     <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Bicol University Polangui Campus</span>
                     <br>Polangui Albay<br><!-- <a href="" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">BSIT-3B</a>. -->
                   </td>
                 </tr>
                 <tr>
                   <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                     2021-2022 <a href="" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">BSIT 3-B</a>.
                   </td>
                 </tr>
               </table>
             </div>
             <!-- END FOOTER -->
 
           <!-- END CENTERED WHITE CONTAINER -->
           </div>
         </td>
         <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
       </tr>
     </table>
   </body>
   ';
   /// send it 
   
   $mail->Body =$body;
   $mail->AltBody= "thos is plain version";
   $mail->AddAddress($value['user_buEmail']);
	if(!$mail->send()){
		$result = 0;
	}
	else{

	   $result = 1;
	   $mail->ClearAddresses();

	}
    
    echo $result;

  }


  ?>