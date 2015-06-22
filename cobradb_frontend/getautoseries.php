<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT series_name FROM source_dim WHERE series_name LIKE '%".$term."%' GROUP BY series_name");
 $json=array();
 
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["series_name"],
                    'label'=>$row["series_name"]
                        );
    }
 
 echo json_encode($json);
 
?>