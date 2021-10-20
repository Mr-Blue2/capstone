
<?php 
     include_once 'db.inc.php';
     include_once 'func.inc.php';

     session_start();
     $session_user_ref_id =$_SESSION['user_ref_id'];
     //$_SESSION['user_buEmail'];
     if (is_null( $_SESSION['user_ref_id'])){
           header("location: index.php");
     }
     
?> 


  
    <script src="../assets/js/jquery-3.6.0.min.js"> </script>
    <style>
    a{
      color: #000;
    }
    a:hover{
      color:red; 
    }
    .btn-view{
      cursor: pointer;
      color: #009BDE;
      font-size: 25px;
    }
    .btn-view:hover{
      color: #ff7802;
    }
  </style>
<!-- 
<div class="table-responsive"> -->
    <table class="table table-borderless">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>

    <tbody>

                      <?php
                          $arr= displayNotif($conn,$session_user_ref_id);
                          foreach ($arr as $value){
                            // not read no response

                            // echo $value['notif_note'];

                        
                            $date = new DateTime($value["notif_date"]);
                            $result_date = $date->format('g:i a-D,M j');
                        
                            //apt sched
                            $date_apt_sched =new DateTime($value["apt_scheduleDate"]);
                            $result_date1 = $date_apt_sched->format('M j'); 

                            // time am or pm
                        
                            $date1 = new DateTime($value["apt_startTime"]);
                            $start_time=$date1->format('h:i a') ;
                            $date2 = new DateTime($value["apt_endTime"]);
                            $end_time=$date2->format('h:i a') ;
                            $result_date_only= $result_date1.'('.$start_time .'-'.$end_time.')';



                            $full_name= ucfirst($value['user_firstName']).' '.ucfirst($value['user_middleName']).' '.ucfirst($value['user_lastName']);
                          
                            $profile_pic= $value['user_profile_pic'];
                             if($profile_pic===''){
                              $profile_pic='default_user.png';
                             }
                         
                             if($value['notif_type']==0 && $value['notif_read']==0 && $value['apt_mode'] <> 5   ) {
                                
                                 echo "
                                 <tr  class='table-secondary'>
                               
                                 <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                                 <td>
                                   <span class='badge badge-pill text-white font-medium badge-warning mr-2'>Requesting</span>
                                 </td>
                                 <td class='date'>{$result_date_only}</td>
                                 <td>{$value['apt_title']}</td>
                                 <td>  
                                 <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i> ";
                                 if($value['apt_all_status']==0){
                                  echo"
                                      
                                      <button type='button' class='btn btn-success btn-xs btn-goin' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Going</button>
                                      <button type='button' class='btn btn-primary btn-xs  btn-not-goin' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Not Going</button>
                                  ";
                                }
                                  
                                echo "
                                 </td>
                                 <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                               </tr>
                                 
              
                                 ";
                            
                                ///na ka respond na
                             }else if($value['notif_type']==0 && $value['notif_read']==1  && $value['apt_mode'] <> 5 ) {
                               
                                echo "
                                    <tr class=''>
                                    <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                                        <td>
                                        <span class='badge badge-pill text-white font-medium badge-warning mr-2'>Requesting</span>
                                        </td>
                                        <td class='date'>{$result_date_only}</td>
                                        <td>{$value['apt_title']}</td>
                                        <td> <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i></td>
                                        <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                                   </tr> 
                                ";


                                
                                // is going
                            }else if ($value['notif_type']==1  && $value['apt_mode'] <> 5){

                            echo "
                
                                <tr class=''>
                                <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                                        <td>
                                         <span class='badge badge-pill text-white font-medium badge-success mr-2'>&nbsp;&nbsp;&nbsp;Going&nbsp;&nbsp;&nbsp;</span>
                                        </td>
                                        <td class='date'>{$result_date_only}</td>
                                        <td>{$value['apt_title']}</td>
                                        <td> <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i></td>
                                        <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                                </tr>
                                
                            ";
                                  
                              //  is not going
                            }else if ($value['notif_type']==2){
                                 
                               if($value['notif_note']!=='none'){
                                echo "
                        
                                <tr class=''>
                                <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                                   <td>
                                   <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Not Going</span>
                                 
                                   </td>
                                   <td class='date'>{$result_date_only}</td>
                                   <td>{$value['apt_title']}</td>
                                   <td> 
                                     
                                   <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i>
                                       <button class='btn btn-secondary btn-note' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Note</button>
                                   </td>
                                   
                                   <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                               </tr> 
                           
                              ";
                               }else{
                                  
                            echo "
                        
                            <tr class=''>
                            <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                               <td>
                               <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Not Going</span>
                               </td>
                               <td class='date'>{$result_date_only}</td>
                               <td>{$value['apt_title']}</td>
                               <td>  <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i></td>
                               <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                           </tr> 
                       
                          ";
                               }

                                  
                             }else if ($value['notif_type']==4  && $value['apt_mode'] <> 5){
                              echo "
                          
                                   <tr class=''>
                                   <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                                      <td>
                                      <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Cancelled</span>
                                      </td>
                                      <td class='date'>{$result_date_only}</td>
                                      <td>{$value['apt_title']}</td>
                            
                                      <td>  <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i></td>

                                      
                                      <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                                  </tr> 
                              
                                 ";    
                              
                               }else if($value['notif_type']==0 && $value['notif_read']==0 && $value['apt_mode'] = 5  ) {
                                    echo "
                                    <tr class=''>
                                  
                                    <td><a href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>
                                    <td>
                                   
                                     <span class='badge badge-pill text-white font-medium badge-warning mr-2'>Requesting</span>
                                     <span class='badge badge-pill text-white font-medium badge-secondary mr-2'>Visitor</span>
                                    </td>
                                    <td class='date'>{$result_date_only}</td>
                                    <td>{$value['apt_title']} </td>
                                    <td>
                                      <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'>&nbsp;</i>
                                      <button type='button' class='btn btn-success btn-xs btn-goin' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Going</button>
                                      <button type='button' class='btn btn-primary btn-xs  btn-not-goin' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Not Going</button>
                                      
                                    </td>
                                    <td class='date'><i class='fa fa-paperclip'>&nbsp;</i>&nbsp;{$result_date}</td>
                                  </tr> 
                                    
                                    
                                    ";
                           
                               ///na ka respond na
                            }

                                 
                          }

                ?>  
  
    </tbody>
  </table>
<!-- </div> -->
  



