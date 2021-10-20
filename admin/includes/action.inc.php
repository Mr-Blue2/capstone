<?php



require_once ('../../includes/db.inc.php');



if (!empty($_POST['type'])) { 
    $type = $_POST['type'];

    if($type=='S' || $type=='T'){
        $query = "SELECT * FROM  department_offices where do_type='d' and do_active=1";
    }
    else if($type=='NT'){
        $query = "SELECT * FROM  department_offices where do_type='o' and do_active=1";
    }
   
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
            echo '<option selected="true" disabled="disabled">Please select course</option> ';
    while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['department_offices_id'].','.$type.'">'.$row['department_offices_desc'].'</option>'; 
        }
    }else{
        echo '<option value="">No Dep available</option>'; 
    }
}


    // departmet course choices
    if (!empty($_POST['departmentId'])) { 
        
        $departmentId = $_POST['departmentId'];
        $arr= explode(",",$departmentId);

        if($arr[1]=='S'){
            $query = "SELECT * FROM  course WHERE department_offices_id= {$arr[0]}";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                    echo '<option selected="true" disabled="disabled">Please select course</option> ';
            while ($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['course_id'].'">'.$row['course_desc'].'</option>'; 
                }
            }else{
                echo '<option value="">No Course available</option>'; 
            }
        }else{
            echo '<option value="0">Not applicable</option>'; 
        }
       
	}


?>