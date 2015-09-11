<?php

require_once('config.php');

if(isset($_POST['pers_auth'])
   && isset($_POST['surname'])
   && isset($_POST['forename'])
   && isset($_POST['pers_title'])
   && isset($_POST['pers_role'])
   && isset($_POST['alt_name'])
   && isset($_POST['birth_year'])
   && isset($_POST['byear_source'])
   && isset($_POST['gender_note'])
   && isset($_POST['race'])
   && isset($_POST['race_note'])
   && isset($_POST['ethnicity'])
   && isset($_POST['ethnicity_note'])
   && isset($_POST['occupation'])
   && isset($_POST['occu_note'])
   && isset($_POST['grade'])
   && isset($_POST['grade_note'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

    
$pers_auth = $_POST['pers_auth'];
$surname = $_POST['surname'];
$forename = $_POST['forename'];
$pers_title = $_POST['pers_title'];
$pers_role = $_POST['pers_role'];
$alt_name = $_POST['alt_name'];
$birth_year = $_POST['birth_year'];
$byear_source = $_POST['byear_source'];
$gender_note = $_POST['gender_note'];
$race = $_POST['race'];
$race_note = $_POST['race_note'];
$ethnicity = $_POST['ethnicity'];
$ethnicity_note = $_POST['ethnicity_note'];
$occupation = $_POST['occupation'];
$occu_note = $_POST['occu_note'];
$grade = $_POST['grade'];
$grade_note = $_POST['grade_note'];




    //sql statements to insert into person_dim, occu_dim, grade_dim, gender_dim
$sqlPerson = "INSERT INTO person_dim (person_auth, surname, forename, person_title, person_role, alt_name, birth_year, byear_source, gender_note, race, race_note, ethnicity, ethnicity_note) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
$sqlOccu = "INSERT INTO occu_dim (occupation) VALUES (?)";
$sqlGrade = "INSERT INTO grade_dim (grade) VALUES (?)";
    
    
    
    //sql statements to insert into person bridge tables
$sqlOccuB = "INSERT INTO person_occu (id_person_dim, id_occu_dim, occu_note) VALUES (?,?,?)";
$sqlGradeB = "INSERT INTO person_grade (id_person_dim, id_grade_dim, grade_note) VALUES (?,?,?)";


    // ids for dim tables
$persId = null;
$occuId = null;
$gradeId = null;

    
    //ids for bridge tables
$persBId = null;
$occuBId = null;
$gradeBId = null;


    
 //insert values into person_dim, occu_dim, grade_dim, gender_dim   
    
if($stmtPerson = mysqli_prepare( $mysqliConnection, $sqlPerson)){
    $stmtPerson->bind_param("sssssssssssss", $pers_auth, $surname, $forename, $pers_title, $role, $alt_name, $birth_year, $byear_source, $gender_note, $race, $race_note, $ethnicity, $ethnicity_note);
    $stmtPerson->execute();
    $persId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtPerson);

}
    
    if($stmtOccu = mysqli_prepare( $mysqliConnection, $sqlOccu)){
    $stmtOccu->bind_param("s", $occupation);
    $stmtOccu->execute();
    $occuId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtOccu);

}
    
    if($stmtGrade = mysqli_prepare( $mysqliConnection, $sqlGrade)){
    $stmtGrade->bind_param("s", $grade);
    $stmtGrade->execute();
    $gradeId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtGrade);
 
}

    
    
    //insert values into the person bridge tables - person_occu, person_grade, person_gender
    
    if($stmtOccuB = mysqli_prepare( $mysqliConnection, $sqlOccuB)){
    $stmtOccuB->bind_param("sss", $persId, $occuId, $occu_note);
    $stmtOccuB->execute();
    $occuBId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtOccuB);

}
    
    if($stmtGradeB = mysqli_prepare( $mysqliConnection, $sqlGradeB)){
    $stmtGradeB->bind_param("sss", $persId, $gradeId, $grade_note);
    $stmtGradeB->execute();
    $gradeBId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtGradeB);

}

    
    $mysqliConnection->close();


    
    
    

//Output the id of person just added

if($persId){
    echo $persId;   
}

    if($occuId){
    echo $occuId;   
}

    
}
?>