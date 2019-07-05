<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];

	$nombre = $_POST['nombre'];
	$imagen = $_POST['data'];

	// despues de descargar el archivo en el terminal del admin 
	// sudo chmod -R 777 /var/www


	if ($sesion == "iniciado"){

		//  abri imagen y guardar, en una direccion

		$path = "/var/www/html/vacbservices/Imagenes";
		$file = $path."/".$nombre.".png";
		

		if (!file_exists($path)) {
		    mkdir($path, 0777, true);
		}

		if(file_put_contents($path, base64_decode($imagen))){

			$result["success"] = "1";
			$result["message"] = "Imagen guardada";

			echo json_encode($result);

		}
		//$bytesArchivo = file_get_contents($path);

		$result["success"] = "0";
		$result["message"] = "Imagen no guardada";

		echo json_encode($result);

	} else {
		$result["success"] = "0";
		$result["message"] = "Sesión no iniciada";

		echo json_encode($result);
	}
}

?>