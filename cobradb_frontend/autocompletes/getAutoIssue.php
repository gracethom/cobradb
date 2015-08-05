<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 $series=$_GET["series"];
 

 $query=mysql_query("SELECT id_source_dim, pub_date, issue_number, series_title FROM source_dim WHERE series_title='".$series."'");
 $json=array();
 
    while($row=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$row["id_source_dim"],
                    'label'=>"Issue ".$row["issue_number"].", ".$row["pub_date"],
                        );
    }
 
 echo json_encode($json);
 
?>

