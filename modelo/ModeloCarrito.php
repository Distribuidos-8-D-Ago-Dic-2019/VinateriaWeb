 <?php
 class ModeloCarrito extends Modelo{
	public function __construct(){
		parent::__construct();
	}

	function deleteCarrito($id,$producto){
		$respuesta = $this->jax->deleteCarritobyProduct(array('user' => $id, 'product' => $producto));
		/*$sql = "SELECT id FROM carrito where usuario='{$id}' and producto={$producto} ORDER BY id DESC LIMIT 1";
		$result = $this->conexion->query($sql)->fetch_assoc();
		var_dump($result);
		$sql = "delete from carrito where id='{$result['id']}'";
		echo $sql;
		$this->conexion->query($sql);
		$this->conexion->close();*/
	}

	function getCarrito($usuario){
		/*$client = new SoapClient("http://localhost:8080/WebServer/WebService?wsdl");
		$respuesta = $client->getCarrito(array('user' => $usuario));
		$carrito = $respuesta->return;*/
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
		$respuesta = $this->jax->deleteCarrito(array('user' => $id));
		/*$sql = "delete from carrito where usuario='{$id}'";
		echo $sql;
		$this->conexion->query($sql);
		$this->conexion->close();*/
	}
}

?> 