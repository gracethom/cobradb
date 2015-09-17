<?php
require_once('/Library/WebServer/Documents/cobradb_copy/config.php');

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
 
    $sqlAutoName = "SELECT series_title FROM source_dim WHERE series_title LIKE ? GROUP BY series_title";
    
    $json = array();

    $mysqliConnection = connectRW(); 

    if($stmt = mysqli_prepare( $mysqliConnection, $sqlAutoName)){ 
        $stmt->bind_param("s", $term); 
        $stmt->execute(); 
        $stmt->bind_result($series_title); 
        while (mysqli_stmt_fetch($stmt)) { 
            $label = $series_title;
            $json[] = array( 'value' => $series_title, 'label' => $label );
        } 
        mysqli_stmt_close($stmt); 
        $mysqliConnection->close();
    }
    
 echo json_encode($json);
    
}

?>