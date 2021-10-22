<?php




if(isset($_POST["course_id"]))

{

    require_once ('../../includes/db.inc.php');
    $connect="mysql:host={$db_servername};dbname={$db_name}";
    $connection = new PDO($connect , $db_username, $db_password );

	$output = array();
	$statement = $connection->prepare(
		
        "SELECT * FROM department_offices WHERE department_offices_id = '".$_POST["course_id"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["department_offices_id"] = $row["department_offices_id"];
        $output["department_offices__short_desc"] = $row["department_offices__short_desc"];
        $output["department_offices_desc"] = $row["department_offices_desc"];
        $output["do_type"] = $row["do_type"];
        $output["do_counter"] = $row["do_counter"];
        $output["ass_user_ref_id"] = $row["ass_user_ref_id"];
        
		
	}
	echo json_encode($output);
}else{
	
   
        header("location: ../../home.php");
        exit();
   
}

?>