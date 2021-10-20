<?php 
     include_once './includes/db.inc.php';
     include_once './includes/func.inc.php';

     session_start();
     $session_user_ref_id =$_SESSION['user_ref_id'];
     //$_SESSION['user_buEmail'];
     if (is_null( $_SESSION['user_ref_id'])){
           header("location: index.php");
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

    <!-- plugins -->
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/card_notif.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


  <!-- -alert plugin -->
  <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />


  <!-- pop up -->

  <link rel="stylesheet" type="text/css" href="assets/css/notification_msgbox.css">


  <!-- font awesone -->


  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  


</head>
<body>
<?php
	include_once('includes/sidenav.php');
?>



<br><br><br>


   
<div class="container-fluid">
  <!-- <h2>Notification</h2> -->
  <div class="card notif">
    <div class="card-header" style="background-color: #009BDE;">
      <div class="md-form mt-0">
        <h2>Notifications</h2>
      </div>
    </div>
    <div class="card-body">
      <input class="form-control" type="text" placeholder="Search Mail" aria-label="Search" style="box-shadow: 9px 7px 11px -2px rgba(0,0,0,0.25);">
    
      <div id="link_wrapper">

	   	</div>


    <!-- <table class="table table-borderless">
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
                         // $arr= displayNotif($conn,$session_user_ref_id);
                          // foreach ($arr as $value){
                          //   // not read no response

                          //   // echo $value['notif_note'];

                        
                          //   $date = new DateTime($value["notif_date"]);
                          //   $result_date = $date->format('g:i a-D,M j  ');


                          //   $date_apt_sched =new DateTime($value["apt_scheduleDate"]);
                          //   $result_date_only = $date->format('M j'); 

                            

                    
                              
                          //    if($value['notif_type']==0 && $value['notif_read']==0 ) {
                          //        echo "
                          //        <tr class=''>
                               
                          //        <td><a href=''>{$value['user_lastName']}</a></td>
                          //        <td>
                          //          <span class='badge badge-pill text-white font-medium badge-warning mr-2'>Requesting</span>
                          //        </td>
                          //        <td class='date'>{$result_date_only}</td>
                          //        <td>{$value['apt_title']}</td>
                          //        <td>
                          //          <i class='fa fa-envelope btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i>
                          //          <button type='button' class='btn btn-success btn-xs btn-goin' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Going</button>
                          //          <button type='button' class='btn btn-primary btn-xs  btn-not-goin' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Not Going</button>
                                   
                          //        </td>
                          //        <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                          //      </tr>
                                 
                                 
                                 
                          //        ";
                            
                          //       ///na ka respond na
                          //    }else if($value['notif_type']==0 && $value['notif_read']==1 ) {
                               
                          //       echo "
                          //           <tr class=''>
                          //               <td><a href=''>  {$value['user_firstName']},{$value['user_lastName']}</a></td>
                          //               <td>
                          //               <span class='badge badge-pill text-white font-medium badge-warning mr-2'>Requesting</span>
                          //               </td>
                          //               <td class='date'>{$result_date_only}</td>
                          //               <td>{$value['apt_title']}</td>
                          //               <td> <i class='fa fa-envelope btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i></td>
                          //               <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                          //          </tr> 
                          //       ";


                                
                          //       // is going
                          //   }else if ($value['notif_type']==1){

                          //   echo "
                
                          //       <tr class=''>
                          //               <td><a href=''>{$value['user_lastName']}  </a></td>
                          //               <td>
                          //                <span class='badge badge-pill text-white font-medium badge-success mr-2'>&nbsp;&nbsp;&nbsp;Going&nbsp;&nbsp;&nbsp;</span>
                          //               </td>
                          //               <td class='date'>{$result_date_only}</td>
                          //               <td>{$value['apt_title']}</td>
                          //               <td> <i class='fa fa-envelope btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i></td>
                          //               <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                          //       </tr>
                                
                          //   ";
                                  
                          //     //  is not going
                          //   }else if ($value['notif_type']==2){
                                 
                          //      if($value['notif_note']!=='none'){
                          //       echo "
                        
                          //       <tr class=''>
                          //          <td><a href=''>{$value['user_lastName']}</a></td>
                          //          <td>
                          //          <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Not Going</span>
                                 
                          //          </td>
                          //          <td class='date'>{$result_date_only}</td>
                          //          <td>{$value['apt_title']}</td>
                          //          <td> 
                                     
                          //          <i class='fa fa-envelope btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i>
                          //              <button class='btn btn-secondary btn-note' id='{$value['apt_ref_id']}s{$value['to_user_ref_id']}s{$value['from_user_ref_id']}'>Note</button>
                          //          </td>
                                   
                          //          <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                          //      </tr> 
                           
                          //     ";
                          //      }else{
                                  
                          //   echo "
                        
                          //   <tr class=''>
                          //      <td><a href=''>{$value['user_lastName']}</a></td>
                          //      <td>
                          //      <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Not Going</span>
                          //      </td>
                          //      <td class='date'>{$result_date_only}</td>
                          //      <td>{$value['apt_title']}</td>
                          //      <td>  <i class='fa fa-envelope btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i></td>
                          //      <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                          //  </tr> 
                       
                          // ";
                          //      }

                                  
                          //    }else if ($value['notif_type']==4){
                          //     echo "
                          
                          //          <tr class=''>
                          //             <td><a href=''>{$value['user_lastName']}</a></td>
                          //             <td>
                          //             <span class='badge badge-pill text-white font-medium badge-danger mr-2'>Cancelled</span>
                          //             </td>
                          //             <td class='date'>{$result_date_only}</td>
                          //             <td>{$value['apt_title']}</td>
                            
                          //             <td>  <i class='fa fa-envelope btn-view' aria-hidden='true' id='{$value['apt_ref_id']}'></i></td>

                                      
                          //             <td class='date'><i class='fa fa-paperclip'></i>&nbsp;{$result_date}</td>
                          //         </tr> 
                              
                          //        ";    
                              
                          //        }
                          // }

                ?>  
  
    </tbody>
  </table> -->
    </div> 
  </div>
</div>


<!-- modal -->
<div class="bs-example">
    '<div id="myModal" class="modal" tabindex="-1">
        '<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                	<h1 class="modal-title font-weight-bold">Title: &nbsp;</h1>
                    <h1 class="modal-title title" id="m_title"></h1>
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

                <!-- saka na beto -->
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Going</button>
                    <button type="button" class="btn btn-primary">Not Going</button>
                </div> -->
            </div>
        </div>
    </div>
</div>
 
	

  
    <!-- alerts plugin -->
    <script src="assets/js/jquery-confirm.min.js"></script>

    <script src="assets/js/moment.js"></script>
  
    <script>
      
        function loadXMLDoc() {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("link_wrapper").innerHTML =
              this.responseText;


              //dapat dito ko nilalagay
              

              $(".btn-goin").click(function(e){
                e.preventDefault();
                //alert($(this).attr('id'));

                var going_id =$(this).attr('id');

                $.ajax({
                    type: 'POST',
                  
                    url: './includes/user_action.inc.php',
                    data: {
                        'going_id':going_id
                    },
                    success: function(data) {
                      $.alert({
                                   title: 'Going!',
                                   content: "Going",
                         });
                    }
                });
    
            });


            $(".btn-not-goin").click(function(e){
              e.preventDefault();
              var not_going_id =$(this).attr('id');
                          $.confirm({
                                title: 'WHy or Set a sched',
                                content: '' +
                                '<form action="" class="formName">' +
                                '<div class="form-group">' +
                                '<label>Enter something here</label>' +
                                '<textarea id="w3review" " class="name form-control" rows="6" cols="50"> </textarea>' +
                                '</div>' +
                                '</form>',
                                buttons: {
                                    formSubmit: {
                                        text: 'Confirm',
                                        btnClass: 'btn-blue',
                                        action: function () {
                                            var note = this.$content.find('.name').val();
                                            if(note.trim()===''){
                                              note='none';
                                            }

                                          $.ajax({
                                                type: 'POST',
                                                
                                                url: './includes/user_action.inc.php',
                                                data: {
                                                    'not_going_id':not_going_id,
                                                    'note':note
                                                },
                                                success: function(data) {
                                                  $.alert({
                                                      title: 'Message Sent!',
                                                      content: 'Your message is sent',
                                                  });
                                                }
                                                });
                                        }
                                    },
                                    cancel: function () {
                                        //close
                                    },
                                },
                                onContentReady: function () {
                                    // bind to events
                                    var jc = this;
                                    this.$content.find('form').on('submit', function (e) {
                                        // if the user submits the form by pressing enter in the field.
                                        e.preventDefault();
                                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                                    });
                                }
                            });

             
    
            });

            // note

            $(".btn-note").click(function(){
         
           
                var  note_id =$(this).attr('id');
                $.ajax({
                    type: 'POST',
                    timeout: 500,
                    url: './includes/user_action.inc.php',
                    data: {
                        'note_id':note_id
                    },
                    success: function(data) {
                           $.dialog({
                            title: 'Text content!',
                            content: data,
                        });
                    }
                });
    
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
                              trHTML += '<tr><td><p class="font-italic lg"><img src="./uploads/profile/'+ item.user_profile_pic +'" alt="Avatar" style="width:30px;height:30px;border-radius: 50%;"> </i> <a href="profile.php?u='+ item.user_type + ''+ item.user_ref_id +'">' + item.user_lastName  +','+ item.user_firstName  + ' ' + item.user_middleName + '</td><td> </a>' + item.apt_status + '</td><td>' + responded_date+ '</p></td></tr>';
                                // trHTML += '<tr><td><i class="fas fa-user-circle"> ' + item.user_lastName  +','+ item.user_firstName  + ' ' + item.user_middleName + '</p></td><td>' + item.apt_status + '</td><td>' + item.date_responded + '</td></tr>';
                            });
                            $('#records_table').append(trHTML);
                        }
                      });

                 });

                
                  $("#icon-close").click(function(){
                    $("#myModal tr").detach();
                    $("#myModal").fadeOut();
                  });

            

            }
          };
          xhttp.open("GET", "includes/response_notif.php", true);
          xhttp.send();
        }

        $(document).ready(function(){

        setInterval(function(){
      	loadXMLDoc();
          // 1sec
        },1000);

                  

        });
    </script>
</body>
</html>
