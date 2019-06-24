<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$establo_id = $_POST['establo_id'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "SELECT * FROM ganado WHERE  estado_saca = False AND establo_id = ".$establo_id." ORDER BY ganado_id DESC;";	
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
				'v_padre' => $line['v_padre'],
				'v_madre' => $line['v_madre'],
				'rgp' => $line['rgp'],
				'rgm' => $line['rgm']
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