<?php 

class mEmpresa {

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
		$sql = "SELECT * FROM empresa";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function updateEmpresa() {
		$sql = "UPDATE empresa SET emprrazsoc=?, emprrif=?, emprlogo=?, emprlema=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->razon);
		$res->bindParam(2,$this->rif);
		$res->bindParam(3,$_FILES['logo']['name']);
		$res->bindParam(4,$this->lema);
		return $res->execute();
	}

}

?>