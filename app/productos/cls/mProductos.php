<?php 

class mProductos {

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
		$sql = "SELECT * FROM vw_productos ORDER BY prodide ASC";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function getAllmedidas() {
		$sql = "SELECT * FROM unidamedid";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function productoInsert() {
		$sql = "SELECT insertproducto(?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(5,$this->cod);
		$res->bindParam(1,$this->descri);
		$res->bindParam(2,$this->medida);
		$res->bindParam(3,$this->precio);
		$res->bindParam(4,$this->stock);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}

	public function productoDelete() {
		$sql= "CALL deleteproducto(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->prodide);
		return $res->execute();
	}

	public function productoIde($prodide) {
		$sql = "SELECT * FROM vw_productos WHERE prodide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$prodide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function productoUpdate() {
		$sql = "SELECT updateproducto(?, ?, ?, ?, ?) as repetido";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->descri);
		$res->bindParam(2,$this->medida);
		$res->bindParam(3,$this->prodide);
		$res->bindParam(4,$this->precio);
		$res->bindParam(5,$this->stock);
		$rt = ($res->execute()==1) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
		return $rt[0]->repetido;
	}

	public function stock($prodide) {
		$sql = "SELECT stock(?) as total";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$prodide);
		$res->execute();
		$row = $res->fetchAll(PDO::FETCH_OBJ);
		return ($row[0]->total>0) ? $row[0]->total : 0;
	}
}

?>