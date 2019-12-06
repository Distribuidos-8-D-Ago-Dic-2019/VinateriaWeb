<div class="card">
	<div class="card-body">
		<div class="media">
			<img src="'.URL.'public/imagenes/'.$this->producto['imagen'].'"  width="150" height="200">
			<div class="media-body">
				<h3 class="display-"><?php echo htmlentities($this->producto['nombre'], ENT_COMPAT, 'ISO-8859-1', true).' '.$this->producto['contenido']; ?>ml</h3>
				<p class="card-text"><?php echo htmlentities($this->producto['descripcion'], ENT_COMPAT, 'ISO-8859-1', true); ?></p>
				<p class="card-text">$<?php  ?>'.$this->producto['precio'].' MXN</p>
				<p class="card-text">'.$this->producto['cantidad'].' Disponibles</p>
			</div>
		</div>
	</div>
	<div class="card-footer">
			<form method="post" action="'.URL.'carrito/insertarCarrito" style="margin-bottom: 5px">
				<input type="hidden" id="producto_'.$this->producto['id'].'" value="'.$this->producto['id'].'">
				<button type="button" id="carrito" class="btn btn-primary" value="'.$this->producto['id'].'"><img src="'.URL.'vista/carshop.png" alt="Logo" style="width:20px;">Añadir al Carrito</button>
			</form>
	</div>
</div>