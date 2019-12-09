<?php
class Modelo {
	protected $conexion;
	protected $conexionBanco;
	public function __construct() {
		$servername = SERVER;
		$username = USER;
		$password = PASS;
		$dbname = "vinateria";
		$this->conexion = new mysqli($servername, $username, $password, $dbname);
		if ($this->conexion->connect_error) {
			die("Connection failed: " . $this->conexion->connect_error);
		}
        
        $servername = SERVER_BANCO;
		$username = USER_BANCO;
		$password = PASS_BANCO;
		$dbname = "banco";
        $this->conexionBanco = new mysqli($servername, $username, $password, $dbname);
		if ($this->conexionBanco->connect_error) {
			die("Connection failed: " . $this->conexionBanco->connect_error);
		}
	}
}
?>