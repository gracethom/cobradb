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
$zipcode = $_POST['zipcode'];

$review_title = $_POST['review_title'];
$review_text = $_POST['review_text'];

$source_name = $_POST['source_type'];
$gcd_link = $_POST['gcd_link'];
$date = $_POST['date'];
$issue_num = $_POST['issue_num'];
$series_name = $_POST['series_name'];





$sql1 = "INSERT INTO person_dim (surname, forename, pers_title, pers_role, alt_name, birth_year, byear_source, grade, race, ethnicity, sex, gender, occupation, occu_source) VALUES ('$surname','$forename','$pers_title','$role','$alt_name','$birth_year','$byear_source','$grade','$race','$ethnicity','$sex','$gender','$occupation','$occu_source')";

$sql2 = "INSERT INTO location_dim (street, city, state, country, zip_code) VALUES ('$street', '$city', '$state', '$country', '$zipcode')";

$sql4 = "INSERT INTO review_dim (review_title, review_text) VALUES ('$review_title', '$review_text')";


$sql11 = "INSERT INTO source_dim (source_type, GCD_link, pub_date, issue_number, series_name) VALUES ('$source_type', '$gcd_link', '$date', '$issue_num', '$series_name')";




if (!mysql_query($sql1)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql2)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql4)) {
	die('Error: ' . mysql_error());
}


if (!mysql_query($sql11)) {
	die('Error: ' . mysql_error());
}

mysql_close();
?>

