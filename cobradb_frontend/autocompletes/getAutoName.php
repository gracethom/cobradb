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
    
    
    $sqlAutoName = "SELECT 
        person_dim.id_person_dim, 
        person_dim.surname, 
        person_dim.forename, 
        activity_fact.id_activity_fact, 
        activity_fact.fact_person, 
        activity_fact.fact_location, 
        location_dim.id_location_dim, 
        location_dim.city, 
        location_dim.state, 
        location_dim.country 
    FROM person_dim
    
        LEFT JOIN activity_fact ON activity_fact.fact_person=person_dim.id_person_dim
        LEFT JOIN location_dim ON activity_fact.fact_location=location_dim.id_location_dim WHERE ( person_dim.surname LIKE ? 
        OR person_dim.forename LIKE ? 
        OR CONCAT(person_dim.forename, ' ', person_dim.surname) LIKE ?)";
       
    
    
    $json = array();

    $mysqliConnection = connectRW(); 


    if($stmt = mysqli_prepare( $mysqliConnection, $sqlAutoName)){ 
        $stmt->bind_param("sss", $term, $term, $term); 
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