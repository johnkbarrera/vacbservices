<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];

	$ganado_id = $_POST['ganado_id'];
	$estado_vaca = $_POST['gr_estado_vaca'];
	$estado = $_POST['gr_estado'];
	$fecha_celo = $_POST['gr_fecha_celo'];
	$peso = $_POST['gr_peso'];



	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$temp = "false";
		if ($estado == "Si") {
			$temp = "true";
		}

		$sql =  "INSERT INTO public.reproduccion(estado_vaca, ultimo_celo, peso, estado, ganado_id)
				 VALUES ('".$estado_vaca."',  '".$fecha_celo."', ".$peso.", ".$temp.", ".$ganado_id.");";

		$executed = pg_query($conn, $sql);

		if ($executed) {
			$result["success"] = "1";
			$result["message"] = "Registro exitoso";
			echo json_encode($result);
			pg_close($conn);
		} else {
			$result["success"] = "0";
			$result["message"] = "Error en los Servicios";
			echo json_encode($result);
			pg_close($conn);
		}
	} else {
		$result["success"] = "0";
		$result["message"] = "Sesión no iniciada";

		echo json_encode($result);
		pg_close($conn);
	}


}

?>