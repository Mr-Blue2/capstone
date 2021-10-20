<?php
    include_once './includes/db.inc.php';
    include_once './includes/func.inc.php';



  if(isset($_GET['u'])){
     $reference_id= $_GET['u'];

     $session_user_type= $reference_id[0];

     $session_user_ref_id = substr($reference_id, 1);
     
     if($session_user_type==='S' ){
      $arr=getUserDetails($conn,$session_user_ref_id,$option='1');
      $year= $arr[0]['user_year'];
      $block = $arr[0]['user_block'];
      $course = $arr[0]['course_desc'];

    }else if($session_user_type==='T' || $session_user_type==='NT'){
      $arr=getUserDetails($conn,$session_user_ref_id,$option='2');
      $year='';
      $block='';
      $course='';
    }else if($session_user_type==='V'){
      $arr=getUserDetails($conn,$session_user_ref_id,$option='3');
      $year='';
      $block='';
      $course='';
    }
    
  
    $user_type= ucfirst($arr[0]['user_type']);
    $full_name= ucfirst($arr[0]['user_firstName']).' '.ucfirst($arr[0]['user_middleName']).' '.ucfirst($arr[0]['user_lastName']);
    $email= $arr[0]['user_buEmail'];
    $gender= $arr[0]['user_gender'];
    $contact_num= $arr[0]['user_contactNum'];
    
    $dept=$arr[0]['department_offices_desc'];
    

      if(($arr[0]['user_gender'])==='m'){
        $gender="Male";
      }elseif(($arr[0]['user_gender'])==='f'){
        $gender="Female";
      }else{
        $gender="Non Binary";
      }

  }else{
    session_start();
  
    $session_user_ref_id =$_SESSION['user_ref_id'];
    $session_user_type=  $_SESSION['user_type'];

 
    
    if($session_user_type==='S'){
     $arr=getUserDetails($conn,$session_user_ref_id,$option='1');
     $year= $arr[0]['user_year'];
     $block = $arr[0]['user_block'];
     $course = $arr[0]['course_desc'];

   }else{
     $arr=getUserDetails($conn,$session_user_ref_id,$option='2');
     $year='';
     $block='';
     $course='';
   }
   
 
   $user_type= ucfirst($arr[0]['user_type']);
   $full_name= ucfirst($arr[0]['user_firstName']).' '.ucfirst($arr[0]['user_middleName']).' '.ucfirst($arr[0]['user_lastName']);
   $email= $arr[0]['user_buEmail'];
   $gender= $arr[0]['user_gender'];
   $contact_num= $arr[0]['user_contactNum'];
   
   $dept=$arr[0]['department_offices_desc'];
   

     if(($arr[0]['user_gender'])==='m'){
       $gender="Male";
     }elseif(($arr[0]['user_gender'])==='f'){
       $gender="Female";
     }else{
       $gender="Non Binary";
     }


  }






    // conditional
    if($arr[0]['user_profile_pic']===''){
      $arr[0]['user_profile_pic']= 'default_user.png';
    }
    
    $type=0;

    if(($arr[0]['user_type'])==='T'){
      $arr[0]['user_type']="Teaching Faculty";
    }elseif(($arr[0]['user_type'])==='NT'){
      $arr[0]['user_type']="Non Teaching";
    }elseif(($arr[0]['user_type'])==='S'){
      $arr[0]['user_type']="Student";
    }elseif(($arr[0]['user_type'])==='V'){
      $arr[0]['user_type']="Visitor";
      $type=1;
    }

  
    
  

  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    

     <link rel="stylesheet" href="assets/css/register.css">
     <link rel="stylesheet" href="assets/css/style.css">

  
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style>
    img {border-radius: 50%;}
  </style>
</head>
<body>
  <?php
  include_once('includes/sidenav.php');
  ?>

