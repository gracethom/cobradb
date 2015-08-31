<?php

require_once('config.php');

if(isset($_POST['contest_name'])
   && isset($_POST['contest_assoc'])
   && isset($_POST['contest_notes'])
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

$contest_name = $_POST['contest_name']; 
$contest_assoc = $_POST['contest_assoc'];
$contest_notes = $_POST['contest_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlContest = "INSERT INTO contest_dim (contest_name, contest_assoc, contest_notes) VALUES (?,?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_contest) VALUES (?,?,?,?,?)";



    // ids for dim tables
$contestId = null;
$activityId = null;


    
 //insert values   
    
if($stmtContest = mysqli_prepare( $mysqliConnection, $sqlContest)){
    $stmtContest->bind_param("sss", $contest_name, $contest_assoc, $contest_notes);
    $stmtContest->execute();
    $contestId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtContest);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $contestId);
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