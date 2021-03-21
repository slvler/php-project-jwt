<?php 


use \Firebase\JWT\JWT;
use \Def\C\Control;


require_once  __DIR__ . '/../Control.php';

class Item extends Control
{

	public function Vt()
	{
		
		$vt =$this->Database("Database","localhost","stable","root","");
		$db = $vt->connect();

		return $db;

	}


	public function all()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "item";
		$items = $this->model("itemmodel",$db,$table_name);


		
		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->myapi) && !empty($data->secret)) {


			try {
				$jwt = $headers["Authorization"];
				$key = temizle($data->secret);
				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;


				$myapi = temizle($data->myapi);

				$result = $items->apikey_check($gelenid,$myapi);

				if (!empty($result)) {

					$veri = $items->all();

					if (!empty($veri)) {

						$this->view('login-list',$veri);

					}else{

						http_response_code(404);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Function!"

						));

					}


				}else{

					http_response_code(500);
					echo json_encode(array(
						"status" => 0,
						'message' => "Error - Key!"

					));
				}


			} catch (Exception $ex) {

				http_response_code(500);
				echo json_encode(array(
					"status" => 0,
					'message' => $ex->getMessage()

				));

			}

		}else{

			http_response_code(503);
			echo json_encode(array(
				"status" => 0,
				'message' => "Error - Acces!"

			));

		}



	}


	public function single()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "item";
		$items = $this->model("itemmodel",$db,$table_name);


		
		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->myapi) && !empty($data->secret) && !empty($data->id)) {


			try {
				$jwt = $headers["Authorization"];
				$key = temizle($data->secret);
				$id = temizle($data->id);
				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;


				$myapi = temizle($data->myapi);

				$result = $items->apikey_check($gelenid,$myapi);

				if (!empty($result)) {

					$veri = $items->single_list($id);

					if (!empty($veri)) {

						$this->view('item-single',$veri);

					}else{

						http_response_code(404);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Empty!"

						));

					}


				}else{

					http_response_code(500);
					echo json_encode(array(
						"status" => 0,
						'message' => "Error - Key!"

					));
				}


			} catch (Exception $ex) {

				http_response_code(500);
				echo json_encode(array(
					"status" => 0,
					'message' => $ex->getMessage()

				));

			}

		}else{

			http_response_code(503);
			echo json_encode(array(
				"status" => 0,
				'message' => "Error - Acces!"

			));

		}


	}


	public function create()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "item";
		$items = $this->model("itemmodel",$db,$table_name);



		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->name) && !empty($data->text)  && !empty($data->status) && !empty($data->myapi) && !empty($data->secret)) {


			try {

				$jwt = $headers["Authorization"];
				$key = temizle($data->secret);
				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;


				$item_name = temizle($data->name);
				$item_text = temizle($data->text);
				$item_status = temizle($data->status);
				$myapi = temizle($data->myapi);

				$result = $items->apikey_check($gelenid,$myapi);

				if (!empty($result)) {


					$veri = $items->create_item($item_name,$item_text,$gelenid,$item_status);

					if (!empty($veri)) {

						$this->view("item-create");

					}else{

						http_response_code(404);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Function!"

						));

					}


				}else{

					http_response_code(500);
					echo json_encode(array(
						"status" => 0,
						'message' => "Error - Empty!"

					));
				}



			} catch (Exception $ex) {

				http_response_code(500);
				echo json_encode(array(
					"status" => 0,
					'message' => $ex->getMessage()

				));

			}


		}else{

			http_response_code(503);
			echo json_encode(array(
				"status" => 0,
				'message' => "Error - Acces!"

			));


		}

	}



	public function update()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "item";
		$items = $this->model("itemmodel",$db,$table_name);

		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->id) && !empty($data->name) && !empty($data->text)  && !empty($data->status) && !empty($data->myapi) && !empty($data->secret)) {

			try {
				$jwt = $headers["Authorization"];
				$key = temizle($data->secret);
				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;


				$id = temizle($data->id);
				$name = temizle($data->name);
				$text = temizle($data->text);
				$status = temizle($data->status);
				$myapi = temizle($data->myapi);

				$return = $items->apikey_check($gelenid,$myapi);

				if (!empty($return)) {

					$result = $items->update($name,$text,$gelenid,$status,$id);

					if ($result) {

						$this->view('item-update');

					}else {

						http_response_code(404);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Create Fail!"

						));

					}

				}else {

					http_response_code(500);
					echo json_encode(array(
						"status" => 0,
						'message' => "Error - Login Fail!"

					));

				}


			} catch (Exception $ex) {

				http_response_code(500);
				echo json_encode(array(
					"status" => 0,
					'message' => $ex->getMessage()

				));

			}


		}else {

			http_response_code(503);
			echo json_encode(array(
				"status" => 0,
				'message' => "Error - Empty!"

			));

		}

	}


	public function delete()
	{
		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "item";
		$items = $this->model("itemmodel",$db,$table_name);

		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->id) && !empty($data->myapi) && !empty($data->secret)) {

			try{

				$jwt = $headers["Authorization"];
				$id = temizle($data->id);
				$key = temizle($data->secret);
				$myapp = temizle($data->myapi);


				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;

				$result = $items->apikey_check($gelenid,$myapp);

				if (!empty($result)) {

					$veri = $items->delete($id);

					if (!empty($veri)) {

						$this->view("item-delete");


					}else{


						http_response_code(404);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Delete"

						));

					}


				}else {

					http_response_code(500);
					echo json_encode(array(
						"status" => 0,
						'message' => "Error - APP or İd FAil!"

					));

				}



			}catch(Exception $ex){

				http_response_code(500);
				echo json_encode(array(
					"status" => 0,
					'message' => $ex->getMessage()

				));

			}



		}


	}


}



?>