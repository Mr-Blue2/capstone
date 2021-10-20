<?php
function test_input($conn,$data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data= htmlentities($data);
	mysqli_real_escape_string($conn,$data);
    return $data;
}


// default time zone
date_default_timezone_set('Asia/Manila');

// generate user ref number
function get_random_figures($str){
    $date_obj = date_create(); 
    $reg_ref_num = date_timestamp_get($date_obj) . random_int(10000,99999) . bin2hex($str);
    return $reg_ref_num;
}
// createUser   // binagao
function createUser($conn,$user_ref_id,$bu_email,$bu_number,$last_name,$first_name,$middle_name,$gender,$course,$year,$block,$contact_num,$password,$verify_token,$filename,$department){
	$sql= "INSERT INTO user (`user_ref_id`,`user_buEmail`,`user_buId`,`user_lastName`,`user_firstName`,`user_middleName`,`user_gender`,`course_id`,`user_year`,`user_block`,`user_contactNum`,`password`,`verify_token`,`user_cor`,`do_id`) 
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	 $stmt= mysqli_stmt_init($conn);
	 if (!mysqli_stmt_prepare($stmt,$sql)) {
	 	header("location:db.inc.php?error=stmtfailed");
	 	exit();
	 }
	    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
	 	mysqli_stmt_bind_param($stmt,"sssssssissssssi",$user_ref_id,$bu_email,$bu_number,$last_name,$first_name,$middle_name,$gender,$course,$year,$block,$contact_num,$hashed_pwd,$verify_token,$filename,$department);
	 	mysqli_stmt_execute($stmt);
	 	mysqli_stmt_close($stmt);
        return true;
}	
///  check exist
function uidExist($conn,$username,$email){
	$result=true;
	$sql= "SELECT  * FROM user WHERE user_buId =? OR user_buEmail=?;";
	 $stmt= mysqli_stmt_init($conn);
	 if (!mysqli_stmt_prepare($stmt,$sql)) {
	 	header("location:../signup.php?error=stmtfailed");
	 	exit();
	 }
	 	mysqli_stmt_bind_param($stmt,"ss",$username,$email);
	 	mysqli_stmt_execute($stmt);

	 	$resultData= mysqli_stmt_get_result($stmt);
	 	if($row=mysqli_fetch_assoc($resultData)){
           return $row;

	 	}else{
	 		$result=false;
	 		return $result;
	 	}
	 	mysqli_stmt_close($stmt);
}

//checck email verified

function  isEmailVerified($conn,$username){
	$result=true;
	$sql= "SELECT  verify_status  FROM user WHERE  user_buEmail=? OR user_buId =?;";
	 $stmt= mysqli_stmt_init($conn);
	 if (!mysqli_stmt_prepare($stmt,$sql)) {
	 	header("location:../signup.php?error=stmtfailed");
	 	exit();
	 }
	 	mysqli_stmt_bind_param($stmt,"ss",$username,$username);
	 	mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		 $vs= mysqli_fetch_assoc($result)['verify_status'];
		 if($vs===0){
			$result =false;
			return $result;
		 }else{
			
			$result ;
		 }
		
}


function  adminVerified($conn,$username){
	$result=true;
	$sql= "SELECT  user_accountStatus  FROM user WHERE  user_buEmail=? OR user_buId =?;";
	 $stmt= mysqli_stmt_init($conn);
	 if (!mysqli_stmt_prepare($stmt,$sql)) {
	 	header("location:../signup.php?error=stmtfailed");
	 	exit();
	 }
	 	mysqli_stmt_bind_param($stmt,"ss",$username,$username);
	 	mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		 $vs= mysqli_fetch_assoc($result)['user_accountStatus'];
		 if($vs===0){
			$result =false;
			return $result;
		 }else{
			
			$result ;
		 }
		
}
// login part
function loginUser($conn,$username,$pwd){

	
	$uidExist= uidExist($conn,$username,$username);
	if ($uidExist===false) {
		return "a";
		exit();
	}
	$email_verified= isEmailVerified($conn,$username);
	if($email_verified===false){
		return "c";
		exit();
	}
	$admin_verified=adminVerified($conn,$username);
	if($admin_verified===false){
		return "d";
		exit();
	}

	$pwd_hashed = $uidExist['password'];

	
	$check_pwd = password_verify($pwd, $pwd_hashed);
	if($check_pwd===false){
		return "b";
	}	
	elseif ($check_pwd===true) {
	    // Start the session
        session_start();
		$_SESSION['user_ref_id']= $uidExist['user_ref_id'];
		$_SESSION['user_buEmail']= $uidExist['user_buEmail'];
		$_SESSION['user_type']= $uidExist['user_type'];
	
		exit();
		
	}
}

