<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 // TODO: will need to go through activity_fact to get location.........
 $query=mysql_query("SELECT source_name, pub_date, issue_number, series_name FROM source_dim WHERE source_name LIKE '%".$term."%' OR series_name LIKE '%".$term."%' OR pub_date LIKE '%".$term."%' OR issue_number LIKE '%".$term."%' GROUP BY source_name");
 $json=array();
 
    while($source_dim=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $source_dim["source_name"].", ".$source_dim["pub_date"].", ".$source_dim["issue_number"].", ".$source_dim["series_name"],
                    'label'=>$source_dim["source_name"].", ".$source_dim["pub_date"].", ".$source_dim["issue_number"].", ".$source_dim["series_name"]
                        );
    }
 
 echo json_encode($json);
 
?>