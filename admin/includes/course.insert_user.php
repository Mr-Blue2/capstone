<?php

require_once ('../../includes/db.inc.php');
require_once ('../../includes/func.inc.php');
        
        


	if($_POST["operation"] == "Add")
	{
		 if(isset($_POST['code'])) {
                    $type= $_POST['type'];
                    $code= $_POST['code'];
                    $desc=$_POST['desc'];

    
                   $stmt = $conn->prepare("INSERT INTO  course (`department_offices_id`,`course_short_desc`,`course_desc`) VALUES (?,?,?)");
                   $stmt->bind_param('iss',$type,$code,$desc);
                   $stmt->execute();
                
                
         }

       
	}
else	if($_POST["operation"] == "Edit")
	{             

                    $id= $_POST['course_id'];
                    $type= $_POST['type'];
                    $code= $_POST['code'];
                    $desc=$_POST['desc'];
                

                    $stmt = $conn->prepare("UPDATE  course SET department_offices_id=?,course_short_desc=?,course_desc=? where course_id=? ");
                    $stmt->bind_param('issi',$type,$code,$desc,$id);
                    $stmt->execute();   
	}
else{
    
    
        header("location: ../../home.php");
        exit();
  
}
       
        
            
      
       

?>