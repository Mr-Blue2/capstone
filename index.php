


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- boxicon -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- -alert plugin -->
    <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>BUPC ASS</title>
</head>

<body>
    <?php
    include_once('navbar.php');
    ?>

    <br>
            <div class="container">
                <div class="row custom-section d-flex align-items-center">
                    <div class="col-12 col-lg-4">
                        <h2>BUPC</h2>
                        <h3 class="font-weight-bold">A<small class="font-italic">ppointment </small></h3>
                        <h3 class="font-weight-bold">S<small class="font-italic">cheduling </small></h3>
                        <h3 class="font-weight-bold">S<small class="font-italic">ystem </small></h3>
                        <p class="font-italic">The journey begins to keep an appointment with BUPCeans! LOGIN NOW!</p>
                        <a href="visitor.php">Register as Stakeholder</a>
                    </div>
                    <div class="col-12 col-lg-8">
                        <img src="image/events.svg" alt="Team process banner">
                    </div>
                </div>
            </div>

     <div class="container" id="part2">
        <div class="row custom-section d-flex align-items-center">
            <div class="col-12 col-lg-4"> 
                <img src="image/svg/aboutus.svg" alt="Team process banner" width="100%">
            </div>
            <div class="col-12 col-lg-8">
                <h2>About Us</h2>
                <br>
                <h3 class="font-weight-bold">Mission</h3>
                <p>The Bicol University Polangui Campus Appointment Scheduling System should be able to create and reliably manage appointments for students, faculty, and stakeholders.</p>
                <h3 class="font-weight-bold">Vision</h3>
                <p>An efficient Appointment Scheduling System for Bicol University Polangui Campus in managing appointments.</p>
                <!-- <a href="#">Learn more</a> -->
            </div>
        </div>
    </div>

   <div class="container" id="part3">
        <div class="row custom-section d-flex align-items-center">
             <div class="col-12 col-lg-4">
                <h2>Support</h2>
                <h3>Us</h3>
                <p>For questions and concerns. Feel free to contact us through our social media sites.</p>
                <a href="https://www.facebook.com/bupcappointmentschedulingsystem"><i class='bx bxl-facebook-circle'></i></a>
                <a href=""><i class='bx bxl-instagram-alt'></i></a>
                <a href=""><i class='bx bxl-twitter'></i></a>
                <a href="https://www.youtube.com/user/TheBicolUniversity"><i class='bx bxl-youtube' ></i></a>
                <!-- <a href="#">Learn more</a> -->
            </div>
            <div class="col-12 col-lg-8">
                <img src="image/svg/teamspirit.svg" alt="Team process banner">
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"> </script>

    <script src="assets/js/jquery-confirm.min.js"></script>


    <script>
        
     
$(document).ready(function() {

    $.confirm({
        icon: 'fa fa-gear fa-spin',
        title: 'Welcome!',
        content: 'This is a capstone project under development. Please be patient with <b>delay in receiving emails </b>in the registration process and creating of appointments, you may check <b> spam/promotion folder </b> in email. This an online tool to set an appointment in Bicol University Polangui Campus. <br><br>For queries you may check the support site. Thank you for using our website.<br><br>-<b>The Researchers/Developers</b>',
        columnClass: 'col-md-10'
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