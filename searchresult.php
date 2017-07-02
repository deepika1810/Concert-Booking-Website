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
<?php session_start();?>

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



<div id="contentofmain"><!- contentofmain begins>

<?php

if(isset($_POST['keyword']))
{
	$keyword=@$_POST['keyword'];
	$keyword=preg_replace("#[^0-9a-zA-Z]#","",$keyword);
	$query=mysql_query("SELECT * FROM concerts WHERE artist LIKE '%$keyword%' OR genre LIKE '%$keyword%' OR location LIKE '%$keyword%' ");
	$count=mysql_num_rows($query);
	if($count==0)
		echo "No search results!";
	else{
	    echo "<table border=1 style='font-size:20px; font-family:'Trebuchet MS', Helvetica, sans-serif;'>
			   <tr>
			      <th>Artist</th>
				  <th>Genre</th>
				  <th>Location</th>
				  <th>Date</th>
				</tr>";
		while($row=mysql_fetch_assoc($query)){
			$artist=@$row['artist'];
			$location=@$row['location'];
			$genre=@$row['genre'];
			$date=@$row['cdate'];
			
            echo "<tr>";
			echo "<td>" . $artist . "</td>";
			echo "<td>" . $genre . "</td>";
			echo "<td>" . $location . "</td>";
			echo "<td>" . $date . "</td>";
			
			echo"</tr>";
		}
		echo "</table>";
		

	}	
}
	   

?>

    </div><!- contentofmain ends>
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



  
				