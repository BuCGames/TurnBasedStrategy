<?php
   {function dump ($var)
   {
   echo '<pre>';
   var_dump ($var);
   echo '</pre>';
	   
   }}
   
   CONST ZIEMIA = 1;
   CONST WODA = 0;
   
   $mapa = [
	 [WODA, WODA, 	WODA, WODA],
	 [ZIEMIA, ZIEMIA, 	WODA, 	WODA],
	 [ZIEMIA, WODA,		WODA, 	WODA],
	 [ZIEMIA, ZIEMIA, 	WODA, 	WODA],
   ];
   
 
   echo json_encode($mapa);
   //TEST POLA
   //echo $mapa[3][1];
  