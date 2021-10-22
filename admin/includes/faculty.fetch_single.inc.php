<?php


if(isset($_POST["course_id"]))

{
  

    require_once ('../../includes/db.inc.php');
    $connect="mysql:host={$db_servername};dbname={$db_name}";
    $connection = new PDO($connect , $db_username, $db_password );

	$output = array();
	$statement = $connection->prepare(
		
        "SELECT * FROM user  WHERE  user_ref_id = '".$_POST["course_id"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["user_ref_id"] = $row["user_ref_id"];
        $output["user_type"] =  $row["user_type"];
        $output["do_id"] = $row["do_id"];
        $output["user_buId"] = $row["user_buId"];
        $output["user_firstName"] = $row["user_firstName"];
        $output["user_lastName"] = $row["user_lastName"];
        $output["user_middleName"] = $row["user_middleName"]; 
        $output["user_buEmail"] = $row["user_buEmail"]; 
        $output["user_gender"] = $row["user_gender"];
        $output["user_contactNum"] = $row["user_contactNum"]; 
	}
	echo json_encode($output);
}else{
   
        header("location: ../../home.php");
        exit();

}

?>