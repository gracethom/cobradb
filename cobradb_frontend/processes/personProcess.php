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
   && isset($_POST['grade'])
   && isset($_POST['race'])
   && isset($_POST['ethnicity'])
   && isset($_POST['sex'])
   && isset($_POST['gender'])
       && isset($_POST['occupation'])){


function connectRW(){
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

$mysqliConnection = connectRW();

$selected_name = $_POST['selectedName'];
$pers_auth = $_POST['pers_auth'];
$surname = $_POST['surname'];
$forename = $_POST['forename'];
$pers_title = $_POST['pers_title'];
$pers_role = $_POST['pers_role'];
$alt_name = $_POST['alt_name'];
$birth_year = $_POST['birth_year'];
$byear_source = $_POST['byear_source'];
$race = $_POST['race'];
$ethnicity = $_POST['ethnicity'];
    
$occupation = $_POST['occupation'];
$occu_note = $_POST['occu_note'];
$grade = $_POST['grade'];
$grade_note = $_POST['grade_note'];
$sex = $_POST['sex'];
$sex_note = $_POST['sex_note'];
$gender = $_POST['gender'];
$gender_note = $_POST['gender_note'];


    //sql statements to insert into person_dim, occu_dim, grade_dim, sex_dim, gender_dim
$sqlPerson = "INSERT INTO person_dim (person_auth, surname, forename, person_title, person_role, alt_name, birth_year, byear_source, race, ethnicity) VALUES (?,?,?,?,?,?,?,?,?,?)";
    
$sqlOccu = "INSERT INTO occu_dim (occupation) VALUES (?)";
$sqlGrade = "INSERT INTO grade_dim (grade) VALUES (?)";
$sqlSex = "INSERT INTO sex_dim (sex) VALUES (?)";
$sqlGender = "INSERT INTO gender_dim (gender) VALUES (?)";
    
    
    
    //sql statements to insert into person bridge tables
$sqlOccuB = "INSERT INTO person_occu (id_person_dim, id_occu_dim, occu_note) VALUES (?,?,?)";
$sqlGradeB = "INSERT INTO person_grade (id_person_dim, id_grade_dim, grade_note) VALUES (?,?,?)";
$sqlSexB = "INSERT INTO person_sex (id_person_dim, id_sex_dim, sex_note) VALUES (?,?,?)";
$sqlGenderB = "INSERT INTO person_gender (id_person_dim, id_gender_dim, gender_note) VALUES (?,?,?)";


    // ids for dim tables
$persId = null;
$occuId = null;
$gradeId = null;
$sexId = null;
$gradeId = null;
    
    //ids for bridge tables
$persBId = null;
$occuBId = null;
$gradeBId = null;
$sexBId = null;
$gradeBId = null;

    
 //insert values into person_dim, occu_dim, grade_dim, sex_dim, gender_dim   
    
if($stmtPerson = mysqli_prepare( $mysqliConnection, $sqlPerson)){
    $stmtPerson->bind_param("ssssssssss", $pers_auth, $surname, $forename, $pers_title, $role, $alt_name, $birth_year, $byear_source, $race, $ethnicity);
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
    
    if($stmtSex = mysqli_prepare( $mysqliConnection, $sqlSex)){
    $stmtSex->bind_param("s", $sex);
    $stmtSex->execute();
    $sexId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtSex);
 
}
    
    if($stmtGender = mysqli_prepare( $mysqliConnection, $sqlGender)){
    $stmtGender->bind_param("s", $gender);
    $stmtGender->execute();
    $genderId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtGender);
    
}
    
    
    //insert values into the person bridge tables - person_occu, person_grade, person_sex, person_gender
    
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
    
    if($stmtSexB = mysqli_prepare( $mysqliConnection, $sqlSexB)){
    $stmtSexB->bind_param("sss", $persId, $sexId, $sex_note);
    $stmtSexB->execute();
    $sexBId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtSexB);

}
    
    if($stmtGenderB = mysqli_prepare( $mysqliConnection, $sqlGenderB)){
    $stmtGenderB->bind_param("sss", $persId, $genderId, $gender_note);
    $stmtGenderB->execute();
    $genderBId = $mysqliConnection->insert_id;
    mysqli_stmt_close($stmtGenderB);

}
    
    $mysqliConnection->close();

    
    
    
    

//Output the id of person just added

if($persId){
    echo $persId;   
}

    if($occuId){
    echo $occuId;   
}
    if($occuBId){
    echo $occuBId;   
}
    
}
?>