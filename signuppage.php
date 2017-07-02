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

<nav>
<img src="logo.png">ONCERTIO!
<ul>
<li><a href="loginpage.php">Login</a></li>
<li><a href="signuppage.php">Register</a></li>
<li><a href="Concerts.php">Browse</a></li>
<li><a href="Support.php">Support</a></li>
</ul>
</nav>
</div>
<center>
<div id="contentofmain" >
<div id="content_left" align="left">
<center>
<h3>REGISTER</h3>
<?php include_once("connectdb.php");
?>
<?php

function test_input($data)
{$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;}

$submit=@$_POST['submit'];
if($submit)
{
$email=@$_POST['email'];	
$username=@$_POST['username'];	
$password=@$_POST['password'];
$contact=@$_POST['contact_no'];	
if($email&&$username&&$password&&$contact)
{    
	$email=test_input($email);
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	  { echo "Invalid email format"; }
	else
	  {            $resulte=mysql_num_rows(mysql_query("SELECT * FROM user WHERE email='$email'"));
				   if($resulte>0)
				   {echo "Another account with this email address already exists!";}
	      else{		   
	     $username=test_input($username);
         if(!preg_match("/^[a-zA-Z0-9_]*$/",$username))
		   {echo "Only underscore,digits,whitespaces and letters allowed"; }
                   
	     else
		   {
             $resultu=mysql_num_rows(mysql_query("SELECT * FROM user WHERE username='$username'"));
				   if($resultu>0)
				   {echo "Username already exists!Try another!";}
                   else   
				   {

			$password=test_input($password);
	        $password=md5($password);
	        $contact=test_input($contact);
	
	$sql="INSERT INTO user(username,password,email,contact) VALUES('".$username."','".$password."','".$email."',".$contact.")";
    $query = mysql_query($sql);
	if(!$query)
         echo "Registration failed.Try again";
	else
         echo "Sucessfully registered.<a href='loginpage.php'> Login</a> to access your account.";
		   } }
           }
	  }
}
else 
  echo "Please fill all four fields!";

 
}

?>

<form action="signuppage.php" method="post">
   <table border="0" align="center"  >
  <tr height="100px">
    <td style="border-bottom:0px; padding-top:0px;"><div align="left" > Email:</div></td>
    <td style="border-bottom:0px; padding-top:0px;"><input type="text" name="email" class="txtfield" />
	</td>
  </tr>
  <tr height="100px">
    <td style="border-bottom:0px;"><div align="left">Username:</div></td>
    <td style="border-bottom:0px;"><input type="text" name="username" class="txtfield"/></td>
  </tr>
 <tr height="100px">
    <td style="border-bottom:0px;"><div align="left" >Password:</div></td>
    <td style="border-bottom:0px;"><input type="password" name="password" class="txtfield" /></td>
  </tr>
  <tr height="100px">
    <td style="border-bottom:0px;"><div align="left" >Contact:</div></td>
    <td style="border-bottom:0px;"><input type="text" name="contact_no" class="txtfield" /></td>
  </tr>
 
</table>
<br>
<input type="submit" name="submit" value="Register" class="buttonfield">
  <br><br>
  Already registered? <a href="loginpage.php">Login</a> here!
</center>
  </form>
</div>
</div>
</center>
<div id="footer"> Copyright Concertio Inc.All rights reserved. </div>

</div>
</body>
</html>
