<?php
	class ubicacion{
		private $con;
		
		public function __construct()
		{
			try{
				//$this->con = new PDO('mysql:host=localhost;dbname=ventas','root','12345678');
				$this->con = new PDO('pgsql:host=localhost;dbname=ubicaciones','postgres','12345');
			}catch(PDOException $e)
			{
				echo "Error: ".$e->getMessage();
			}
		}
		
		public function obtener()
		{
			try{
				$query = $this->con->prepare('select * from mapas');
				$query->execute();
				return $query->fetchAll();
				
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
		public function insertar($latitud,$longitud)
		{
			try{
				//$query = $this->con->prepare('insert into personas value(null,?,?,?)');
				$query = $this->con->prepare('insert into mapas(nombre,direccion,lat,lng,tipo) values(?,?,?,?,?)');
				$query->bindParam(1,$nombre);
				$query->bindParam(2,$direccion);
				$query->bindParam(3,$lat);
				$query->bindParam(4,$lng);
				$query->bindParam(5,$tipo);
				$query->execute();
				
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
		public function actualizar($id,$latitud,$longitud)
		{
			try{
				$query = $this->con->prepare('update mapas set nombre=?,direccion=?,lat=?,lng=?,tipo=? where id=?');
				$query->bindParam(1,$nombre);
				$query->bindParam(2,$direccion);
				$query->bindParam(3,$lat);
				$query->bindParam(4,$lng);
				$query->bindParam(5,$tipo);
				$query->bindParam(4,$id);
				$query->execute();
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
		public function borrar($id)
		{
			try{
				$query = $this->con->prepare('delete from mapas where id=?');
				$query->bindParam(1,$id);
				$query->execute();
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
	}
?>



