<?php

require_once('config.php');

if(isset($_POST['fan_club_name'])
   && isset($_POST['fan_club_abbr'])
   && isset($_POST['fan_club_assoc'])
   && isset($_POST['fan_club_notes'])
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

$fan_club_name = $_POST['fan_club_name']; 
$fan_club_abbr = $_POST['fan_club_abbr'];
$fan_club_assoc = $_POST['fan_club_assoc'];
$fan_club_notes = $_POST['fan_club_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlClub = "INSERT INTO club_dim (fan_club_name, fan_club_abbr, fan_club_assoc, fan_club_notes) VALUES (?,?,?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_club) VALUES (?,?,?,?,?)";



    // ids for dim tables
$clubId = null;
$activityId = null;


    
 //insert values   
    
if($stmtClub = mysqli_prepare( $mysqliConnection, $sqlClub)){
    $stmtClub->bind_param("ssss", $fan_club_name, $fan_club_abbr, $fan_club_assoc, $fan_club_notes);
    $stmtClub->execute();
    $clubId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtClub);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $clubId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
    $mysqliConnection->close();

    

//Output the id of person just added

if($clubId){
    echo $clubId;   
}
    
if($activityId){
    echo $activityId;   
}

    
}
?>