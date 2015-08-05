<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 
 $query=mysql_query("SELECT id_person_dim, surname, forename, id_activity_fact, fact_person, fact_location, id_location_dim, city, state, country 
 FROM person_dim, activity_fact, location_dim
 WHERE surname LIKE '%".$term."%' OR forename LIKE '%".$term."%' 
 AND id_person_dim=fact_person 
 AND id_location_dim=fact_location
 GROUP BY surname");

 



//after parameterization, just save id into the VALUE array below then can use the id of whatever name I selected


 $json=array();
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["id_person_dim"],
                    'label'=>$row["surname"].", ".$row["forename"].", ".$row["city"].", ".$row["state"].", ".$row["country"]
                        );
    
   
}
 
 echo json_encode($json);
 
?>