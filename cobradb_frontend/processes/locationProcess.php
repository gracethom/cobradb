<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<?php

require_once('/Library/WebServer/Documents/cobradb_copy/config.php');

if(isset($_POST['street'])
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

$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$postal_code = $_POST['postal_code'];
    
$username = $_SESSION['username'];
$table_name = "location_dim";


    //sql statement
$sqlLocation = "INSERT INTO location_dim (street, city, state, country, postal_code) VALUES (?,?,?,?,?)";
    
$sqlAudit = "INSERT INTO master_audit (table_name, record_id, created_by, created_on) VALUES (?,?,?, NOW())";
    

    // id for location record
$locationId = null;
$auditId = null;

 //insert values into location, occu_dim, grade_dim, sex_dim, gender_dim   
    
if($stmtLocation = mysqli_prepare( $mysqliConnection, $sqlLocation)){
    $stmtLocation->bind_param("sssss", $street, $city, $state, $country, $postal_code);
    $stmtLocation->execute();
    $locationId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtLocation);
}
    
   if($stmtAudit = mysqli_prepare($mysqliConnection, $sqlAudit)){
    $stmtAudit->bind_param("sss", $table_name, $locationId, $username);
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
