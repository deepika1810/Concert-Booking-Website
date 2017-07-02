<?php include_once("connectdb.php");
?>
<?php session_start();?>
<html>
<head>
<title>Concertio</title>
<link rel="stylesheet" type="text/css" href="layout.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
</script>
</head>


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

	<div class="contentofmain">
	    <?php 
		$page='loginpage.php';
		if(@$_SESSION['username'])
		{ 
	     $email=$_SESSION['email'];
		 $username=$_SESSION['username'];
		 if(isset($_POST['submit']))
		 {
			 $msg='Username :'.$username."\n".'Your tickets have been booked';
			 mail($email,'Tickets From Concertio',$msg);
			 echo "You're tickets have been booked!";
			 
		 }
	    }
		else{
			
			header("Location:$page");
			
		}
		
		?>
	</div>
	</div>
	<div id="footer">Copyright Concertio Inc.All rights reserved.</div>	
</body>
</html>