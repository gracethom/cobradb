<?php
require_once('loginConfig.php');

function connectRW(){
    $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL - (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

if(isset($_POST['user'])
   && isset($_POST['pass'])){

    
    $mysqliConnection = connectRW();
 
    $user=$_POST['user'];
    $pass=$_POST['pass'];
 
    $sqlLogin = "SELECT count(user) FROM user WHERE user= ? AND password= ? LIMIT 0, 1";

    $mysqliConnection = connectRW(); 

    if($stmt = mysqli_prepare( $mysqliConnection, $sqlLogin)){ 
        $stmt->bind_param("ss", $user, $password); 
        $stmt->execute(); 
        $stmt->bind_result($user, $password); 
        $numrows = mysqli_num_rows($stmt);
        
        while (mysqli_stmt_fetch($stmt)) { 
            if($numrows=1){
                header("Location: index.php");
            }
            else
                echo "Please try again.";
        }
         mysqli_stmt_close($stmt); 
        $mysqliConnection->close();
    }
    
    
}

?>