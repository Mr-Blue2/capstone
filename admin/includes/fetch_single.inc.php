<?php

require_once ('../../includes/db.inc.php');


$connect="mysql:host={$db_servername};dbname={$db_name}";

$connection = new PDO($connect , $db_username, $db_password );


if(isset($_POST["course_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		//"SELECT * FROM   WHERE id = '".$_POST["course_id"]."' LIMIT 1"
         " SELECT * FROM user as u 
            JOIN course as c ON u.course_id = c.course_id 
            JOIN department_offices as d ON d.department_offices_id =c.department_offices_id 
            WHERE u.user_ref_id = '".$_POST["course_id"]."' LIMIT 1
        "
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["user_ref_id"] = $row["user_ref_id"];
		// $output["course"] = $row["course"];
		// $output["students"] = $row["students"];
	}
	echo json_encode($output);
}
?>