<?php

  if(isset($_GET['email']))
      $email=$_GET['email'];
  else
      $email="";



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

       <!-- -alert plugin -->
    <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />
   


</head>
<body>
	<?php
	include_once('navbar.php');
	?>
   
  
	<section class="testimonial py-5" >
    <!-- register form -->
    <div class="container" id="register_form">


    <?php
    if(isset($_GET['status'])=='ok'){
        echo '<div class="alert alert-success" role="alert">
          Note: Please be patient. It may take a while in receiving an email. 
            If you are unable to see an email, check your Spam or Promotions folder.
            Thank you.
            
     </div>';
    }else if(isset($_GET['status'])=='verified'){
      echo '<div class="alert alert-success" role="alert">
          Your email has been verified, please wait for the admin to full verify your account or you may contact on the messenger buton below.
    </div>';

    }

    ?>
  
        <div class="row ">
            <div class="col-md-4 registration text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <h2 class="py-3">Login</h2>
                        <img src="image/svg/access.svg" style="width:80%">                       
                        <!-- <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Login with your BU ID or BU Email</h4>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input id="login_id" name="buemail" placeholder="Email" class="form-control" type="text" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="login_pass" name="password" placeholder="Password" class="form-control" required="required" type="password">
                        </div>
                   </div>
                    
                    <div class="form-row">
                        <button type="button" class="button" id="btn-login" >Submit</button>
                    </div>  
                    <div class="form-row">
                      <a href="send-code.php"><p class="font-italic"><small>Didnt recieve the email ?</small></p></a>
                    </div>
                    <div class="form-row">
                      <a href="password-reset.php"><p class="font-weight-bolder font-italic">Forgot Password ?</p></a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>


<!-- ajax -->
<script src="assets/js/jquery-3.6.0.min.js"> </script>
<script src="assets/js/main_ajax.js"></script>

<!-- alert plugin -->
<script src="assets/js/jquery-confirm.min.js"></script>
      

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