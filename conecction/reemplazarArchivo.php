<?php 
	require_once "conexion.php";
	require_once "metodosCrud.php";

	$obj = new metodos();

	//$ruta = '/home/iot\-client/app/data/94CC96C40A24';
	$ruta = '/home/miguelcar18/files';
	$carpeta = null;
	$arrayCarpetas = scandir($ruta);
	for($i = 0; $i < count($arrayCarpetas); $i++){

		/* 
			Si es la ultima carpera
			Normalmente esta ordenado del más antiguo al mas reciente
			asi que la última carpeta (la mas reciente) es donde se tomará los datos
		*/
		if($i == (count($arrayCarpetas) - 1)) {
			$carpeta = $arrayCarpetas[$i];
		}
	}

	$buscarCarpeta = $obj->buscarCarpeta($carpeta);
	$idCarpeta = null;
	if($buscarCarpeta === 0){
		//$from = '/home/iot-client/app/data/94CC96C40A24/'.$carpeta.'/data.txt';
		$from = '/home/miguelcar18/files/'.$carpeta.'/data.txt';
		$to = '/var/www/html/production/files/data.txt';

		//Ejecuto el comando para copiar los archivos de la carpeta from a to
		if(file_exists($to)){
			unlink($to);
		}
		copy($from, $to);
		//exec('copy "'.$from.'" "'.$to.'"');
		//$obj->truncarTabla();
		$insertarDatosCarpeta = $obj->insertarDatosCarpeta($carpeta);
		$idCarpeta = $obj->idCarpeta($carpeta);
	}
	$data = [];
	$data['carpeta'] = $carpeta;
	$data['contador'] = $buscarCarpeta;
	$data['idCarpeta'] = $idCarpeta;

	echo json_encode($data);
	
 ?>