// sending meail
class  phpmailer{
	public function sendMail($email,$body,$subject){
		require("PHPMailer/src/PHPMailer.php");
		require("PHPMailer/src/SMTP.php");
	   
	   $mail= new PHPMailer\PHPMailer\PHPMailer();

	   $mail->SMTPDebug = 2;
	   $mail->isSMTP();

	   $mail->Host="mail.smtp2go.com";
	   $mail->SMTPAuth = true;

	   $mail->Username ="bupcsass";
	   $mail->Password = "bG9tZnAzMXBlamsw"; 
	   $mail->SMTPSecure = "tls";

	   $mail->Port="2525" ;

	   $mail->From = "bupcass@bupcappointmentschedulingsystem.online";
	   $mail->FromName = "bupc";

	   $mail->addAddress($email,"BUPCASS");

	   $mail->isHTML(true);

	   $mail->Subject =$subject;
	   $mail->Body =$body;
	   $mail->AltBody= "thos is plain version";

	   $mail->Debugoutput = 'html';

	   if(!$mail->send())
	   	$result = "Error";
       else
	  	 $result = "Success";

	   return $result;

	}
}

function sendMailto($email,$body,$subject){
	require("PHPMailer/src/PHPMailer.php");
	require("PHPMailer/src/SMTP.php");
   
   $mail= new PHPMailer\PHPMailer\PHPMailer();

   $mail->SMTPDebug = 2;
   $mail->isSMTP();

   $mail->Host="mail.smtp2go.com";
   $mail->SMTPAuth = true;

   $mail->Username ="bupcsass";
   $mail->Password = "bG9tZnAzMXBlamsw"; 
   $mail->SMTPSecure = "tls";

   $mail->Port="2525" ;

   $mail->From = "bupcass@bupcappointmentschedulingsystem.online";
   $mail->FromName = "BUPC Appointment Management System";

   $mail->addAddress($email,"BUPCASS");

   $mail->isHTML(true);

   $mail->Subject =$subject;
   $mail->Body =$body;
   $mail->AltBody= "thos is plain version";

   $mail->Debugoutput = 'html';

   if(!$mail->send())
	   $result = 0;
   else
	   $result = 1;

   return $result;

}

//multiple



function emailMultiple($subject,$body,$address){
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
	$mail->Subject =$subject;
	$mail->Body =$body;
	$mail->AltBody= "thos is plain version";

   foreach($address as $value){
	$mail->AddAddress($value);
	if(!$mail->send()){
		$result = 0;
	}
	else{

	   $result = 1;
	   $mail->ClearAddresses();

	}
   }
  
  echo $result;
}
//resendCode

