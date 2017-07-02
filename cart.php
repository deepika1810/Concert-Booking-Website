<!DOCTYPE html>
<html>
<head>
<title>Concertio</title>
<link rel="stylesheet" type="text/css" href="layout.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">

function selectStep(n)
{
	if(n==1){
		$(".progress-selected").animate({marginLeft: '0px'},100);
	}else if(n==2){
		$(".progress-selected").animate({marginLeft: '36px'},100);
	}else if(n==3){
		$(".progress-selected").animate({marginLeft: '63px'},100);
	}
	$(".content-switcher").hide();
	$("#content"+n).show();
}


</script>
</head>

<?php include_once("connectdb.php");
?>
<?php session_start(); ?>
<body>
<!- container begins>
<div id="container">
    <!- navigation bar begins>
	<div id="navbar">
		<div id="logindet"> 
		<?php if(@$_SESSION['username']) {echo "Hi,".$_SESSION['username']."! |";
		echo "<a href='logout.php' style='color:white; text-decoration:none;'>Logout </a>";}?>
		</div>
		<nav>
		<a href="index.php"><img src="logo.png">ONCERTIO!</a>
		<ul>
			<?php if(@$_SESSION['username']){ echo "<li><a href='browsemember.php'>Concerts</a></li>";
		    echo "<li><a href='support.php'>Support</a></li>";
			}
         else{
			echo "<li><a href='loginpage.php'>Login</a></li>";
			echo "<li><a href='signuppage.php'>Register</a></li>";
		    echo "<li><a href='browse.php'>Concerts</a></li>";
			echo "<li><a href='support.php'>Support</a></li>";}
		?>
		</ul>
		</nav>
	</div><!- navigation bar ends>
<center>
<div id='contentofmain' style='padding:50px;'>	

					<table border=1 valign="center" style="font-size:20px; font-family:'Trebuchet MS', Helvetica, sans-serif;">
			   <tr style="border-bottom:2px solid blue;">
			      <th>Artist</th>
				  <th>Date</th>
				  <th>Quantity</th>
				  <th>Price</th>
				   <th>Decrease quantity</th>
				  <th>Increase Quantity</th>
				  <th>Delete Concert</th>
				  <th>Total</th>
				</tr>

<?php
$total='';
if(isset($_GET['add']))
{   
	$query=mysql_query('SELECT id,quantity FROM concerts WHERE id='.mysql_real_escape_string((int)$_GET['add']));
	while($quantity_row=mysql_fetch_assoc($query))
	{
		if($quantity_row['quantity']!=@$_SESSION['cart_'.$_GET['add']])
		{
			@$_SESSION['cart_'.$_GET['add']]+='1';
			
			
		}
	}
}

if(isset($_GET['remove']))
{
	$_SESSION['cart_'.(int)$_GET['remove']]--;
	
}

if(isset($_GET['delete']))
{
	$_SESSION['cart_'.(int)$_GET['delete']]=0;
	
}
{
	
	foreach($_SESSION as $name=>$value)
	{
		if($value>0)
		{
			if(substr($name,0,5)=='cart_')
			{
				$id=substr($name,5,(strlen($name)-5));
				$get=mysql_query('SELECT id,artist,price,cdate FROM concerts WHERE id='.mysql_real_escape_string((int)$id));
				while($row=mysql_fetch_assoc($get))
				{
					$sub=$row['price']*$value;
					$artist=@$row['artist'];
					$date=@$row['cdate'];
					$price=@$row['price'];
					echo "<tr>";
					echo "<td>" . $artist . "</td>";
					echo "<td>" . $date . "</td>";
					echo "<td>" . $value . "</td>";
					echo "<td>Rs" . $price . "/-</td>";
					echo "<td>";
					echo "<a href='cart.php?remove=$id' style='text-decoration:none;'><img src='cremove.jpg'></a>";
					echo "</td>";
					echo "<td>";
					echo "<a href='cart.php?add=$id' style='text-decoration:none;'><img src='cadd.jpg'></a>";
					echo "</td>";
					echo "<td>";
					echo "<a href='cart.php?delete=$id' style='text-decoration:none;'>delete</a>";
					echo "</td>";
					echo "<td>Rs".$sub."</td>";
					echo "</tr>";	
			}
		}
				   $total=@($total+$sub);
		
		}
}

			   echo "<tr>";
			   echo "<td></td>";
			   echo "<td></td>";
			   echo "<td></td>";
			   echo "<td></td>";
			   echo "<td></td>";
			   echo "<td></td>";
			   echo "<td>Total:</td>";
			   echo "<td>".$total."</td>";
			   echo "</tr>";
				echo "</table>";

}

?>
<br /><br />
<a href="browse.php">Go back to shopping</a>
<form action="checkout.php" method="POST">
<input type="submit" name="checkout" value="Login" class="buttonfield" />
</form>
</div>
</div>
<div class="cont"><!- cont begins> 
	    <div class="main-content"><!- main-cont begins>
		<div class="content-switcher" id="content1">
		    <img src="g1.png" align="left" style="margin-left:50px">
			<img src="g2.png" align="right" style="margin-right:50px">
		</div>
		<div class="content-switcher" id="content2">
		    <img src="g3.png" align="left" style="margin-left:50px">
			<img src="g4.png" align="right" style="margin-right:50px">
		</div>
		<div class="content-switcher" id="content3">
		    <img src="g5.png" align="left" style="margin-left:50px">
			<img src="g6.png" align="right" style="margin-right:50px">
		</div>	
		</div><!- main-cont ends>
		<div class="progress-cont"><!- progress-cont begins>
			<a href="#" class="item-number" onclick="selectStep(1); return false;"></a>
		    <a href="#" class="item-number" onclick="selectStep(2); return false;"></a>
			<a href="#" class="item-number" onclick="selectStep(3); return false;"></a>
		 
		
			<div class="progress-selected">
			</div>
	    </div><!- progress-cont ends>
	</div><!- cont ends>
	
	<div id="footer">Copyright Concertio Inc.All rights reserved.</div>	

</body>
</html>