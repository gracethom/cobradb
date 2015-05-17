<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
require_once 'config.php';


if($_GET['type'] == 'person_name'){
	$row_num = $_GET['row_num'];
	$result = mysql_query("SELECT surname, forename FROM person_dim where name LIKE '".strtoupper($_GET['name_startsWith'])."%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		$name = $row['surname'].'|'.$row['forename'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
}



?>