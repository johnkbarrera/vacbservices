<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$ganadero_usuario = $_POST['ganadero_usuario'];
	$sesion = $_POST['sesion'];


	require_once '../DAO/connection.php';

	if ($sesion == "iniciado"){

		
		$sql = "SELECT * FROM ganadero WHERE usuario = '".$ganadero_usuario."';";
		// $sql = "SELECT * FROM ganadero WHERE usuario = 'johnkevinbarrera@gmail.com';";
		$executed = pg_query($conn, $sql);

	    $data = array();

	    while ($line = pg_fetch_array($executed, null, PGSQL_ASSOC)) {
	    	$data[] = array(
	    		'index' => $line['ganadero_id'],
	    		'usuario' => $line['usuario'],
	    		'detalle' => $line['detalle']
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