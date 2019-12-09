 <?php
 class ModeloTarjeta extends Modelo{
	public function __construct(){
		parent::__construct();
	}

	function getSaldo($tarjeta){
		$sql = "select saldo from tarjeta where tarjeta={$tarjeta}";
		$result = $this->conexionBanco->query($sql);
		return $obj;
	}
}