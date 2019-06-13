<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganadero_id = $_POST['ganadero_id'];
	$sesion = $_POST['sesion'];

	$nombre = $_POST['nombre'];
	$detalle = $_POST['detalle'];
	$pais = $_POST['pais'];
	$region = $_POST['region'];
	$ciudad = $_POST['ciudad'];
	$comuna = $_POST['comuna'];
	$latitud = $_POST['latitud'];
	$longitud = $_POST['longitud'];
	$altitud = $_POST['altitud'];


	//require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		/*$sql = "SELECT * FROM establo WHERE ganadero_id = ".$ganadero_id.";";	
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
	    }*/

	    $result["success"] = "1";
		// $result["message"] = $data;
		$result["message"] = " ".$nombre."\n ".
							 $detalle ."\n".
							 $pais ."\n".
							 $region ."\n".
							 $ciudad."\n".
							 $comuna ."\n".
							 $latitud ."\n".
					 		 $longitud ."\n".
							 $altitud;

		//$result["message"] = "mensaje de exito";


		echo json_encode($result);
		//pg_close($conn);

	} else {
		$result["success"] = "0";
		$result["message"] = "Sesión no iniciada";

		echo json_encode($result);
		//pg_close($conn);
	}


}

?>