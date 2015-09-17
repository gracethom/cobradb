<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<?php

require_once('/Library/WebServer/Documents/cobradb_copy/config.php');

if(isset($_POST['source_type'])
   && isset($_POST['gcd_link'])
   && isset($_POST['series_title'])
   && isset($_POST['issue_num'])
   && isset($_POST['pub_date'])
   && isset($_POST['page_num'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

$source_type = $_POST['source_type'];
$gcd_link = $_POST['gcd_link'];
$series_title = $_POST['series_title'];
$issue_num = $_POST['issue_num'];
$pub_date = $_POST['pub_date'];
$page_num = $_POST['page_num'];
    
$username = $_SESSION['username'];
$table_name = "source_dim";


    //sql statement
$sqlSource = "INSERT INTO source_dim (source_type, gcd_link, series_title, issue_number, pub_date, page_num) VALUES (?,?,?,?,?,?)";
    
$sqlAudit = "INSERT INTO master_audit (table_name, record_id, created_by, created_on) VALUES (?,?,?, NOW())";
    

    // id for location record
$sourceId = null;
$auditId = null;

 //insert values into location, occu_dim, grade_dim, sex_dim, gender_dim   
    
if($stmtSource = mysqli_prepare( $mysqliConnection, $sqlSource)){
    $stmtSource->bind_param("ssssss", $source_type, $gcd_link, $series_title, $issue_num, $pub_date, $page_num);
    $stmtSource->execute();
    $sourceId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtSource);

}
    
    if($stmtAudit = mysqli_prepare($mysqliConnection, $sqlAudit)){
    $stmtAudit->bind_param("sss", $table_name, $sourceId, $username);
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