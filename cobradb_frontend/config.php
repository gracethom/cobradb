<?php
/*Configuration Settings*/

/*MySQL Settings*/
/*Database name*/
define('DB_NAME', 'cobra');

/*Database user*/
define('DB_USER', 'grace');

/*Database user password*/
define('DB_PASSWORD', 'gracie');




/*Database host*/
define('DB_HOST', 'localhost');

/*Database character set*/
define('DB_CHARSET', 'utf8');

/*Database collation*/
define('DB_COLLATE', '');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>
