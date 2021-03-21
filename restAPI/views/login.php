
<?php 
header("Acces-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");



if ($_SERVER["REQUEST_METHOD"] === "POST") {



	http_response_code(200);
	echo json_encode(array(

		"status" => 1,
		"jwt" => $data,
		"message" => "Succesful"

	));

}else {


	http_response_code(503);
	echo json_encode(array(
		"status" => 0,
		'message' => "Error - Acces!"

	));
}

?>