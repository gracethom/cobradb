<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<?php

require_once('/Library/WebServer/Documents/cobradb_copy/config.php');

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
    
$username = $_SESSION['username'];
$table_name = "phys_loc_dim";


    //sql statement
$sqlLocation = "INSERT INTO location_dim (street, city, state, country, postal_code) VALUES (?,?,?,?,?)";
    
$sqlPhysLoc = "INSERT INTO phys_loc_dim (phys_loc_name, phone, repository, coll_name, coll_num, id_location_dim) VALUES (?,?,?,?,?,?)";
    
$sqlAudit = "INSERT INTO master_audit (table_name, record_id, created_by, created_on) VALUES (?,?,?, NOW())";

    // id for location record
$locationId = null;
$physLocId = null;
$auditId = null;

    
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
    
    if($stmtAudit = mysqli_prepare($mysqliConnection, $sqlAudit)){
    $stmtAudit->bind_param("sss", $table_name, $physLocId, $username);
    $stmtAudit->execute();
    $auditId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtAudit);
 
}



$mysqliConnection->close();
    

//Output the id of location just added

if($auditId){
    echo $auditId;   
}


}

?>

<?php else : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
    </p>
    <?php endif; ?>