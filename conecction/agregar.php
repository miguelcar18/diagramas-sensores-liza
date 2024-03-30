<?php

	/*
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado 
	*/

	require_once "conexion.php";
	require_once "metodosCrud.php";

	$X_AXIS 		= $_POST['X_AXIS'];
	$Y_AXIS 		= $_POST['Y_AXIS'];
	$Z_AXIS 		= $_POST['Z_AXIS'];
	$BATTERY_VOLTS 	= $_POST['BATTERY_VOLTS'];
	$ENE 			= $_POST['ENE'];
	$F 				= $_POST['F'];
	$IDCARPETA 		= $_POST['IDCARPETA'];

	$datos = [$ENE, $X_AXIS, $Y_AXIS, $Z_AXIS, $BATTERY_VOLTS, $F, $IDCARPETA];
	$obj = new metodos();
	echo json_encode($obj->insertarDatos($datos));
 ?>