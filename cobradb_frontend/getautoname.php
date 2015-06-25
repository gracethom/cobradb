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

/*TODO: include both person_dim AND location_dim in this while loop to display person and location data.........*/
 
 $json=array();
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["surname"].", ".$row["forename"].", ".$row["city"].", ".$row["state"].", ".$row["country"],
                    'label'=>$row["surname"].", ".$row["forename"].", ".$row["city"].", ".$row["state"].", ".$row["country"]
                        );
    
   
}
 
 echo json_encode($json);
 
?>