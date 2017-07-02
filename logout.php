<?php

session_start();
session_destroy();
$page='loginpage.php';
header("Location:$page");
?>