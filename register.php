<?php include_once './includes/db.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


     <link rel="stylesheet" href="assets/css/register.css">
     <link rel="stylesheet" href="assets/css/style.css">
     
     <!-- password jquery  plugin-->
     <link rel="stylesheet" href="assets/css/jquery.passwordRequirements.css" />

     <!-- -alert plugin -->
     <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />


    
    <style>
        .has-error {
         border: 3px solid red;
        }
        .has-success {
            border: 3px solid green;
        }


        .spinner-grow{
            height: 100px;
            width: 100px;
            display: block;
            position: fixed;
            z-index: 1031; /* High z-index so it is on top of the page */
            top: 50%;
            right: 50%; /* or: left: 50%; */
            margin-top: -..px; /* half of the elements height */
            margin-right: -..px; /* half of the elements widht */
        }
    </style>


</head>
<body>
	<?php
	include_once('navbar.php');
 
	?>


   <!-- spinner -->
   <div class="spinner-grow text-primary" role="status" >
             <span class="sr-only">Loading...</span>
        </div>


<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 registration text-white text-center ">
                <div class=" ">
                     <div class="card-body">
                        <h2 class="py-3">Registration Form</h2>
                        <img src="image/svg/personalinfo.svg" style="width:100%"><br><br>
                        <p>You're on the way to connect with BUPCeans!
                        This registration form is exclusive only for BUPC Students, fill-up the necessary data and submit! Make sure to fill-up completely and carefully.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Please fill with your details</h4>
                <form  method="post" action="" enctype="multipart/form-data" id="myform">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input  placeholder="BU Email" class="form-control" type="text" id="bu_email">
                        </div>
                        <div class="form-group col-md-6">
                          <input  placeholder="Student No." class="form-control" type="text" id="bu_number">
                        </div>
                        <div class="form-group col-md-6">
                          <input type="text" class="form-control"  placeholder="Last name" id="last_name">
                        </div>
                        <div class="form-group col-md-6">
                          <input   placeholder="First name" class="form-control" type="text" id="first_name">
                        </div>
                        <div class="form-group col-md-12">
                          <input   placeholder="Middle name" class="form-control" type="text" id="middle_name">
                        </div>
                     </div>

                     <div class="form-row">
                     	<div class="form-group col-md-6">
                     		<label>Gender</label>
      						       <div>
                     			<label><input type="radio" name="gender"  checked value="m">Male</label>
      						    <label><input type="radio" name="gender" value="f">Female</label>
                                <label><input type="radio" name="gender" value="n">Non Binary</label>
                        </div>
                     	</div>
                     </div>

                 
                    <div class="form-row">
                    	<div class="form-group col-md-6">
                                  <select id="department" name="department" class="form-control">
                                  <option selected="true" disabled="disabled">Please select Department</option>  
                                    <!-- deparment choices -->
                                  <?php
                                        $department_query = "SELECT * FROM department_offices  WHERE do_type='d' and  do_active=1 ";
                                        $result = $conn->query($department_query);
                                        if ($result->num_rows >0) {
                                        while ($row=$result->fetch_assoc()) {
                                        echo "<option value='{$row["department_offices_id"]}'>{$row['department_offices_desc']}</option>";
                                        }
                                        }else{
                                        echo "<option value=''>Department not available</option>";
                                        }
                                    ?>
                                  </select>
                        </div>
                        <div class="form-group col-md-6">
                                  <select id="course" name="department" class="form-control">
                                  <option selected="true" disabled="disabled">Please select Course</option>  
                                  </select>
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="year"  placeholder="Year" class="form-control" required="required" type="text">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="block" name="block" placeholder="Block" class="form-control" required="required" type="text">
                        </div>
                         
                        <div class="form-group col-md-12">
                        <p>COR picture</p>
                        <input type="file" id="file" name="file" />
                        <!-- <div class="custom-file"> -->
    					<!-- <input type="file" class="custom-file-input" id="customFile"> -->
   					 		<!-- <label class="custom-file-label" for="customFile">Choose file</label>
  						</div> -->
  						</div>

                        <div class="form-group col-md-12">
                            <input id="contact_num" name="contact number" placeholder="Contact Number" class="form-control" required="required" type="text">
                        </div>
                    </div>

                     <div class="form-row">
                        <div class="form-group col-md-6" id="password">
                            <input id="password" name="password" placeholder="Password" class="form-control pr-password" required="required" type="password">
                        </div>
                        <div class="form-group col-md-6" id="confirm_password">
                            <input id="confirm_password" name="confirm_password" placeholder="Confirm Password" class=" form-control " required="required" type="password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="agree"  name= "agree"required>
                                  <label class="form-check-label" for="invalidCheck2">
                                    <small id="agree_text">By clicking Submit, you agree to our Terms & Conditions, User Agreement and Privacy Policy.</small>
                                  </label>
                                </div>
                              </div>

                          </div>
                    </div>
                    
                    <div class="form-row">
                        <button type="button" class="button" id="btn-register">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

    
    <script src="assets/js/jquery-3.6.0.min.js"> </script>
    <!-- Password Requirements JS --> 
    <script src="assets/js/jquery.passwordRequirements.min.js"></script>
    <script src="assets/js/main_ajax.js"></script>
    
    <!-- alerts plugin -->
    <script src="assets/js/jquery-confirm.min.js"></script>
   
    <!-- Messenger Chat Plugin Code -->
   
   <!-- file validation -->

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>

    <!-- end -->

    <script>
        // Size in kb
        $.validator.addMethod('filesize', function (value, element,param) {
                var size=element.files[0].size;
                size=size/1024;
                size=Math.round(size);
                return this.optional(element) || size <=param ;
                }, '<b>File size must be less than {0}<b>');

    </script>
  
   

</body>
</html>

