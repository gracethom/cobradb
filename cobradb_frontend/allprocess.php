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

$letter_title = $_POST['letter_title'];
$salutation = $_POST['salutation'];
$closing = $_POST['closing'];
$letter_text = $_POST['letter_text'];
$letter_pg_title = $_POST['letter_pg_title'];

$review_title = $_POST['review_title'];
$review_text = $_POST['review_text'];

$contest_name = $_POST['contest_name'];
$contest_desc = $_POST['contest_desc'];
$contest_aff = $_POST['contest_aff'];

$club_name = $_POST['club_name'];
$club_abbr = $_POST['club_abbr'];
$club_aff = $_POST['club_aff'];

$mtg_name = $_POST['mtg_name'];


$classified_title = $_POST['classified_title'];
$classified_info = $_POST['classified_info'];

$penpals_title = $_POST['penpals_title'];
$penpals_desc = $_POST['penpals_desc'];

$traces_column_title = $_POST['traces_column_title'];
$traces_desc = $_POST['traces_desc'];

$source_name = $_POST['source_type'];
$gcd_link = $_POST['gcd_link'];
$series_name = $_POST['series_name'];
$issue_num = $_POST['issue_num'];
$date = $_POST['date'];
$page_num = $_POST['page_num'];

$mention_col_title = $_POST['mention_col_title'];
$mention_desc = $_POST['mention_desc'];





$blank = NULL;


$sql1 = "INSERT INTO person_dim (surname, forename, pers_title, pers_role, alt_name, birth_year, byear_source, grade, race, ethnicity, sex, gender, occupation, occu_source) VALUES ('$surname','$forename','$pers_title','$role','$alt_name','$birth_year','$byear_source','$grade','$race','$ethnicity','$sex','$gender','$occupation','$occu_source')";

$sql2 = "INSERT INTO location_dim (street, city, state, country, zip_code) VALUES ('$street', '$city', '$state', '$country', '$zipcode')";

$sql3 = "INSERT INTO letter_dim (letter_title, salutation, closing, letter_text, letter_pg_title) VALUES ('$letter_title', '$salutation', '$closing', '$letter_text', '$letter_pg_title')";



$sql4 = "INSERT INTO review_dim (review_title, review_text) VALUES ('$review_title', '$review_text')";

$sql5 = "INSERT INTO contest_dim (contest_name, contest_desc, contest_affiliation) VALUES ('$contest_name', '$contest_desc', '$contest_aff')";

$sql6 = "INSERT INTO club_dim (fan_club_name, fan_club_abbr, club_association) VALUES ('$club_name', '$club_abbr', '$club_aff')";


$sql7 = "INSERT INTO meeting_dim (mtg_name) VALUES ('$mtg_name')";


$sql8 = "INSERT INTO classified_dim (classified_title, classified_info) VALUES ('$classified_title', '$classified_info')";



$sql9 = "INSERT INTO pen_pals_dim (column_title, penpals_desc) VALUES ('$penpals_title', '$penpals_desc')";


$sql10 = "INSERT INTO traces_dim (traces_col_title, traces_desc) VALUES ('$traces_column_title', '$traces_desc')";



$sql11 = "INSERT INTO source_dim (source_type, GCD_link, series_name, issue_number, pub_date, page_num) VALUES ('$source_type', '$gcd_link', '$series_name', '$issue_num', '$date', '$page_num')";


$sql12 = "INSERT INTO mention_dim (mention_col_title, mention_desc) VALUES ('$mention_col_title', '$mention_desc')";



if (!mysql_query($sql1)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql2)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql3)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql4)) {
	die('Error: ' . mysql_error());
}
if (!mysql_query($sql5)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql6)) {
	die('Error: ' . mysql_error());
}
if (!mysql_query($sql7)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql8)) {
	die('Error: ' . mysql_error());
}
if (!mysql_query($sql9)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql10)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql11)) {
	die('Error: ' . mysql_error());
}

if (!mysql_query($sql12)) {
	die('Error: ' . mysql_error());
}

mysql_close();
?>