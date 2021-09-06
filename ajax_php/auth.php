<?
require_once $_SERVER['DOCUMENT_ROOT']."/models/init.php";

if (isset($_POST['login']) && isset($_POST['pass'])){
	$out = $base->check_data($_POST['login'], $_POST['pass']);

	if ($out){
		session_start();
		$hash = md5(date(DATE_RFC822).$_POST['login']);

		$base->insert_hash(session_id(), $_POST['login']);

		echo json_encode( array('sucsess' => true) );
	}else{
		echo json_encode( array('sucsess' => false) );
	}

	
}