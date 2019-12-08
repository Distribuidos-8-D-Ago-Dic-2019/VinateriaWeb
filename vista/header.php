<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cocos en la Playa</title>
	<meta charset="utf-8">
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
	<!-- Icons -->
	<script src="https://kit.fontawesome.com/180eab578a.js"></script>
	<!-- Alertify -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>
	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/themes/default.min.css"/>
	<!-- JS general -->
	<script src='public/JS/general.js'></script>
	<!-- icono -->
	<link rel="icon" type="image/png" href="<?php echo URL ?>vista/logo_sm.png" sizes="32x32">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" >
		<a class="navbar-brand" href="<?php echo URL ?>home">
			<img src="<?php echo URL ?>vista/logo.png" alt="Logo" style="width:20px;">
		</a>
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link disabled" href="">Vinatería Cocos en la Playa</a>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navb">
			<ul class="navbar-nav mr-auto">
			</ul>
			<form method="post" class="form-inline my-2 my-lg-0" action="<?php echo URL ?>home">
				<div class="input-group">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-secondary input-group-text"><i class="fas fa-search"></i></button>
					</div>
						<input type="text" class="form-control" placeholder="Buscar Producto" name="buscar" required>
				</div>
			</form>
			<ul class="navbar-nav mr-sm-3">
			</ul>
			<?php if (!isset($_SESSION['user'])||$_SESSION['tipo_usuario']=='t') { ?>
				<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal_login">
					Iniciar sesión
				</button>
			<?php }else { ?>
				<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="btn btn-secondary" id="navbardrop" data-toggle="dropdown">
						<?php echo $_SESSION['user'] ?>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" data-toggle="modal" data-target="#Modal_user">Mis Datos</a>
						<a class="dropdown-item" href="<?php echo URL ?>compra/historial">Mis Compras</a>
						<?php if ($_SESSION['tipo_usuario'] == 'a') { ?>
							<a class="dropdown-item" href="<?php echo URL ?>user">Usuarios</a>
							<a class="dropdown-item" href="<?php echo URL ?>productos/index">Productos</a>
						<?php }else if ($_SESSION['tipo_usuario'] == 'i') { ?>
							<a class="dropdown-item" href="<?php echo URL ?>productos/index">Productos</a>
						<?php } ?>
						<a class="dropdown-item" href="<?php echo URL ?>user/logout">Cerrar Sesion</a>
					</div>
				</li>
			</ul>
			<?php } ?>

			<ul class="navbar-nav mr-sm-3">
			</ul>
			<ul class="navbar-nav mr-sm-3">
			</ul>
			<a class="navbar-brand" href="<?php echo URL ?>carrito">
				<img src="<?php echo URL ?>vista/carshop.png" alt="Logo" style="width:30px;">
			</a>
		</div>
	</nav>

	<div class="modal fade" id="Modal_user">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Bienvenido <?php echo $_SESSION['user']; ?></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<div class="container">
						<form method="post" action="<?php echo URL ?>user/update" class="was-validated">
							<div class="form-group">
								<label for="name">Nombre:</label>
								<input type="text" class="form-control" id="name" placeholder="Enter name" name="nombre" value="<?php echo $_SESSION['nombre'] ?>" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group">
								<label for="apellidos">Apellidos:</label>
								<input type="text" class="form-control" id="apellidos" placeholder="Enter last names" name="apellidos" value="<?php echo $_SESSION['apellidos'] ?>" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group">
								<label for="telefono">Telefono:</label>
								<input type="number" min="1000000000" max="9999999999" class="form-control" id="telefono" placeholder="Enter phone number" name="telefono" value="<?php echo $_SESSION['telefono'] ?>" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<?php if (!isset($_SESSION['tarjeta'])) { ?>
								<label for="tarjeta">Tarjeta:</label>
								<button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#Modal_Card">
									Agregar Tarjeta
								</button>
								<input type="hidden" id="tarjeta"value="<?php echo $_SESSION['tarjeta'] ?>">
							<?php }else { ?>
								<div class="form-group">
									<label for="tarjeta">Tarjeta:</label>
									<input type="text" disabled class="form-control" id="tarjeta" placeholder="Enter card number" name="tarjeta" value="<?php echo $_SESSION['tarjeta'] ?>" required>
									<div class="valid-feedback">Ingresado</div>
									<div class="invalid-feedback">Favor de llenar este campo</div>
								</div>
							<?php } ?>
							<div class="form-group form-check">    	
							</div>
							<button type="submit" class="btn btn-secondary btn-block">Actualizar datos</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal del Login -->
	<div class="modal fade" id="Modal_login">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Iniciar sesión</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<h2>Vinatería Cocos en la Playa</h2>
						<p>Favor de rellenar los siguientes campos con la información requerida para iniciar sesión</p>
						<form method="post" id="log_form" action="<?php echo URL ?>user/login" class="was-validated">
							<div class="form-group">
								<label for="log_user">Usuario:</label>
								<input type="text" class="form-control" id="log_user" placeholder="Enter username" name="user" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group">
								<label for="log_pass">Contraseña:</label>
								<input type="password" id="log_pass" class="form-control" placeholder="Contraseña" name="password" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<button type="button" id="log" class="btn btn-secondary btn-block">Continuar</button>
							<button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#Modal_Signup">
								Registrarse
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal del Registro -->
	<div class="modal fade" id="Modal_Signup">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Registro</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<h2>Vinatería Cocos en la Playa</h2>
						<p>Favor de rellenar los siguientes campos con la información requerida para realizar el registro de usuario</p>
						<form method="post" id="sign_form" action="<?php echo URL ?>user/registrar" class="was-validated">
							<div class="form-group">
								<label for="sign_user">Usuario:</label>
								<input type="text" id="sign_user" class="form-control" placeholder="Enter user" name="user" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group">
								<label for="sign_name">Nombre:</label>
								<input type="text" class="form-control" id="sign_name" placeholder="Enter name" name="nombre" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group">
								<label for="sign_last">Apellidos:</label>
								<input type="text" class="form-control" id="sign_last" placeholder="Enter last name" name="apellidos" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<label for="femenino">Sexo:</label>
							<div class="form-group">
								<div class="form-check-inline">
									<label class="form-check-label" for="femenino">
										<input type="radio" class="form-check-input" id="femenino" name="sexo" value="F" checked>Femenino
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label" for="masculino">
										<input type="radio" class="form-check-input" id="masculino" name="sexo" value="M">Masculino
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">Fecha de nacimiento</span>
									</div>
									<input type="number" min="1" max="31" class="form-control" id="day" placeholder="dd" name="mes" required>
									<input type="number" min="1" max="12" class="form-control" id="month" placeholder="mm" name="dia" required>
									<input type="number" min="1900" max="2001" class="form-control" id="year" placeholder="aaaa" name="año" required>
								</div>
							</div>
							<div class="form-group">
								<label for="number">Número telefónico:</label>
								<input type="number" min="1000000000" max="9999999999" class="form-control" id="number" placeholder="Enter number" name="telefono" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group">
								<label for="sign_pass">Contraseña:</label>
								<input type="password" class="form-control" id="sign_pass" placeholder="Enter password" maxlength="16" name="password" required>
								<div class="valid-feedback">Ingresado</div>
								<div class="invalid-feedback">Favor de llenar este campo</div>
							</div>
							<div class="form-group form-check">    	
							</div>
							<button type="button" id="sign" class="btn btn-secondary btn-block">Registrarse</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tarjeta -->
	<div class="modal fade" id="Modal_Card">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Agregar Tarjeta Bancoco</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<h2>Vinatería Cocos en la Playa</h2>
						<p>Favor de rellenar los siguientes campos con la información requerida para realizar el registro de su tarjeta</p>
						<form method="post" id="card_form" class="was-validated">
							<div class="form-group">
								<label for="card_card">Tarjeta:</label>
								<input type="number" min="1000000000000000" max="9999999999999999" id="card_card" class="form-control" placeholder="Ingresar Tarjeta" required>
								<div class="valid-feedback">Correcto</div>
								<div class="invalid-feedback">Tarjeta Bancoco</div>
							</div>
							<div class="form-group">
								<label for="card_cvv">CVV:</label>
								<input type="number" min="100" max="999" class="form-control" id="card_cvv" placeholder="Ingresar CVV" required>
								<div class="valid-feedback">Correcto</div>
								<div class="invalid-feedback">Card Verification value</div>
							</div>
							<div class="form-group form-check">    	
							</div>
							<button type="button" id="card" class="btn btn-secondary btn-block">Ingresar Tarjeta</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" id="user" value="<?php echo $_SESSION['user'] ?>">

	<br>
	<br>
	<br>
	
	<div class="container">
		

<!-- 
Falta cerrar esto!
Para continuar
</body>
</html>
 -->