function resendCode($conn,$resend_email){
	$checkemail_query="SELECT  * FROM user WHERE  user_buEmail=?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$checkemail_query)) {
		header("location:test.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$resend_email);
    mysqli_stmt_execute($stmt);

	$resultData= mysqli_stmt_get_result($stmt);
	if($row=mysqli_fetch_assoc($resultData)){
		if($row['verify_status']=="0"){	
           $name= $row['user_lastName'];
		   $email=$row['user_buEmail'];
		   $verify_token= $row['verify_token'];
		   $link="https://bupcappointmentschedulingsystem.online/includes/verify-email.php?token={$verify_token}";

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
							   <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-top: 1px solid #ff7802;">Hi !,
								 <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #009BDE">'.$name.'</small></p>
	   
							   <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Resend :Your request for an account is partially approved. To access your account, please verify your email by clicking the link.</p>
	   
							   <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #ff7802;">Welcome to <small style="font-family: sans-serif; font-size: 15px; color: #009BDE; font-style: italic;"> Bicol University Polangui Campus </small> Appointment Scheduling System</p>
	   
							   <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-bottom: 1px solid #ff7802;">Enjoy making appointments without hassle!</p>
							   
							   <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
								 <tbody>
								   <tr>
									 <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
									   <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
										 <tbody>
										   <tr>
											 <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;">
											   <a href="'.$link.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">VERIFY</a>
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
	
		   $arr=[];
		   array_push($arr,$email);
		   emailMultiple("Resend Code",$body,$arr);
		   return  "sent";
		}else{
		  return "already";
		}
	}else{
	 		
	 	return "notregistered";
	}
	mysqli_stmt_close($stmt);
		
}

// send code to reset
function send_resetPassword($conn,$email){
	$token =md5(rand());

	$uidExist= uidExist($conn,$email,$email);
	if ($uidExist===false) {
		return "not_exist";
	}else{

		$update_token= "UPDATE user SET verify_token=? WHERE user_buEmail=? LIMIT 1;";
		$stmt= mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$update_token)) {
				header("location:test.php?error=stmtfailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss",$token,$email);
			mysqli_stmt_execute($stmt);


			test_input($conn,$email);

		   $link="https://bupcappointmentschedulingsystem.online/password-change.php?token={$token}&email={$email}";

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
							   <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-top: 1px solid #ff7802;">Hi !,
								 <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #009BDE">'.$email.'</small></p>
	   
							   <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Reset Passsword :Click the link below to reset password , You will be directed to the system.</p>
	   
							   <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; color: #ff7802;">Welcome to <small style="font-family: sans-serif; font-size: 15px; color: #009BDE; font-style: italic;"> Bicol University Polangui Campus </small> Appointment Scheduling System</p>
	   
							   <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px; border-bottom: 1px solid #ff7802;">Enjoy making appointments without hassle!</p>
							   
							   <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
								 <tbody>
								   <tr>
									 <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
									   <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
										 <tbody>
										   <tr>
											 <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;">
											   <a href="'.$link.'" target="_blank" style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">RESET</a>
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
	
		   $arr=[];
		   array_push($arr,$email);
		   emailMultiple("Reset Password",$body,$arr);
	
		 
           
			return "sent";
	}

}

//reset_password

function resetPassword($conn,$email,$token,$password){
	$uidExist= uidExist($conn,$email,$email);
	if ($uidExist===false) {
		return "not_exist";
	}else{

		$update_password= "UPDATE user SET password=? WHERE verify_token=? AND user_buEmail =? LIMIT 1;";
		$stmt= mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$update_password)) {
				header("location:test.php?error=stmtfailed");
				exit();
			}
			$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt,"sss",$hashed_pwd,$token,$email);
			mysqli_stmt_execute($stmt);

		  // bukas update naman yung bagong token
			return "reset";
	}
}

// ccreate appt
function createAppointment($conn,$apt_ref_id,$message,$schedule_date,$start_time,$end_time,$mode,$result,$title,$session_user_ref_id,$dept_id,$total){
    $up_date=date('Y-m-d H:i:s');
	$day= "MONDAY";
	$sql= "INSERT INTO appointment (`apt_ref_id`,`apt_scheduleDate`,`apt_day`,`apt_startTime`,`apt_endTime`,`apt_message`,`apt_mode`,`apt_result`,`apt_title`,`apt_creator`,`apt_CreatedAt`,`department_target_id`,`nu_persons`) 
	       VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ;";
	 $stmt= mysqli_stmt_init($conn);
	 if (!mysqli_stmt_prepare($stmt,$sql)) {
	 	header("location:db.inc.php?error=stmtfailed");
	 	exit();
	 }
	 	mysqli_stmt_bind_param($stmt,"sssssssssssii",$apt_ref_id,$schedule_date,$day,$start_time,$end_time,$message,$mode,$result,$title,$session_user_ref_id,$up_date,$dept_id,$total);
	 	mysqli_stmt_execute($stmt);
	 	mysqli_stmt_close($stmt);
        return true;
}

