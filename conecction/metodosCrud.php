<?php 
/*
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
*/

	class metodos{
		public function mostrarDatos($sql){
			$c = new conectar();
			$conexion = $c->conexion();
			$result = mysqli_query($conexion, $sql);
			return mysqli_fetch_all($result, MYSQLI_ASSOC);
		}

		public function insertarDatos($datos){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql = "INSERT INTO data_graficas (`index`, `ejex`, `ejey`, `ejez`, `voltaje`, `furier`, `idCarpeta`) 
				values ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]')";
			return $result = mysqli_query($conexion, $sql)  or die(mysqli_error($conexion));
		}

		public function truncarTabla(){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql = "TRUNCATE TABLE data_graficas";
			return $result = mysqli_query($conexion, $sql)  or die(mysqli_error($conexion));
		}

		public function insertarDatosCarpeta($carpeta){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql = "INSERT INTO carpetas (`nombre`) 
				values ('$carpeta')";
			return $result = mysqli_query($conexion, $sql)  or die(mysqli_error($conexion));
		}

		public function buscarCarpeta($carpeta){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql = "SELECT * FROM carpetas WHERE nombre = '$carpeta'";
			$result = mysqli_query($conexion, $sql)  or die(mysqli_error($conexion));
			return  mysqli_num_rows($result);
		}

		public function idCarpeta($carpeta){
			$c = new conectar();
			$conexion = $c->conexion();
			$sql = "SELECT * FROM carpetas WHERE nombre = '$carpeta'";
			$result = mysqli_query($conexion, $sql)  or die(mysqli_error($conexion));
			$row = mysqli_fetch_array($result);
			return  $row[0];
		}
	}
 ?>