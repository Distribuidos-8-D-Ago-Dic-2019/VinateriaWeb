<?php
class Modelo {
	public function __construct() {
		$this->conexion = new mysqli(SERVER, USER, PASS, DB);
		if ($this->conexion->connect_error) {
			die("Connection failed: " . $this->conexion->connect_error);
		}

		$this->conexionBanco = new mysqli(SERVER_BANCO, USER_BANCO, PASS_BANCO, DB_BANCO);
		if ($this->conexionBanco->connect_error) {
			die("Connection failed: " . $this->conexionBanco->connect_error);
		}

		$this->conexionLog = new mysqli(SERVER_LOG, USER_LOG, PASS_LOG, DB_LOG);

		$this->jax = new SoapClient("http://192.168.84.225:8080/WebServer/WebService?wsdl");
	}
}
?>