<style type="text/css">
	@media only screen and (max-width: 600px) {
		.car {
			height: 300;
		}
	}
</style>
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="car" src="<?php echo URL ?>public/imagenes/promo1.jpg" alt="" width="100%" height="500" srcset="">
		</div>
		<div class="carousel-item">
			<img class="car" src="<?php echo URL ?>public/imagenes/promo2.jpg" alt="" width="100%" height="500" srcset="">
		</div>
		<div class="carousel-item">
			<img class="car" src="<?php echo URL ?>public/imagenes/promo3.jpg" alt="" width="100%" height="500" srcset="">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<div class="row">
	<?php foreach ($this->productos as $producto) { ?>
		<div class="col-12 col-sm-6 col-md-4 mt-3">
			<div class="card" style="height: 100%">
				<img class="card-img-top" src="<?php echo URL ?>public/imagenes/<?php echo $producto->imagen ?>" alt="Card image" style="height: 400px">
				<div class="card-body">
					<h4 class="card-title"><?php echo htmlentities($producto->nombre, ENT_COMPAT, 'ISO-8859-1', true); ?></h4>
					<p class="card-text">$<?php echo $producto->precio ?></p>
					<p class="card-text"><?php echo $producto->cantidad ?> Articulos disponibles</p>
				</div>
				<div class="card-footer">
					<form method="post" action="<?php echo URL ?>producto" style="margin-bottom: 5px">
						<input type="hidden" name="id" value="<?php echo $producto->id ?>">
						<button class="btn btn-secondary" type="submit">Ver Producto</button>
					</form>
					<button id="carrito" value="<?php echo $producto->id ?>" type="button" class="btn btn-primary"><img src="<?php echo URL ?>vista/carshop.png" alt="Logo" style="width:20px;">Añadir al Carrito</button>
				</div>
			</div>
		</div>
	<?php } ?>
</div>