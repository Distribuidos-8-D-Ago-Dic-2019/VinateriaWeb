<?php
class Producto extends Controlador{
	function __construct() {
		parent::__construct();
		$this->setModelo("Producto");
		$this->setHeader();
		$this->setFooter();
		$this->setJs("home");
	}

	function index() {
		$producto = $this->modelo->getProducto($_POST['id']);
		
		$this->setVista("Producto/index");
	}
}
?>

