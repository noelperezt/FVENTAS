<?php 

class mUsuarios {

	protected $bdh, $con, $msj;

	public function __clone() {

	}

	public function __construct() {
		$this->dbh = new Conexion();
		$this->msj = array();
		$this->con = $this->dbh->conectar();
		if(isset($_POST)) {
			foreach($_POST as $i=>$r) {
				$this->$i = $r;
			}
		}
	}

	public function redirecLogin() {
		if(!isset($_SESSION['usuaide'])) {
			header('location: login.php');
		}
	}

	public function redirecIndex() {
		if(isset($_SESSION['usuaide'])) {
			header('location: index.php');
		}
	}

	public function login() {
		$sql = "SELECT * FROM  usuario WHERE acceusuari=? AND acceclave=? AND accesestado=1";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->usuario);
		$res->bindParam(2,$this->clave);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function opcionesMenu() {
		$sql = "SELECT * FROM opcionesmenu WHERE usuaide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$_SESSION['usuaide']);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function contenido($var) {
		$sql = "SELECT * FROM opcionesmenu WHERE usuaide=? AND sumoide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$_SESSION['usuaide']);
		$res->bindParam(2,$var);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function getAll() {
		$sql = "SELECT * FROM  usuario";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function usuarioInsert() {
		$sql = "SELECT insertusuario(?, ?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nombre);
		$res->bindParam(2,$this->apelli);
		$res->bindParam(3,$this->nacion);
		$res->bindParam(4,$this->cedula);
		$res->bindParam(5,$this->usuari);
		$res->bindParam(6,$this->clave);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}

	public function opcionesMenuUsuaide($usuaide) {
		$sql = "SELECT * FROM listasubmodulos";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$usuaide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function permisosUsuario($sumoide, $usuaide) {
		$sql = "SELECT * FROM permisos WHERE sumoide=? AND usuaide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$sumoide);
		$res->bindParam(2,$usuaide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	public function permisosUpdate() {
		$sql= "CALL updatepermiso(?, ?, ?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->usuaide);
		$res->bindParam(2,$this->sumoide);
		$res->bindParam(3,$this->valor);
		return $res->execute();
	}

	public function usuarioDelete() {
		$sql= "CALL deleteusuario(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->usuaide);
		return $res->execute();
	}

	public function usuarioIde($usuaide) {
		$sql = "SELECT * FROM  usuario WHERE usuaide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$usuaide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function usuarioUpdate() {
		$sql = "SELECT updateusuario(?, ?, ?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nombre);
		$res->bindParam(2,$this->apelli);
		$res->bindParam(3,$this->nacion);
		$res->bindParam(4,$this->cedula);
		$res->bindParam(5,$this->usuari);
		$res->bindParam(6,$this->clave);
		$res->bindParam(7,$this->usuaide);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}
}

?>