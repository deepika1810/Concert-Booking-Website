
//for reference
<?php include("connectdb.php");
?>
<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];


if($username&&$password)
{   $query=mysql_query("SELECT * FROM user WHERE username='$username'");
    $numrows=mysql_num_rows($query);
    if($numrows!=0)
         { $row=mysql_fetch_assoc($query);
		   $dbusername=$row['username'];
		   $dbpassword=$row['password'];
		   if($dbusername==$username&&$dbpassword==$password)
		       {
			     echo"youre in!";
			   
			   }
		   else
		      echo "Incorrect password!Try again";   
		   
		 } 
    else
	     echo "This user doesnot exist!Please enter a valid username!";
}
else
   echo "Please enter username and password!";



?>