// insert to the appotintmnt participant table

function insertAppointmentParticipant($conn,$apt_ref_id,$email,$session_user_ref_id){
    	$up_date=date('Y-m-d H:i:s');
	    $value=getUserRefId($conn,$email);

		if($value===$session_user_ref_id){
			$ap_status =3;
		}else{
			$ap_status =0;	
		}
		$sql_insert= "INSERT INTO appointment_participants (`apt_ref_id`,`user_ref_id`,`apt_status`,`creator_user_ref_id`,`date_responded`) VALUES (?,?,?,?,?);";
		$stmt_insert= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt_insert,$sql_insert)) {
			header("location:db.inc.php?error=stmtfailed");
					exit();
			}
		mysqli_stmt_bind_param($stmt_insert,"ssiss",$apt_ref_id,$value,$ap_status,$session_user_ref_id,$up_date);
		if(mysqli_stmt_execute($stmt_insert)){
			if($value!==$session_user_ref_id){
				notify($conn,$apt_ref_id,$value,$session_user_ref_id,0,0,"none");
			}
			
		}

}

function getUserRefId($conn,$email){
	$sql= "SELECT user_ref_id from user WHERE user_buEmail=?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"s",$email);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['user_ref_id'];
		return $id;
	
}
function notify($conn,$apt_ref_id,$to_user_ref_id,$from_user_ref_id,$notif_type,$notif_read,$note){
	$up_date=date('Y-m-d H:i:s');
	$sql_insert= "INSERT INTO notification (`apt_ref_id`,`to_user_ref_id`,`from_user_ref_id`,`notif_type`,`notif_read`,`notif_note`,`notif_date`) VALUES (?,?,?,?,?,?,?);";
	$stmt_insert= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt_insert,$sql_insert)) {
		header("location:db.inc.php?error=stmtfailed");
				exit();
		}
	mysqli_stmt_bind_param($stmt_insert,"sssiiss",$apt_ref_id,$to_user_ref_id,$from_user_ref_id,$notif_type,$notif_read,$note,$up_date);
	mysqli_stmt_execute($stmt_insert);

}

function notifyRead($conn,$apt_ref_id,$to_user_ref_id,$from_user_ref_id,$notif_read){
	$sql_insert= "UPDATE notification SET notif_read=? WHERE apt_ref_id =? and from_user_ref_id=? and to_user_ref_id=?;  ";
	$stmt_insert= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt_insert,$sql_insert)) {
		header("location:db.inc.php?error=stmtfailed");
				exit();
		}
	mysqli_stmt_bind_param($stmt_insert,"isss",$notif_read,$apt_ref_id,$to_user_ref_id,$from_user_ref_id);
	mysqli_stmt_execute($stmt_insert);

}
// echo  date('Y-m-d H:i:s');
function updateAptStatus($conn,$apt_status,$apt_ref_id,$to_user_ref_id){
	date_default_timezone_set('Asia/Manila');
	$up_date=date('Y-m-d H:i:s');
	$sql_insert= "UPDATE appointment_participants SET apt_status=? , date_responded=? WHERE apt_ref_id =? and user_ref_id=? ; ";
	$stmt_insert= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt_insert,$sql_insert)) {
		header("location:db.inc.php?error=stmtfailed");
				exit();
		}
	mysqli_stmt_bind_param($stmt_insert,"isss",$apt_status,$up_date,$apt_ref_id,$to_user_ref_id);
	mysqli_stmt_execute($stmt_insert);

}

