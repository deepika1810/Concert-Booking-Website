        <?php include_once("connectdb.php");
?>

		<?php
		date_default_timezone_set('Asia/Calcutta'); 
		$current_date = date('Y-m-d');
           echo $current_date;
		$sql='';
		$submit=@$_POST['datemodify'];
		if($submit)
		{$query=mysql_query("SELECT * FROM concerts");
		
		while($row=mysql_fetch_array($query)){
		$date=@$row['cdate'];
		$ts1 = strtotime($date);
		$ts2 = strtotime($current_date);

		$seconds_diff = $ts1 - $ts2;
        $diff=(int)floor($seconds_diff/3600/24);
     
		if($diff <= 2)
		{   	 $sql=mysql_query("DELETE FROM concerts WHERE cdate='$date'");
	        }
		} }
		?>
		
		
		
		
		
		
		<div> <form action="datemodify.php" method="post">
<input type="submit" name="datemodify" value="Modify" class="buttonfield" />
</form>
</div>