<?php 
        //////// session of admin
        session_start();
        $session_user_type =$_SESSION['user_type'];
        //$_SESSION['user_buEmail'];
        if (is_null( $_SESSION['user_ref_id'])){
            header("location: ../index.php");
        }else if($session_user_type!=='A'){
            header("location: ../index.php");
        }
        ///////////////// 
    ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

.chart-container {
	width:  80%;
	height: 480px;
	margin: 0 auto;
}

.pie-chart-container {
	width : 360px;
	height : 360px;
	float : left;
}




h1{
  color:white;
  margin-top: 2em;
}
p{
  color:white;
}

/******************************

Stati - minimal statistical cards

*******************************/
.stati{
  background: #fff;
  height: 6em;
  padding:1em;
  margin:1em 0; 
    -webkit-transition: margin 0.5s ease,box-shadow 0.5s ease; /* Safari */
    transition: margin 0.5s ease,box-shadow 0.5s ease; 

}
.stati:hover{ 
  margin-top:0.5em;  
  -moz-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
-webkit-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
}
.stati i{
  font-size:3.5em; 
} 
.stati div{
  width: calc(100% - 3.5em);
  display: block;
  float:right;
  text-align:right;
}
.stati div b {
  font-size:2.2em;
  width: 100%;
  padding-top:0px;
  margin-top:-0.2em;
  margin-bottom:-0.2em;
  display: block;
}
.stati div span {
  font-size:1em;
  width: 100%;
  color: rgb(0, 0, 0,0.8); !important;
  display: block;
}

.stati.left div{ 
  float:left;
  text-align:left;
}

.stati div span {
    font-size: 1em;
    width: 100%;
    color: #f1f1f1;
    display: block;
}
.stati.bg-turquoise { background: rgb(26, 188, 156); color:white;} 
.stati.bg-emerald { background: rgb(46, 204, 113); color:white;} 
.stati.bg-peter_river { background: rgb(52, 152, 219); color:white;} 
.stati.bg-amethyst { background: rgb(155, 89, 182); color:white;} 
.stati.bg-wet_asphalt { background: rgb(52, 73, 94); color:white;} 
.stati.bg-green_sea { background: rgb(22, 160, 133); color:white;} 
.stati.bg-nephritis { background: rgb(39, 174, 96); color:white;} 
.stati.bg-belize_hole { background: rgb(41, 128, 185); color:white;} 
.stati.bg-wisteria { background: rgb(142, 68, 173); color:white;} 
.stati.bg-midnight_blue { background: rgb(44, 62, 80); color:white;} 
.stati.bg-sun_flower { background: rgb(241, 196, 15); color:white;} 
.stati.bg-carrot { background: rgb(230, 126, 34); color:white;} 
.stati.bg-alizarin { background: rgb(231, 76, 60); color:white;} 
.stati.bg-clouds { background: rgb(236, 240, 241); color:white;} 
.stati.bg-concrete { background: rgb(149, 165, 166); color:white;} 
.stati.bg-orange { background: rgb(243, 156, 18); color:white;} 
.stati.bg-pumpkin { background: rgb(211, 84, 0); color:white;} 
.stati.bg-pomegranate { background: rgb(192, 57, 43); color:white;} 
.stati.bg-silver { background: rgb(189, 195, 199); color:white;} 
.stati.bg-asbestos { background: rgb(127, 140, 141); color:white;} 
  

.stati.turquoise { color: rgb(26, 188, 156); } 
.stati.emerald { color: rgb(46, 204, 113); } 
.stati.peter_river { color: rgb(52, 152, 219); } 
.stati.amethyst { color: rgb(155, 89, 182); } 
.stati.wet_asphalt { color: rgb(52, 73, 94); } 
.stati.green_sea { color: rgb(22, 160, 133); } 
.stati.nephritis { color: rgb(39, 174, 96); } 
.stati.belize_hole { color: rgb(41, 128, 185); } 
.stati.wisteria { color: rgb(142, 68, 173); } 
.stati.midnight_blue { color: rgb(44, 62, 80); } 
.stati.sun_flower { color: rgb(241, 196, 15); } 
.stati.carrot { color: rgb(230, 126, 34); } 
.stati.alizarin { color: rgb(231, 76, 60); } 
.stati.clouds { color: rgb(236, 240, 241); } 
.stati.concrete { color: rgb(149, 165, 166); } 
.stati.orange { color: rgb(243, 156, 18); } 
.stati.pumpkin { color: rgb(211, 84, 0); } 
.stati.pomegranate { color: rgb(192, 57, 43); } 
.stati.silver { color: rgb(189, 195, 199); } 
.stati.asbestos { color: rgb(127, 140, 141); } 


