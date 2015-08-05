<?php

require_once('config.php');

if(isset($_POST['review_title'])
   && isset($_POST['review_text'])
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

$review_title = $_POST['review_title']; 
$review_text = $_POST['review_text'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];


    //sql statements
$sqlReview = "INSERT INTO review_dim (review_title, review_text) VALUES (?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_review) VALUES (?,?,?,?,?)";



    // ids for dim tables
$reviewId = null;
$activityId = null;


    
 //insert values 
    
if($stmtReview = mysqli_prepare( $mysqliConnection, $sqlReview)){
    $stmtReview->bind_param("ss", $review_title, $review_text);
    $stmtReview->execute();
    $reviewId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtReview);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $reviewId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
    $mysqliConnection->close();

    

//Output the id of person just added

if($reviewId){
    echo $reviewId;   
}
    
if($activityId){
    echo $activityId;   
}

    
}
?>