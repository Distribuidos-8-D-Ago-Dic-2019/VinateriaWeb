<div class="card">
	<div class="card-body">
		<div class="media">
			<img src="<?php echo URL ?>public/imagenes/<?php echo $this->producto->imagen ?>"  width="150" height="200">
			<div class="media-body">
				<h3 class="display-"><?php echo htmlentities($this->producto->nombre, ENT_COMPAT, 'ISO-8859-1', true) ?> <?php echo $this->producto->contenido ?>ml</h3>
				<p class="card-text"><?php echo htmlentities($this->producto->descripcion, ENT_COMPAT, 'ISO-8859-1', true); ?></p>
				<p class="card-text">$<?php echo $this->producto->precio ?> MXN</p>
				<p class="card-text"><?php echo $this->producto->cantidad ?> Disponibles</p>
			</div>
		</div>
	</div>
	<div class="card-footer">
			<form method="post" action="<?php echo URL ?>carrito/insertarCarrito" style="margin-bottom: 5px">
				<button type="button" id="carrito" class="btn btn-primary" value="<?php echo $this->producto->id ?>"><img src="<?php echo URL ?>vista/carshop.png" alt="Logo" style="width:20px;">Añadir al Carrito</button>
			</form>
	</div>
</div>