.greeting {
  font-weight: 900;
  font-size: 25pt;
  margin-left: 2vw;
  
}

#myDiv {
  
  font-size: 9pt;
  font-weight: 550;
  margin-left: 2.3vw;
}

</style>
</head>
<body>

 <?php include_once('includes/sidenav.php'); ?>
 <?php require_once ('../includes/func.inc.php'); ?>
 <?php require_once ('../includes/db.inc.php'); ?>


<div class="container">
  <br>
  <div class="row " >
      <h3  class="greeting"></h3><br>
     
  </div>

  <div class="row " >
  <p id="myDiv"></p>
  </div>
  
  <div class="row " >
    
    <div class="col ">
        <br><br>
       <h3><b id="status">Status<b></h3>
      <div class="col-md-12">
        <div class="stati bg-orange left">
        <i class="fa fa-pencil-square-o" style="font-size:36px"></i>
          <div>
            <b><?php  echo countUser($conn,1); ?></b>
            <span>Request</span>
          </div> 
        </div>
      </div>

      <div class="col-md-12">
        <div class="stati bg-peter_river left">
        <i class="fa fa-user" style="font-size:36px"></i>
          <div>
            <b><?php  echo countUser($conn,2); ?></b>
            <span>Total Users</span>
          </div> 
        </div>
      </div> 

      <div class="col-md-12  align-item-center">
      <div class="stati bg-concrete left">
       
          <div class="col-sm-3">
              <b><?php  echo countUser($conn,2); ?></b>
            <span>Students</span>
          </div>
          <div class="col-sm-3">
              <b><?php  echo countUser($conn,4); ?></b>
            <span>Teaching</span>
          </div>
          <div class="col-sm-3">
              <b><?php  echo countUser($conn,5); ?></b>
            <span>Non Teaching</span>
          </div>
          <div class="col-sm-3">
              <b><?php  echo countUser($conn,6); ?></b>
            <span>Visitors</span>
          </div>
        </div>
      </div> 

      <div class="col-md-12">
        <div class="stati bg-carrot left">
        <i class="fa fa-user" style="font-size:36px"></i>
          <div>
            <b><?php  echo countUser($conn,2); ?></b>
            <span>Total Users</span>
          </div> 
        </div>
      </div> 


    </div>
    <div class="col">
     
    <div class="chart-container">
		<div class="pie-chart-container">
			<canvas id="pie-chartcanvas-1"></canvas>
		</div>
    </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
        <div class="container bar">
            <canvas id="bar-chartcanvas"></canvas>
        </div>

    </div>
  </div>
</div>
















    <!--  -->


 

    

    
	<!-- javascript -->
  
    <script src="../vendor/chart_js/js/jquery.min.js"></script>
    <script src="../vendor/chart_js/js/Chart.min.js"></script>

   <script>
   showGraph();
   showPieGraph();
