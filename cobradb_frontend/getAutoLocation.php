<?php
 
$dbConn = new mysqli("localhost","grace","gracie", "cobra");

$term=$_GET["term"];

$stmt = $dbConn->prepare('SELECT street, city, state, country 
 FROM location_dim
 WHERE street LIKE ? OR city LIKE ? OR state LIKE ? OR country LIKE ?');

$stmt->bind_param("s", $term)
    

 

 
 
/* $query=mysql_query("SELECT street, city, state, country 
 FROM location_dim
 WHERE street LIKE '%".$term."%' OR city LIKE '%".$term."%' OR state LIKE '%".$term."%' OR country LIKE '%".$term."%'");*/

 
 $json=array();
    while($row=mysql_fetch_array($stmt)){
         $json[]=array(
                    'value'=>$row["street"].", ".$row["city"].", ".$row["state"].", ".$row["country"],
                    'label'=>$row["street"].", ".$row["city"].", ".$row["state"].", ".$row["country"]
                        );
    
   
}
 
 echo json_encode($json);
 
$stmt->execute();
$stmt->close();
$dbConn->close();

?>