<br>
<br>
<section class="testimonial py-5" id="testimonial">
    <div class="container">

    <?php

    if(isset($_GET['status'])){
      if($_GET['status']=='not' ){
        echo '<div class="alert alert-danger" role="alert">
        Password must be the same.
       </div>';
      }else if($_GET['status']=='inc'){
       echo '<div class="alert alert-danger" role="alert">
        Your old password is incorrect.
      </div>';
     }else if($_GET['status']=='success'){
       echo '<div class="alert alert-success" role="alert">
        Password changed.
      </div>';
     }
    }
 


  ?>
        
        <div class="row ">
            <div class="col-md-4 registration text-white text-center ">
                <div class="">
                    <div class="card-body">
                        <img class="profile_img" src="./uploads/profile/<?php echo  $arr[0]['user_profile_pic'] ?>" height="300px" >        
                        <br>
                        <h2 style="color:#fff; font-size: 50px;"><?php echo  $arr[0]['user_type'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <!-- <h4 class="pb-4">Please fill with your details</h4> -->
                <form>  
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <h1><?php echo $full_name ?></h1>
                       
                          <p><?php echo $email ?></p>
                        
                        </div>
                       
                        <div class="form-group col-md-6">
                          <h6><?php echo $dept ?></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <h6><?php echo $course ?></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <h6><?php echo $year ?></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <h6><?php echo $block ?></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <h6><?php  echo $gender ?></h6>
                        </div>
                        
                        
                        <div class="form-group col-md-6">
                          <h6><?php echo $contact_num ?></h6>
                        </div>
                        <div class="form-group col-md-6">

                        <?php 
                           if($type==1){
                             echo '<a href="./uploads/visitor/'.$arr[0]["user_cor"].'" target="_blank" class="btn btn-warning btn-lg btn-block view">Check Presented Verification </a>';
                           }
                      
                        
                        ?>
                       
                                                  
                        </div>
                       
                     </div>

                    <?php
                         if(isset($_GET['u'])){
                
                         }else{
                          echo '
                          <div class="form-row">
                          <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModalCenter">
                              Edit Profile
                          </button>
                          <button type="button" class="btn btn-secondary btn-lg btn-block " data-toggle="modal" data-target="#exampleModal">
                              Edit Password
                          </button>
                                                  
                          </div>
                          ';
                         }
                     ?>
                  
                </form>
                  
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle" style="color:#000;">Update Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form action="includes/update_info.php" method="POST" enctype="multipart/form-data">
            
                                  <label>First Name</label>
                                  <input class ="form-control" name="first_name" value="<?php echo $arr[0]['user_firstName']?>" >
                                  <label>Middle Name</label>
                                  <input class ="form-control" name="middle_name" value="<?php echo $arr[0]['user_middleName']?>">
                                  <label>Last Name</label>
                                  <input class ="form-control" name="last_name" value="<?php echo $arr[0]['user_lastName']?>">
                               
                                    <?php
                                          if($session_user_type==='S' ){
                                             $user_year =  $arr[0]['user_year'];
                                             $user_block =  $arr[0]['user_block'];
                                            echo '
                                            
                                            <label>Year</label>
                                            <input class ="form-control"  name="year"value="'.$user_year.'">
                                            <label>Block</label>
                                            <input class ="form-control" name="block" value="'.$user_block.'">
                                            ';
                                       
                                          }



                                    ?>
                             
                                  <label>Contact Number</label>
                                  <input class ="form-control" name="contact_num" value="<?php echo $arr[0]['user_contactNum']?>">
                                  <label>Profile Pic</label>
                                  <input type="file" class="form-control-file"  name="fileToUpload" >
                                    

                               
                             
                            </div>
                            <div class="modal-footer">
                              
                            <input type="submit" name="btn-add" class="btn btn-primary btn-lg btn-block">

                        </form>
                                
                            </div>
                          </div>
                        </div>
                      </div>



            </div>
        </div>
    </div>



    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="includes/update_password.php" method="POST">
            <label>Old Password</label>
            <input class ="form-control" name="old_pass" type="password" required >
            <label>New Password</label>
            <input class ="form-control" name="new_pass" type="password" required>
            <label>Confirm New Password</label>
            <input class ="form-control" name="confirm_new_pass" type="password" required>
          
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck" value="1" name="check">
              <label class="form-check-label" for="gridCheck">
                Logout after changing password
              </label>
            </div>
      </div>

          
      <div class="modal-footer">
      <input type="submit" name="btn-password" class="btn btn-primary btn-lg btn-block">
  </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
</section>

<script>

</script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>