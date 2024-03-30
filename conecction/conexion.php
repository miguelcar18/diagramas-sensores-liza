<?php 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado 
	class conectar{
		/*
		private $servidor="localhost";
		private $usuario="root";
		private $bd="graficas";
		private $password="*MSC+001+cl*";
		*/
		private $servidor="localhost";
		private $usuario="root";
		private $bd="graficas";
		private $password="";
		
		public function conexion(){
			$conexion = mysqli_connect(
				$this->servidor, 
				$this->usuario, 
				$this->password, 
				$this->bd
			);
			return $conexion;
		}
	}
 ?>