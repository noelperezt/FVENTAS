<?php 

class mVentas {

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

	public function insertArticulo() {
		$sql = "SELECT insertarticulo(?, ?, ?) AS response";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->producto);
		$res->bindParam(2,$this->cantidad);
		$res->bindParam(3,$this->clieide);
		if ($res->execute()==1) {
			$row = $res->fetchAll(PDO::FETCH_OBJ);
			$rt = $row[0]->response;
		} else {
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}

	public function getVentas($clieide) {
		$sql = "SELECT * FROM vw_ventas WHERE factide=0 and clieide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$clieide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function getVentasFact($fact) {
		$sql = "SELECT * FROM vw_ventas WHERE factide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$fact);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getVentaFact() {
		$sql = "SELECT * FROM factura, clientes WHERE factura.factestado = 1 and factura.clieide = clientes.clieide order by factfecha desc ";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getVentaFactf($fechai, $fechaf) {
		$sql = "SELECT * FROM factura, clientes WHERE factura.factestado = 1 and factura.clieide = clientes.clieide and DATE_FORMAT(factura.factfecha, '%m-%d-%Y') BETWEEN ? AND ? order by factfecha desc ";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$fechai);
            $res->bindParam(2,$fechaf);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function getVentasAnuladas($fechai, $fechaf) {
		$sql = "SELECT * FROM factura, clientes WHERE factura.factestado = 0 and factura.clieide = clientes.clieide and DATE_FORMAT(factura.factfecha, '%m-%d-%Y') BETWEEN ? AND ? order by factfecha desc ";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$fechai);
		$res->bindParam(2,$fechaf);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getVentaFactAnul() {
		$sql = "SELECT * FROM factura, clientes WHERE factura.factestado = 0 and factura.clieide = clientes.clieide order by factfecha desc ";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTotalFactAnul() {
		$sql = "SELECT SUM(facttotal) as total FROM factura WHERE factura.factestado = 0  ";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	
	 	public function getTotalFact() {
		$sql = "SELECT SUM(facttotal) as total FROM factura WHERE factura.factestado = 1  ";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function getTotalFacts($fechai, $fechaf) {
		$sql = "SELECT SUM(facttotal) as total FROM factura WHERE factura.factestado = 1 and DATE_FORMAT(factura.factfecha, '%m-%d-%Y') BETWEEN ? AND ? ";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$fechai);
        $res->bindParam(2,$fechaf);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	public function getTotalAnulado($fechai, $fechaf) {
		$sql = "SELECT SUM(facttotal) as total FROM factura WHERE factura.factestado = 0 and DATE_FORMAT(factura.factfecha, '%m-%d-%Y') BETWEEN ? AND ? ";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$fechai);
		$res->bindParam(2,$fechaf);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function totalPagar($cliente, $factura) {
		$sql = "SELECT totalpagar(?, ?) as total";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cliente);
		$res->bindParam(2,$factura);
		$res->execute();
		$row = $res->fetchAll(PDO::FETCH_OBJ);
		return $row[0]->total;
	}

	public function ventaDelete() {
		$sql = "CALL deleteventa(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->ventide);
		return $res->execute();
	}
	
	public function ventasDelete($id) {
		$sql = "CALL deleteventa(?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$id);
		return $res->execute();
	}

	public function anular() {
		if($this->confirmafecha($this->factide)){
			$sql = "INSERT INTO notacredito (fecha, idfact) values (now(),?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->factide);
			$res->execute();
			$sql = "UPDATE factura set factestado = 0 WHERE factide = ?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->factide);
			$res->execute();

			$todo = $this->getVentasFact($this->factide);

			foreach($todo as $t) {
				$this->ventasDelete($t->ventide);
			}
			return 1;
		}else{
			$sql = "UPDATE factura set factestado = 0 WHERE factide = ?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->factide);
			$res->execute();

			$todo = $this->getVentasFact($this->factide);

			foreach($todo as $t) {
				$this->ventasDelete($t->ventide);
			}
			return 1;
		}
	}

	public function confirmafecha($id){
		$sql = "SELECT factfecha FROM factura WHERE factide = ?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$id);
		$res->execute();
		$row = $res->fetchAll(PDO::FETCH_OBJ);
		if(date("m", strtotime($row[0]->factfecha)) < date("m")){
			return true;
			//echo "Fuera de Periodo";
		}else{
			echo "Dentro de periodo";
			//return false;
		}

	}
	
	public function facturar($clieide) {
		$total = $this->totalPagar($clieide,0);
		$sub = $total-($total*0.12);
		$iva = $total*0.12;
		$sql = "INSERT INTO factura (clieide, facttotal, factsubtot, factiva, factfecha, usuaide) values (?, ?, ?, ?, now(), ?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$clieide);
		$res->bindParam(2,$total);
		$res->bindParam(3,$sub);
		$res->bindParam(4,$iva);
		$res->bindParam(5,$_SESSION['usuaide']);
		$res->execute();

		$last = $this->con->lastInsertId();
		$todo = $this->getVentas($this->clieide);

		$sql = "UPDATE ventas set factide=? where ventide=?";
		$res = $this->con->prepare($sql);
		foreach($todo as $t) {
			$res->bindParam(1,$last);
			$res->bindParam(2,$t->ventide);
			$res->execute();
		}
		return $last;
	}

}