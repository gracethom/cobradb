<?php
require_once('/Library/WebServer/Documents/cobradb_copy/config.php');

function connectRW(){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

if(isset($_GET['term'])
   && isset($_GET['series'])){

    
    $mysqliConnection = connectRW();
 
    $series=$_GET['series'];
    $term=$_GET['term'];
    
 
    $sqlAutoName = "SELECT id_source_dim, pub_date, issue_number, series_title FROM source_dim WHERE (series_title= ? AND (issue_number = ? OR pub_date= ?))";
    
    $json = array();

    $mysqliConnection = connectRW(); 

    if($stmt = mysqli_prepare( $mysqliConnection, $sqlAutoName)){ 
        $stmt->bind_param("sss", $series, $term, $term); 
        $stmt->execute(); 
        $stmt->bind_result($id_source_dim, $pub_date, $issue_number, $series_title); 
        while (mysqli_stmt_fetch($stmt)) { 
            $label = 'Issue ' . $issue_number . ' - ' . $pub_date;
            $json[] = array( 'value' => $id_source_dim, 'label' => $label );
        } 
        mysqli_stmt_close($stmt); 
        $mysqliConnection->close();
    }
    
 echo json_encode($json);
    
}

?>