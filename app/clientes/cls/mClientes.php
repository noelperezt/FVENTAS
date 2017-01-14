<?php 

class mClientes {

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

	public function getAll() {
		$sql = "SELECT * FROM clientes";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function clienteInsert() {
		$sql = "SELECT insertcliente(?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nacion);
		$res->bindParam(2,$this->cedula);
		$res->bindParam(3,$this->razsoc);
		$res->bindParam(4,$this->direcc);
		$res->bindParam(5,$this->telefo);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}

	public function clienteInsert2() {
		$sql = "SELECT insertcliente2(?, ?, ?, ?, ?) as ide";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nacion);
		$res->bindParam(2,$this->cedula);
		$res->bindParam(3,$this->razsoc);
		$res->bindParam(4,$this->direcc);
		$res->bindParam(5,$this->telefo);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->ide;
	}

	public function clienteDelete() {
		$sql= "CALL deletecliente(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->clieide);
		return $res->execute();
	}

	public function clienteIde($clieide) {
		$sql = "SELECT * FROM clientes WHERE clieide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$clieide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function clienteUpdate() {
		$sql = "SELECT updatecliente(?, ?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nacion);
		$res->bindParam(2,$this->cedula);
		$res->bindParam(3,$this->razsoc);
		$res->bindParam(4,$this->direcc);
		$res->bindParam(5,$this->telefo);
		$res->bindParam(6,$this->clieide);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}
}

?>