<?php 



class itemmodel
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


	public function apikey_check($id,$apikey)
	{
		$sql_string = "SELECT * FROM login WHERE login_id = :id AND login_apikey = :apikey";
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

	public function all()
	{


		$sql_string = "SELECT * FROM ".$this->table_name;

		$result = $this->db->prepare($sql_string);

		$result->execute();



		return $result->fetchAll(PDO::FETCH_ASSOC);

	}



	public function single_list($id){

		$sql_string = "SELECT * FROM ".$this->table_name. " WHERE item_id = :id";

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

	
	public function create_item($name,$text,$user,$status)
	{

		$sql_string = "INSERT INTO ".$this->table_name." SET item_name =:name, item_text=:text, user_id=:user, item_status =:status ";
		$result = $this->db->prepare($sql_string);

		$result->bindParam(":name", $name, PDO::PARAM_STR);
		$result->bindParam(":text", $text, PDO::PARAM_STR);
		$result->bindParam(":user", $user, PDO::PARAM_INT);
		$result->bindParam(":status", $status, PDO::PARAM_INT);

		if ($result->execute()) {
			return true;
		}else{

			return false;
		}

	}


	public function update($name,$text,$user,$status,$id)
	{

		$sql_string = "UPDATE ".$this->table_name." SET item_name= :name, item_text= :text, user_id= :user, item_status= :status WHERE item_id= :id";
		$result = $this->db->prepare($sql_string);


		$result->bindParam(":name", $name, PDO::PARAM_STR);
		$result->bindParam(":text", $text, PDO::PARAM_STR);
		$result->bindParam(":user", $user, PDO::PARAM_INT);
		$result->bindParam(":status", $status, PDO::PARAM_INT);
		$result->bindParam(":id", $id, PDO::PARAM_INT);

		$result->execute();

		$count = $result->rowCount();

		if ($count > 0 ){

			return true;
		}else{

			return array();
		}

	}


	public function delete($id)
	{

		$sql_string = "DELETE FROM ".$this->table_name." WHERE item_id = :id";

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



	public function allcount()
	{


		$sql_string = "SELECT * FROM course";

		$result = $this->db->prepare($sql_string);

		$result->execute();
		$veri = $result->fetchAll();

		
		return $result->rowCount();

	}


	public function itemler(){


		$query = "";
		$output = array();
		$query .= "SELECT * from course";
		if (isset($_POST["search"]["value"])) 
		{

			$query .= 'WHERE course LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= 'Or students LIKE "%'.$_POST["search"]["value"].'%" ';

		}

		$statament = $this->db->prepare($query);

		$statament->execute();
		$result = $statament->fetchAll();

		$data = array();
		$filtered_rows = $statament->rowCount();

		foreach ($result as $row) {

			$sub_array = array();

			$sub_array[] = $row["id"];
			$sub_array[] = $row["course"];
			$sub_array[] = $row["students"];
			$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-success">Edit</button>';
			$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger">Delete</button>';

			$data[] = $sub_array;
		}

		$output = array(

			"draw" =>"1",
			"recordsTotal" => $filtered_rows,
			"recordsFiltered" => $this->allcount(),
			"data" => $data  
		);


		echo json_encode($output);



	}



}



?>