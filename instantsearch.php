<?php include_once("connectdb.php");
?>
<?php
$output='';
if(isset($_POST['searchVal']))
{
	$keyword=@$_POST['searchVal'];
	$keyword=preg_replace("#[^0-9a-zA-Z]#","",$keyword);
	$query=mysql_query("SELECT * FROM concerts WHERE artist LIKE '%$keyword%' OR genre LIKE '%$keyword%' OR location LIKE '%$keyword%' ");
	$count=mysql_num_rows($query);
	if($count==0)
		$output="No search results!";
	else{
		while($row=mysql_fetch_assoc($query)){
			$artist=@$row['artist'];
			$location=@$row['location'];
			$genre=@$row['genre'];
			$date=@$row['date'];
			$output.='<div>'.$genre.' '.$artist.' '.$location.' '.$date.'</div>';
		}
	}	
}
echo($output);

?>