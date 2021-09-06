<?

require_once $_SERVER['DOCUMENT_ROOT']."/models/init.php";

if (isset($_POST['buttonEvent'])){

	$query = $base->query_($_POST['buttonEvent']);


	echo json_encode($query);
}