<?php

require_once('config.php');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) {
	die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}

$pers_auth = $_POST['pers_auth'];
$surname = $_POST['surname'];
$forename = $_POST['forename'];
$pers_title = $_POST['pers_title'];
$role = $_POST['role'];
$alt_name = $_POST['alt_name'];
$birth_year = $_POST['birth_year'];
$byear_source = $_POST['byear_source'];
$grade = $_POST['grade'];
$race = $_POST['race'];
$ethnicity = $_POST['ethnicity'];
$sex = $_POST['sex'];
$gender = $_POST['gender'];
$occupation = $_POST['occupation'];
$occu_source = $_POST['occu_source'];


$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$postal_code = $_POST['postal_code'];

$letter_pg_title = $_POST['letter_pg_title'];
$letter_text = $_POST['letter_text'];

$source_type = $_POST['source_type'];
$gcd_link = $_POST['gcd_link'];
$series_title = $_POST['series_title'];
$issue_num = $_POST['issue_num'];
$pub_date = $_POST['pub_date'];
$page_num = $_POST['page_num'];

$loc_name = $_POST['loc_name'];
$loc_phone = $_POST['loc_phone'];
$loc_street = $_POST['loc_street'];
$loc_city = $_POST['loc_city'];
$loc_state = $_POST['loc_state'];
$loc_country = $_POST['loc_country'];
$loc_postal_code = $_POST['loc_postal_code'];





$sql1 = "INSERT INTO person_dim (pers_auth, surname, forename, pers_title, pers_role, alt_name, birth_year, byear_source, grade, race, ethnicity, sex, gender, occupation, occu_source) VALUES ('$pers_auth', '$surname','$forename','$pers_title','$role','$alt_name','$birth_year','$byear_source','$grade','$race','$ethnicity','$sex','$gender','$occupation','$occu_source')";

$sql2 = "INSERT INTO location_dim (street, city, state, country, postal_code) VALUES ('$street', '$city', '$state', '$country', '$postal_code')";

$sql3 = "INSERT INTO letter_dim (letter_pg_title, letter_text) VALUES ('$letter_pg_title', '$letter_text')";


$sql11 = "INSERT INTO source_dim (source_type, GCD_link, series_title, issue_number, pub_date, page_num) VALUES ('$source_type', '$gcd_link', '$series_title', '$issue_num', '$pub_date', '$page_num')";

$sql13 = "INSERT INTO phys_loc (phys_loc_name, phys_loc_phone) AND location_dim (street, city, state, country, postal_code) VALUES ('$loc_name', '$loc_phone', '$loc_street', '$loc_city', '$loc_state', '$loc_country', '$loc_postal_code')";







if (!mysql_query($sql1)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql2)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql3)) {
	die('Error: ' . mysql_error());
}


if (!mysql_query($sql11)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql13)) {
	die('Error: ' . mysql_error());
}

mysql_close();
?>

