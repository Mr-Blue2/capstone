<?php    
  require_once('db.inc.php');
  require_once('func.inc.php');
   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="./assets/css/sidenav.css">
        <link rel="stylesheet" href="./assets/css/register.css">
        <link rel="stylesheet" href="./assets/css/badge.css">


          <!-- -alert plugin -->
        <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />


        <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

       
        <!--  token field -->
        <link rel="stylesheet" href="./assets/css/bootstrap-tokenfield.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">

        <style>

            .create_apt{       
        position: absolute; /*Can also be `fixed`*/
        left: 0;
        right: 0;
        top: 100px;
        bottom: 0;
        margin: auto;
        display: none;
        height: auto;
        z-index: 100;                 
}
.form-group .form-control {
        padding: 2;     
            }
.modal-content{
    background-color: #f1f1f1;
    box-shadow: 1px 26px 56px 3px rgba(0,0,0,0.55);
}  
                    


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

        <!-- for number -->

    </head>

    <body id="body-pd"> 
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
            <div class="header__img">
                <a href="profile.php">
                <img src="uploads/profile/<?php   echo getPicturebyId($conn, $_SESSION['user_ref_id']) ;?>">
                
                </a>
            </div>         
        </header> 

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                       
                        <span class="nav__logo-name">BUPC A.S.S</span>
                    </a>
                    <div class="nav__list">

                         <a href="javascript:void(0)" class="nav__link aaf" data-id="102" data-username="sample_username">
                            <i class='bx bx-plus-circle nav__icon'></i>
                            <span class="nav__name">Create Appointment</span>
                        </a>
                        <a href="home.php" class="nav__link">
                            <i class='bx bxs-home nav__icon' ></i>
                            <span class="nav__name">My Appointments</span>
                            <span class='fudge badge-warning' id='lblHomeCount'></span> 
                        </a>
                        
              
                        <a href="notification.php" class="nav__link">                    
                            <i class='bx bxs-notification nav__icon' ></i>
                            <!-- notif count -->
                            <span class="nav__name">Notification</span>
                            <span class='fudge badge-warning' id='lblCartCount'></span> 
                          
                        </a>
                        <a href="my-calendar.php" class="nav__link">
                            <i class='bx bxs-calendar nav__icon'></i>
                            <span class="nav__name">Calendar</span>
                        </a>
                        <a href="history.php" class="nav__link">
                            <i class='bx bx-history nav__icon' ></i>
                            <span class="nav__name">History</span>
                        </a>
                    </div>
                </div>
               <a href="includes/logout.inc.php" class="nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

<!-- create appointment -->


    <div class="container col-md-7 create_apt">

         <!-- spinner -->
        <div class="spinner-grow text-primary" role="status" >
             <span class="sr-only">Loading...</span>
        </div>

            <form id="myform">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #525252;">
            <h6 class="modal-title" id="exampleModalLongTitle" style="color: #fff;">Create Appointment</h6>
            <button type="button"  id="btn-close" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#fff">&times;</span>
            </button>
            </div>
            
            
            <div class="modal-body">
             <div class="form-group">
                <label for="exampleFormControlInput1">To:</label>
                <input type="text" id="search_data" placeholder="Search email only" autocomplete="off" class="form-control input-lg" />
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Select Department</label>
                                <select id="department" name="department" class="form-control">
                                  <option selected="true" disabled="disabled">Please select Department</option>  
                                    <!-- deparment choices -->
                                  <?php
                                        $department_query = "SELECT * FROM department_offices where do_active=1 ";
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

           
            <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input type="text" id="title" placeholder="" autocomplete="off" class="form-control input-lg" />
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Message</label>
                <textarea class="form-control" id="message" rows="3" placeholder="Optional"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Schedule Date</label>
                <input id="schedule_date"  placeholder="Date" class="form-control" type="date" min="<?php date_default_timezone_set('Asia/Manila'); echo date('Y-m-d'); ?>">
    
            </div>

            <div class="form-group">
                <label for="exampleFormControlInput1">Mode</label>
                <select class="form-control" id="mode">
                          	<option value="1">Online Meeting</option>
                          	<option value="2">Outside Campus</option>
                          	<option value="3"> Inside Campus</option>
                            <option value="4"> Call</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Start Time</label>
                <input id="start_time"  placeholder="Start Time" class="form-control" type="time">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Estimated End Time</label>
                <input id="end_time"  placeholder="End Time" class="form-control" type="time">
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlInput1">Input details here</label>
                <input id="result"  placeholder="Insert Meeting Link" class="form-control" type="text">
            </div>
            <div class="form-group tokenhide">
            <input type="text" class="form-control" id="tokenfield" placeholder="Add Person and hit Enter" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" id="btn-create_apt">Send</button>
            </div>

         
            </div>
          </div>
         </div>
        </form>
    </div>

          



 <!--===== MAIN JS =====-->
        <script src="./assets/js/sidenav.js"></script>
        <script src="./assets/js/jquery-3.6.0.min.js"> </script>

        <!-- token field -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>


        <script src="assets/js/jquery-confirm.min.js"></script>

        <script src="assets/js/moment.js"></script>
     
        
    </body>
