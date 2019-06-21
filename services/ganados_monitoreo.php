<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganado_id = $_POST['ganado_id'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){


		$sql = "SELECT * FROM monitoreo WHERE ganado_id = ".$ganado_id." ORDER BY monitoreo_id DESC LIMIT 1;";	

		$executed = pg_query($conn, $sql);

	    $data = array();

	    while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
	    	$data[] = array(
				'monitoreo_id' => $line['monitoreo_id'],
				'c_somaticas' => $line['c_somaticas'],
				'prof_ubre' => $line['prof_ubre'],
				'prof_corp' => $line['prof_corp'],
				'fecha' => $line['fecha'],
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