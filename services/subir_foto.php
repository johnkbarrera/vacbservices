<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$sesion = $_POST['sesion'];

	$nombre = $_POST['nombre'];
	$imagen = $_POST['data'];


	if ($sesion == "iniciado"){

		//  abri imagen y guardar, en una direccion

		$path = "/home/administrator/Imágenes/vacas/".$nombre.".png";

		$path = "../Imagenes/".$nombre.".png";
		
		$imagen_file = base64_decode($imagen)

		if(base64_encode(base64_decode($imagen)) === $imagen){

			file_put_contents($path, $imagen_file)

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