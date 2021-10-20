<?php

require_once 'db.inc.php';

 if(isset($_POST['details_apt_ref_id'])){
    
    $details_apt_ref_id= $_POST['details_apt_ref_id'];
    session_start();
    $session_user_ref_id=$_SESSION['user_ref_id'];
    $sql="SELECT * FROM user AS u JOIN appointment_participants as ap ON u.user_ref_id = ap.user_ref_id 
    WHERE ap.apt_ref_id='{$details_apt_ref_id}' ORDER BY apt_status DESC;";
 



    $stmt=mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: index.php?error=stmtfailed");
        exit();
    }	

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $arr = array();          
    while($row = mysqli_fetch_assoc($resultData)){
            array_push($arr,$row);            
        }
    echo json_encode($arr);         
    mysqli_stmt_close($stmt);  

}

?>