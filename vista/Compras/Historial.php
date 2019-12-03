<?php if (!empty($this->carrito)) { ?>
	<?php $total = 0 ?>
	<?php foreach ($this->carrito as $producto) { $subtotal = $producto['cantidad']*$producto['precio']; $total = $total + $subtotal; ?>
		<div class='card mb-2'>
			<div class='card-body'>
				<div class='row align-items-center'>
					<div class='col-12 col-sm-6 col-md-2'>
						<img src='<?php echo URL ?>public/imagenes/<?php echo $producto['imagen'] ?>' class='rounded mx-auto d-block' alt='Img' height='100px'>
					</div>
					<div class='col-12 col-sm-6 col-md-10'>
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
							<div class='col-5 col-sm-5 col-md-4'>Subtotal:   $<?php echo $subtotal ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
<?php }else { ?>
	<h1>No tienes compras aun</h1>
<?php } ?>
