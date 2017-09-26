<?php
$conn = new mysqli('localhost','big_giftshop','Milind@1610');
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_admin'];
// SQL Query To Fetch Complete Information Of User
//$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
$sql="select username from big_giftshop.admins where username='$user_check'";

$result = $conn ->query($sql);
$row = $result ->fetch_assoc();
$login_session =$row['username'];
if(!isset($login_session)){
$conn->close();
header('Location: loginpage.php'); // Redirecting To Home Page
}
?>