<?php
    // connection
    require_once 'db.inc.php';
    require_once 'func.inc.php';
    // departmet course choices
    if (!empty($_POST['departmentId'])) { 
        $departmentId = $_POST['departmentId'];
        $query = "SELECT * FROM  course WHERE department_offices_id= {$departmentId}";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
                echo '<option selected="true" disabled="disabled">Please select course</option> ';
        while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['course_id'].'">'.$row['course_desc'].'</option>'; 
            }
        }else{
            echo '<option value="">No Course available</option>'; 
        }
  	}

    /// register
  else  if (isset($_FILES['file']['name'])){
        $bu_email = $_POST['bu_email'];
        $bu_number = $_POST['bu_number'];
        $last_name=$_POST['last_name'];
        $first_name=$_POST['first_name'];
        $middle_name=$_POST['middle_name'];
        $gender=$_POST['gender'];
        $course=$_POST['course'];
        $year=$_POST['year'];
        $block=$_POST['block'];
        $contact_num=$_POST['contact_num'];
        $department=$_POST['department'];   /// binago ko
        $password= $_POST['password'];
        $user_ref_id=get_random_figures(isset($user_ref_id));
        $verify_token= md5(rand());

        test_input($conn,$bu_email);
        trim($password);
        test_input($conn,$course);
        test_input($conn,$department);

       if (uidExist($conn,$bu_email,$bu_email)!==false) {
             echo "Email or Student Number already exist on database"; 
       }else{
              
                        
     $link="https://bupcappointmentschedulingsystem.online/includes/verify-email.php?token={$verify_token}&email={$bu_email}";
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
                          <small style="font-family: sans-serif; font-style: italic; font-size: 16px; color: #009BDE">'.$first_name.' '.$last_name.'</small></p>

                        <p style="font-family: sans-serif; font-size: 20px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your request for an account is partially approved. To access your account, please verify your email by clicking the link.
                        In case this message is on spam folder , just copy this. '.$link.'</p>

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
                                 
                                  $recipient_arr =[];
                                    array_push($recipient_arr,$bu_email);
                                    emailMultiple($subject="Verify email:",$body,$recipient_arr);
                                    $filename = $_FILES['file']['name'];
                                    $location = "../uploads/cor/".$filename;
                                    move_uploaded_file($_FILES['file']['tmp_name'],$location) ;
                                    createUser($conn,$user_ref_id,$bu_email,$bu_number,$last_name,$first_name,$middle_name,$gender,$course,$year,$block,$contact_num,$password,$verify_token,$filename,$department);
                                    
                                    
                                  
                  }

          }
       
      

      
      //login part
     /// register
   else  if (isset($_POST['login_pass'])){

        $login_id = $_POST['login_id'];
        $login_pass = $_POST['login_pass'];
        
        test_input($conn,$login_id);
        trim($login_pass);  

        if(loginUser($conn,$login_id,$login_pass)==="a"){
            echo "Account Doesnt Exist";
        } else if ( loginUser($conn,$login_id,$login_pass)==="c"){
            echo "Your email has not been verified";
         } else if ( loginUser($conn,$login_id,$login_pass)==="d"){
              echo "Sorry ,Your account was not fully verified by the admin";
        }else if (loginUser($conn,$login_id,$login_pass)==="b"){
            echo "Invalid Credentials";
        }
     }

    
     //resend code
  else   if(isset($_POST['resend_email'])){
        $resend_email =$_POST['resend_email'];

        test_input($conn,$resend_email);

        if( resendCode($conn,$resend_email) =="sent"){
            echo "Email Sent";
        }else if( resendCode($conn,$resend_email)=="already"){
            echo "You are already Verified";
        }else{
            echo "You did not register to the system";
        }
       
     }

      //forgot pass emailing
  else    if(isset($_POST['forgot_email'])){
        $forgot_email =$_POST['forgot_email'];

        test_input($conn,$forgot_email);

       if(send_resetPassword($conn,$forgot_email) == "not_exist"){
           echo "not exist";
       }else{
           echo "sent";
       }
     }

     //reset pass
   
  else   if(isset($_POST['new_email'])){
        $new_email=$_POST['new_email'];
        $new_password=$_POST['new_password'];

        test_input($conn,$new_email);
        test_input($conn,$new_password);

        $token= $_POST['token'];
         if(resetPassword($conn,$new_email,$token,$new_password)=="not_exist"){
             echo "Email Not Exist";
         }else{
             echo "New Password Added";
         }
    }

  else{
        header("Location: ../home.php");
        exit();
  }


   

     

  

