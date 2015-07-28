<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 
/* $query=mysql_query("SELECT id_phys_loc, phys_loc_name, id_activity_fact, fact_phys_loc, fact_location, id_location_dim, city, state, country 
 FROM phys_loc, activity_fact, location_dim
 WHERE phys_loc_name LIKE '%".$term."%' 
 AND id_phys_loc=fact_phys_loc
 AND id_location_dim=fact_location
 GROUP BY phys_loc_name");*/

$query=mysql_query("SELECT phys_loc_name
 FROM phys_loc
 WHERE phys_loc_name LIKE '%".$term."%'");

 
 $json=array();
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["phys_loc_name"].", ".$row["city"].", ".$row["state"].", ".$row["country"],
                    'label'=>$row["phys_loc_name"].", ".$row["city"].", ".$row["state"].", ".$row["country"]
                        );
    
   
}
 
 echo json_encode($json);
 
?>