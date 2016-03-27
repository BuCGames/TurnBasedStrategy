<?php

class Response {
	public $code;
	public $message;
}


function res ($code,$message)
{
	$response = new Response;
	$response->code = $code;
	$response->message = $message;
	
	return $response;
}


const CODE_ALREADY_REGISTERED=0;
const CODE_INVALID_DATA=1;
const CODE_SUCCESS=2;


session_start();
if (isset($_SESSION['username'])) {
		$response = res(CODE_ALREADY_REGISTERED, 'sesja trwa');
} else {
	if (isset($_POST['username']) and $_POST['username'] != '') {
		$_SESSION['username'] = $_POST['username'];
		$response = res(CODE_SUCCESS, 'pomyslnie zalogowano');
	
	} else {
	$response = res(CODE_INVALID_DATA, 'wprowadz poprawne dane');
	}
}

echo json_encode ($response);




//$_POST



//username

/*koles wprowadza dane
sprawdzam czy sesja trwa
if tak to error, zwroc
in nie to zarejestroj, dodaj do bazy, zwroc 
*/