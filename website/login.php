<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$conn = new mysqli('localhost','big_giftshop','Milind@1610');
$username = stripslashes($username);
$password = stripslashes($password);
$sql= "select * from big_giftshop.users where username='$username' and password='$password'";
$result = $conn ->query($sql);
$rows=$result->num_rows;
if ($rows == 1) {
$_SESSION['login_user']=$username;
$_SESSION["tog"]=1; // Initializing Session
header("location: categoryhome.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
$conn->close();
}
}
?>