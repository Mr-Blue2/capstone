
<?php
require_once ('../../includes/db.inc.php');


$connect="mysql:host={$db_servername};dbname={$db_name}";

$connection = new PDO($connect , $db_username, $db_password );

function get_total_all_records($connection)
{
	$statement = $connection->prepare("SELECT * FROM  course ");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_user_records($conn,$id)
{
    $sql= "SELECT count( user_ref_id) as result from user as u JOIN course as c ON c.course_id=u.course_id WHERE u.user_type='S' and c.course_id=?;";

    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:db.inc.php?error=stmtfailed");
        exit();
    }
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $id= mysqli_fetch_assoc($result)['result'];
        return $id;
}


$query = '';
$output = array();
$query .= "SELECT * FROM course as c JOIN department_offices as d ON d.department_offices_id=c.department_offices_id 
WHERE c.course_active=1 ORDER BY d.do_type ASC,d.department_offices_desc ASC , c.course_desc ASC";


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
	
    $id=$row["course_id"];

    $sub_array[] = $row["department_offices_desc"];
    $sub_array[] = $row["course_short_desc"];
    $sub_array[] = $row["course_desc"];
   $sub_array[] = get_user_records($conn,$id);
   
    $sub_array[] = '<button type="button" name="update" id="'.$row["course_id"].'" class="btn btn-primary btn-sm update"><i class="glyphicon glyphicon-pencil">&nbsp;</i>Edit</button></button>';
	$sub_array[] = '<a  class="btn btn-danger btn-sm approve" href="includes/mini.action.php?course_delete='.$row["course_id"].'">Disable </a>';
	

	
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

