<?php

  
require_once 'db.inc.php';
require_once 'func.inc.php';


    if(isset($_POST['btn-password'])){
         if(isset($_POST['check'])) 
            $check = 1;
        else
           $check=0;

        echo $check;
            

        $old_pass=$_POST['old_pass'];
        $new_pass=$_POST['new_pass'];
        $confirm_new_pass= $_POST['confirm_new_pass'];
        


        test_input($conn,$old_pass);
        test_input($conn,$new_pass);
        test_input($conn,$confirm_new_pass);


        if($new_pass !== $confirm_new_pass){
            header('location:../profile.php?status=not');
        }else{
        session_start();
        $session_user_ref_id = $_SESSION['user_ref_id'];
       
        $stmt = $conn->prepare('SELECT password  FROM user WHERE user_ref_id=?');
        $stmt->bind_param("s", $session_user_ref_id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        $pwd_hashed = $data ? $data['password'] : null;
         	
	    $check_pwd = password_verify($old_pass, $pwd_hashed);
        if($check_pwd===true){

            $new_pass_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('UPDATE  user set password=?  WHERE user_ref_id=?');
            $stmt->bind_param("ss",$new_pass_hashed, $session_user_ref_id);
            $stmt->execute();
            if($check==1)
                header('location:logout.inc.php');
            else
                 header('location:../profile.php?status=success');
        }else{
            header('location:../profile.php?status=inc');
        }
        }


        
 
        

    }else{
         header('location:../index.php');
    }





?>