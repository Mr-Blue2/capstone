  <?php 
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "bupcass";
	$conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
    }		
    else{
      //echo "connected";
    }
    
	