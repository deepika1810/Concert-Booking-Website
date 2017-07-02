<!DOCTYPE html>
<html>
<head>
<title>Concertio</title>
<link rel="stylesheet" type="text/css" href="layout.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
</head>
<body>
<div id="container">
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
</div>

<div id="contentofmain">

<div id="content_left1" align="left" >
<center>
<h3>LOGIN</h3>
<?php
$conn=mysql_connect("localhost","root","");
$db=mysql_select_db("cbooking",$conn);
?>
<?php

session_start();
$page='browsemember.php';
$submit=@$_POST['submit'];
if($submit){
$username=@$_POST['username'];
$password=md5(@$_POST['password']);
if($username&&$password)
{   $query=mysql_query("SELECT * FROM user WHERE username='$username'");
    $numrows=mysql_num_rows($query);
    if($numrows!=0)
         { $row=mysql_fetch_assoc($query);
		   $dbusername=$row['username'];
		   $dbpassword=$row['password'];
		   $dbemail=$row['email'];
		   if($dbusername==$username&&$dbpassword==$password)
		       {
			       $_SESSION['username']=$username;
				   $_SESSION['email']=$dbemail;
				  header("Location:$page"); 
			   }
		   else
		      echo "Incorrect password!Try again";   
		   
		 } 
    else
	     echo "This user doesnot exist!Please enter a valid username!";
}
else
   echo "Please enter username and password!";

}
?>
<form action="loginpage.php" method="POST">
   <table border="0" align="center"  >
<tr height="80px">
    <td style="border-bottom:0px;"><input type="text" name="username" class="txtfield" placeholder="Username"/></td>
  </tr>
 <tr height="80px">
 
    <td style="border-bottom:0px;"><input type="password" name="password"  class="txtfield" placeholder="Password" /></td>
  </tr>
  </table>
  <br>
  <input type="submit" name="submit" value="Login" class="buttonfield" />
  </form>
  <br><br>
  Not registered yet? <a href="signuppage.php">Register</a> here!
  </center>
</div>
<div id="content_right"> <center>
<img src="r1.jpg">
<img src="r2.jpg">
</center>
</div>
  </div>

</div>
<div id="footer">Copyright Concertio Inc.All rights reserved.</div>
</body>
</html>


