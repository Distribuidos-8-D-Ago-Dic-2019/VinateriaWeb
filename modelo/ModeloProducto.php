<?php
 class ModeloProducto extends Modelo
 {
	public function __construct()
	{
		parent::__construct();
	}


	function getProducto($id) {
		$respuesta = $this->jax->getProductobyId(array('id' => $id));
		$producto = $respuesta->return;
		return $producto;
		/*$sql = "SELECT id, nombre, descripcion, precio, contenido, imagen, cantidad FROM producto where id= '".$id."'";
		$result = $this->conexion->query($sql)->fetch_object();
		$this->conexion->close();
		return $result;*/
	}

	function getProductos() {
		$respuesta = $this->jax->getAllProductos();
		$productos = $respuesta->return;
		/*$sql = "SELECT id, nombre, descripcion, precio, contenido, imagen, cantidad FROM producto where cantidad>0";
		if($result = mysqli_query($this->conexion,$sql)){
			while ($obj =  mysqli_fetch_array($result)){
				array_push(	$productos, $obj);
			}
			mysqli_free_result($result);
		} else {
			return null;
		}*/
		return $productos;
	}

	function searchProductos($busqueda) {
		$respuesta = $this->jax->getProductosbyName(array('like' => $busqueda));
		if (isset($respuesta->return)) {
			$productos = $respuesta->return;
		}else {
			$productos = array();
			$sql = "SELECT id, nombre, descripcion, precio, contenido, imagen, cantidad FROM producto where nombre like '".$busqueda."%' and cantidad>0";
			if($result = mysqli_query($this->conexion,$sql)){
				while ($obj = mysqli_fetch_array($result)){
					array_push(	$productos, $obj);
				}
				mysqli_free_result($result);
			}
			$this->conexion->close();
		}
		/*$productos = array();
		$sql = "SELECT id, nombre, descripcion, precio, contenido, imagen, cantidad FROM producto where nombre like '".$busqueda."%' and cantidad>0";
		if($result = mysqli_query($this->conexion,$sql)){
			while ($obj = mysqli_fetch_array($result)){
				array_push(	$productos, $obj);
			}
			mysqli_free_result($result);
		}
		$this->conexion->close();*/
		return $productos;
	}
}
?>