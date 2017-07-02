//for reference
<?php include_once("connectdb.php");
?>
<?php

$submit=@$_POST['submit'];
if($submit)
{
if(empty($_POST['email']))
{echo "Email is required";}
else
{$email=test_input($_POST['email']);
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){ echo "Invalid email format";}
}
if(empty($_POST['username']))
{echo "Username is required";}
else
{$username=test_input($_POST['username']);
if(!preg_match("/^[a-zA-Z]*[0-9]*_$/",$username))
{echo "Only underscore,digits,whitespaces and letters allowed"; }
}
if(empty($_POST['password']))
{echo "Password is required"; }
else
{$password=test_input($_POST['password']);}
if(empty($_POST['contact_no']))
{echo "Contact number is required";}
else
{$contact=test_input($_POST['contact_no']);}


function test_input($data)
{$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;}
$sql="INSERT INTO user VALUES('".$username."','".$password."','".$email."',".$contact.")";
$query = mysql_query($sql);

if(!$query)
{    echo "Registration failed.Try again";
	echo "<a href='signuppage.php'></a>";
}
else
{   echo "Sucessfully registered. Login to access your account.";
echo "<a href='loginpage.php'></a>";  }
?>