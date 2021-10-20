<?php

require_once ('../../includes/db.inc.php');
require_once ('../../includes/func.inc.php');
        
        


	if($_POST["operation"] == "Add")
	{
                
               
                $user_ref_id=get_random_figures(isset($user_ref_id));
                $password='bupc4321';//dapat naka hash din 
                $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

                $verify_status=1;
                $user_status=1;
	
                $type= $_POST['type'];
                $department= $_POST['department'];
                 $bu_id=$_POST['bu_id'];
                 $last_name=$_POST['last_name'];
                 $middle_name=$_POST['middle_name'];
                 $first_name=$_POST['first_name'];
                 $gender=$_POST['gender'];
                $bu_email=$_POST['bu_email'];
                $contact_num=$_POST['contact_num'];
    
                   $stmt = $conn->prepare("INSERT INTO user
                    (`user_type`,`do_id`,`user_buId`,`user_lastName`,`user_middleName`,`user_firstName`,`user_gender`,`user_buEmail`,`user_contactNum`,`user_ref_id`,`password`,`user_accountStatus`,`verify_status`)
                   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                   $stmt->bind_param('sisssssssssii',$type,$department,$bu_id,$last_name,$middle_name,$first_name,$gender,$bu_email,$contact_num,$user_ref_id,$hashed_pwd,$user_status,$verify_status);
                   $stmt->execute();   
         
	}
	if($_POST["operation"] == "Edit")

	{          
                

                 $id = $_POST['course_id'];
                 $type= $_POST['type'];
                 $department= $_POST['department'];
                 $bu_id=$_POST['bu_id'];
                 $last_name=$_POST['last_name'];
                 $middle_name=$_POST['middle_name'];
                 $first_name=$_POST['first_name'];
                 $gender=$_POST['gender'];
                 $bu_email=$_POST['bu_email'];
                 $contact_num=$_POST['contact_num'];


                $stmt = $conn->prepare("UPDATE user SET user_type=? ,do_id=?,user_buId=?, user_lastName=?, user_middleName=?,user_firstName=?,user_gender=?, user_buEmail=?,user_contactNum=?
                 WHERE user_ref_id=?;
                ");
                $stmt->bind_param('sissssssss',$type,$department,$bu_id,$last_name,$middle_name,$first_name,$gender,$bu_email,$contact_num,$id);
                $stmt->execute();   
                    
	}

    
      
       

?>