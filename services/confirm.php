<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$password = $_POST['password'];
	$code = $_POST['code'];

	$password = sha1($password);

	require_once '../DAO/connection.php';

	//$hoy = getdate();
	//$detalle = "Ganadero creado ".$hoy;
	$detalle = "Ganadero creado ";

	// Verificamos si el correo ya fue registrado
	$exist_email = 0;
	$sql = "SELECT count(*) FROM usuario WHERE correo = '".$email."'";
	$executed0 = pg_query($conn, $sql);
	while ($line = pg_fetch_array($executed0, null, PGSQL_ASSOC)) {
		$exist_email = $line['count'];
	}


	if ($exist_email==1) {

		// ExTRAEMOS EN CODIGO DE LA BD
		$cod_conf = "";
		$sql = "SELECT cod_conf FROM usuario WHERE correo='".$email."'";
		$executed0 = pg_query($conn, $sql);
		while ($line = pg_fetch_array($executed0, null, PGSQL_ASSOC)) {
			$cod_conf = $line['cod_conf'];
		}

		// VERIFICAMOS SI EL CODIGO ES CORRECTO
		if ($code == $cod_conf) {

			// VALIDAMOS A EL USUARIO - modificamos estado
			$sql = "UPDATE public.usuario
					SET estado=true, cod_conf='000000'
				WHERE usuario = '".$email."' AND contrasenia = '".$password."' AND cod_conf = '".$code."';";
			$executed1 = pg_query($conn, $sql);

			// CREAMOS UN GANADERO
			if ($executed1){
				$sql = "INSERT INTO public.ganadero(usuario, detalle)
				 	 VALUES ('".$email."', '".$detalle."');";
				$executed2 = pg_query($conn, $sql);

				if ($executed2){
					$result["success"] = "1";
					$result["message"] = "Código verificado";

					echo json_encode($result);
					pg_close($conn);
				} else {
					$result["success"] = "0";
					$result["message"] = "No pudimos crear ganadero";
					echo json_encode($result);
					pg_close($conn);
				}

			} else {
				$result["success"] = "0";
				$result["message"] = "No pudimos actualizar el estado de usuario";
				echo json_encode($result);
				pg_close($conn);
			}

		} else {

			if ($cod_conf=="0") {
				$result["success"] = "0";
				$result["message"] = "El email ya fue confirmado!";
				
				echo json_encode($result);
				pg_close($conn);

			} else {
				$result["success"] = "0";
				$result["message"] = "Código incorrecto, ingrese otro código";
				
				echo json_encode($result);
				pg_close($conn);
			}
		}

	} else {
		$result["success"] = "0";
		$result["message"] = "Email no registrado";

		echo json_encode($result);
		pg_close($conn);
		
	}


	$result["success"] = "0";
	$result["message"] = "error rarito";

	echo json_encode($result);
}

?>