<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('test.db');
      }
   }
   
session_start();
   dump ($_SESSION);
   //FUNKCA DUMP
   {function dump ($var)
   {
   echo '<pre>';
   var_dump ($var);
   echo '</pre>';
	   
   }}
	
	//MAPA
	/*
   CONST ZIEMIA = 'X';
   CONST WODA = 'O';
   
   $mapa = [
	 [ZIEMIA, ZIEMIA, ZIEMIA, WODA],
	 [ZIEMIA, ZIEMIA, WODA, WODA],
	 [ZIEMIA, WODA, WODA, WODA],
	 [ZIEMIA, ZIEMIA, WODA, WODA],
   ];
   
   foreach($mapa as $x) {
	   foreach($x as $y) {
		   echo $y;
	   }
	   echo '<br>';
   }
   
   echo json_encode($mapa);
   
   dump($mapa);} 
   */
   
	//OTWARCIE BAZY DANYCH
	/*
	
   {session_start();
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   } }*/
	
	// SZTYWNE WYSWIETLENIE BAZY DANYCH
	/*
  {dump ($GLOBALS);
   
  $sql =<<<EOF
      SELECT * from COMPANY;
EOF;

   $ret = $db->query($sql);
    dump ($ret->fetchArray(SQLITE3_ASSOC));
    dump ($ret->fetchArray(SQLITE3_ASSOC));
	dump ($ret->fetchArray(SQLITE3_ASSOC));
	dump ($ret->fetchArray(SQLITE3_ASSOC));
  
   
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      echo "ID = ". $row['ID'] . "\n";
      echo "NAME = ". $row['NAME'] ."\n";
      echo "ADDRESS = ". $row['ADDRESS'] ."\n";
      echo "SALARY =  ".$row['SALARY'] ."\n\n";
   }
   echo "Operation done successfully\n";
   $db->close();
   
  }*/
   
   //SZTYWNE PODANIE NAZWY UZYTKOWNIKA
   {
   $_SESSION['message']='k';
	if (isset($_GET['name'])) {
		$_SESSION['username'] = $_GET['name'];
	}
   dump ($_SESSION);
   
   }