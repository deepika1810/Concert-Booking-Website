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
<?php
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("cbooking",$conn);
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
<div id="contentofmain" style="padding:50px;">	
	<?php
	
    $query=mysql_query("SELECT * FROM concerts");
		echo "<table border=1 style='font-size:20px; font-family:'Trebuchet MS', Helvetica, sans-serif; '>
			   <tr style='border-bottom:2px solid blue;'>
			      <th>Artist</th>
				  <th>Genre</th>
				  <th>Location</th>
				  <th>Date</th>
				  <th>Time</th>
				  <th>Price</th>
				  <th>Order</th>
				</tr>";
		while($row=mysql_fetch_assoc($query)){
			$artist=@$row['artist'];
			$location=@$row['location'];
			$genre=@$row['genre'];
			$date=@$row['cdate'];
			$time=@$row['time'];
			$price=@$row['price'];
			$id=@$row['id'];
            echo "<tr>";
			echo "<td>" . $artist . "</td>";
			echo "<td>" . $genre . "</td>";
			echo "<td>" . $location . "</td>";
			echo "<td>" . $date . "</td>";
			echo "<td>" . $time . "</td>";
            echo "<td>Rs" . $price . "\-</td>";
			
			if($row['quantity']<=0)
			 {echo "<td>Sold Out!</td>";}
			else echo "<td><a href='cart.php?add=$id' style='border:1px solid #ccc;font-size:20px; text-decoration:none; padding:3px; background-color:blue; height:px; color:white;
 border-radius:5px;'>Add to cart</a></td>";
			echo"</tr>";
		}
		echo "</table>";
	?>

	</div></center>
	</div>	<!- container ends>
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