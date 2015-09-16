
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
 
    $sqlAutoPhysLoc = "SELECT 
        id_phys_loc_dim, 
        phys_loc_name, 
        repository, 
        coll_name, 
        coll_num
    FROM phys_loc_dim
    WHERE ( phys_loc_name LIKE ? 
        OR repository LIKE ? OR coll_name LIKE ? OR coll_num LIKE ? )
    GROUP BY phys_loc_name";
    
    $json = array();

    $mysqliConnection = connectRW(); 

    if($stmt = mysqli_prepare( $mysqliConnection, $sqlAutoPhysLoc)){ 
        $stmt->bind_param("ssss", $term, $term, $term, $term); 
        $stmt->execute(); 
        $stmt->bind_result($id_phys_loc_dim, $phys_loc_name, $repository, $coll_name, $coll_num); 
        while (mysqli_stmt_fetch($stmt)) { 
            $label = $phys_loc_name . ', ' . $repository . ' - ' . $coll_name . $coll_num;
            $json[] = array( 'value' => $id_phys_loc_dim, 'label' => $label );
        } 
        mysqli_stmt_close($stmt); 
        $mysqliConnection->close();
    }
    
 echo json_encode($json);
    
}

?>