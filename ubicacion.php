<?php
	class ubicacion{
		private $con;
		
		public function __construct()
		{
			try{
				//$this->con = new PDO('mysql:host=localhost;dbname=ventas','root','12345678');
				$this->con = new PDO('pgsql:host=localhost;dbname=mapa','postgres','12345');
			}catch(PDOException $e)
			{
				echo "Error: ".$e->getMessage();
			}
		}
		
		public function obtener()
		{
			try{
				$query = $this->con->prepare('select * from ubicacion');
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
				$query = $this->con->prepare('insert into ubicacion(latitud,longitud) values(?,?)');
				$query->bindParam(1,$latitud);
				$query->bindParam(2,$longitud);
				$query->execute();
				
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
		public function actualizar($id,$latitud,$longitud)
		{
			try{
				$query = $this->con->prepare('update ubicacion set latitud=?,longitud=? where id=?');
				$query->bindParam(1,$latitud);
				$query->bindParam(2,$longitud);
				$query->bindParam(4,$id);
				$query->execute();
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
		public function borrar($id)
		{
			try{
				$query = $this->con->prepare('delete from ubicacion where id=?');
				$query->bindParam(1,$id);
				$query->execute();
			}catch(PDOException $e){
				echo "Error: ".$e->getMessage();
			}
		}
	}
?>



