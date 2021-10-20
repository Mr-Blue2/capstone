<?php

if (isset($_POST['btn-add'])) {
   
    require_once 'db.inc.php';
    require_once 'func.inc.php';

    session_start();
    $session_user_ref_id = $_SESSION['user_ref_id'];
    $session_user_buEmail = $_SESSION['user_buEmail'];



    $first_name= $_POST['first_name'];
    $middle_name= $_POST['middle_name'];
    $last_name= $_POST['last_name'];
    $year= $_POST['year'];
    $block=$_POST['block'];
    $contact_num =$_POST['contact_num'];

    $random =get_random_figures(isset($str));

    $target_dir = "../uploads/profile/";
    
    $check=($_FILES["fileToUpload"]["name"]);
    if($check===''){


   $img_name= getImg($conn,$session_user_ref_id);
    update_info($conn,$session_user_ref_id,$option=1,$first_name,$middle_name,$last_name,$year,$block,$contact_num,$img_name);
    header("location: ../profile.php?error=success");
    exit(); 
    }else{
        


        $file_temp =$_FILES["fileToUpload"]["tmp_name"];
        $target_file = $target_dir .$random.basename($_FILES["fileToUpload"]["name"]);  // the image file name
        $img_name=$random.basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(!empty($file_temp)){
            $check_if_image = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        }
        $file_size=$_FILES["fileToUpload"]["size"] ;


        if (emptyInput($first_name,$middle_name,$last_name,$contact_num)!==false) {
            header("location: ../profile.php?error=emptyinput");
            exit();
        }
      
       // image validation
        if (UploadCheckIfImage($check_if_image)!==false){
           header("location: ../profile.php?error=notimage");
           exit();
        }
       
        if (UploadSizeImage($file_size)!==false){
           header("location: ../profile.php?error=imagetolarge");
           exit();
        }
        if (UploadFileTypeImage($imageFileType)!==false){
           header("location: ../profile.php?error=notanimagetest");
           exit();
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            update_info($conn,$session_user_ref_id,$option=1,$first_name,$middle_name,$last_name,$year,$block,$contact_num,$img_name);
            header("location: ../profile.php?error=success");
           exit();     
        } else{
            header("location: ../profile.php?error=uploading failed");
           exit();
        }
    }
    
       
   
    

    






    
}
?>