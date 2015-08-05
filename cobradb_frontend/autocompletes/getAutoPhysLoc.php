<?php
 
mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT id_location_dim, loc_name, street, city, state, country 
 FROM location_dim
 WHERE loc_name LIKE '%".$term."%' OR street LIKE '%".$term."%' OR city LIKE '%".$term."%' OR state LIKE '%".$term."%' OR country LIKE '%".$term."%'");

 
 $json=array();
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["id_location_dim"],
                    'label'=>$row["loc_name"].", ".$row["street"].", ".$row["city"].", ".$row["state"].", ".$row["country"]
                        );
    
   
}
 
 echo json_encode($json);


?>
