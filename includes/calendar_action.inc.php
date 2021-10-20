<?php
        require_once 'db.inc.php';
        
        session_start();
        $session_user_ref_id= $_SESSION['user_ref_id'];

        $data = array();
        $query = "SELECT a.apt_message,a.apt_mode,a.apt_result,a.apt_all_status,a.apt_ref_id,a.apt_title,Concat(a.apt_scheduleDate, 'T',a.apt_startTime) as start,Concat(a.apt_scheduleDate, 'T',a.apt_endTime) as end 
                        FROM appointment as a JOIN appointment_participants as ap ON a.apt_ref_id=ap.apt_ref_id
                        JOIN user as u ON u.user_ref_id = ap.user_ref_id WHERE ap.user_ref_id='{$session_user_ref_id}' 
                        ORDER BY ap.date_responded DESC ";
        $result = $conn->query($query);
        foreach ($result as $row) {
            $up_date=date('Y-m-d H:i:s');
            $color= "blue";
            if($row['apt_all_status']==0 and $row['start']<$up_date ){
               $color="#5cb85c";
            }else if($row['apt_all_status']==1) {
                $color="#d9534f";
            }else if($row['apt_all_status']==0){
                $color="#f0ad4e";
            }
            
            $data[] = array(
                'id'   => $row["apt_ref_id"],
                'title'   => $row["apt_title"],
                'start'   => $row["start"],
                'end'   => $row["end"],
                'details'=> $row["apt_message"],
                'mode'=> $row["apt_mode"],
                'result'=>$row['apt_result'],
                'status'=>$row['apt_all_status'],
                'backgroundColor'=>$color,
               


               );
        }
        echo json_encode($data);
      
       
?>

