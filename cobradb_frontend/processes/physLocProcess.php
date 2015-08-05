<?php

require_once('config.php');

if(isset($_POST['loc_name'])
   && isset($_POST['street'])
   && isset($_POST['city'])
   && isset($_POST['state'])
   && isset($_POST['country'])
   && isset($_POST['postal_code'])
   && isset($_POST['phone'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$postal_code = $_POST['postal_code'];


    //sql statement
$sqlLocation = "INSERT INTO location_dim (loc_name, street, city, state, country, postal_code, phone) VALUES (?,?,?,?,?,?,?)";
    

    // id for location record
$locationId = null;

 //insert values into location, occu_dim, grade_dim, sex_dim, gender_dim   
    
if($stmtPerson = mysqli_prepare( $mysqliConnection, $sqlLocation)){
    $stmtPerson->bind_param("sssss", $loc_name, $street, $city, $state, $country, $postal_code, $phone);
    $stmtPerson->execute();
    $locationId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtPerson);
    $mysqliConnection->close();
}
    

//Output the id of location just added

if($locationId){
    echo $locationId;   
}

    
}
?>