</html>
<script>


    $(document).ready(function(){

    

      

        //token field
        $('.tokenhide').hide();

        // $("#search_data").tokenfield('setTokens', []);
        // $("#tokenfield").tokenfield('setTokens', []);

        $('#tokenfield').tokenfield({

            showAutocompleteOnFocus: true
            
            })
    
        // mode clicked
      
        $('#mode').change(function(){ 
            var value = $(this).val();
            
            if(value==1){
              var result='Insert Meeting Link';
             $('.tokenhide').hide();
             $('#result').show();
           
            } 
            else if(value==2){
              var result='Insert address';
              $('#result').show();
            $('.tokenhide').hide();
            }  else if(value==3){
              var result='BUPC CAMPUS';
              $('#result').hide();
            $('.tokenhide').show();

            }else if(value==4){
              var result='phone number';
              $('#result').show();
            }
           $("#result").attr("placeholder", result);
           
        });


        $('.spinner-grow').hide();


        $('.aaf').on("click",function(){
            $('.create_apt').fadeIn();
        });

        $('#btn-close').on("click",function(){
            $('.create_apt').fadeOut();
       
            $("#search_data").tokenfield('setTokens', []);
            $("#tokenfield").tokenfield('setTokens', []);

            
        });



        /// geting dep

       $('#search_data').tokenfield({
        autocomplete :{
            source: function(request, response)
            {
                jQuery.get('includes/user_action.inc.php', {
                    query : request.term
                }, function(data){
                    data = JSON.parse(data);
                    response(data);
                    
                });
            },
            delay: 100
        }
       });
       
        $('#search_data').on('tokenfield:createtoken', function (event) {
            var tokens = $(this).tokenfield('getTokens');
            $.each(tokens, function(index, token) {
                if (token.value === event.attrs.value)
                    event.preventDefault();
            });
        });

    

        
    

            
       $('#btn-create_apt').on("click",function(e){
                e.preventDefault();

            
   
           var recipient = $('#search_data').val(),
               title= $('#title').val(),
               message =$('#message').val(),
               schedule_date=$('#schedule_date').val(),
               start_time = $('#start_time').val(),
               end_time=$('#end_time').val(),
               mode=$('#mode').val(),
               result=$('#result').val();

               var with_list=$('#tokenfield').tokenfield('getTokensList',',');

               var dept_id=$('#department').val();
               
               //var startDate = new Date($('#start_time').val());
              
              start_time.trim();
              end_time.trim();

               var a = moment( schedule_date+' ' +start_time, 'YYYY.MM.DD mm:ss');  //start
               var b = moment( schedule_date+' ' +end_time, 'YYYY.MM.DD mm:ss');  //end
               
               
               var min_time =  moment( schedule_date+' ' +'08:00', 'YYYY.MM.DD mm:ss');
               var max_time =  moment( schedule_date+' ' +'17:00', 'YYYY.MM.DD mm:ss');
               

             
      
               if(recipient.trim()===''){
                        $.alert({
                        title: 'No Recipient!',
                        content: 'Please insert recipient',
                  });
               }
               else if(dept_id===''){
                        $.alert({
                        title: 'No Department!',
                        content: 'Please insert target department',
                  });
               }
               else if(title.trim()===''){
                        $.alert({
                        title: 'No title!',
                        content: 'Please insert title',
                  });
               }
               else if(schedule_date.trim()===''){
                        $.alert({
                        title: 'No Schedule Date!',
                        content: 'Please insert Date',
                  });
               }
               else if(mode.trim()===''){
                        $.alert({
                        title: 'No Mode!',
                        content: 'Please insert mode',
                  });
               }
               else if(start_time.trim()===''){
                        $.alert({
                        title: 'No Start time!',
                        content: 'Please insert time',
                  });
               }
               else if(end_time.trim()===''){
                        $.alert({
                        title: 'No End time!',
                        content: 'Please insert end  time',
                  });
               } 

               //to calculate the diff
               else if(a.isSameOrAfter(b)===true) {
                        $.alert({
                                title: 'Check start time and end time!',
                                content: 'End time must be greater than to start time',
                        });
               } // pag true mali

              
              else   if(mode==='3'){

                    if(a.isSameOrAfter(min_time) === false ||  a.isSameOrBefore(max_time) === false || b.isSameOrBefore(max_time) === false || b.isSameOrAfter(min_time)=== false )
                    {
                                $.alert({
                                        title: 'Sorry',
                                        content: 'BUPC 8am t0 5pm only',
                                });
                    }

              }
               
            
    
               
               
               else{
                    $.ajax({
                    type: 'POST',
                    url: './includes/user_action.inc.php',
                    //timeout: 20000,
                
                    data: {
                        'recipient': recipient,
                        'title':title,
                        'message': message,
                        'schedule_date': schedule_date,
                        'start_time': start_time,
                        'end_time': end_time,
                        'mode': mode,
                        'result': result,
                        'with_list':with_list,
                        'dept_id':dept_id,
                    },
                
                    beforeSend: function() {
                        $('.spinner-grow').show();
                    },
                    success: function(data) { 
                        $('.spinner-grow').hide();
                        $('.create_apt').hide();
                       
                        // $.alert({
                        // title: 'Success!',
                        // content: 'Creating appointment Success',
                        // });

                        $.alert({
                        title: 'Alert!',
                        content: data,
                        });

                     

                     
                    },
                    complete: function(data) {
                        $('.spinner-grow').hide();
                        $('.create_apt').hide();
                        $("#search_data").tokenfield('setTokens', []);
                        $("#tokenfield").tokenfield('setTokens', []);
                       
                        
                    
                    }
            });

         }


       });

       // my testing

      function loadXMLDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                result =this.responseText.split(","); 
                
                if(result[0]==='empty' || result[1]==='empty') {
                    result[0]='';
                    result[1]='';
                }
                 document.getElementById("lblCartCount").innerHTML =result[0];
                 document.getElementById("lblHomeCount").innerHTML =result[1];
            }
        };
        xhttp.open("GET", "includes/response_status_notif.php", true);
        //xhttp.open("GET", <server.php?id=f", true);
        xhttp.send();
        }

        setInterval(function(){
            loadXMLDoc();
            // 1sec
        },1000);


      
        
       
  
    });
 
   
</script>

