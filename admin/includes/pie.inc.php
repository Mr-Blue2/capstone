<?php
header('Content-Type: application/json');

require_once ('../../includes/db.inc.php');



$sqlQuery = "SELECT apt_mode,count(*) as no_mode FROM appointment as no_modes
GROUP BY  apt_mode";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>