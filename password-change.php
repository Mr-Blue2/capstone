<?php session_start();
     if(isset( $_SESSION['user_ref_id']));
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

</head>
<body>
	<?php
	include_once('navbar.php');
	?>

    <!-- forgot pass -->
  <section class="testimonial py-5">
    <div class="container" id="recover_form">
        <div class="row ">
            <div class="col-md-4 registration text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="image/undrawpng3.png" style="width:30%">
                        <h2 class="py-3">Forgot PAss</h2>
                        <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Enter your Email</h4>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input  id="new_email"placeholder="Email" class="form-control" type="text" value="<?php echo $_GET['email'] ?>">
                        </div>

                        <div class="form-group col-md-6">
                          <input  id="new_password"placeholder="password" class="form-control" type="password">
                        </div>
                        <div class="form-group col-md-6">
                          <input  id="new_confirm_password"placeholder="Confirm Password" class="form-control" type="password">
                        </div>
                   </div>
                    <div class="form-row">
                        <button type="button" class="button" id="btn-reset-submit" >Submit</button>
                    </div>  
                    <div class="form-row">
                      <a href="login.php" > <h4>Login Account </h4></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ajax -->

<script>
  
$(document).ready(function() {

    $('#btn-reset-submit').on("click",function(e){
        e.preventDefault();
        var new_email = $('#new_email').val();
        var  new_password= $('#new_password').val();
        var  new_confirm_password = $('#new_confirm_password').val();

        var token ="<?php echo $_GET['token'] ?>";
        if(new_email==="" || new_password ==="" || new_confirm_password ==="" ){
            window.alert("complete all fields");
        }else if(new_password !== new_confirm_password){
            window.alert("password dont match");
        }else{
            $.ajax({
                    type: 'POST',
                    url: './includes/action.inc.php',
                    data: {
                        'new_email':new_email,
                        'new_password':new_password,
                        'token':token
                    },
                    success: function(data) {
                        window.alert(data);
                    }
                });
          }
    });
       
});

</script>
<script src="assets/js/jquery-3.6.0.min.js"> </script>

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