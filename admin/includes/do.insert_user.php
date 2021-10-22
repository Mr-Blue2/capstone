<?php

require_once ('../../includes/db.inc.php');
require_once ('../../includes/func.inc.php');
        
        


	if($_POST["operation"] == "Add")
	{
		 if(isset($_POST['code'])) {
                   $type= $_POST['type'];
                   $code= $_POST['code'];
                   $desc=$_POST['desc'];
                   $person_per_day=$_POST['person_per_day'];
                   $email=$_POST['email'];
    
                   $stmt = $conn->prepare("INSERT INTO  department_offices (`department_offices__short_desc`,`department_offices_desc`,`do_type`,`do_counter`,`ass_user_ref_id`) VALUES (?,?,?,?,?)");
                   $stmt->bind_param('sssis',$code,$desc,$type,$person_per_day,$email);
                   $stmt->execute();   
         }
	}
	else if($_POST["operation"] == "Edit")

	{                $id= $_POST['course_id'];
                    $type= $_POST['type'];
                    $code= $_POST['code'];
                    $desc=$_POST['desc'];
                    $person_per_day=$_POST['person_per_day'];
                    $email=$_POST['email'];

                    $stmt = $conn->prepare("UPDATE  department_offices SET department_offices__short_desc=?,department_offices_desc=?,do_type=?,do_counter=?,ass_user_ref_id=? where department_offices_id=? ");
                    $stmt->bind_param('sssisi',$code,$desc,$type,$person_per_day,$email,$id);
                    $stmt->execute();   
	}
    else{
   
        header("location: ../../home.php");
        exit();
 
    }

       
        
            
                
            
      
       

?>