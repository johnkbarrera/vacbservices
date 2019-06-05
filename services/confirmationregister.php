<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$password = $_POST['code'];
	//$password = password_hash($password, PASSWORD_DEFAULT);
	$password = sha1($password);
	$user = $email;

	require_once '../DAO/connection.php';

	//generar aleatorio
	$cod_conf = "123456";
	// Enviar email

	// Verificamos si el correo ya fue registrado


	$sql = "INSERT INTO usuario(usuario, contrasenia, correo, estado, cod_conf) 
			VALUES (
				'".$user."',
				'".$password."',
				'".$email."',
				false,
				'".$cod_conf."'
			)";

	$executed = pg_query($conn, $sql);

	if ($executed) {
		$result["success"] = "1";
		$result["message"] = "success";
		
		echo json_encode($result);
		pg_close($conn);

	} else {
		$result["success"] = "0";
		$result["message"] = "error";

		echo json_encode($result);
		pg_close($conn);

	}

}

?>