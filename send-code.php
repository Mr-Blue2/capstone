<?php session_start();
      //echo $_SESSION['user_ref_id'];
?>
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

     <style>
           .spinner-grow{
            height: 50px;
            width: 50px;
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


	<section class="testimonial py-5" >
    <!-- register form -->
    <div class="container" id="register_form">
        <div class="row ">
            <div class="col-md-4 registration text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <h2 class="py-3">Email</h2>
                        <img src="image/svg/mailsent.svg" style="width:80%">
                        <!-- <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Resend Email</h4>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input id="resend_email" name="buemail" placeholder="Email" class="form-control" type="text">
                        </div>
                      
                   </div>
                    
                    <div class="form-row">
                        <button type="button" class="button" id="btn-resend" >Resend</button>
                    </div>  
            
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ajax -->
<script src="assets/js/jquery-3.6.0.min.js"> </script>
<script>

$(document).ready(function() {

    $('.spinner-grow').hide();
     $('#btn-resend').on('click', function(e) {
         e.preventDefault();
     var resend_email = $('#resend_email').val();
            $.ajax({
                        type: 'POST',
                        url: './includes/action.inc.php',
                       
                        data: {
                            'resend_email':resend_email
                        },

                        beforeSend: function() {
                            $('.spinner-grow').show();
                        },
                        success: function(data) {
                            window.alert(data);
                            $('.spinner-grow').hide();
                            $('#resend_email').val('');
                        },
                        complete: function() {
                            $('.spinner-grow').hide();
                            $('#resend_email').val('');
                        },

                    });
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