function cancel($conn,$apt_ref_id,$status){
	$sql_insert= "UPDATE appointment SET apt_all_status=?  WHERE apt_ref_id =? ; ";
	$stmt_insert= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt_insert,$sql_insert)) {
		header("location:db.inc.php?error=stmtfailed");
				exit();
		}
	mysqli_stmt_bind_param($stmt_insert,"is",$status,$apt_ref_id);
	mysqli_stmt_execute($stmt_insert);

}
function displayNotif($conn,$user_ref_id){


	
		$sql="SELECT * FROM  appointment as a
		JOIN  notification as n on a.apt_ref_id=n.apt_ref_id
		JOIN user as u ON u.user_ref_id = n.from_user_ref_id 
		WHERE n.to_user_ref_id=?
		ORDER BY n.notif_date DESC; ";

		// $sql="SELECT * FROM  appointment as a
		// JOIN  notification as n on a.apt_ref_id=n.apt_ref_id
		// JOIN user as u ON u.user_ref_id = n.from_user_ref_id 
		// WHERE n.to_user_ref_id=?
		// ORDER BY  n.notif_type Asc,n.notif_read ASC, n.notif_date DESC;";

	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		header("location: cart.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$user_ref_id);	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	$arr = array();          
	while($row = mysqli_fetch_assoc($resultData)){
			array_push($arr,$row);            
		}
	return $arr;               
	mysqli_stmt_close($stmt);  
}

function displayGoing($conn,$user_ref_id){

	// $sql="SELECT * FROM appointment as a
	// JOIN appointment_participants as ap ON a.apt_ref_id = ap.apt_ref_id
	// JOIN  user as u ON u.user_ref_id = ap.creator_user_ref_id
	// WHERE ap.user_ref_id =? and a.apt_all_status= 0
	// ORDER BY a.apt_scheduleDate  ASC;";

	$up_date=date('Y-m-d');
	$sql = "SELECT * FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id = ap.apt_ref_id JOIN user as u ON u.user_ref_id = ap.creator_user_ref_id 
	WHERE ap.user_ref_id=? and a.apt_all_status= 0 and a.apt_scheduleDate >=current_date()  Order by a.apt_scheduleDate ASC ";


$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
	header("location: cart.php?error=stmtfailed");
	exit();
}
//mysqli_stmt_bind_param($stmt,"ss",$user_ref_id,$up_date);	

mysqli_stmt_bind_param($stmt,"s",$user_ref_id);	
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
$arr = array();          
while($row = mysqli_fetch_assoc($resultData)){
		array_push($arr,$row);            
	}
return $arr;               
mysqli_stmt_close($stmt);  
}



function displayGoingHistory($conn,$user_ref_id){

	// $sql="SELECT * FROM appointment as a
	// JOIN appointment_participants as ap ON a.apt_ref_id = ap.apt_ref_id
	// JOIN  user as u ON u.user_ref_id = ap.creator_user_ref_id
	// WHERE ap.user_ref_id =? and a.apt_all_status= 0
	// ORDER BY ap.date_responded  DESC;";

	$up_date=date('Y-m-d');
	$sql = "SELECT * FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id = ap.apt_ref_id JOIN user as u ON u.user_ref_id = ap.creator_user_ref_id 
	WHERE ap.user_ref_id=? and a.apt_all_status= 0 and a.apt_scheduleDate < ? ORDER BY apt_scheduleDate DESC";


$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
	header("location: cart.php?error=stmtfailed");
	exit();
}
mysqli_stmt_bind_param($stmt,"ss",$user_ref_id,$up_date);	
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
$arr = array();          
while($row = mysqli_fetch_assoc($resultData)){
		array_push($arr,$row);            
	}
return $arr;               
mysqli_stmt_close($stmt);  
}



