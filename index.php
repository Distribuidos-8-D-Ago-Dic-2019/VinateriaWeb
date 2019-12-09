<?php
require_once 'config/config.php';
require_once 'libs/Controlador.php';
require_once 'libs/Modelo.php';

$url = isset($_GET['url'])?$_GET['url']:null;
$url = rtrim($url, '/');
$url = explode('/', $url);

if (empty($url[0])) {
	require_once 'controlador/ControladorHome.php';
	$controlador = new Home;
	$controlador->index();
	return;
}

$archivo = 'controlador/Controlador'.$url[0].'.php';

if (file_exists($archivo)) {
	require_once $archivo;
	$controlador = new $url[0];

	if (isset($url[1])) {
		$controlador->{$url[1]}();
	}else {
		$controlador->index();
	}
}else {
	echo "La pagina no existe";
}

?>