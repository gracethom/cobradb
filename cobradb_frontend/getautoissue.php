<?php
 mysql_connect("localhost","grace","gracie");
 mysql_select_db("cobra");
 
 $term=$_GET["term"];
 
 //TODO: change "Fantasic 4" to whatever value was entered in series name field
 $query=mysql_query("SELECT pub_date, issue_number, series_name FROM source_dim WHERE series_name='Fantastic 4' AND pub_date LIKE '%".$term."%' OR issue_number LIKE '%".$term."%' GROUP BY series_name");
 $json=array();
 
    while($source_dim=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=>$source_dim["issue_number"].", ".$source_dim["pub_date"],
                    'label'=>"Issue ".$source_dim["issue_number"].", ".$source_dim["pub_date"],
                        );
    }
 
 echo json_encode($json);
 
?>