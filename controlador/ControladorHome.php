<?php
class Home extends Controlador{
	function __construct() {
		parent::__construct();
		$this->setHeader();
		$this->setFooter();
		$this->setModelo("Producto");
	}

	function index() {
		if (!isset($_POST['buscar'])) {
			$this->productos = $this->modelo->getProductos();
			$this->setVista("Home/index");
		}else {
			$this->productos = $this->modelo->searchProductos($_POST['buscar']);
			$this->setVista("Home/buscar");
		}
		$this->setJs("home");
	}
}
?>