<?php
class Controlador {
	public $session;
	public function __construct() {
		session_start();
		if (empty($_SESSION['user'])) {
			$_SESSION['user'] = uniqid();
			$_SESSION['tipo_usuario'] = "t";
		}


		if ($_SESSION['tipo_usuario'] != "t") {
			$algo = new mysqli(SERVER, USER, PASS, DB);
			$sql = "SELECT sesion FROM usuario where usuario='{$_SESSION['user']}'";
			$result = $algo->query($sql)->fetch_assoc();
			$session = $result['sesion'];
			if ($_SESSION['id'] != $session) {
				session_destroy();
				unset($_SESSION);
				header('Location: '.URL.'home');
			}
		}
	}

	function setFooter() {
		require 'vista/header.php';
	}

	function setHeader() {
		require 'vista/footer.php';
	}

	function setVista($vista) {
		require 'vista/'.$vista.'.php';
	}

	function setModelo($modelo) {
		$url = 'modelo/Modelo'.$modelo.'.php';
		if(file_exists($url)){
			require $url;
			$nombre = 'Modelo'.$modelo;
			$this->modelo = new $nombre();
		}
	}

	function setJs($JS) {
		echo "<script src='".URL."public/JS/$JS.js'></script>";
	}
}
?>