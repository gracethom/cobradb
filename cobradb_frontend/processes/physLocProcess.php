<?php

require_once('config.php');

if(isset($_POST['loc_name'])
   && isset($_POST['phone'])
   && isset($_POST['repository'])
   && isset($_POST['coll_name'])
   && isset($_POST['coll_num'])
   && isset($_POST['street'])
   && isset($_POST['city'])
   && isset($_POST['state'])
   && isset($_POST['country'])
   && isset($_POST['postal_code'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();


$loc_name = $_POST['loc_name'];
$phone = $_POST['phone'];
$repository = $_POST['repository'];
$coll_name = $_POST['coll_name'];
$coll_num = $_POST['coll_num'];
    
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$postal_code = $_POST['postal_code'];


    //sql statement
$sqlLocation = "INSERT INTO location_dim (street, city, state, country, postal_code) VALUES (?,?,?,?,?)";
    
$sqlPhysLoc = "INSERT INTO phys_loc_dim (phys_loc_name, phone, repository, coll_name, coll_num, id_location_dim) VALUES (?,?,?,?,?,?)";
    

    // id for location record
$locationId = null;
$physLocId = null;

    
if($stmtLocation = mysqli_prepare( $mysqliConnection, $sqlLocation)){
    $stmtLocation->bind_param("sssss", $street, $city, $state, $country, $postal_code);
    $stmtLocation->execute();
    $locationId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtLocation);
}

if($stmtPhysLoc = mysqli_prepare( $mysqliConnection, $sqlPhysLoc)){
    $stmtPhysLoc->bind_param("ssssss", $loc_name, $phone, $repository, $coll_name, $coll_num, $locationId);
    $stmtPhysLoc->execute();
    $physLocId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtPhysLoc);
}



$mysqliConnection->close();
    

//Output the id of location just added

if($locationId){
    echo $locationId;   
}

if($physLocId){
    echo $physLocId;   
}

}

?>