<?php 
class Conexion {
	public $host,$driver,$bd,$user,$pwd,$con;

	public function __clone() {

	}

	public function __construct() {
		$this->host   = "localhost";
		$this->driver = "mysql";
		$this->bd     = "fventas";
		$this->user   = "root";
		$this->pwd    = "";
	}

	public function conectar() {
		$this->con 	= new PDO($this->driver.':host='.$this->host.';dbname='.$this->bd, $this->user, $this->pwd);
		return $this->con;
	}
}
?>