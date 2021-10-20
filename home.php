    <?php 
        include_once './includes/db.inc.php';
        include_once './includes/func.inc.php';

        session_start();
        $session_user_ref_id =$_SESSION['user_ref_id'];
        $session_user_type =$_SESSION['user_type'];
        //$_SESSION['user_buEmail'];
        if (is_null( $_SESSION['user_ref_id'])){
            header("location: index.php");
        }else if($session_user_type=='A'){
            header("location: admin/index.php");
        }
        
    ?> 


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

       <!-- pluginsd -->

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/notifications.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


          <!-- -alert plugin -->
  <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />


        <!-- auto update load -->

        <!-- <script type="text/javascript" src="autoUpdate.js"></script> -->

        <style>
            .to{
                color:#000;
            }
            .to:hover{
                color: red;
            }
            .btn-view{
                cursor: pointer;
                color: #009BDE;
                font-size: 25px;
            }
            .btn-view:hover{
                color: #ff7802;
            }
        </style>

    </head>
    <body>


    <?php
        include_once('includes/sidenav.php');
    ?>

        <br><br><br><br>
        <div class="container-fluid">
        <!-- <h2>Notification</h2> -->
        <div class="card">
            <div class="card-header" style="background-color: #009BDE;">
            <div class="md-form mt-0">
                <h2 id="my_apt">My Appointments</h2>
            </div>
            </div>
            <div class="card-body">
            <input class="form-control" type="text" placeholder="Search Mail" aria-label="Search" style="box-shadow: 9px 7px 11px -2px rgba(0,0,0,0.25);">
            <div class="table-responsive">
            <table class="table table-borderless table-hover">
            <thead>
                <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
            </thead>

            <tbody>
            <?php

                            $arr= displayGoing($conn,$session_user_ref_id);
                            foreach ($arr as $value){
                           
                            $date = new DateTime($value["date_responded"]);
                            $result_date = $date->format('g:i a-D,M j');
                            $full_name= ucfirst($value['user_firstName']).' '.ucfirst($value['user_middleName']).' '.ucfirst($value['user_lastName']);                     
                           //apt sched
                            $date_apt_sched =new DateTime($value["apt_scheduleDate"]);
                            $result_date_only = $date_apt_sched->format('M j'); 
                            // time am or pm
                            $date1 = new DateTime($value["apt_startTime"]);
                            $start_time=$date1->format('h:i a') ;
                            $date2 = new DateTime($value["apt_endTime"]);
                            $end_time=$date2->format('h:i a') ;
                            $final_time= $result_date_only.'('.$start_time .'-'.$end_time.')';




                            
                            $profile_pic= $value['user_profile_pic'];
                            if($profile_pic===''){
                             $profile_pic='default_user.png';
                            }
                        
                                if($value['apt_status']==3 ) {
                                
                                    echo "
                                    <tr class='table'>
                                    <td><a class='to' href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> You </a></td>

                                            <td>
                                            </td>
                                            <td class='date'>{$final_time}</td>
                                            <td>{$value['apt_title']}</td>
                                            <td> <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i></td>
                                            <td><button type='button' class='btn btn-warning btn-xs btn-cancel'  id='{$value['apt_ref_id']}'>Cancel</button></td>
                                            <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                                    </tr>
                                    
                                    ";


                                }else if ($value['apt_status']==1  ){
                                   

                                    echo "
                                     <tr class='table'>
                                     <td><a class='to' href='profile.php?u={$value['user_type']}{$value['user_ref_id']}'><img src='./uploads/profile/$profile_pic' alt='Avatar' style='width:30px;height:30px;border-radius: 50%;'> {$full_name} </a></td>

                                        <td>
                                        <!-- <span class='badge badge-pill text-white font-medium badge-warning mr-2 btn-cancel'>Requesting</span> -->
                                        </td>
                                        <td class='date'>{$final_time}</td>
                                        <td>{$value['apt_title']}</td>
                                        <td> <i class='fa fa-sticky-note btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i></td>
                                        <td></td>
                                        <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                                    </tr>
                                    ";
                                }

                            }
                    ?>
                


            </tbody>
        </table>
            </div> 
        </div>
        </div>
    
        <!-- modal -->

                <div class="bs-example">
            '<div id="myModal" class="modal" tabindex="-1">
                '<div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title font-weight-bold">Title: &nbsp; <small class="" id="m_title"></small></h4>
                            <!-- <h1 class="modal-title title" id="m_title"></h1> -->
                            <button id="icon-close" type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <div class="modal-body">
                            <p class="font-weight-bold ">Date Created: &nbsp;<small id="m_date_created">date</small></p>
                            <p class="font-weight-bold ">When: &nbsp;<small id="m_when">date</small></p>
                            <p class="font-weight-bold">Mode: &nbsp;<small class="font-weight-bold" id="m_mode"></small>&nbsp;
                                <p id="m_result"> <a href="" id="m_link">   </a></p>
                            </p>
                            <p class="font-weight-bold">Note: <small  id="m_message"></small></p>
                            <p class="font-weight-bold"><i class='fas fa-user-friends'></i>&nbsp;Guests:</p>

                            <table id="records_table">
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        
  

        <!-- end of modal -->
                    
        <!-- alerts plugin -->
    <script src="assets/js/jquery-confirm.min.js"></script>

    <script src="assets/js/moment.js"></script>

        <script>

            $(document).ready(function(){
              
                $(".btn-cancel").click(function(e){
                   // alert($(this).attr('id'));
                    e.preventDefault();

                    var cancel_id =$(this).attr('id');


                     $.confirm({
                        title: 'Confirm!',
                        content: ' Cancel this appointment?',
                        buttons: {
                            confirm: function () {
                                    $.ajax({
                                        type: 'POST',
                                    
                                        url: './includes/user_action.inc.php',
                                        data: {
                                            'cancel_id':cancel_id
                                        },
                                        success: function(data) {
                                            location.reload();
                                            // $.alert({
                                            //     title: 'Confirmed Cancelled',
                                            //     content: data,
                                            // });
                                        }
                                    });
                            },
                            cancel: function () {
                               
                            },
                          
                        }
                    });

                });
            });

            //  close modal
            $("#icon-close").click(function(){
                    $("#myModal tr").detach();
                    $("#myModal").fadeOut();
          });

                
         $(".btn-view").click(function(){
         
         // $("#myModal").fadeIn();

         
         var view_id =$(this).attr('id');

               
                $.ajax({
                    type: 'POST',
                    url: './includes/user_action.inc.php',
                    dataType: "json",
                    data: {
                        'view_id':view_id
                    },
                    success: function (response) {
                             $("#myModal").fadeIn();
                            var trHTML = '';



                        
                            $.each(response, function (i, item) {                          
                      
                                //item.apt_scheduleDate
                              $("#m_title").text(item.apt_title);
                              $("#m_message").text(item.apt_message);
                              $("#m_when").text(  moment(item.apt_scheduleDate).format("ddd, MMM D ") +'' +moment(item.startTime).format('LT') + '-' +moment(item.endTime).format('LT') );
                              $("#m_date_created").text(  moment(item.apt_CreatedAt).format("ddd, MMM D LT ") );
                             // 
                              var responded_date= moment(item.date_responded).calendar();   

                              if(item.apt_mode==1) {
                                $("#m_mode").text('Online');
                                $("#m_link").text(item.apt_result);
                              }
                              else if(item.apt_mode==2) {
                                $("#m_mode").text('Outside Campus');
                                $("#m_result").text(item.apt_result);
                              }else if(item.apt_mode==3) {
                                $("#m_mode").text('Inside Campus');
                                $("#m_result").text(item.apt_result);
                              }else if(item.apt_mode==4) {
                                $("#m_mode").text('Call');
                                $("#m_result").text(item.apt_result);
                              }

                              if(item.apt_status===3){
                                 item.apt_status= "<span class='badge badge-pill text-white font-medium badge-primary mr-2'>Organizer</span>";
                              } else if(item.apt_status===2){
                                 item.apt_status= "<span class='badge badge-pill text-white font-medium badge-danger mr-2'>Not Gong</span>";
                              }else if(item.apt_status===1){
                                 item.apt_status= "<span class='badge badge-pill text-white font-medium badge-success mr-2'>Going</span>";
                              }else if(item.apt_status===0){
                                 item.apt_status= "<span class='badge badge-pill text-white font-medium badge-warning mr-2'>Pending</span>";
                              }


                              // default image
                              if(item.user_profile_pic===''){
                                item.user_profile_pic= "default_user.png";
                              }


                              //  if(item.)
                              trHTML += '<tr><td><p class="font-italic lg"><img src="./uploads/profile/'+ item.user_profile_pic +'" alt="Avatar" style="width:30px;height:30px;border-radius: 50%;">  <a class="to" href="profile.php?u='+ item.user_type + ''+ item.user_ref_id +'">' + item.user_lastName  +','+ item.user_firstName  + ' ' + item.user_middleName + '</td><td> </a>' + item.apt_status + '</td><td>' + responded_date+ '</p></td></tr>';
                                // trHTML += '<tr><td><i class="fas fa-user-circle"> ' + item.user_lastName  +','+ item.user_firstName  + ' ' + item.user_middleName + '</p></td><td>' + item.apt_status + '</td><td>' + item.date_responded + '</td></tr>';
                            });
                            $('#records_table').append(trHTML);
                        }
                      });

                 });


                 


        </script>


        <!-- alerts plugin -->
        <script src="assets/js/jquery-confirm.min.js"></script>

        <!-- moment js -->
        <script src="assets/js/moment.js"></script>

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
