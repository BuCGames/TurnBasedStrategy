<?php

const CODE_ALREADY_REGISTERED=0;
const CODE_INVALID_DATA=1;
const CODE_SUCCESS=2;

session_start();

class AppDB extends SQLite3
{
	function __construct()
	{
		$this->open('app.db');
	}

	function checkIfTableExists($tableName)
	{
		$result = $this->query(
			'SELECT name '
			. 'FROM sqlite_master '
			. 'WHERE type="table" '
			. 'AND name = \'' . $tableName . '\'')
			->fetchArray(SQLITE3_ASSOC)
		;


		if ($result === false) {
			return false;
		}

		return true;
	}


}
class Response {
	public $code;
	public $message;

	public function __construct($code,$message)
	{
		$this->code = $code;
		$this->message = $message;
	}
}

$db = new AppDB();

 if(!$db->checkIfTableExists('users')) {
    $sql = 'CREATE TABLE users '
		. '( '
		. 'id			INTEGER  PRIMARY KEY AUTOINCREMENT	NOT NULL, '
		. 'session_id  	STRING    							NOT NULL, '
		. 'username 	STRING     							NOT NULL, '
		. 'created_at 	STRING 					  				  '
		. ')';

	$db->exec($sql);
}

$username = 'Kornel';
$sessionId = 'asdasdasdasdasdasd';


$sql = 'INSERT INTO users (session_id,username,created_at)'
  . 'VALUES ('
	  . '\'' . session_id() . '\','
	  . '\''. $username . '\','
	  . '\'' . $dateString . '\''
  . ')';


 /*
$query = $db->query('SELECT * FROM users');

while($row = $query->fetchArray(SQLITE3_ASSOC) ){
      echo "id = ". $row['id'] . '<br>';
      echo "session_id = ". $row['session_id'] .'<br>';
      echo "username = ". $row['username'] .'<br>';
      echo "created_at =  ".$row['created_at'] .'<br>';
	  echo '<hr>';
}

$db->close();
die;
*/



if (isset($_SESSION['username'])) {
	$response = new Response(CODE_ALREADY_REGISTERED, 'sesja trwa');
} else {
	if (isset($_POST['username']) and $_POST['username'] != '') {
		$_SESSION['username'] = $_POST['username'];
		$response = new Response(CODE_SUCCESS, 'pomyslnie zalogowano');

		$now = new DateTime();
		$dateString = $now->format('Y-m-d H:i:s');
		$sql = 'INSERT INTO users (session_id,username,created_at)'
		  . 'VALUES ('
			  . '\'' . session_id() . '\','
			  . '\''. $_POST['username'] . '\','
			  . '\'' . $dateString . '\''
		  . ')';

		$db->exec($sql);

	} else {
		$response = new Response(CODE_INVALID_DATA, 'wprowadz poprawne dane');
	}
}

echo json_encode ($response);
