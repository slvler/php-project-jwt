<?php 



class Database
{

	
	private $hostname;
	private $dbname;
	private $username;
	private $pass;


	private $conn;


	public function __construct($hostname,$dbname,$username,$pass){

		$this->hostname = $hostname;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->pass = $pass;
		
	}



	public function connect(){

		try {

			$this->conn = new PDO("mysql:host=".$this->hostname.";dbname=".$this->dbname.";charset=utf8",$this->username,$this->pass);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			


		} catch (Exception $e) {
			echo 'Con Error' . $e->getMessage();
		}



		return $this->conn;

	}
}


?>