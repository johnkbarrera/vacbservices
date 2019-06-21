
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$password = $_POST['password'];
	//$password = password_hash($password, PASSWORD_DEFAULT);
	$password = sha1($password);
	$user = $email;

	require_once '../DAO/connection.php';

	// Verificamos si el correo ya fue registrado
	$exist_email = 0;
	$sql = "SELECT count(*) FROM usuario WHERE correo = '".$email."';";
	$executed0 = pg_query($conn, $sql);
	while ($line = pg_fetch_array($executed0, null, PGSQL_ASSOC)) {
		$exist_email = $line['count'];
	}

	if ($exist_email == 1) {

		$sql = "SELECT * FROM usuario WHERE usuario = '".$email."' AND contrasenia = '".$password."';";
		$executed = pg_query($conn, $sql);
		$data = array();

		if ($executed) {
			while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
		    	$data[] = array(
		    		'usuario_id' => $line['usuario_id'],
		    		'usuario' => $line['usuario'],
		    		'contrasenia' => $line['contrasenia'],
		    		'nombres' => $line['nombres'],
		    		'apellidos' => $line['apellidos'],
		    		'correo' => $line['correo'],
		    		'perfil' => $line['perfil'],
		    		'estado' => $line['estado'],
		    		'cod_conf' => $line['cod_conf']
		    	);  
		    }

		    if (count($data) == 0) {		    
		    	$result["success"] = "0";
				$result["message"] = "Contraseña errada";

				echo json_encode($result);
				pg_close($conn);
		    } else {		    
		    	$result["success"] = "1";
				$result["message"] = $data;

				echo json_encode($result);
				pg_close($conn);

		    }
	

		} else {

			$result["success"] = "0";
			$result["message"] = "error estrayendo usuario ";

			echo json_encode($result);
			pg_close($conn);
		}

	} else {
		
		$result["success"] = "0";
		$result["message"] = "Email no registrado";

		echo json_encode($result);
		pg_close($conn);
	}

}

?>