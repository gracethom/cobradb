<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 $query=mysql_query("SELECT series_title FROM source_dim WHERE series_title LIKE '%".$term."%' GROUP BY series_title");
 $json=array();
 
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["series_title"],
                    'label'=>$row["series_title"]
                        );
    }
 
 echo json_encode($json);
 
?>