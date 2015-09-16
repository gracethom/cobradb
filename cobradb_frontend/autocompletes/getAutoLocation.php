<?php
require_once('config.php');

function connectRW(){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

if(isset($_GET['term'])){
    
    $mysqliConnection = connectRW();
 
    $term='%' . $_GET['term'] . '%';
 
    $sqlAutoName = "SELECT id_location_dim, street, city, state, country 
 FROM location_dim
 WHERE street LIKE ? OR city LIKE ? OR state LIKE ? OR country LIKE ?";
    
    $json = array();

    $mysqliConnection = connectRW(); 

    if($stmt = mysqli_prepare( $mysqliConnection, $sqlAutoName)){ 
        $stmt->bind_param("ssss", $term, $term, $term, $term); 
        $stmt->execute(); 
        $stmt->bind_result($id_location_dim, $street, $city, $state, $country); 
        while (mysqli_stmt_fetch($stmt)) { 
            $label = $street . ', ' . $city . ', ' . $state . ' - ' . $country;
            $json[] = array( 'value' => $id_location_dim, 'label' => $label );
        } 
        mysqli_stmt_close($stmt); 
        $mysqliConnection->close();
    }
    
 echo json_encode($json);
    
}

?>