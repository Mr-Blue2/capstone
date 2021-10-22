<?php


if(isset($_POST["course_id"]))

{
    require_once ('../../includes/db.inc.php');
    $connect="mysql:host={$db_servername};dbname={$db_name}";
    $connection = new PDO($connect , $db_username, $db_password );

	$output = array();
	$statement = $connection->prepare(
		
       

        "SELECT * FROM course as c JOIN department_offices as d ON d.department_offices_id=c.department_offices_id 
        WHERE c.course_active=1 and   course_id = '".$_POST["course_id"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["course_id"] = $row["course_id"];
         $output["course_short_desc"] = $row["course_short_desc"];
         $output["course_desc"] = $row["course_desc"];
         $output["department_offices_id"] = $row["department_offices_id"];
    
        
		
	}
	echo json_encode($output);
}else{


        header("location: ../../home.php");
        exit();
   
}

?>