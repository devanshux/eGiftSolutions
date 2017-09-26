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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>

	<form id="sendproduct" method="get" action="product.php">

	</form>

	<form id="sendcategory" method="get" action="category.php">

	</form>

	<form id="sendsort" method="get" action="home.php">

	</form>

	<form id="sendsearch" method="get" action="home.php">

	</form>

	<form id="sendsearch2" method="get" action="home.php">

	</form>

	<form id="cart" method="post" action="home.php">

	</form>

	<form id="page" method="post" action="home.php">

	</form>

	<form id="addcat" method="post" action="addcategory.php">

	</form>

	<form id="renamecat" method="post" action="addcategory.php">

	</form>

	<form id="newname" method="post" action="addcategory.php">

	</form>

	<?php

	include('session.php');

	$servername = "localhost";

			$username = "big_giftshop";

			$password = "Milind@1610";



			// Create connection

			$conn = new mysqli($servername, $username, $password, "big_giftshop");

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

					<p class="mdl-navigation__link">Hey <?php echo $login_session ?></p> <br>

					<b><a class="mdl-navigation__link" href="logout.php">Logout</a></b>

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

							<input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp-2" form="sendsearch2" >

							<button type="submit" form="sendsearch2" id="searchbutton">asd</button>

							

						</div>

					</div>

				</nav>

			</div>

		</header>

  <div class="mdl-layout__drawer">

	<span class="mdl-layout-title"><img id="logonav" src="giftshop.png"></span>

	<nav class="mdl-navigation">

      <a class="mdl-navigation__link hamfont" href="home.php"><i class="material-icons iconspacing">home</i>Home</a>

       <a class="mdl-navigation__link hamfont" href="star.php"><i class="material-icons iconspacing">star</i>Starred Items</a>

	  <a class="mdl-navigation__link hamfont" href="hidden.php"><i class="material-icons iconspacing">remove_red_eye</i>Hidden Items</a>

	  <a class="mdl-navigation__link hamfont" href="#" id="submenu"><i class="material-icons iconspacing">toc</i>Categories

              <i class="material-icons arrow" role="presentation">arrow_drop_down</i>

 

	  </a>

	  <a class="mdl-navigation__link hamfont" href="uploadproduct.php"><i class="material-icons iconspacing">add</i>Add Product</a>

	  <a class="mdl-navigation__link hamfont" href="addcategory.php"><i class="material-icons iconspacing">add</i>Add Category</a>

 <a class="mdl-navigation__link hamfont" href="deletecategory.php"><i class="material-icons iconspacing">delete</i>Delete Category</a>

	  <?php

	  if ($login_session == "dinesh")

	  {

		  echo "

		  	<a class='mdl-navigation__link hamfont' href='users.php'><i class='material-icons iconspacing'>account_circle</i>Users</a>

			";

		  echo "

		  	<a class='mdl-navigation__link hamfont' href='stock.php'><i class='material-icons iconspacing'>attach_money</i>Stock</a>

			";

	  }?>

	  <a class="mdl-navigation__link hamfont" href="logout.php"><i class="material-icons iconspacing">info</i>Logout</a>

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
	<form id="addorder" method="post"></form>
	<form id="orderinfo" method="post"></form>
	<form id="addorderdetails" method="get" action="addorderdetails.php"></form>
    <div class="page-content"><!-- Your content goes here -->
	<?php
	$orderid=$_GET["subdetails"];
	echo $orderid;
	$sql1="select max(detailid) as newdetid from orderdetails";
	$res=$conn->query($sql1);
	$resarr=$res->fetch_assoc();
	$detailid=$resarr["newdetid"];
	if($detailid<=0)
		$detailid=1;
	else
		$detailid=$detailid+1;
	echo $detailid;
	
	
	echo "<input type='hidden' name='subdetails' value='$orderid' form='addorderdetails'>";
	if(!isset($_GET["productid"]))
	{
		echo "Enter Product Name: ";
		echo "<input type='text' name='productname' form='addorderdetails'>";
		echo "<button type='submit' name='submit' form='addorderdetails'>Add</button>";
	}
	if(isset($_GET["productname"]))
	{
		$productname=$_GET["productname"];
		echo "<input type='hidden' name='productname' form='addorderdetails' value='$productname'>";
		$sql2="select * from products where name like '%$productname%'";
		$prod=$conn->query($sql2);
		if($prod->num_rows>0)
		{
			$prodres=$prod->fetch_assoc();
			$productid=$prodres["product_id"];
			$name=$prodres["name"];
			$price=$prodres["price"];
			echo "<br>". $productid;
			echo "<br><b>Product Name:</b> " . $name . "<br>";
			echo "<b>Price:</b> " . $price . "<br>";
			echo "<b>Enter Quantity:</b> <input type='text' name='quantity' form='addorderdetails'>";
			echo "<br><b>Enter Warehouse:</b> ";
			echo "<select name='warehouse' form='addorderdetails'><option value='1'>Warehouse 1</option><option value='2'>Bhiwandi Warehouse</option></select>";
			echo "<br><b>Enter Discount:</b> <input type='number' name='discount' form='addorderdetails'>";
			echo "<br><button type='submit' name='submit' form='addorderdetails'>Add</button>";
			echo "<input type='hidden' name='productname' form='addorderdetails' value='$productname'>";
		}
		else 
		{
			echo "<br>Product not Found.";
		}
		
			if(isset($_GET["quantity"]))
			{
				echo $productid,$name,$price;
				$quantity=$_GET["quantity"];
				$warehouse=$_GET["warehouse"];
				$discount=$_GET["discount"];
				if($discount==NULL)
					$discount=0;
				$total=($price-(($discount/100)*$price))*$quantity;
				$sql3="insert into orderdetails values($detailid,$orderid,$productid,'$name',$quantity,$warehouse,$price,$discount,$total)";
				$res=$conn->query($sql3);
				if($res)
				{
					echo "<br>Order detail Added";
					echo "<br><a href='addorderdetails.php?subdetails=$orderid'>Add Another product</a>";
					echo "<br><a href='vieworderdetails.php?id=$orderid'>View Order Info</a>";
				}
				else
					echo "not added";
			}
		
		
	}
	?>
	</div>

  </main>

</div>

</body>







</html>