<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];

	$nombre = $_POST['nombre'];
	$imagen = $_POST['data'];


	if ($sesion == "iniciado"){

		//  abri imagen y guardar, en una direccion

		$path = "../Imagenes/".$nombre.".png";

		$path = "/home/administrator/Imágenes/vacbs/".$nombre.".png";
		

		file_put_contents($path, base64_decode($imagen));
		//$bytesArchivo = file_get_contents($path);


		$result["success"] = "1";
		$result["message"] = "Imagen guardada";

		echo json_encode($result);

	} else {
		$result["success"] = "0";
		$result["message"] = "Sesión no iniciada";

		echo json_encode($result);
	}
}

?>