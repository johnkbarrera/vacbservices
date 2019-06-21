<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganado_id = $_POST['ganado_id'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "SELECT * FROM ganado WHERE ganado_id = ".$ganado_id.";";	
		//$sql = "SELECT * FROM ganado;";

		$executed = pg_query($conn, $sql);

	    $data = array();

	    while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
	    	$data[] = array(
	    		'ganado_id' => $line['ganado_id'],
				'nombre' => $line['nombre'],
				'registro' => $line['registro'],
				'raza' => $line['raza'],
				'procedencia' => $line['procedencia'],
				'dob' => $line['dob'],
				'pesodob' => $line['pesodob'],
				'rgm' => $line['rgm'],
				'rgp' => $line['rgp'],
				'v_madre' => $line['v_madre'],
				'v_padre' => $line['v_padre'],
				'saca_estado' => $line['estado_saca'],
				'saca_motivo' => $line['motivo_saca'],
				'saca_fecha' => $line['fecha_saca']
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