<?php 



class UserModel 
{
	private $db;
	private $table_name;




	public $user_id;
	public $user_name;
	public $user_email;
	public $user_pass;
	public $use_status;



	
	public function __construct($db,$table_name){

		$this->db = $db;
		$this->table_name = $table_name;

	}


	public function user_all_list(){

		$sql_string = "SELECT * FROM ".$this->table_name;

		$result = $this->db->prepare($sql_string);

		$result->execute();

		return $result->fetchAll(PDO::FETCH_ASSOC);

	}

	public function single_list($id){

		$sql_string = "SELECT * FROM ".$this->table_name. " WHERE login_id = :id";

		$result = $this->db->prepare($sql_string);

		$result->bindParam(":id", $id, PDO::PARAM_INT);

		$result->execute();

		$count = $result->rowCount();

		if ($count > 0 ){

			return $result->fetch(PDO::FETCH_ASSOC);
		}else{

			return array();
		}

	}

	public function apikey_check($id,$apikey)
	{
		$sql_string = "SELECT * FROM ".$this->table_name." WHERE login_id = :id AND login_apikey = :apikey";
		$result = $this->db->prepare($sql_string);

		$result->bindParam(":id", $id, PDO::PARAM_INT);
		$result->bindParam(":apikey", $apikey, PDO::PARAM_STR);

		$result->execute();

		$count = $result->rowCount();

		if ($count > 0 ){

			return true;
		}else{

			return array();
		}
	}

	public function login_check($email,$sifre,$apikey)
	{

		$sql_string = "SELECT * FROM ".$this->table_name." WHERE login_email = :email AND login_pass = :pass AND login_apikey = :api";
		$result = $this->db->prepare($sql_string);
		$result->bindParam(":email", $email, PDO::PARAM_STR);
		$result->bindParam(":pass", $sifre, PDO::PARAM_STR);
		$result->bindParam(":api", $apikey, PDO::PARAM_STR);

		$result->execute();

		$count = $result->rowCount();

		if ($count > 0 ){

			return $result->fetch(PDO::FETCH_ASSOC);
		}else{

			return array();
		}


	}



	public function email_check($email,$app)
	{

		$sql_string = "SELECT * FROM ".$this->table_name." WHERE login_email = :email OR login_apikey = :apikey";

		$result = $this->db->prepare($sql_string);

		$result->bindParam(":email", $email, PDO::PARAM_STR);
		$result->bindParam(":apikey", $app, PDO::PARAM_STR);
		$result->execute();

		$count = $result->rowCount();

		if ($count == 0 ){

			return true;
		}else{

			return array();
		}
	}


	public function register($email,$pass,$apikey,$status)
	{

		$sql_string = "INSERT INTO ".$this->table_name." SET login_email =:email, login_pass=:pass, login_apikey=:apikey, login_status =:status ";
		$result = $this->db->prepare($sql_string);

		$result->bindParam(":email", $email, PDO::PARAM_STR);
		$result->bindParam(":pass", $pass, PDO::PARAM_STR);
		$result->bindParam(":apikey", $apikey, PDO::PARAM_STR);
		$result->bindParam(":status", $status, PDO::PARAM_INT);

		if ($result->execute()) {
			return true;
		}else{

			return false;
		}


	}


	public function update($email,$pass,$apikey,$status,$id)
	{

		$sql_string = "UPDATE ".$this->table_name." SET login_email= :email, login_pass= :pass, login_apikey= :apikey, login_status= :status WHERE login_id= :id";
		$result = $this->db->prepare($sql_string);


		$result->bindParam(":email", $email, PDO::PARAM_STR);
		$result->bindParam(":pass", $pass, PDO::PARAM_STR);
		$result->bindParam(":apikey", $apikey, PDO::PARAM_STR);
		$result->bindParam(":status", $status, PDO::PARAM_INT);
		$result->bindParam(":id", $id, PDO::PARAM_INT);

		if ($result->execute()) {
			return true;
		}else{

			return false;
		}

	}



	public function delete($id)
	{

		$sql_string = "DELETE FROM ".$this->table_name." WHERE login_id = :id";

		$result = $this->db->prepare($sql_string);

		$result->bindParam(":id", $id, PDO::PARAM_INT);

		$result->execute();

		$count = $result->rowCount();

		if ($count > 0 ){

			return true;
		}else{

			return array();
		}
	}





}














?>