function getAptPartcipants($conn,$apt_ref_id){
	$sql="SELECT user_ref_id FROM appointment_participants WHERE apt_ref_id =? and apt_status <> 3;";
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		header("location: cart.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$apt_ref_id);	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	$arr = array();          
	while($row = mysqli_fetch_assoc($resultData)){
			array_push($arr,$row);            
		}
	return $arr;               
	mysqli_stmt_close($stmt);  


}


function displayNote($conn,$apt_ref_id,$from_user_ref_id){
	$sql= "SELECT notif_note from notification WHERE  from_user_ref_id =? and  apt_ref_id=?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"ss",$from_user_ref_id,$apt_ref_id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['notif_note'];
		return $id;
	
}


function getAptDetails($conn,$apt_ref_id){
	
	$sql="SELECT * FROM user AS u JOIN appointment_participants as ap ON u.user_ref_id = ap.user_ref_id 
	JOIN appointment as a ON a.apt_ref_id = ap.apt_ref_id WHERE ap.apt_ref_id=? ORDER BY apt_status DESC";
 
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		header("location: cart.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$apt_ref_id);	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	$arr = array();          
	while($row = mysqli_fetch_assoc($resultData)){
			array_push($arr,$row);            
		}
	return $arr;               
	mysqli_stmt_close($stmt);  


}



function getNameWithBUemail($conn,$bu_email){
	$sql='SELECT concat(user_firstName," ",user_middleName," ",user_lastName) as userinfo FROM user WHERE user_buEmail=?';
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		header("location: cart.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$bu_email);	
	mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['userinfo'];
		return $id;     
	mysqli_stmt_close($stmt);  

}

function checkIfAptFull($conn,$apt_schedule,$dept_id,$no_participants){
	$sql= "SELECT IF((
		SELECT do_counter FROM department_offices WHERE department_offices_id=?) >=(SELECT IFNULL(SUM(nu_persons),0) + ?
		FROM appointment
				 WHERE ( apt_mode =3 OR apt_mode=5) and apt_scheduleDate=? and department_target_id=?), 'Y', 
	   (SELECT do_counter FROM department_offices 
	   			WHERE department_offices_id=?)-
	   (SELECT IFNULL(SUM(nu_persons),0) FROM appointment 
	   			WHERE ( apt_mode =3 OR apt_mode=5) and apt_scheduleDate=? and department_target_id=?)) as result;";


	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"iisiisi",$dept_id,$no_participants,$apt_schedule,$dept_id,$dept_id,$apt_schedule,$dept_id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['result'];
		return $id;
	
}

function checkIfDepartment($conn,$email,$dept_id){

    foreach($dept_id as $val){
		$sql= "SELECT count(do_id) as  result
		FROM user 
		WHERE user_buEmail =? and  do_id =?;";
	
	
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("location:db.inc.php?error=stmtfailed");
			exit();
		}
			mysqli_stmt_bind_param($stmt,"si",$email,$dept_id);
			mysqli_stmt_execute($stmt);
			
			$result = mysqli_stmt_get_result($stmt);
			$id= mysqli_fetch_assoc($result)['result'];
			return $id;
	}

	
}

function getUserDetails($conn,$id,$option){

//    1 student
	if($option==1){
		$sql="SELECT * FROM user as u
		JOIN  course as c ON u.course_id = c.course_id
		JOIN  department_offices as d ON d.department_offices_id =c.department_offices_id
		WHERE u.user_ref_id =? or  u.user_buEmail=?";
		// teching or non teaching
	}elseif($option==2){
		$sql="SELECT * FROM user as u 
		JOIN department_offices as d ON u.do_id= d.department_offices_id
		WHERE u.user_ref_id =? or  u.user_buEmail=?";

	}elseif($option==3){
		$sql="SELECT * FROM user WHERE user_ref_id =? or  user_buEmail=?";
	}
	
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		header("location: cart.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ss",$id,$id);	
	mysqli_stmt_execute($stmt);
	$resultData = mysqli_stmt_get_result($stmt);
	$arr = array();          
	while($row = mysqli_fetch_assoc($resultData)){
			array_push($arr,$row);            
		}
	return $arr;               
	mysqli_stmt_close($stmt);  


}


