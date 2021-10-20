<?php include_once './includes/db.inc.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--  token field -->
    <link rel="stylesheet" href="./assets/css/bootstrap-tokenfield.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	

     <link rel="stylesheet" href="assets/css/register.css">
     <link rel="stylesheet" href="assets/css/style.css">

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

        <div class="spinner-grow text-primary" role="status" >
             <span class="sr-only">Loading...</span>
        </div>
<section class="testimonial py-5" id="testimonial">
    <div class="container">
      <center><h2>Visitors Form</h2></center>
        <div class="row ">
            <div class="col-md-4 registration text-white text-center "> 
                <div class="">
                    <div class="card-body">
                        <h2 class="py-3">Please fill up your details</h2>
                        <!-- <img src="assets/images/personalinfo.svg" style="width:100%"><br><br> -->
                        <!-- <p>Please enter your dedicated website university's details via our dedicated website.</p> -->
                         <div class="form-row">
                        <div class="form-group col-md-12">
                          <input id="first_name" placeholder="First Name" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-12">
                          <input id="middle_name" placeholder="Middle name" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-12">
                          <input id="last_name" placeholder="Last name" type="text" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                          <input id="bu_email" placeholder="Email" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                                <label><input type="radio" name="gender"  checked value="m" selected>Male</label>
      						    <label><input type="radio" name="gender" value="f">Female</label>
                                <label><input type="radio" name="gender" value="n">Non Binary</label>
                        </div>


                        <div class="form-group col-md-12">
                          <input id="contact_num" placeholder="Contact number" type="text" class="form-control">
                        </div>  

                        <div class="form-group col-md-12"><br>
                        <h6>Please insert your valid ID photo</h6>
                        <div class="custom-file">
                            <input type="file" id="file" name="file"  class="form-control-file"/> 
                            
                        </div>
                        </div>

                        <!-- <div class="form-row col-md-12">
                        <button type="button" class="button">Submit Details</button>
                        </div> -->
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Create Appointment</h4>
                <form>
                    <div class="form-row"> 
                        <div class="form-group col-md-12">
                                 <select id="department" name="department" class="form-control">
                                  <option selected="true" disabled="disabled">Please select Department</option>  
                                    <!-- deparment choices -->
                                  <?php
                                        $department_query = "SELECT * FROM department_offices where do_active=1 ";
                                        $result = $conn->query($department_query);
                                        if ($result->num_rows >0) {
                                        while ($row=$result->fetch_assoc()) {
                                        echo "<option value='{$row["department_offices_id"]},{$row["ass_user_ref_id"]}'>{$row['department_offices_desc']}</option>";
                                        }
                                        }else{
                                        echo "<option value=''>Department not available</option>";
                                        }
                                    ?>
                                  </select>
                        </div>
                          <div class="form-group col-md-12">
                        
                        </div>
                        <div class="form-group col-md-12">
                          <textarea id="message" class="form-control" rows="3" placeholder="Purpose"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                          <label for="exampleFormControlInput1">To</label>
                          <input type="text" id="search_data"  autocomplete="off" class="form-control input-lg" placeholder="Make Sure to hit enter" />
                      </div>
                        
                     </div>

                     <div class="form-row">
                        <div class="form-group col-md-12">
                          <p>Date</p>
                          <input id="date_sched" name="date" class="form-control" type="date"  min="<?php date_default_timezone_set('Asia/Manila'); echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                      
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Start Time</label>
                      <input id="start_time"  placeholder="Start Time" class="form-control" type="time">
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Estimated End Time</label>
                      <input id="end_time"  placeholder="End Time" class="form-control" type="time">
                  </div>
                    
                    <div class="form-row">
                        <button type="button" class="button" id="btn-visit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

 <script src="assets/js/jquery-3.6.0.min.js"> </script>
  <!-- alerts plugin -->
  <script src="assets/js/jquery-confirm.min.js"></script>

  <!-- token field -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
     

  <script>
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isContactNum(test) { 
        var regex = /^(09|\+639)\d{9}$/;
        return regex.test(test);
    }

    function isCharacter(string) { 
        var regex = /^[A-Za-z]+$/;
        return regex.test(string);
     }

     function isDigit(string) { 
        var regex = /^[0-9]+$/;
        return regex.test(string);
     } </script>
<script>
    
$(document).ready(function() {
    // register
    $('.spinner-grow').hide();

    $('#search_data').tokenfield({
       
       });

    $('#btn-visit').on('click', function(e) {
        e.preventDefault(e);
        
        var bu_email = $('#bu_email').val(),
            last_name = $('#last_name').val(),
            first_name = $('#first_name').val(),
            middle_name = $('#middle_name').val(),   
            department = $("#department option:selected").val(),
            message = $('#message').val(), 
            gender = $('input[name="gender"]:checked').val(),
            date_sched = $('#date_sched').val(), 
            contact_num = $("#contact_num").val();

            start_time=$('#start_time').val();
            end_time=$('#end_time').val();
           
            
        
            var fd = new FormData();
            var files = $('#file')[0].files;
            var with_list=$('#search_data').tokenfield('getTokensList',',');
            
            // Check file selected or not
           
            fd.append('file',files[0]);
            fd.append('bu_email',bu_email);
            fd.append('last_name',last_name);
            fd.append('first_name',first_name);
            fd.append('middle_name',middle_name);
            fd.append('message',message);
            fd.append('gender',gender);
            fd.append('department',department);
            fd.append('contact_num',contact_num);
            fd.append('date_sched',date_sched);
            fd.append('with_list',with_list);
            fd.append('start_time',start_time);
            fd.append('end_time',end_time);

         
             
  
      // error handling
        // if (bu_email === ""  || last_name === "" || first_name === "" ||
        //     middle_name === "" || gender === "" || department === ""  ||
        //     contact_num === "" || message === "" || date_sched==="") {
        //         $.alert({
        //             title: 'Check',
        //             content: 'Input All Fields',
        //         });
        // } else if(files.length == 0 ){
        //        $.alert({
        //             title: 'Check',
        //            content: 'No file uploaded',
        //         });
           
            
        // }else if(isEmail(bu_email)==false){
        //         $.alert({
        //             title: 'Check Your Email',
        //             content: 'Email not accepted',
        //         });
        // }
       
        // else if(isDigit(year)==false){
        //     $.alert({
        //         title: 'Invalid Input',
        //         content: 'Allows Digit Only" ',
        //     });

        // }
        // else if(isContactNum(contact_num)==false){
        //     $.alert({
        //         title: 'Check Your Number',
        //         content: 'Your number must start with "09" or "+639" ',
        //     });

        //  } else{
            $.ajax({
                type: 'POST',
                url: './includes/visitors.inc.php',
                //timeout: 20000,
                data:fd,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner-grow').show();
                },
                success: function(data) { 
                  window.alert(data);
                 
                    $('.spinner-grow').hide();
                   
                },
                complete: function(data) {
                    $('.spinner-grow').hide();

                 
                }
            });

    //    }

    });

});

  
</script>


<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>
        <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "107038105086874");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>


</body>
</html>