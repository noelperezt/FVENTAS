<?php 

class mEntradas {

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

	public function getAll($prodide) {
		$sql = "SELECT * FROM entradaproductos WHERE prodide=? ORDER BY prodide DESC LIMIT 0,10";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$prodide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function entradaInsert() {
		$sql = "CALL insertentrada(?, ?, ?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->producto);
		$res->bindParam(2,$this->cantidad);
		$res->bindParam(3,$this->proveedor);
		return $res->execute();
	}

	public function entradaDelete() {
		$sql= "CALL deletedeentrada(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->prodide);
		return $res->execute();
	}


}

?>