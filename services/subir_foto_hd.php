<?php
  
$target_dir = "/var/www/html/vacbservices/Imagenes/";

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}


$target_file_name = $target_dir .basename($_FILES["file"]["name"]);
$response = array();
 
// Check if image file is a actual image or fake image
if (isset($_FILES["file"])) 
{
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name)) 
 {
  $success = 1;
  $message = "Imagen guardada";
 }
 else
 {
  $success = 0;
  $message = "Error mientras subiamos la imagen";
 }
}
else
{
 $success = 0;
 $message = "Archivo no encontrado";
}
 
$response["success"] = $success;
$response["message"] = $message;

echo json_encode($response);
 
?>