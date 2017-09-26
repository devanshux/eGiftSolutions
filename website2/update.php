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

	<script>
	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
	showDivs(slideIndex += n);
	}

	function currentDiv(n) {
	showDivs(slideIndex = n);
	}

	function showDivs(n) {
	var i;
	var x = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("demo");
	if (n > x.length) {slideIndex = 1}    
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace("mdl-button mdl-js-button mdl-button--raised mybuttonnumber demo", "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybuttonnumber demo");
	}
	x[slideIndex-1].style.display = "block";  
	dots[slideIndex-1].className = "mdl-button mdl-js-button mdl-button--raised mybuttonnumber demo";
	
	}
</script>
<script>
function showDiv(divname) {
   document.getElementById(divname).style.display = "initial";
}
</script>
	
	
	
</head>


<body>
	<!--header-->
	<!--form-->
	<form id="sendproduct" method="get" action="product.php">
	</form>
	<form id="sendcategory" method="get" action="category.php">
	</form>
	<form id="updatedata" method="post" action="update.php">
	</form>
	<form id="sendproduct" method="get" action="product.php">
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
					<a class="mdl-navigation__link" href="template.html">Home</a>
					<a class="mdl-navigation__link" href="">Products</a>
					<a class="mdl-navigation__link" href="">Contact Us</a>
					<a class="mdl-navigation__link" href="">About Us</a>
					<a class="mdl-navigation__link" href="test.html">Test</a>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
						mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							for="fixed-header-drawer-exp">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" name="sample"
							id="fixed-header-drawer-exp">
						</div>
					</div>
				</nav>
				
				<!--mobile only to show search bar-->     
				<nav class="mdl-navigation mdl-layout--small-screen-only">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
						mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							for="fixed-header-drawer-exp-2">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" name="search"id="fixed-header-drawer-exp-2">
						</div>
					</div>
				</nav>
			</div>
		</header>
  <div class="mdl-layout__drawer">
	<span class="mdl-layout-title">Gift Shop</span>
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
			
			echo "<a class='mdl-menu__item' href='category.php?categoryname=$currentcategory'>$currentcategory</a>";
		}
		?>
	</ul>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
	<?php
	$id=$_POST["product_id"];
	$name=$_POST["name"];
	$description=$_POST["description"];
	$description2=$_POST["description2"];
	$quantity=$_POST["quantity"];
	$quantity2=$_POST["quantity2"];
	$price=$_POST["price"];
	$category1=$_POST["category1"];
	$category2=$_POST["category2"];
	$servername = "localhost";
	$username = "admin";
	$password = "admin";
	$sql="update big_giftshop.products set name='$name', description='$description', description2='$description2', quantity=$quantity, quantity2=$quantity2, price=$price,category1='$category1',category2='$category2' where product_id=$id";
	$conn->query($sql);
	echo "<script type='text/javascript'>alert('Product Updated')</script>";
	echo "<div id='buttonwrapper'>";
	echo "<button type='submit' form='sendproduct' name='id' value=$id class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go back to Product</button>";
	echo "    <a href='home.php' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go Home</a>";
$categoryname=$_POST["category"];
	echo "    <a href='category.php?categoryname=" . $categoryname  . "' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go Back to start of Category</a>";
	echo "</div>";
	?>
			
	</div>
  </main>
</div>
</body>



</html>