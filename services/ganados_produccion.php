<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganado_id = $_POST['ganado_id'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "SELECT * FROM produccion WHERE ganado_id = ".$ganado_id." ORDER BY produccion_id DESC ;";

		$executed = pg_query($conn, $sql);

	    $data = array();

	    while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
	    	$data[] = array(
	    		'produccion_id' => $line['produccion_id'],
				'litros_leche' => $line['litros_leche'],
				'solidos' => $line['solidos'],
				'c_somaticas' => $line['c_somaticas'],
				'estado_prod' => $line['estado_prod'],
				'fecha' => $line['fecha'],
				'hora' => $line['hora'],
			);  
	    }

	    $result["success"] = "1";
		$result["message"] = $data;

		echo json_encode($result);
		pg_close($conn);

	} else {
		$result["success"] = "0";
		$result["message"] = "Sesión no iniciada";

		echo json_encode($result);
		pg_close($conn);
	}


}

?>