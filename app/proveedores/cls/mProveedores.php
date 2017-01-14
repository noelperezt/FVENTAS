<?php 

class mProveedores {

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
		$sql = "SELECT * FROM proveedores";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function proveedorInsert() {
		$sql = "SELECT insertproveedor(?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->razon);
		$res->bindParam(2,$this->rif);
		$res->bindParam(3,$this->direccion);
		$res->bindParam(4,$this->telefono);
		$res->bindParam(5,$this->correo);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}

	public function proveedorDelete() {
		$sql= "CALL deleteproveedor(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->provide);
		return $res->execute();
	}

	public function proveedorIde($provide) {
		$sql = "SELECT * FROM proveedores WHERE provide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$provide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function proveedorUpdate() {
		$sql = "SELECT updateproveedor(?, ?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->razon);
		$res->bindParam(2,$this->rif);
		$res->bindParam(3,$this->direccion);
		$res->bindParam(4,$this->telefono);
		$res->bindParam(5,$this->correo);
		$res->bindParam(6,$this->provide);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}
}

?>