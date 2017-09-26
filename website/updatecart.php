<!doctype html>
<?php

include('session.php');
if(isset($_COOKIE["cartarray"]))
{
	$receive=$_COOKIE["cartarray"];
	$array=json_decode($receive);
	$array2 = json_decode(json_encode($array), True);
	if(isset($_POST["editq"]))
	{
		$qarray=$_POST["quantityvalue"];
		$currentpid=0;
		
		foreach($qarray as $data)
		{
			if($data>0)
				break;
			$currentpid++;
		}
		foreach($array2 as $index=>&$quantity)
		{
			if($index==$_POST["editq"])
			{
				@$quantity=$qarray[$currentpid];
				break;
			}
		}
		
		$send=json_encode($array2);
		setcookie("cartarray",$send,time()+(86400*7),"/");
	}
	if(isset($_POST["removefromcart"]))
	{
		$receive=$_COOKIE["cartarray"];
		$array=json_decode($receive);
		$array2 = json_decode(json_encode($array), True);
		foreach($array2 as $index=>&$quantity)
		{
			if($index==$_POST["removefromcart"])
			{
				//echo $index;
				$del = $index;
				break;
			}
		}
		unset($array2[$del]);
		$send=json_encode($array2);
		setcookie("cartarray",$send,time()+(86400*7),"/");
	}
}
?>
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
	<!--header-->
	<!--form-->
	<form id="sendproduct" method="get" action="product.php">
	</form>
	<form id="sendcategory" method="get" action="category.php">
	</form>
	<form id="sendsort" method="get" action="home.php">
	</form>
	<form id="sendsearch" method="get" action="home.php">
	</form>
	<form id="cart" method="post" action="home.php">
	</form>
	<form id="quantitychange" method="post" action="cart.php">
	</form>
	<form id="editquantity" method="post" action="updatecart.php">
	</form>
	<form id="removecart" method="post" action="updatecart.php">
	</form>
	<?php
	$servername = "localhost";
			$username = "big_giftshop";
			$password = "Milind@1610";

			// Create connection
			$conn = new mysqli($servername, $username, $password);
			// Check connection
			if (mysqli_connect_error()) 
			{
				die("Database connection failed: " . mysqli_connect_error());
			}
			$sortquery=0;
	?>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title">Gift Shop</span>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
	  
				<!-- Navigation. We hide it in small screens. -->
				<nav class="mdl-navigation mdl-layout--large-screen-only">
					<a class="mdl-navigation__link" href="home.php">Home</a>
					<a class="mdl-navigation__link" href="">Products</a>
					<a class="mdl-navigation__link" href="">Contact Us</a>
					<a class="mdl-navigation__link" href="">About Us</a>
					<a class="mdl-navigation__link" href="test.html">Test</a>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							for="fixed-header-drawer-exp">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" name="search"
							id="fixed-header-drawer-exp" form="sendsearch">
							<button type="submit" form="sendsearch" id="searchbutton">asd</button>
						</div>
					</div>
				</nav>
				
				<!--mobile only to show search bar-->     
				<nav class="mdl-navigation mdl-layout--small-screen-only">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
						mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							for="fixed-header-drawer-exp-2 ">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp-2" >
							
						</div>
					</div>
				</nav>
			</div>
		</header>
  <div class="mdl-layout__drawer">
	<span class="mdl-layout-title"><img id="logonav" src="giftshop.png"></span>
	<nav class="mdl-navigation">
      <a class="mdl-navigation__link hamfont" href="home.php"><i class="material-icons iconspacing">home</i>Home</a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">store</i>Products</a>
	  <a class="mdl-navigation__link hamfont" href="#" id="submenu"><i class="material-icons iconspacing">toc</i>Categories
              <i class="material-icons arrow" role="presentation">arrow_drop_down</i>
 
	  </a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">email</i>Contact Us</a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">info</i>About Us</a>
	 
    </nav>
	<!-- sub menu only visible when clicked on the link above -->
	<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect " for="submenu">
		<?php
		$category="select distinct products.category1 from big_giftshop.products";
		$categoryres=$conn->query($category);
		while($categoryarray = $categoryres->fetch_assoc())
		{
			$currentcategory=$categoryarray["category1"];
			
			echo "<li class=\"mdl-menu__item\"><button class=\"mdl-menu__item linknostyle\" type=\"submit\" name=\"categoryname\" value=\"$currentcategory\" form=\"sendcategory\">";
			echo $currentcategory . "</button></li>";
		}
		?>
	</ul>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
		<?php
		echo "<script type='text/javascript'>alert('Product Updated')</script>";
		echo "<div id='buttonwrappers'>";
		echo "    <a href='cart.php' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go back to cart</a>";
		echo "    <a href='home.php' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go Home</a>";
		echo "</div>";
	?>
		
	</div>
  </main>
</div>
</body>



</html>