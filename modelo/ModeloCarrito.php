 <?php
 class ModeloCarrito extends Modelo{
	public function __construct(){
		parent::__construct();
	}
	 
	function addCarrito($usuario,$producto,$total){
		$sql = "insert into carrito(usuario,producto) values('{$usuario}','{$producto}')";

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
		$sql = "delete from carrito where usuario='{$id}' and producto={$producto}";
		echo $sql;
		$this->conexion->query($sql);
		$this->conexion->close();
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
}

?> 