function getUserDetailsByUserOnly($conn,$id){

	//    1 student
	
			$sql="SELECT * FROM user as u
			WHERE user_ref_id =? ";
		
			$stmt=mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)){
				header("location: cart.php?error=stmtfailed");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"s",$id);	
			mysqli_stmt_execute($stmt);
			$resultData = mysqli_stmt_get_result($stmt);
			$arr = array();          
			while($row = mysqli_fetch_assoc($resultData)){
					array_push($arr,$row);            
				}
			return $arr;               
			mysqli_stmt_close($stmt);  
	
	
	}

function emptyInput($first_name,$middle_name,$last_name,$contact_num){
	$result='';
	if (empty($first_name)||empty($middle_name)||empty($last_name)||empty($contact_num)) {
	     $result=true;
	}
	else{
		$result=false;
	}
	return $result;
}
function UploadCheckIfImage($check_if_image){

	if($check_if_image== false){
		$result= true;
	}else{
		$result=false;
	}
	return $result;
}
	

/*function UploadExistImage($target_file){
   if(file_exists($target_file)){
		  $result=true;
   }else{
	   $result=false;
   }
   return $result;
}
*/

function UploadSizeImage($file_size){
	if ($file_size>5000000) {
		$result=true;	
	}else{
		$result=false;
	}
	return $result;

}

function UploadFileTypeImage($imageFileType){
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		$result= true;
	}else{
		$result=false;
	}
	return $result;

}

function update_info($conn,$user_ref_id,$option=1,$first_name,$middle_name,$last_name,$year,$block,$contact_num,$img_name){
        if($option==1){
			$sql= "UPDATE user SET  user_firstName=? , user_middleName=?, user_lastName=? ,user_year=?,user_block=?,user_contactNum=?, user_profile_pic=?  WHERE user_ref_id=?;";
		}
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("location:db.inc.php?error=stmtfailed");
			exit();
		}
			mysqli_stmt_bind_param($stmt,"ssssssss",$first_name,$middle_name,$last_name,$year,$block,$contact_num,$img_name,$user_ref_id);
			mysqli_stmt_execute($stmt);
	
}

function getImg($conn,$user_ref_id){
	$sql= "SELECT  user_profile_pic from user where  user_ref_id=?;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"s",$user_ref_id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['user_profile_pic'];
		return $id;
	
}

function insertVisitor($conn,$user_type,$user_ref_id,$user_buEmail,$user_lastName,$user_firstName,$user_middleName,$gender,$pic){
	  //    
        //    INSERT INTO appointment (`apt_ref_id`,`apt_CreatedAt`,`apt_creator`,`apt_scheduleDate`,`apt_message`,`apt_mode`,`department_target_id`)
	$sql="INSERT INTO  user (`user_type`,`user_ref_id`,`user_buEmail`,`user_lastName`,`user_firstName`,`user_middleName`,`user_gender`,`user_cor`) 
	     VALUES(?,?,?,?,?,?,?,?);";
	$stmt=mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		header("location: cart.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ssssssss",$user_type,$user_ref_id,$user_buEmail,$user_lastName,$user_firstName,$user_middleName,$gender,$pic);	
	mysqli_stmt_execute($stmt);
	

}


function insertVisitorAppt($conn,$apt_ref_id,$apt_created,$apt_creator,$apt_sched,$apt_message,$apt_mode,$department_target_id,$with_list_count,$start_time,$end_time){
	//    
	  //    INSERT INTO appointment (`apt_ref_id`,`apt_CreatedAt`,`apt_creator`,`apt_scheduleDate`,`apt_message`,`apt_mode`,`department_target_id`)
  $sql="INSERT INTO appointment (`apt_ref_id`,`apt_CreatedAt`,`apt_creator`,`apt_scheduleDate`,`apt_title`,`apt_mode`,`department_target_id`,`nu_persons`,`apt_startTime`,`apt_endTime`) 
  		VALUES (?,?,?,?,?,?,?,?,?,?);";
  $stmt=mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
	  header("location: cart.php?error=stmtfailed");
	  exit();
  }
  mysqli_stmt_bind_param($stmt,"sssssiiiss",$apt_ref_id,$apt_created,$apt_creator,$apt_sched,$apt_message,$apt_mode,$department_target_id,$with_list_count,$start_time,$end_time);	
  mysqli_stmt_execute($stmt);



}



