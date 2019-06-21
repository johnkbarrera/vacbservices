<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganadero_usuario = $_POST['ganadero_usuario'];
	$sesion = $_POST['sesion'];

	$nombre = $_POST['nombre'];
	$detalle = $_POST['detalle'];
	$pais = $_POST['pais'];
	$region = $_POST['region'];
	$ciudad = $_POST['ciudad'];
	$comuna = $_POST['comuna'];
	$latitud = $_POST['latitud'];
	$longitud = $_POST['longitud'];
	$altitud = $_POST['altitud'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "INSERT INTO establo(nombre, detalle, pais, region, ciudad, comuna, latitud, longitud, altitud, ganadero_id)
				VALUES ('".$nombre."', '".$detalle."', '".$pais."', '".$region."', '".$ciudad."', '".$comuna."', ".$latitud.", ".$longitud.", ".$altitud.", 
						(SELECT ganadero_id FROM ganadero WHERE ganadero.usuario = '".$ganadero_usuario."'));";

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