<?php
// uM1~u>vHn
session_start();
require_once 'db.inc.php';
require_once 'func.inc.php';

if(isset($_GET['token'])){
    $token=$_GET['token'];
    $email= $_GET['email'];

    test_input($conn,$token);
    test_input($conn,$email);

    $verify_query= "SELECT verify_token,verify_status FROM user WHERE verify_token='$token' LIMIT 1";
    $verify_query_run =mysqli_query($conn,$verify_query);

    if(mysqli_num_rows($verify_query_run)>0){
        $row=mysqli_fetch_array($verify_query_run);
        if($row['verify_status']=="0"){
            $clicked_token = $row['verify_token'];
            $update_query="UPDATE user SET verify_status ='1'  WHERE  verify_token ='$clicked_token' LIMIT 1"; 
            $update_query_run = mysqli_query($conn,$update_query);

            if($update_query_run){
                header("Location: ../login.php?status=verified&email={$email}");
                exit();
                //sucess
            }else{
                header("Location: ../login.php?status=failed");
                exit();
                //failed
            }
        }else{
            header("Location: ../login.php?status=email_alredy");
            //email_already_verfired
            exit();
        }
    }else{  
        header("Location: ../login.php?status=not_exist");
        //not exist token
    }
}else{
    header("Location: ../login.php");
}





?>