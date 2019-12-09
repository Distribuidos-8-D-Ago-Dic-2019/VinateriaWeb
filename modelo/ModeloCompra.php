 <?php
 class ModeloCompra extends Modelo{
	public function __construct(){
		parent::__construct();
	}
	
	function addCompra($usuario,$total){
		$sql = "insert into compra(usuario,fecha,total) values('$usuario',NOW(),$total)";
		$this->conexionLog->query('INSERT INTO LOG (query, date) VALUES ("'.$sql.'", NOW())');

		echo $sql;
		if($result=$this->conexion->query($sql)){
			echo 'Se agregó el producto al carrito correctamente';
		}else{
			echo 'error';
		}
		$this->conexion->close();
	}

	function getCompras($usuario){
		$compra = array();
		$sql = "SELECT producto.imagen, producto.nombre as producto, producto.precio, historial.cantidad FROM historial RIGHT join compra on compra.id = historial.ticket inner join producto on historial.producto = producto.id where usuario = '{$usuario}'";
		if ($result = $this->conexion->query($sql)) {
			while ($obj = mysqli_fetch_array($result)){
				array_push(	$compra, $obj);
			}
			mysqli_free_result($result);
			return $compra;
		}else{
			return null;
		}
	}
}

?> 