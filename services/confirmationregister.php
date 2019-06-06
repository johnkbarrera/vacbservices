<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$email = $_POST['email'];
	$code = $_POST['code'];

	require_once '../DAO/connection.php';


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
				WHERE correo='".$email."';";
		$executed1 = pg_query($conn, $sql);

		// CREAMOS UN GANADERO
		if ($executed1){
			$sql = "INSERT INTO public.ganadero(usuario, detalle)
				VALUES ('".$email."', 'detalle');";
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

	} else {2
		$result["success"] = "0";
		$result["message"] = "Código incorrecto, ingrese otro código";
		
		echo json_encode($result);
		pg_close($conn);

	}

}

?>