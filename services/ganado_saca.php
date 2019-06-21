<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];
	$ganado_id = $_POST['ganado_id'];
	$saca_motivo = $_POST['saca_motivo'];
	$saca_fecha = $_POST['saca_fecha'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "UPDATE ganado 
				SET estado_saca=true, motivo_saca='".$saca_motivo."', fecha_saca='".$saca_fecha."'
	            WHERE ganado_id = ".$ganado_id.";";

		$executed = pg_query($conn, $sql);

		if ($executed) {
			$result["success"] = "1";
			$result["message"] = "Eliminación exitosa";

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