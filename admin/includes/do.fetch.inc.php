
<?php
require_once ('../../includes/db.inc.php');


$connect="mysql:host={$db_servername};dbname={$db_name}";

$connection = new PDO($connect , $db_username, $db_password );

function get_total_all_records($connection)
{
	$statement = $connection->prepare("SELECT * FROM  department_offices ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

$query = '';
$output = array();
$query .= "SELECT * FROM `department_offices` WHERE do_active=1";


// if(isset($_POST["search"]["value"]))
// {
// 	$query .= 'AND department_offices_desc LIKE "%'.$_POST["search"]["value"].'%" ';
	
//    // $query .= 'OR department__offices_desc LIKE "%'.$_POST["search"]["value"].'%") ';
// }

// if(isset($_POST["order"]))
// {
// 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
// }
// else
// {
// 	$query .= 'ORDER BY  department_offices_id ASC ';
// }

// if($_POST["length"] != -1)
// {
// 	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	
    if($row["do_type"]==='o'){
        $row["do_type"]="Office";
    }else{
        $row["do_type"]="Department";
    }
    $sub_array[] = $row["do_type"];
    $sub_array[] = $row["department_offices__short_desc"];
    $sub_array[] = $row["department_offices_desc"];
    $sub_array[] = $row["do_counter"];
    $sub_array[] = $row["ass_user_ref_id"];
    
    $sub_array[] = '<button type="button" name="update" id="'.$row["department_offices_id"].'" class="btn btn-primary btn-sm update"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button></button>';
	$sub_array[] = '<a  class="btn btn-danger btn-sm approve" href="includes/mini.action.php?delete='.$row["department_offices_id"].'">Disable </a>';
	

	
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

