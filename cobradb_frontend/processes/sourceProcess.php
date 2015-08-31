<?php

require_once('config.php');

if(isset($_POST['source_type'])
   && isset($_POST['gcd_link'])
   && isset($_POST['series_title'])
   && isset($_POST['issue_num'])
   && isset($_POST['pub_date'])
   && isset($_POST['page_num'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

$source_type = $_POST['source_type'];
$gcd_link = $_POST['gcd_link'];
$series_title = $_POST['series_title'];
$issue_num = $_POST['issue_num'];
$pub_date = $_POST['pub_date'];
$page_num = $_POST['page_num'];


    //sql statement
$sqlSource = "INSERT INTO source_dim (source_type, gcd_link, series_title, issue_number, pub_date, page_num) VALUES (?,?,?,?,?,?)";
    

    // id for location record
$sourceId = null;

 //insert values into location, occu_dim, grade_dim, sex_dim, gender_dim   
    
if($stmtSource = mysqli_prepare( $mysqliConnection, $sqlSource)){
    $stmtSource->bind_param("ssssss", $source_type, $gcd_link, $series_title, $issue_num, $pub_date, $page_num);
    $stmtSource->execute();
    $sourceId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtSource);
    $mysqliConnection->close();
}
    

//Output the id of location just added

if($sourceId){
    echo $sourceId;   
}

    
}
?>