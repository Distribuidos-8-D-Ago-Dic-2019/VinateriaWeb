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
		$carrito = $this->modelo->getCarrito($_SESSION['user']);
		$total = 0;
		echo "
		<input type='hidden' name='usuario' value='{$_SESSION['user']}'>
		<input type='hidden' id='tipo' value='{$_SESSION['tipo_usuario']}'>
		<br>
		<br>
		<br>";
		for ($i=0; $i < count($carrito); $i++) {
			$subtotal = $carrito[$i]['cantidad']*$carrito[$i]['precio'];
			$total = $total + $subtotal;
			$carrito[$i]['producto'] = htmlentities($carrito[$i]['producto'], ENT_COMPAT, 'ISO-8859-1', true);
			echo "
			<div class='card mb-2'>
				<div class='card-body'>
					<div class='row align-items-center'>
						<div class='col-12 col-sm-6 col-md-2'>
							<img src='".URL."public/imagenes/{$carrito[$i]['imagen']}' class='rounded mx-auto d-block' alt='Img' height='100px'>
						</div>
						<div class='col-12 col-sm-6 col-md-8'>
							<div class='row'>
								<div class='col-12 col-sm-6 col-md-4'>
									<label for='name' class='card-title'>Producto: {$carrito[$i]['producto']}.</label>
								</div>
								<div class='col-0 col-sm-0 col-md-4'></div>
								<div class='col-6 col-sm-6 col-md-4'>
									<label for='precio' class='card-text'>Precio: $ {$carrito[$i]['precio']}</label>
								</div>
							</div>
							<div class='row'>
								<div class='col-5 col-sm-5 col-md-4'>Cantidad: {$carrito[$i]['cantidad']}</div>
								<div class='col-1 col-sm-1 col-md-4'></div>
								<div class='col-5 col-sm-5 col-md-4'>Subtotal:   $$subtotal</div>
							</div>
						</div>
						<div class='col-12 col-sm-12 col-md-2 mt-2'>
							<form method='post' action='".URL."carrito/eliminarCarrito'>
								<button class='btn btn-danger' type='submit'>Eliminar</button>
								<input type='hidden' name='producto' value='{$carrito[$i]['clave_producto']}'>
								<input type='hidden' name='usuario' value='{$_SESSION['user']}'>
							</form>
						</div>
					</div>
				</div>
			</div>";
		}
		echo "
		<div class='card mb-2'>
			<div class='card-footer'>
				<div class='row'>
					<div class='col-7 col-sm-7 col-md-10'>
					</div>
					<div class='col-5 col-sm-5 col-md-2'>
						Total : $$total
					</div>
				</div>
			</div>
		</div>
		<form method='post' id='comprar' action='".URL."home'>
			<input type='hidden' id='total' name='total' value='$total'>
			<button class='btn btn-secondary' id='comprar' type='button'>Comprar Carrito</button>
		</form>";
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