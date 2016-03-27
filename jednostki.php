<?php

session_start();

class UnitsDB extends SQLite3{
	function __construct()
	{
		$this->open('Units.db');		 
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

$db = new UnitsDB();

 if(!$db->checkIfTableExists('units')) {     //jednostki
 
    $sql = 'CREATE TABLE uunits'
		. '( '
		. 'id			INTEGER  PRIMARY KEY AUTOINCREMENT	NOT NULL, '    //jednostki
		. 'session_id  	STRING    							NOT NULL, '    //jednostki
		. 'username 	STRING     							NOT NULL, '		//jednostki
		. 'created_at 	STRING 					  				  '			//jednostki
		. ')';

	$db->exec($sql);
}

/*             //caly iff
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

*/

echo json_encode ($response);