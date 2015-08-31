<?php

require_once('config.php');

if(isset($_POST['classified_title'])
   && isset($_POST['classified_notes'])
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

$classified_title = $_POST['classified_title']; 
$classified_notes = $_POST['classified_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlClassified = "INSERT INTO classified_dim (classified_title, classified_notes) VALUES (?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_classified) VALUES (?,?,?,?,?)";



    // ids for dim tables
$classifiedId = null;
$activityId = null;


    
 //insert values   
    
if($stmtClassified = mysqli_prepare( $mysqliConnection, $sqlClassified)){
    $stmtClassified->bind_param("ss", classified_title, classified_notes);
    $stmtClassified->execute();
    $classifiedId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtClassified);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $classifiedId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
    $mysqliConnection->close();

    

//Output the id of person just added

if($activityId){
echo "Success! <a href='" . $link_address."'>Add another activity record</a>";
}

    
}
?>