
<?php
require_once ('../../includes/db.inc.php');


$connect="mysql:host={$db_servername};dbname={$db_name}";

$connection = new PDO($connect , $db_username, $db_password );

function get_total_all_records($connection)
{
	$statement = $connection->prepare("SELECT * FROM  user");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

$query = '';
$output = array();
$query .= "SELECT * FROM user as u JOIN course as c ON u.course_id = c.course_id 
JOIN department_offices as d ON d.department_offices_id =c.department_offices_id
WHERE (u.verify_status=1  and u.user_accountStatus=0 )";



if(isset($_POST["search"]["value"]))
{
	$query .= 'AND (u.user_lastName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR  c.course_id LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR  u.user_buEmail LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR u.user_firstName LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR u.user_middleName LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY user_ref_id ASC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	
    if($row["user_type"]==='S'){
        $row["user_type"]='Student';
    }else if($row["user_type"]==='T'){
        $row["user_type"]='Teaching';
    }else if($row["user_type"]==='NT'){
        $row["user_type"]='Non Teaching';
    }
    
	if($row["user_gender"]=='m'){
        $row["user_gender"]='Male';
    }else if($row["user_gender"]=='f'){
        $row["user_gender"]='Female';
    }else if($row["user_type"]=='m'){
        $row["user_gender"]='Non b';
    }

	$sub_array[] = $row["user_type"];
	$sub_array[] = $row["department_offices__short_desc"];
   
    $sub_array[] = $row["course_short_desc"];
	$sub_array[] = $row["user_year"];
	$sub_array[] = $row["user_block"];
	$sub_array[] = $row["user_buId"];
    $sub_array[] = $row["user_lastName"];
	$sub_array[] = $row["user_firstName"];
	$sub_array[] = $row["user_middleName"];
    $sub_array[] = $row["user_buEmail"];
	$sub_array[] = $row["user_gender"];
	$sub_array[] = $row["user_contactNum"];

	$sub_array[] = '<a  class="btn btn-primary btn-sm approve" href="includes/mini.action.php?approve='.$row["user_ref_id"].'">Approve </a>';
	$sub_array[] ='<a href="../uploads/cor/'.$row["user_cor"].'" target="_blank" class="btn btn-warning btn-sm view">View Pic
    <img src="./uploads/cor/'.$row["user_cor"].'" alt=""
        style="width: 37rem;max-width: 100%;height: auto;vertical-align: 
        middle;border-style: none;">
	</a>';
	$sub_array[] = '<a  class="btn btn-danger btn-sm approve" href="includes/mini.action.php?not_approve='.$row["user_ref_id"].'">Not Approve </a>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records($connection),
	"data"				=>	$data
);
echo json_encode($output);

?>

