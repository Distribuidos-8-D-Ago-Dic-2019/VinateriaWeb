<?php
class Carrito extends Controlador{
	function __construct() {
		parent::__construct();
		$this->setModelo("Carrito");
	}

	function index() {
		$this->setHeader();
		$this->setFooter();
		$this->setJs("carrito");
		$this->productos = $this->modelo->getCarrito($_SESSION['user']);
		$this->setVista("Carrito/index");
	}

	function insertarCarrito(){
		$this->modelo->addCarrito($_SESSION['user'],$_POST['producto']);
		header("Location: ".URL."home");
	}

	function eliminarCarrito(){
		$this->modelo->deleteCarrito($_SESSION['user'],$_POST['producto']);
		header("Location: ".URL."carrito");
	}
}
?>