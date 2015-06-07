<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT series_name FROM source_dim WHERE series_name LIKE '%".$term."%' GROUP BY series_name");
 $json=array();
 
    while($source_dim=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$source_dim["series_name"],
                    'label'=>$source_dim["series_name"]
                        );
    }
 
 echo json_encode($json);
 
?>