function showGraph()
        {
            {
                $.post("includes/bar.inc.php",
                function (data)
                {             

                            console.log(data);
                            var month = [];
                            var apts = [];

                            for (var i in data) {
                                month.push(data[i].archive_dt);
                                apts.push(data[i].apts);
                            }

                            var ctx = $("#bar-chartcanvas");
                            var data = {
                            labels : month,
                            datasets : [
                            
                                {
                                    label : month,
                                    data : apts,
                                    backgroundColor : [
                                        "rgba(50, 150, 250, 0.3)",
                                        "rgba(50, 150, 250, 0.3)",
                                        "rgba(50, 150, 250, 0.3)",
                                        "rgba(50, 150, 250, 0.3)",
                                        "rgba(50, 150, 250, 0.3)"
                                    ],
                                    borderColor : [
                                        "rgba(50, 150, 250, 1)",
                                        "rgba(50, 150, 250, 1)",
                                        "rgba(50, 150, 250, 1)",
                                        "rgba(50, 150, 250, 1)",
                                        "rgba(50, 150, 250, 1)"
                                    ],
                                    borderWidth : 1
                                }
                            ]
                            };

                        var options = {
                            title : {
                                display : true,
                                position : "top",
                                text : "Appointments Made per Month",
                                fontSize : 16,
                                fontColor : "#111"
                            },
                            legend : {
                                display : true,
                                position : "bottom"
                            },
                            scales : {
                                yAxes : [{
                                    ticks : {
                                        min : 0
                                    }
                                }]
                            }
                        };

                        var chart = new Chart( ctx, {
                            type : "bar",
                            data : data,
                            options : options
                        });


                });
            }
        }
       


        function showPieGraph()
        {
            {
                $.post("includes/pie.inc.php",
                function (data)
                {    
                            console.log(data);
                            var  apt_mode = [];
                            var no_mode = [];

                            for (var i in data) {

                            //     <option value="1">Online Meeting</option>
                          	// <option value="2">Outside Campus</option>
                          	// <option value="3"> Inside Campus</option>
                            // <option value="4"> Call</option>

                            if(data[i].apt_mode==1){
                                data[i].apt_mode = "Online Meeting";
                            }else if(data[i].apt_mode==2){
                                data[i].apt_mode = "Outside Campus";
                            }else if(data[i].apt_mode==3){
                                data[i].apt_mode = "Inside  Campus";
                            }else if(data[i].apt_mode==4){
                                data[i].apt_mode = "Via Call";
                            }else if(data[i].apt_mode==5){
                                data[i].apt_mode = "Visitor(Inside Campus)";
                            }

                                apt_mode.push(data[i].apt_mode);
                                no_mode.push(data[i].no_mode);
                            }         
                                             
                            var ctx1 = $("#pie-chartcanvas-1");
                            
                            var data1 = {
                                labels :apt_mode,
                                datasets : [
                                    {
                                        label : apt_mode,
                                        data : no_mode,
                                        backgroundColor : [
                                            "#F17720",
                                            "#FFA630",
                                            "#EBEBEB",
                                            "#00A7E1",
                                            "#0474BA"
                                        ],
                                        borderColor : [
                                            "#F17720",
                                            "#FFA630",
                                            "#EBEBEB",
                                            "#00A7E1",
                                            "#0474BA"
                                        ],
                                        borderWidth : [1, 1, 1, 1, 1]
                                    }
                                ]
                            };

                            // Vivid Tangelo: #F17720
                            // Deep Saffron: #FFA630
                            // Bright Gray: #EBEBEB
                            // Vivid Cerulean: #00A7E1
                            // French Blue: #0474BA
                            

                            var options = {
                                title : {
                                    display : true,
                                    position : "top",
                                    text : "Prefered Mode of Users",
                                    fontSize : 16,
                                    fontColor : "#111"
                                },
                                legend : {
                                    display : true,
                                    position : "bottom"
                                }
                            };


                            var chart1 = new Chart( ctx1, {
                                type : "pie",
                                data : data1,
                                options : options
                            });




                });
            }
        }


  var thehours = new Date().getHours();
	var themessage;
	var morning = ('Good morning Admin');
	var afternoon = ('Good afternoon Admin');
	var evening = ('Good evening Admin');

	if (thehours >= 0 && thehours < 12) {
		themessage = morning; 

	} else if (thehours >= 12 && thehours < 17) {
		themessage = afternoon;

	} else if (thehours >= 17 && thehours < 24) {
		themessage = evening;
	}

	$('.greeting').append(themessage);



  function showDateTime() {
  var myDiv = document.getElementById("myDiv");

  var date = new Date();
  var dayList = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  var monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  ];
  var dayName = dayList[date.getDay()];
  var monthName = monthNames[date.getMonth()];
  var today = `${dayName}, ${monthName} ${date.getDate()}, ${date.getFullYear()}`;

  var hour = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();

  var time = hour + ":" + min + ":" + sec;
  myDiv.innerText = `Today is  ${today}. Time is ${time}`;
}
setInterval(showDateTime, 1000);


</script>
</body>
</html>