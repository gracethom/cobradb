<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 // TODO: will need to go through activity_fact to get location.........
 $query=mysql_query("SELECT surname,forename, street, city, state, country FROM person_dim, location_dim where surname like '%".$term."%' or forename like '%".$term."%' group by surname");
 $json=array();
 
    while($person_dim=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $person_dim["surname"].", ".$person_dim["forename"].", ".$location_dim["street"].", ".$location_dim["city"].", ".$location_dim["state"].", ".$location_dim["country"],
                    'label'=>$person_dim["surname"].", ".$person_dim["forename"].", ".$location_dim["street"].", ".$location_dim["city"].", ".$location_dim["state"].", ".$location_dim["country"]
                        );
    }
 
 echo json_encode($json);
 
?>