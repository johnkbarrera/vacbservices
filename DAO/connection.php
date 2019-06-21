<?php

// $servidor = "172.22.3.169";
$servidor = "10.66.49.59";
$usuario="postgres";
$contrasenia="postgres";
// $base_datos="VACAS3";
$base_datos="vaca";
$puerto="5432";

//$conn = pg_connect($servidor, $puerto, "options", "tty", "dbname");

$conn = pg_connect('host='.$servidor.' port='.$puerto.' dbname='.$base_datos.' user='.$usuario.' password='.$contrasenia);

/*
if (!$conn) {
  echo "An error occurred.\n";
  exit;
} else {
  echo "Conexión exitosa.\n";
}

*/

?>