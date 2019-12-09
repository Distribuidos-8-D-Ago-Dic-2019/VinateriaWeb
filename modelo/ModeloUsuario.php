 <?php
 class ModeloUsuario extends Modelo{
	function __construct(){
		parent::__construct();
	}

	function registrarUsuario($usuario,$contrasena,$nombre,$apellidos,$sexo,$telefono,$fecha_nacimiento,$tipo_usuario){
		$sql = "insert into usuario(usuario,contrasena,nombre,apellidos,sexo,telefono,fecha_nacimiento,tipo_usuario) values('{$usuario}','{$contrasena}','{$nombre}','{$apellidos}','{$sexo}','{$telefono}','{$fecha_nacimiento}','{$tipo_usuario}')";
		$this->conexionLog->query('INSERT INTO LOG (query, date) VALUES ("'.$sql.'", NOW())');
		if($result=$this->conexion->query($sql)){
            echo 'Se registró al usuario correctamente';
        }else{
        	$sql = "select *from usuario where usuario= '{$usuario}'";
        	if($this->conexion->query($sql)){
        		echo 'Usuario ya registrado';
        	}else{
            echo 'error';
        	}
        }
		$this->conexion->close();
		
		return $result;
	}

	function login($usuario,$contrasena){
		$productos = array();
		$sql = "select nombre, apellidos, telefono, tarjeta, tipo_usuario, sesion from usuario where usuario='{$usuario}' and contrasena = '{$contrasena}'";
		if ($result = $this->conexion->query($sql)) {
			while ($obj = mysqli_fetch_array($result)){
				array_push(	$productos, $obj);
			}
			mysqli_free_result($result);
			return $productos;
		}else{
			return null;
		}
	}

	function getUsers(){
		$usuario = array();
		$sql = "SELECT * FROM usuario";
		if($result = mysqli_query($this->conexion,$sql)){
			while ($obj = mysqli_fetch_array($result)){
				array_push(	$usuario, $obj);
			}
			mysqli_free_result($result);
		}
		$this->conexion->close();
		return $usuario;
	}

	function updateUser($usuario,$nombre,$apellidos,$telefono){
		$sql = "update usuario set nombre='$nombre', apellidos='$apellidos', telefono=$telefono where usuario='$usuario'";
		$this->conexionLog->query('INSERT INTO LOG (query, date) VALUES ("'.$sql.'", NOW())');
		$this->conexion->query($sql);
		$this->conexion->close();
	}

	function deleteUser($usuario){
		$sql = "delete from usuario where usuario='{$usuario}'";
		$this->conexionLog->query('INSERT INTO LOG (query, date) VALUES ("'.$sql.'", NOW())');
		$this->conexion->query($sql);
		$this->conexion->close();
	}

	function setSession($usuario) {
		$session = uniqid();
		$sql = "update usuario set sesion ='{$session}' where usuario='{$usuario}'";
		$this->conexionLog->query('INSERT INTO LOG (query, date) VALUES ("'.$sql.'", NOW())');
		$this->conexion->query($sql);
	}
}
?> 