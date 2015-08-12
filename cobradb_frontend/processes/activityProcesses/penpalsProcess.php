<?php

require_once('config.php');

if(isset($_POST['penpals_title'])
   && isset($_POST['penpals_notes'])
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

$penpals_title = $_POST['penpals_title']; 
$penpals_notes = $_POST['penpals_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlPenPals = "INSERT INTO pen_pals_dim (penpals_title, penpals_notes) VALUES (?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_pen_pals) VALUES (?,?,?,?,?)";



    // ids for dim tables
$penpalsId = null;
$activityId = null;


    
 //insert values   
    
if($stmtPenPals = mysqli_prepare( $mysqliConnection, $sqlPenPals)){
    $stmtPenPals->bind_param("ss", $penpals_title, $penpals_notes);
    $stmtPenPals->execute();
    $penpalsId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtPenPals);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $penpalsId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
    $mysqliConnection->close();

    

//Output the id of person just added

if($penpalsId){
    echo $penpalsId;   
}
    
if($activityId){
    echo $activityId;   
}

    
}
?>