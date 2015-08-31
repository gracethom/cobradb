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
 
    $term=$_GET['term'];
 
    $sqlAutoName = "SELECT 
        id_person_dim, 
        surname, 
        forename, 
        id_activity_fact, 
        fact_person, 
        fact_location, 
        id_location_dim, 
        city, 
        state, 
        country 
    FROM person_dim, activity_fact, location_dim
    WHERE ( surname LIKE ? 
        OR forename LIKE ? )
        AND id_person_dim=fact_person 
        AND id_location_dim=fact_location
    GROUP BY surname";
    
    $json = array();

    $mysqliConnection = connectRW(); 

    if($stmt = mysqli_prepare( $mysqliConnection, $sqlAutoName)){ 
        $stmt->bind_param("ss", $term, $term); 
        $stmt->execute(); 
        $stmt->bind_result($id_person_dim, $surname, $forename, $id_activity_fact, $fact_person, $fact_location, $id_location_dim, $city, $state, $country); 
        while (mysqli_stmt_fetch($stmt)) { 
            $label = $surname . ', ' . $forename . ' (' . $city . ', ' . $state . ' - ' . $country . ')';
            $json[] = array( 'value' => $id_person_dim, 'label' => $label );
        } 
        mysqli_stmt_close($stmt); 
        $mysqliConnection->close();
    }
    
 echo json_encode($json);
    
}

?>