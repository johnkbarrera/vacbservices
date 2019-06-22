<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];
	$ganado_id = $_POST['ganado_id'];

	$gpr_fecha = $_POST['gpr_fecha'];
	$gpr_hora = $_POST['gpr_hora'];
	$gpr_litros = $_POST['gpr_litros'];
	$gpr_solidos = $_POST['gpr_solidos'];
	$gpr_csomaticas = $_POST['gpr_c_somaticas'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "INSERT INTO public.produccion(fecha, hora, litros_leche, solidos, c_somaticas, estado_prod, ganado_id)
				VALUES ('".$gpr_fecha."', '".$gpr_hora."', ".$gpr_litros.", ".$gpr_solidos.",  ".$gpr_csomaticas.", 'Normal', ".$ganado_id.");";

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