function checkIfAptFullVisitor($conn,$apt_schedule,$dept_id,$no_participants){

	$sql= "SELECT IF((SELECT do_counter FROM department_offices WHERE department_offices_id=?) >=
	(SELECT COUNT(apt_id) FROM appointment WHERE apt_scheduleDate=? AND apt_mode =5 and department_target_id=?) + ?, 'Y', 
	(SELECT do_counter FROM department_offices WHERE department_offices_id=?)-(SELECT COUNT(apt_id) FROM appointment 
	WHERE apt_scheduleDate=? AND apt_mode =5 and department_target_id=?)) as result;";
    

	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"isiiisi",$dept_id,$apt_schedule,$dept_id,$no_participants,$dept_id,$apt_schedule,$dept_id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['result'];
		return $id;
	
}


function check_if_student($conn,$bu_email){

	$sql= "SELECT user_type from user where user_buEMail=? LIMIT 1;";
    

	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"s",$bu_email);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['user_type'];
		
		if($id==='S'){
			return 1;
		}else{
			return 0;
		}
	
}

function insertAppointmentVisitorParticipant($conn,$apt_ref_id,$email,$session_user_ref_id){
    	$up_date=date('Y-m-d H:i:s');
	    $value=getUserRefId($conn,$email);

		if($value===$session_user_ref_id){
			$ap_status =3;
		}else{
			$ap_status =0;	
		}
		$sql_insert= "INSERT INTO appointment_participants (`apt_ref_id`,`user_ref_id`,`apt_status`,`creator_user_ref_id`,`date_responded`) VALUES (?,?,?,?,?);";
		$stmt_insert= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt_insert,$sql_insert)) {
			header("location:db.inc.php?error=stmtfailed");
					exit();
			}
		mysqli_stmt_bind_param($stmt_insert,"ssiss",$apt_ref_id,$value,$ap_status,$session_user_ref_id,$up_date);
		if(mysqli_stmt_execute($stmt_insert)){
			if($value!==$session_user_ref_id){
				notify($conn,$apt_ref_id,$value,$session_user_ref_id,0,0,"none");
			}
			
		}

}


function countUser($conn,$option){
   
	switch($option){
		case 1:
			$sql= "SELECT COUNT(user_id) FROM user WHERE user_type ='S'and user_accountStatus=0 and verify_status=1;";
		break;

		case 2:
			$sql= "SELECT COUNT(user_id) FROM user WHERE  user_accountStatus=1 and verify_status=1 and user_type<>'V' and user_type<>'A'";
		break;
	    
		case 3:
			$sql= "SELECT COUNT(user_id) FROM user WHERE  user_accountStatus=1 and verify_status=1 and user_type ='S';";
		break;

		case 4: 
		    $sql= "SELECT COUNT(user_id) FROM user WHERE user_type ='T';";
		break;
		case 5:
	    	$sql= "SELECT COUNT(user_id) FROM user WHERE   user_type ='NT';";
		break;

		case 6:
			$sql= "SELECT COUNT(user_id) FROM user WHERE   user_type ='V';";
		break;
			
	}
	
	


	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
	
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['COUNT(user_id)'];
		return $id;
	
}


function getPicturebyId($conn,$user_ref_id){

	$sql= "SELECT user_profile_pic from user where user_ref_id=? ";
    

	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location:db.inc.php?error=stmtfailed");
		exit();
	}
		mysqli_stmt_bind_param($stmt,"s",$user_ref_id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		$id= mysqli_fetch_assoc($result)['user_profile_pic'];

		if(is_null($id) or empty($id))
			$id= "default_user.png";
		return $id;
	
}
