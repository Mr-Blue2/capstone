<?php



    //////// session of admin
    session_start();
    $session_user_type =$_SESSION['user_type'];
    //$_SESSION['user_buEmail'];
    if (is_null( $_SESSION['user_ref_id'])){
        header("location: ../index.php");
        exit();
    }else if($session_user_type!=='A'){
        header("location: ../index.php");
        exit();
    }
    ///////////////// 
	
header('Content-Type: application/json');

require_once ('../../includes/db.inc.php');



$sqlQuery = "SELECT DATE_FORMAT(apt_scheduleDate,'%b %Y')as archive_dt ,COUNT(*) as apts FROM appointment WHERE apt_all_status=0 and apt_scheduleDate < CURRENT_DATE() GROUP BY archive_dt  ORDER BY archive_dt desc";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>