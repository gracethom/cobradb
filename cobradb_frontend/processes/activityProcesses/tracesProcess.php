<?php

require_once('config.php');

if(isset($_POST['traces_col_title'])
   && isset($_POST['traces_notes'])
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

$traces_col_title = $_POST['traces_col_title']; 
$traces_notes = $_POST['traces_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlTraces = "INSERT INTO traces_dim (traces_col_title, traces_notes) VALUES (?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_traces) VALUES (?,?,?,?,?)";



    // ids for dim tables
$tracesId = null;
$activityId = null;


    
 //insert values   
    
if($stmtTraces = mysqli_prepare( $mysqliConnection, $sqlTraces)){
    $stmtTraces->bind_param("ss", $traces_col_title, $traces_notes);
    $stmtTraces->execute();
    $tracesId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtTraces);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $tracesId);
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