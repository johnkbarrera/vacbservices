<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganadero_id = $_POST['ganadero_id'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		$sql = "SELECT * FROM establo WHERE ganadero_id = ".$ganadero_id." ;";	
		$executed = pg_query($conn, $sql);

	    $data = array();

	    while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
	    	$data[] = array(
	    		'establo_id' => $line['establo_id'],
				'nombre' => $line['nombre'],
				'detalle' => $line['detalle'],
				'pais' => $line['pais'],
				'region' => $line['region'],
				'ciudad' => $line['ciudad'],
				'comuna' => $line['comuna'],
				'latitud' => $line['latitud'],
				'longitud' => $line['longitud'],
				'altitud' => $line['altitud']
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