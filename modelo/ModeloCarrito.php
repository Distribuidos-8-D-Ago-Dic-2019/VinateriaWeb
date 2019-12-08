 <?php
 class ModeloCarrito extends Modelo{
	public function __construct(){
		parent::__construct();
	}
	 
	function addCarrito($usuario,$producto){
		$sql = "insert into carrito(usuario,producto) values('{$usuario}','{$producto}')";
		echo $sql;
		if($result=$this->conexion->query($sql)){
			echo 'Se agregó el producto al carrito correctamente';
		}else{
			$sql = "select *from carrito where producto= '{producto}'";
			if($this->conexion->query($sql)){
				echo 'El producto ya está en el carrito';
			}else{
			echo 'error';
			}
		}
		$this->conexion->close();
	}

	function deleteCarrito($id,$producto){
		$client = new SoapClient("http://localhost:8080/WebServer/WebService?wsdl");
		$respuesta = $client->deleteCarritobyProduct(array('user' => $id, 'product' => $producto));
		/*$sql = "SELECT id FROM carrito where usuario='{$id}' and producto={$producto} ORDER BY id DESC LIMIT 1";
		$result = $this->conexion->query($sql)->fetch_assoc();
		var_dump($result);
		$sql = "delete from carrito where id='{$result['id']}'";
		echo $sql;
		$this->conexion->query($sql);
		$this->conexion->close();*/
	}

	function getCarrito($usuario){
		$carrito = array();
		$sql = "SELECT producto.imagen, producto.nombre as producto, producto.precio, carrito.producto as clave_producto,  count(*) as cantidad FROM carrito inner join producto on carrito.producto = producto.id where usuario = '{$usuario}' group by producto";
		if($result = mysqli_query($this->conexion,$sql)){
			while ($obj = mysqli_fetch_array($result)){
				array_push(	$carrito, $obj);
			}
			mysqli_free_result($result);
		}
		$this->conexion->close();
		return $carrito;
	}

	function deleteAllCarrito($id){
		$client = new SoapClient("http://localhost:8080/WebServer/WebService?wsdl");
		$respuesta = $client->deleteCarrito(array('user' => $id));
		/*$sql = "delete from carrito where usuario='{$id}'";
		echo $sql;
		$this->conexion->query($sql);
		$this->conexion->close();*/
	}
}

?> 