<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res = mysql_query("SELECT surname,forename FROM person_dim WHERE surname LIKE '%$q%' OR forename LIKE '%$q%' ORDER BY surname LIMIT 10");
while($row=mysql_fetch_array($sql_res))
{
$surname=$row['surname'];
$forename=$row['forename'];
$b_surname='<strong>'.$q.'</strong>';
$b_forename='<strong>'.$q.'</strong>';
$final_surname = str_ireplace($q, $b_surname, $surname);
$final_forename = str_ireplace($q, $b_forename, $forename);
?>
<div class="show" align="left">
<img src="author.PNG" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $final_surname; ?></span>&nbsp;<br/><?php echo $final_forename; ?><br/>
</div>
<?php
}
}
?>