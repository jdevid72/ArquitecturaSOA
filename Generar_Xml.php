<?php
$host = "127.0.0.1";
$dbname = "ubicaciones";
$user = "postgres";
$pass = "12345";
$con = pg_connect("host = $host dbname = $dbname user = $user password = $pass");
if($con){}
	else{
		echo "conexion fallida.....";
	}
	$query = "SELECT * FROM mapas ORDER BY id";
	$res = pg_query($query);
	echo ("<ubicaciones>");
	while ($data = pg_fetch_assoc($res)) {
		echo ("mapas");
		     echo ("<id>".$data['id']."</id>");
		     echo ("<nombre>".$data['nombre']."</nombre>");
		     echo ("<direccion>".$data['direccion']."</direccion>");
		     echo ("<lat>".$data['lat']."</lat>");
		     echo ("<lng>".$data['lng']."</lng>");
		     echo ("<tipo>".$data['tipo']."</tipo>");
		echo ("</mapas>");
	}
	echo ("</ubicaciones>");
	pg_close();
?>