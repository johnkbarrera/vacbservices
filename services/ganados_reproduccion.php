<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganado_id = $_POST['ganado_id'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){


		$sql = "SELECT * FROM reproduccion WHERE ganado_id = ".$ganado_id." ORDER BY reproduccion_id DESC LIMIT 1;";	

		$executed = pg_query($conn, $sql);

	    $data = array();

	    while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
	    	$data[] = array(
				'reproduccion_id' => $line['reproduccion_id'],
				'estado_vaca' => $line['estado_vaca'],
				'ultimo_celo' => $line['ultimo_celo'],
				'peso' => $line['peso'],
				'estado' => $line['estado'],
	    		'ganado_id' => $line['ganado_id'],
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