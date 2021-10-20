<?php    

require_once 'db.inc.php';

session_start();
 $session_user_ref_id= $_SESSION['user_ref_id'];


function  notif_count($conn,$session_user_ref_id){
    $sql= "SELECT IFNULL(COUNT(notif_id),0) as result FROM notification WHERE to_user_ref_id=? and notif_read=0  and notif_type=0 ; ";
$stmt= mysqli_stmt_init($conn); 
if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location:db.inc.php?error=stmtfailed");
    exit();
}
     mysqli_stmt_bind_param($stmt,"s",$_SESSION['user_ref_id']);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $id= mysqli_fetch_assoc($result)['result'];
    
    if($id==0){
        $id="";
    }
    return $id;

}

//163160814263900   163160822478340
date_default_timezone_set('Asia/Manila');
 $up_date=date('Y-m-d');

function  home_count($conn,$session_user_ref_id){
    $sql= "SELECT IFNULL(COUNT(ap.ap_id),0) as result FROM appointment_participants as ap JOIN appointment as a On ap.apt_ref_id=a.apt_ref_id
     WHERE ap.user_ref_id=? and ap.apt_status <> 2 and ap.apt_status <> 0 and a.apt_scheduleDate =current_date() and apt_all_status<>1";
$stmt= mysqli_stmt_init($conn); 
if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("location:db.inc.php?error=stmtfailed");
    exit();
}
    mysqli_stmt_bind_param($stmt,"s",$_SESSION['user_ref_id']);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $id= mysqli_fetch_assoc($result)['result'];
    
    
    if($id==0){
        $id="";
    }
    return $id;
}


  echo $final= notif_count($conn,$_SESSION['user_ref_id']) . ','. home_count($conn,$_SESSION['user_ref_id']);

 



?>