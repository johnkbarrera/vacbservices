<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$password = $_POST['password'];
	//$password = password_hash($password, PASSWORD_DEFAULT);
	$password = sha1($password);
	$user = $email;

	require_once '../DAO/connection.php';

	//generar aleatorio
	$cod_conf = "123456";
	// Enviar email

	// Verificamos si el correo ya fue registrado
	$exist_email = 0;
	$sql = "SELECT count(*) FROM usuario WHERE correo = '".$email."'";
	$executed0 = pg_query($conn, $sql);
	while ($line = pg_fetch_array($executed0, null, PGSQL_ASSOC)) {
		$exist_email = $line['count'];
	}

	// GENERAMOS NUMERO ALEATORIO
	$cod_conf = "123456";
	// EnNVIAMOS EMAIL DE COFIRMACIÓN

	if ($exist_email==0) {
		// REGITRAMOS EL USUARIO - AUN NO ESTA CONFIRMADO
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
			$result["message"] = "Error registrado usuario";

			echo json_encode($result);
			pg_close($conn);
		}
	} else {
		$result["success"] = "0";
		$result["message"] = "Email ya registrado";

		echo json_encode($result);
		pg_close($conn);
		
	}

}

?>