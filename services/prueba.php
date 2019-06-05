<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = password_hash($password, PASSWORD_DEFAULT);
	$user = $email;

	require_once 'connection.php';

	//generar aleatorio
	$cod_cof = "111111";

	$result["success"] = "1";
	$result["message"] = "success";

	
	echo json_encode($result);

}

?>