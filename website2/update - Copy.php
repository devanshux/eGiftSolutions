<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-orange.min.css" />
	<link rel="stylesheet" href="styles.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A catalogue ay">
</head>
<body>
<form id="sendproduct" method="get" action="product.php">
</form>

<?php
$id=$_POST["product_id"];
$name=$_POST["name"];
$description=$_POST["description"];
$quantity=$_POST["quantity"];
$price=$_POST["price"];
$category1=$_POST["category1"];
$category2=$_POST["category2"];
$servername = "localhost";
$username = "inc_giftshop";
$password = "Milind@1610";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if (mysqli_connect_error()) 
{
die("Database connection failed: " . mysqli_connect_error());
}

$sql="update inc_giftshop.products set name='$name', description='$description', quantity=$quantity, price=$price,category1='$category1',category2='$category2' where product_id=$id";
$conn->query($sql);
echo "<script type='text/javascript'>alert('Product Updated')</script>";
echo "<div id='buttonwrapper'>";
echo "<button type='submit' form='sendproduct' name='id' value=$id class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go back to Product</button>";
echo "    <a href='home.php' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go Home</a>";
echo "</div>";
?>
</body>
</html>