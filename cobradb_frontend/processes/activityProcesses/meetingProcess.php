<?php

require_once('config.php');

if(isset($_POST['mtg_name'])
   && isset($_POST['mtg_start'])
   && isset($_POST['mtg_end'])
   && isset($_POST['mtg_notes'])
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

$mtg_name = $_POST['mtg_name']; 
$mtg_start = $_POST['mtg_start'];
$mtg_end = $_POST['mtg_end'];
$mtg_notes = $_POST['mtg_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlMeeting = "INSERT INTO meeting_dim (mtg_name, mtg_start, mtg_end, mtg_notes) VALUES (?,?,?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_meeting) VALUES (?,?,?,?,?)";



    // ids for dim tables
$meetingId = null;
$activityId = null;


    
 //insert values   
    
if($stmtMeeting = mysqli_prepare( $mysqliConnection, $sqlMeeting)){
    $stmtMeeting->bind_param("ssss", $mtg_name, $mtg_start, $mtg_end, $mtg_notes);
    $stmtMeeting->execute();
    $meetingId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtMeeting);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $meetingId);
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