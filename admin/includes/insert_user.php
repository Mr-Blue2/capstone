<?php


require_once ('../../includes/db.inc.php');

function get_random_figures($str){
    $date_obj = date_create(); 
    $reg_ref_num = date_timestamp_get($date_obj) . random_int(10000,99999) . bin2hex($str);
    return $reg_ref_num;
}


$type= $_POST['type'];
$new_type= explode(',',$type);
$new_type= $new_type[0];
$department=$_POST['department'];
$new_department= explode(',',$department);
$new_department =$new_department[0];

$course= $_POST['course'];
$new_course= explode(',',$course);
$new_course=$new_course[0];

$year=$_POST['year'];
$block=$_POST['block'];
$bu_id=$_POST['bu_id'];
$first_name=$_POST['first_name'];
$middle_name=$_POST['middle_name'];
$last_name=$_POST['last_name'];
$gender=$_POST['gender'];
$bu_email=$_POST['bu_email'];
$contact_num= $_POST['contact_num'];

$user_ref_id= get_random_figures(isset($user_ref_id));
$password='1234';


$user_account_status=$verify_status=1;
$verify_token='verified';

function createUser($conn,$new_type,$user_ref_id,$bu_email,$bu_id,$last_name,$first_name,$middle_name,$gender,$new_course,$year,$block,$contact_num,$password,$user_account_status,$verify_token,$verify_status){
	$sql= "INSERT INTO user (`user_type`,`user_ref_id`,`user_buEmail`,`user_buId`,`user_lastName`,`user_firstName`,`user_middleName`,`user_gender`,`course_id`,`user_year`,`user_block`,`user_contactNum`,`password`,`user_accountStatus`,`verify_token`,`verify_status`)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	 $stmt= mysqli_stmt_init($conn);
	 if (!mysqli_stmt_prepare($stmt,$sql)) {
	 	header("location:db.inc.php?error=stmtfailed");
	 	exit();
	 }
	    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
	 	mysqli_stmt_bind_param($stmt,"ssssssssissssisi",$new_type,$user_ref_id,$bu_email,$bu_id,$last_name,$first_name,$middle_name,$gender,$new_course,$year,$block,$contact_num,$password,$user_account_status,$verify_token,$verify_status);
	 	mysqli_stmt_execute($stmt);
	 	mysqli_stmt_close($stmt);
        return true;
}	



echo $type;
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{   
		createUser($conn,$new_type,$user_ref_id,$bu_email,$bu_id,$last_name,$first_name,$middle_name,$gender,$new_course,$year,$block,$contact_num,$password,$user_account_status,$verify_token,$verify_status);
	}
	if($_POST["operation"] == "Edit")
	{
		
        echo "edit";
	}
}



?>