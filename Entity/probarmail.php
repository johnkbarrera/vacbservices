<?php

	$emailamigo = "kevin-tk@hotmail.es";
	$asunto = "Codigo de confirmacion VacBs";
	$mensaje = "tu codigo de confirmacion es 123456";
	$tunombre = "VacBs";
	$tuemail = "no-reply@gmail.com";
	
	mail ($emailamigo, $asunto, $mensaje,"From:".$tunombre."<".$tuemail.">");

?>