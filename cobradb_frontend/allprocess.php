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

$review_title = $_POST['review_title'];
$review_text = $_POST['review_text'];

$contest_name = $_POST['contest_name'];
$contest_aff = $_POST['contest_assoc'];
$contest_desc = $_POST['contest_desc'];


$fan_club_name = $_POST['fan_club_name'];
$fan_club_abbr = $_POST['fan_club_abbr'];
$fan_club_aff = $_POST['fan_club_assoc'];
$fan_club_notes = $_POST['fan_club_notes'];

$mtg_name = $_POST['mtg_name'];
$mtg_start = $_POST['mtg_start'];
$mtg_end = $_POST['mtg_end'];
$mtg_notes = $_POST['mtg_notes'];

$mention_col_title = $_POST['mention_col_title'];
$mention_desc = $_POST['mention_desc'];
$mention_notes = $_POST['mention_notes'];

$classified_title = $_POST['classified_title'];
$classified_notes = $_POST['classified_notes'];

$penpals_title = $_POST['penpals_title'];
$penpals_notes = $_POST['penpals_notes'];

$traces_col_title = $_POST['traces_col_title'];
$traces_notes = $_POST['traces_notes'];

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







$blank = NULL;


$sql1 = "INSERT INTO person_dim (pers_auth, surname, forename, pers_title, pers_role, alt_name, birth_year, byear_source, grade, race, ethnicity, sex, gender, occupation, occu_source) VALUES ('$pers_auth', '$surname','$forename','$pers_title','$role','$alt_name','$birth_year','$byear_source','$grade','$race','$ethnicity','$sex','$gender','$occupation','$occu_source')";

$sql2 = "INSERT INTO location_dim (street, city, state, country, postal_code) VALUES ('$street', '$city', '$state', '$country', '$postal_code')";

$sql3 = "INSERT INTO letter_dim (letter_pg_title, letter_text) VALUES ('$letter_pg_title', '$letter_text')";



$sql4 = "INSERT INTO review_dim (review_title, review_text) VALUES ('$review_title', '$review_text')";

$sql5 = "INSERT INTO contest_dim (contest_name, contest_assoc, contest_desc) VALUES ('$contest_name', '$contest_assoc', '$contest_desc')";

$sql6 = "INSERT INTO club_dim (fan_club_name, fan_club_abbr, fan_club_assoc, fan_club_notes) VALUES ('$fan_club_name', '$fan_club_abbr', '$fan_club_assoc', '$fan_club_notes')";


$sql7 = "INSERT INTO meeting_dim (mtg_name, mtg_start, mtg_end, mtg_notes) VALUES ('$mtg_name', '$mtg_start', '$mtg_end', '$mtg_notes')";


$sql8 = "INSERT INTO classified_dim (classified_title, classified_notes) VALUES ('$classified_title', '$classified_notes')";



$sql9 = "INSERT INTO pen_pals_dim (penpals_title, penpals_notes) VALUES ('$penpals_title', '$penpals_notes')";


$sql10 = "INSERT INTO traces_dim (traces_col_title, traces_notes) VALUES ('$traces_col_title', '$traces_notes')";



$sql11 = "INSERT INTO source_dim (source_type, GCD_link, series_title, issue_number, pub_date, page_num) VALUES ('$source_type', '$gcd_link', '$series_title', '$issue_num', '$pub_date', '$page_num')";


$sql12 = "INSERT INTO mention_dim (mention_col_title, mention_desc, mention_notes) VALUES ('$mention_col_title', '$mention_desc', '$mention_notes')";

$sql13 = "INSERT INTO phys_loc (phys_loc_name, phys_loc_phone) AND location_dim (street, city, state, country, postal_code) VALUES ('$loc_name', '$loc_phone', '$loc_street', '$loc_city', '$loc_state', '$loc_country', '$loc_postal_code')";
// break into two separate insert statements? Change in processLetter.php also


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

if (!mysql_query($sql13)) {
	die('Error: ' . mysql_error());
}

mysql_close();
?>