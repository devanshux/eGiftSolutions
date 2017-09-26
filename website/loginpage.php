<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user']))
{
header("location: categoryhome.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-orange.min.css" />
	<link rel="stylesheet" href="styles.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A catalogue ay">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div id="logo">
<img id="logoimg" src="giftshop1.png">
</div>	
<div id="login">
<div id="login">
<form name="login" action="" method="post">
<div class="mdl-textfield mdl-js-textfield">
    <input class="mdl-textfield__input field" type="text" id="username" name="username">
    <label class="mdl-textfield__label field" for="sample1">Text...</label>
</div>
<br>
<div class="mdl-textfield mdl-js-textfield">
    <input class="mdl-textfield__input field" type="password" id="password" name="password">
    <label class="mdl-textfield__label field" for="sample1">Password</label>
</div>
<br>
<input  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect loginbutton" type="submit" value=" Login " name="submit">
&nbsp;
<br>
<span><?php echo $error; ?></span>
</form>
</div>
</body>
</html>