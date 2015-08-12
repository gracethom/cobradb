<?php

require_once('config.php');

if(isset($_POST['mention_col_title'])
   && isset($_POST['mention_desc'])
   && isset($_POST['mention_notes'])
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

$mention_col_title = $_POST['mention_col_title']; 
$mention_desc = $_POST['mention_desc'];
$mention_notes = $_POST['mention_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements 
$sqlMention = "INSERT INTO mention_dim (mention_col_title, mention_desc, mention_notes) VALUES (?,?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_mention) VALUES (?,?,?,?,?)";



    // ids for dim tables
$mentionId = null;
$activityId = null;


    
 //insert values   
    
if($stmtMention = mysqli_prepare( $mysqliConnection, $sqlMention)){
    $stmtMention->bind_param("sss", $mention_col_title, $mention_desc, $mention_notes);
    $stmtMention->execute();
    $mentionId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtMention);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $mentionId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
    $mysqliConnection->close();

    

//Output the id of person just added

if($mentionId){
    echo $mentionId;   
}
    
if($activityId){
    echo $activityId;   
}

    
}
?>