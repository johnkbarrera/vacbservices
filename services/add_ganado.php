<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$establo_id = $_POST['establo_id'];
	$sesion = $_POST['sesion'];

	$nombre = $_POST['nombre'];
	$registro = $_POST['registro'];
	$raza = $_POST['raza'];
	$procedencia = $_POST['procedencia'];
	$dob = $_POST['dob'];
	$peso_dob = $_POST['peso_dob'];
	$rgm = $_POST['rgm'];
	$rgp = $_POST['rgp'];
	$v_madre = $_POST['v_madre'];
	$v_padre = $_POST['v_padre'];

	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "INSERT INTO ganado(nombre, registro, raza, procedencia, dob, pesodob, rgm, rgp, v_madre, v_padre, establo_id, estado_saca)
				VALUES ('".$nombre."', '".$registro."', '".$raza."', '".$procedencia."', '".$dob."',".$peso_dob.", '".$rgm."', '".$rgp."', '".$v_madre."', '".$v_padre."', ".$establo_id.", false);";

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