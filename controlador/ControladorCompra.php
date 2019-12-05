<?php
class Compra extends Controlador{
	function __construct() {
		parent::__construct();
		$this->setModelo("Compra");
	}

	function historial(){
		$this->carrito = $this->modelo->getCompras($_SESSION['user']);
		$total = 0;

		$this->setHeader();
		$this->setFooter();

		$this->setVista("Compras/Historial");
	}

	function comprar(){
		$this->setModelo("Tarjeta");
		$saldo = $this->modelo->getSaldo($_SESSION['tarjeta']);
		if (($saldo['saldo']-$total)>0) {
			$this->modelo->updateSaldo($_SESSION['tarjeta'],$_POST['total']);
			$this->setModelo("Compra");
			$this->modelo->addCompra($_SESSION['user'],$_POST['total']);
			$this->setModelo("Carrito");
			$this->modelo->deleteAllCarrito($_SESSION['user']);
		}
		header("Location: ".URL."home");
	}
}
?>