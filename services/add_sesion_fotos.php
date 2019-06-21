<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];
	$ganado_id = $_POST['ganado_id'];
	$fecha = $_POST['date'];
	$imagen_frontal = $_POST['foto_frontal'];
	$imagen_posterior = $_POST['foto_posterior'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = 	"INSERT INTO public.monitoreo(c_somaticas, prof_ubre, prof_corp, url_imagen_1, url_imagen_2, fecha, ganado_id)
				 VALUES (0,0,0,'".$imagen_frontal."', '".$imagen_posterior."', '".$fecha ."', ".$ganado_id.");";

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