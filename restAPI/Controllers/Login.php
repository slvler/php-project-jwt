<?php 


use \Firebase\JWT\JWT;
use \Def\C\Control;


require_once  __DIR__ . '/../Control.php';

class Login extends Control
{

	public function Vt()
	{
		
		$vt =$this->Database("Database","localhost","stable","root","");
		$db = $vt->connect();

		return $db;

	}

	public function index()
	{
		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "login";
		$users = $this->model("UserModel",$db,$table_name);


		$data = json_decode(file_get_contents("php://input"));

		if (!empty($data->email) && !empty($data->password) && !empty($data->apikey)) {

			$email = temizle($data->email);
			$pass = temizle($data->password);
			$apikey = temizle($data->apikey);


			$sifre = sha1($pass);

			$res = $users->login_check($email,$sifre,$apikey);


			if (!empty($res)) {

				$iss = "localhost";
				$iat = time();
				$nbf = $iat + 10;
				$exp = $iat + 60*60;
				$aud  = "mylogin";
				$login_arr = array(
					"id" =>  $res["login_id"],
					"email" =>  $res["login_email"],
					"myapikey" =>   $res["login_apikey"]
				);

				$key = "stableDeneme";
				$veri = array(
					"iss" => $iss,
					"iat" => $iat,
					"nbf" => $nbf,
					"exp" => $exp,
					"aud" => $aud,
					"data" => $login_arr

				);


				$jwt = JWT::encode($veri, $key, 'HS256');

				$this->view('login',$jwt);

			}else{

				http_response_code(500);
				echo json_encode(array(
					"status" => 0,
					'message' => "Error - Login Fail!"

				));

			}



		}else{

			http_response_code(500);
			echo json_encode(array(
				"status" => 0,
				'message' => "Error - Empty!"

			));

		}

	}


	public function all()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "login";
		$users = $this->model("UserModel",$db,$table_name);

		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->myapi) && !empty($data->secret)) {

			try{

				$jwt = $headers["Authorization"];
				$key = temizle($data->secret);
				$myapp = temizle($data->myapi);


				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;

				$result = $users->apikey_check($gelenid,$myapp);

				if (!empty($result)) {

					$veri = $users->user_all_list();

					$this->view('login-list',$veri);


				}else {

					http_response_code(404);
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

		}else{

			http_response_code(404);
			echo json_encode(array(
				"status" => 0,
				'message' => "Error - Acces"

			));

		}

	}

	public function single()
	{
		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "login";
		$users = $this->model("UserModel",$db,$table_name);

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

				$result = $users->apikey_check($gelenid,$myapp);

				if (!empty($result)) {

					$veri = $users->single_list($id);

					if (!empty($veri)) {
						$this->view('login-single',$veri);
						
					}else{

						http_response_code(404);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Empty User"

						));

					}


				}else {

					http_response_code(404);
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

	public function register()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "login";
		$users = $this->model("UserModel",$db,$table_name);

		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->email) && !empty($data->password) && !empty($data->apikey) && !empty($data->status) && !empty($data->myapi) && !empty($data->secret)) {

			try {
				$jwt = $headers["Authorization"];
				$key = $data->secret;
				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;


				$email = temizle($data->email);
				$password = temizle($data->password);
				$apikey = temizle($data->apikey);
				$status = temizle($data->status);
				$myapi = temizle($data->myapi);

				$sss = sha1($password);
				$return = $users->apikey_check($gelenid,$myapi);

				if (!empty($return)) {

					$kayit = $users->email_check($email,$apikey);
					if (!empty($kayit)) {

						$result = $users->register($email,$sss,$apikey,$status);

						if ($result) {

							$this->view('login-create');

						}else {

							http_response_code(404);
							echo json_encode(array(
								"status" => 0,
								'message' => "Error - Register Fail!"

							));

						}

					}else{


						http_response_code(500);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Register Mail Or Apikey"

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

	public function update()
	{

		$this->helpers("tool");

		$db = $this->vt();
		$table_name = "login";
		$users = $this->model("UserModel",$db,$table_name);

		$data = json_decode(file_get_contents("php://input"));

		$headers = getallheaders();


		if (!empty($data->id) && !empty($data->email) && !empty($data->password) && !empty($data->apikey) && !empty($data->status) && !empty($data->myapi) && !empty($data->secret)) {

			try {
				$jwt = $headers["Authorization"];
				$key = $data->secret;
				$veri = JWT::decode($jwt, $key, array('HS256'));
				$gelenid =  $veri->data->id;


				$id = temizle($data->id);
				$email = temizle($data->email);
				$password = temizle($data->password);
				$apikey = temizle($data->apikey);
				$status = temizle($data->status);
				$myapi = temizle($data->myapi);

				$sss = sha1($password);
				$return = $users->apikey_check($gelenid,$myapi);

				if (!empty($return)) {

					$kayit = $users->email_check($email,$apikey);
					if (!empty($kayit)) {

						$result = $users->update($email,$sss,$apikey,$status,$id);

						if ($result) {

							$this->view('login-update');

						}else {

							http_response_code(404);
							echo json_encode(array(
								"status" => 0,
								'message' => "Error - Register Fail!"

							));

						}

					}else{


						http_response_code(500);
						echo json_encode(array(
							"status" => 0,
							'message' => "Error - Register Mail Or Apikey"

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
		$table_name = "login";
		$users = $this->model("UserModel",$db,$table_name);

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

				$result = $users->apikey_check($gelenid,$myapp);

				if (!empty($result)) {

					$veri = $users->delete($id);

					if (!empty($veri)) {

						$this->view("login-delete");


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