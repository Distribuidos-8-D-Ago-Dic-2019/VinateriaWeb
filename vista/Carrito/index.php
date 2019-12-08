<?php $total = 0; ?>
<?php foreach ($this->productos as $producto) {$subtotal = $producto['cantidad']*$producto['precio'];
	$total = $total + $subtotal;
	$producto['producto'] = htmlentities($producto['producto'], ENT_COMPAT, 'ISO-8859-1', true); ?>
	<div class='card mb-2'>
		<div class='card-body'>
			<div class='row align-items-center'>
				<div class='col-12 col-sm-6 col-md-2'>
					<img src="<?php echo URL ?>public/imagenes/<?php echo $producto['imagen'] ?>" class='rounded mx-auto d-block' alt='Img' height='100px'>
				</div>
				<div class='col-12 col-sm-6 col-md-8'>
					<div class='row'>
						<div class='col-12 col-sm-6 col-md-4'>
							<label for='name' class='card-title'>Producto: <?php echo $producto['producto'] ?>.</label>
						</div>
						<div class='col-0 col-sm-0 col-md-4'></div>
						<div class='col-6 col-sm-6 col-md-4'>
							<label for='precio' class='card-text'>Precio: $ <?php echo $producto['precio'] ?></label>
						</div>
					</div>
					<div class='row'>
						<div class='col-5 col-sm-5 col-md-4'>Cantidad: <?php echo $producto['cantidad'] ?></div>
						<div class='col-1 col-sm-1 col-md-4'></div>
						<div class='col-5 col-sm-5 col-md-4'>Subtotal:   $<?php echo $subtotal; ?></div>
					</div>
				</div>
				<div class='col-12 col-sm-12 col-md-2 mt-2'>
					<form method='post' action='<?php echo URL ?>carrito/eliminarCarrito'>
						<button class='btn btn-danger' type='submit'>Eliminar</button>
						<input type='hidden' name='producto' value='<?php echo $producto['clave_producto'] ?>'>
						<input type='hidden' name='usuario' value='<?php echo $_SESSION['user'] ?>'>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div class='card mb-2'>
	<div class='card-footer'>
		<div class='row'>
			<div class='col-7 col-sm-7 col-md-10'>
			</div>
			<div class='col-5 col-sm-5 col-md-2'>
				Total : $<?php echo $total; ?>
			</div>
		</div>
	</div>
</div>
<form method='post' id='comprar' action='<?php echo URL ?>home'>
	<input type='hidden' id='total' name='total' value='$total'>
	<button class='btn btn-secondary' id='comprar' type='button'>Comprar Carrito</button>
</form>