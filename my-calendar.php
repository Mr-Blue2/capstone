

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='./vendor/calendar/main.css' rel='stylesheet' />
<script src='./vendor/calendar/main.js'></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

 <!-- -alert plugin -->
 <link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />

<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
   
    background: white;
  }
  .to{
    color:#000; 
  }
  .to:hover{
     color: red;
  }
  .badge{
    height: 20px;
   
   
  }

  .badge-group span{
    font-size: 1em;
    color: #fff;
  }

  @media only screen and (max-device-width: 480px) {
    .fc .fc-toolbar-title {
        font-size: .8em;
        margin: 0;
    }
    #banner {
      font: 0.8em sans-serif;
    }
    

    .badge{
    height: 15px;
   
   
  }

  .badge-group span{
    font-size: 0.5em;
    color: #fff;
  }

  }
    


</style>
</head>
<body>

    <?php
      include('includes/sidenav.php');
    ?>
    
  <br><br><br>
  <h1 id="banner" align="center" style="font-weight: bold;">BUPC A.S.S. Calendar</h1><br>
    <center>
    <div class="badge-group" >
    <span class="badge badge-pill badge-success">Success</span>
    <span class="badge badge-pill badge-danger">Cancelled</span>
    <span class="badge badge-pill badge-warning">Pending</span>
    </div>

    </center>
  

  <br>
  <!-- actual calendar -->
  <div id='calendar'></div>
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
 
  
  
</body>
<!-- <script src="assets/js/jquery-3.6.0.min.js"> </script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 

 <!-- token field -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

  <!-- alerts plugin -->
  <script src="assets/js/jquery-confirm.min.js"></script>

  <!-- alerts plugin -->
  <script src="assets/js/moment.js"></script>




<script>

    document.addEventListener('DOMContentLoaded', function() {

          $("#icon-close").click(function(){
                    $("#myModal tr").detach();
                    $("#myModal").fadeOut();
           });
         

        
    var calendarEl = document.getElementById('calendar');


            var calendar = new FullCalendar.Calendar(calendarEl, {
              timeZone: 'Asia/Manila',
              nowIndicator:true,
           
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
                },

               

    //    date clicked

    dateClick: function(info) {
      // alert('Clicked on: ' + info.dateStr);
      var prev  = Date.parse(info.dateStr);
      var today = Date.parse($.datepicker.formatDate('yy-mm-dd', new Date()));

     if(prev < today){
         $.alert({
            title: 'Alert!',
            content: 'You cant create appt ',
        });
     }else{
      $('.create_apt').fadeIn();

      if(info.dateStr.length==10){
        $('#schedule_date').val(info.dateStr);
        $('#start_time').val('');
      }else{
        $('#schedule_date').val(info.dateStr.slice(0,10));
        $('#start_time').val(info.dateStr.slice(11,16));
      }

     }

       
            

         
      
        
        // alert('Current view: ' + info.view.type);
    },
   

   // eventClick
    eventClick: function(info) {
                   var view_id= info.event.id;
        $.ajax({
                    type: 'POST',
                    timeout: 5000,
                    url: './includes/user_action.inc.php',
                    dataType: 'JSON',
                    data: {
                        'view_id':view_id
                    },
                    // success: function(response) { 

                    //         // array length

                    //         function count(array){
                    //               var c = 0;
                    //               for(i in array) // in returns key, not object
                    //                   if(array[i] != undefined)
                    //                       c++;
                    //               return c;
                    //           }
        
                    //       var total = count(response);
                    //       part_arr =[];

                    //         for(var i=0;i<total;i++){
                    //           var last_name = response[i].user_lastName,
                    //               first_name = response[i].user_firstName,
                    //               middle_name= response[i].user_middleName; 
                    //               status=response[i].apt_status;

                    //               var participants= last_name + ", " + first_name + " " + middle_name + ": " +status + "<br>";      
                    //               part_arr.push(participants);
                              
                    //         }
                        

                    //         $.dialog({
                    //             columnClass: 'col-md-8',
                    //             type: 'blue',
                    //             title: info.event.title + "<br>" +  "<p>" + info.event.start + "</p>" ,
                    //             content: info.event.extendedProps.details + "<br>" +part_arr.join(''),
                    //         });
                      
                    // }
                  
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
                                trHTML += '<tr><td><p class="font-italic lg"><img src="./uploads/profile/'+ item.user_profile_pic +'" alt="Avatar" style="width:30px;height:30px;border-radius: 50%;"> <a class="to" href="profile.php?u='+ item.user_type + ''+ item.user_ref_id +'">' + item.user_lastName  +','+ item.user_firstName  + ' ' + item.user_middleName + '</td><td> </a>' + item.apt_status + '</td><td>' + responded_date+ '</p></td></tr>';
                                // trHTML += '<tr><td><i class="fas fa-user-circle"> ' + item.user_lastName  +','+ item.user_firstName  + ' ' + item.user_middleName + '</p></td><td>' + item.apt_status + '</td><td>' + item.date_responded + '</td></tr>';
                            });
                            $('#records_table').append(trHTML);
                        }
                });
    // alert(info.event.extendedProps.details);
    // alert('Event: ' + info.event.title);
    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
    // alert('View: ' + info.view.type);
  
    // change the border color just for fun
    info.el.style.borderColor = 'red';
  },
        //tooltip not working

       // initialDate: '2020-09-12',
        navLinks: true, // can click day/week names to navigate views
        //businessHours: true, // display business hours
        editable: true,
        selectable: false,
      
       
        events: 'includes/calendar_action.inc.php',
        
        nowIndicator:true,
        height:'auto',
        
    });

    

    
   calendar.render();



    setInterval(function(){
      calendar.refetchEvents();
   },1000);
  
    });

</script>

</html>
