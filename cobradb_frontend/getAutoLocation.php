<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 
 $query=mysql_query("SELECT street, city, state, country 
 FROM location_dim
 WHERE street LIKE '%".$term."%' OR city LIKE '%".$term."%' OR state LIKE '%".$term."%' OR country LIKE '%".$term."%'");

 
 $json=array();
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["street"].", ".$row["city"].", ".$row["state"].", ".$row["country"],
                    'label'=>$row["street"].", ".$row["city"].", ".$row["state"].", ".$row["country"]
                        );
    
   
}
 
 echo json_encode($json);
 
?>