<!DOCTYPE html>
<html>
<head>
  <title>Add Appointment</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   <link rel="stylesheet" href="css/register.css">
</head>
<body>
<?php
include_once('sidenav.php');
?>

<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row ">
            
            <div class="col-md-8 py-5 border">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <p>To:</p>
                          <input id="" name="buemail" placeholder="Email" class="form-control" type="email">
                        </div> 
                   </div>

                   <div class="form-row">
                        <div class="form-group col-md-12">
                          <p>Title:</p>
                          <input id="" name="title" placeholder="Title" class="form-control" type="text">
                        </div> 
                   </div>

                   <div class="form-row">
                        <div class="form-group col-md-12">
                          <p>Date</p>
                          <input id="" name="date" class="form-control" type="date">
                        </div>
                        <div class="form-group col-md-6">
                          <p>Start Time</p>
                          <input id="" name="start_time" class="form-control" type="Time">
                        </div>
                        <div class="form-group col-md-6">
                          <p>End Time</p>
                          <input id="" name="end_time" class="form-control" type="Time">
                        </div>
                   </div>

                   <div class="form-row">
                        <div class="form-group col-md-12">
                          <p>Mode</p>
                          <select class="form-group">
                          	<option>Face to Face</option>
                          	<option>Online meeting</option>
                          	<option>Call</option>
                          </select>
                          <input id="" name="title" placeholder="Input details" class="form-control" type="text">
                        </div> 
                   </div>
                    <!-- <div class="form-row">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                  <label class="form-check-label" for="invalidCheck2">
                                    <small>By clicking Submit, you agree to our Terms & Conditions, User Agreement and Privacy Policy.</small>
                                  </label>
                                </div>
                              </div>
                          </div>
                    </div> -->

                    <p>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Link with href
  </a>
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-target
  </button>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>
                    
                    <div class="form-row">
                        <button type="button" class="button">Send</button>
                    </div>
                </form>
            </div>
<div class="col-md-4 registration text-white text-center ">
                <div class=" ">
                    <div class="card-body"> 
                        <h2 class="py-3">Create New Appointment</h2>
                        <br><br>
                        <img src="assets/images/newmess.svg" style="width:80%">
                        <p></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


</body>
</html>