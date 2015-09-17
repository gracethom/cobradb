<?php include_once '/Library/WebServer/Documents/cobradb_copy/includes/db_connect.php'; include_once '/Library/WebServer/Documents/cobradb_copy/includes/functions.php'; sec_session_start(); ?>

<?php if (login_check($mysqli)==true) : ?>

<?php

require_once('/Library/WebServer/Documents/cobradb_copy/config.php');

if(isset($_POST['mention_col_title'])
   && isset($_POST['mention_desc'])
   && isset($_POST['mention_notes'])
   && isset($_POST['selectedPerson'])
   && isset($_POST['selectedLocation'])
   && isset($_POST['selectedSource'])
   && isset($_POST['selectedPhysLoc'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

$mention_col_title = $_POST['mention_col_title']; 
$mention_desc = $_POST['mention_desc'];
$mention_notes = $_POST['mention_notes'];
    
$selectedPerson = $_POST['selectedPerson'];
$selectedLocation = $_POST['selectedLocation'];
$selectedSource = $_POST['selectedSource'];
$selectedPhysLoc = $_POST['selectedPhysLoc'];
    
$username = $_SESSION['username'];
$table_name = "mention_dim";
$table_activity = "activity_fact";



    //sql statements 
$sqlMention = "INSERT INTO mention_dim (mention_col_title, mention_desc, mention_notes) VALUES (?,?,?)";
    
$sqlActivity = "INSERT INTO activity_fact (fact_person, fact_location, fact_source, fact_phys_loc, fact_mention) VALUES (?,?,?,?,?)";
    
    //insert both dim table and activity_fact record into master_audit table (two rows at once)
$sqlAudit = "INSERT INTO master_audit (table_name, record_id, created_by, created_on) VALUES (?,?,?, NOW()), (?,?,?, NOW())";



    // ids for dim tables
$mentionId = null;
$activityId = null;
$auditId = null;
$auditActivityId = null;


    
 //insert values   
    
if($stmtMention = mysqli_prepare( $mysqliConnection, $sqlMention)){
    $stmtMention->bind_param("sss", $mention_col_title, $mention_desc, $mention_notes);
    $stmtMention->execute();
    $mentionId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtMention);

}
    
    if($stmtActivity = mysqli_prepare( $mysqliConnection, $sqlActivity)){
    $stmtActivity->bind_param("sssss", $selectedPerson, $selectedLocation, $selectedSource, $selectedPhysLoc, $mentionId);
    $stmtActivity->execute();
    $activityId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtActivity);

}
    
     //insert both dim table and activity_fact record into audit table (two rows at once)
    if($stmtAudit = mysqli_prepare($mysqliConnection, $sqlAudit)){
    $stmtAudit->bind_param("ssssss", $table_name, $mentionId, $username, $table_activity, $activityId, $username);
    $stmtAudit->execute();
    $auditId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtAudit);
 
}
    
    $mysqliConnection->close();

    

$link_address = 'http://localhost/cobradb_copy/index.php';
    $logout = 'http://localhost/cobradb_copy/includes/logout.php';

if($activityId){
echo "

<div>Success!</div> 

<div><a href='" . $link_address."'><button>Add another activity record</button></a></div>
    
<div>Or <a href='" . $logout."'><button>Log Out</button></a><div>";
}

    
}
?>
<?php else : ?>
    <p>
        <span class="error">You are not authorized to access this page.</span> Please <a href="login.php">login</a>.
    </p>
    <?php endif; ?>