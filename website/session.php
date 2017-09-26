<?php
$conn = new mysqli('localhost','big_giftshop','Milind@1610');
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
//$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
$sql="select username from big_giftshop.users where username='$user_check'";
$result = $conn ->query($sql);
$row = $result ->fetch_assoc();
$login_session =$row['username'];
if($login_session!="")
{
}
else
{
$conn->close();
header('Location: loginpage.php'); // Redirecting To Home Page
}
?>