<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];
	$ganado_id = $_POST['ganado_id'];
	$gpr_litros = $_POST['gpr_litros'];
	$gpr_fecha = $_POST['gpr_fecha'];
	$gpr_peso = $_POST['gpr_peso'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){


		$sql = "INSERT INTO public.produccion(litros_leche, solidos, estado_prod, fecha, peso, ganado_id)
				VALUES (".$gpr_litros.", 0, 'SI', '".$gpr_fecha."', ".$gpr_peso.", ".$ganado_id.");";

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