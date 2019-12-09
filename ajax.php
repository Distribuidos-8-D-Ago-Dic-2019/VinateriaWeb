<?php
require_once 'config/config.php';
class Ajax {

	function __construct() {
		$this->conexion = new mysqli(SERVER, USER, PASS, DB);
		if ($this->conexion->connect_error) {
			die("Connection failed: " . $this->conexion->connect_error);
		}
		$this->conexionBanco = new mysqli(SERVER_BANCO, USER_BANCO, PASS_BANCO, DB_BANCO);
		if ($this->conexionBanco->connect_error) {
			die("Connection failed: " . $this->conexionbanco->connect_error);
		}
	}
	
	public function moverCarrito ($usuario) {
		$carrito = array();
		$sql = "SELECT producto, count(*) as cantidad FROM carrito where usuario = '{$usuario}' group by producto";
		if($result = mysqli_query($this->conexion,$sql)){
			while ($obj = mysqli_fetch_array($result)){
				array_push(	$carrito, $obj);
			}
		}
		foreach ($carrito as $key => $value) {
			$sql = "insert into historial (producto,cantidad,ticket) values({$value['producto']}, {$value['cantidad']},(select max(id) from compra))";
			$this->conexion->query($sql);
		}
	}

	public function agregarCarrito() {
		$usuario = $_POST['user'];
		$producto = $_POST['producto'];
		$client = new SoapClient("http://192.168.84.225:8080/WebServer/WebService?wsdl");
		$respuesta = $client->addCarrito(array('user' => $usuario, 'product' => $producto));
		/*$sql = "insert into carrito(usuario,producto) values('{$usuario}','{$producto}')";
		if($result=$this->conexion->query($sql)){
			echo 'Se agregó el producto al carrito correctamente';
		}else{
			echo 'error';
		}
		$this->conexion->close();*/
	}

	public function agregarCarrito2() {
		/*$usuario = $_POST['user'];
		$producto = $_POST['producto'];
		$client = new SoapClient("http://192.168.84.225:8080/WebServer/WebService?wsdl");
		$respuesta = $client->addCarrito(array('user' => $usuario, 'product' => $producto));*/
		$sql = "insert into carrito(usuario,producto) values('{$usuario}','{$producto}')";
		if($result=$this->conexion->query($sql)){
			echo 'Se agregó el producto al carrito correctamente';
		}else{
			echo 'error';
		}
		$this->conexion->close();
	}

	public function checarUsuario() {
		$usuario = $_POST['user'];
		$contrasena = $_POST['pass'];
		$sql = "select usuario from usuario where usuario='{$usuario}' and contrasena = '{$contrasena}'";
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			echo "ok";
		}else{
			echo "error";
		}
		$this->conexion->close();
	}

	public function checarDisponible() {
		$usuario = $_POST['user'];
		$sql = "select usuario from usuario where usuario='{$usuario}'";
		$result = $this->conexion->query($sql);
		if ($result->num_rows > 0) {
			echo "error";
		}else{
			echo "ok";
		}
		$this->conexion->close();
	}

	public function comprarCarrito() {
		$usuario = $_POST['user'];
		$total = $_POST['total'];
		$tarjeta = $_POST['tarjeta'];
		$this->conexion->begin_transaction();
		$this->conexionBanco->begin_transaction();
		try {
			$sql = "select saldo from tarjeta where tarjeta={$tarjeta}";
			$result = $this->conexionBanco->query($sql);
			if ($result->num_rows > 0) {
				$obj = mysqli_fetch_array($result);
			}else{
				throw new Exception('La tarjeta registrada no existe.');
			}

			if ($obj['saldo']<$total) {
				throw new Exception('El saldo de la tarjeta no es suficiente.');
			}

			$sql = "select producto, count(producto) as cantidad from carrito where usuario='{$usuario}' group by producto";
			$result = $this->conexion->query($sql);
			while ($obj = mysqli_fetch_array($result)){
				$sql = "select id, nombre, cantidad from producto where id={$obj['producto']}";
				$result1 = $this->conexion->query($sql);
				$obj1 = mysqli_fetch_array($result1);
				if ($obj1['cantidad']<$obj['cantidad']) {
					throw new Exception('No hay suficientes '.$obj1['nombre'].' en el inventario.');
				}else {
					$sql = "update producto set cantidad=cantidad-{$obj['cantidad']} where id={$obj['producto']}";
					$result1 = $this->conexion->query($sql);
				}
			}

			$sql = "update tarjeta set saldo=saldo-{$total} where tarjeta={$tarjeta}";
			$this->conexionBanco->query($sql);

			$sql = "update tarjeta set saldo=saldo+{$total} where tarjeta=1111444477778888";
			$this->conexionBanco->query($sql);

			
			$carrito = array();
			$sql = "SELECT producto, count(*) as cantidad FROM carrito where usuario = '{$usuario}' group by producto";
			if($result = mysqli_query($this->conexion,$sql)){
				while ($obj = mysqli_fetch_array($result)){
					array_push(	$carrito, $obj);
				}
			}
			foreach ($carrito as $key => $value) {
				$sql = "insert into historial (producto,cantidad,ticket) values({$value['producto']}, {$value['cantidad']},(select max(id) from compra))";
				$this->conexion->query($sql);
			}

			$sql = "delete from carrito where usuario='{$usuario}'";
			$this->conexion->query($sql);

			$sql = "insert into compra(usuario,fecha,total) values('$usuario',NOW(),$total)";
			if($result=$this->conexion->query($sql)){
				echo 'La compra se realizo correctamente';
			}

			$this->conexion->commit();
			$this->conexionBanco->commit();
			$this->conexion->close();
			$this->conexionBanco->close();
		} catch (Exception $e) {
			$this->conexion->rollback();
			$this->conexionBanco->rollback();
			echo $e->getMessage();
		}
	}

	public function checarTarjeta () {
		$cvv = $_POST['cvv'];
		$tarjeta = $_POST['card'];
		$sql = "select tarjeta from tarjeta where tarjeta={$tarjeta} and cvc={$cvv}";
		$result = $this->conexionBanco->query($sql);
		if ($result->num_rows > 0) {
			echo "ok";
		}else{
			echo "error";
		}
		$this->conexion->close();
	}

}
$ajax = new Ajax();
$ajax->{$_POST['funcion']}();
?>