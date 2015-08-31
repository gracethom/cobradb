<?php

require_once('config.php');

if(isset($_POST['letter_pg_title'])
   && isset($_POST['letter_text'])
   && isset($_POST['selectedPerson'])
   && isset($_POST['selectedLocation'])
   && isset($_POST['selectedSource'])
   && isset($_POST['selectedPhysLoc'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

$letter_pg_title = $_POST['letter_pg_title']; 
$letter_text = $_POST['letter_text'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlLetter = "INSERT INTO letter_dim (letter_pg_title, letter_text) VALUES (?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_letter) VALUES (?,?,?,?,?)";



    // ids for dim tables
$letterId = null;
$activityId = null;


    
 //insert values   
    
if($stmtLetter = mysqli_prepare( $mysqliConnection, $sqlLetter)){
    $stmtLetter->bind_param("ss", $letter_pg_title, $letter_text);
    $stmtLetter->execute();
    $letterId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtLetter);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $letterId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
    $mysqliConnection->close();

$link_address = 'http://localhost/cobradb_copy/index.php';

//Output the id of person just added
if($activityId){
echo "Success! <a href='" . $link_address."'><button>Add another activity record</button></a>";
}
    
}
?>