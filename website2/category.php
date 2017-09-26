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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.min.css">
	<script src="jquery.fancybox.min.js"></script>
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
	<form id="cart" method="post" action="home.php">
	</form>
	<form id="page" method="get" action="category.php">
	</form>
	<form id="sendsearch2" method="get" action="home.php">
	</form>
	<?php
	include('session.php');
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
						mdl-textfield--floating-label mdl-textfield">
						 <label class="mdl-textfield__label field" for="sample1">Search</label>
							<input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp-2" form="sendsearch2" >
							<button type="submit" form="sendsearch2" id="searchbutton">asd</button>
							
						
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
		$category="select products_categories.categoryname from big_giftshop.products_categories";
		$categoryres=$conn->query($category);
		while($categoryarray = $categoryres->fetch_assoc())
		{
			$currentcategory=$categoryarray["categoryname"];
			
			echo "<a class='mdl-menu__item' href='category.php?categoryname=$currentcategory'>$currentcategory</a>";
		}
		?>
	</ul>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
		<div class="productdisplay" style="overflow-x:auto;">
		<?php
		$categorysearch=$_GET['categoryname'];
		$pagecount=0;
		$sqlpage="SELECT count(*) AS pagecount from big_giftshop.products where products.category1 like '$categorysearch' or products.category2 like '$categorysearch'";
		$pageresult= $conn->query($sqlpage);
		$countarray=$pageresult->fetch_assoc();
		$k=0;
	if(isset($_GET["pagenumber"]))
		{
			$k=$_GET["pagenumber"];
		}
		for($k3=0;$k3<$countarray["pagecount"];$k3=$k3+12)
		{
		}
			
		$k1=$k-12;
		$k2=$k+12;
		echo "&nbsp;&nbsp; Page ";
		echo floor($k/12)+1;
		echo " of ";
		echo floor($k3/12);
		?>
		<table>
		<tr>
		<th>Product ID</th>
		<th>Image</th>
		<th>Name</th>
		<th>Quantity</th>
		<th>Quantity BW</th>
		<th>Price</th>
		<th>Category</th>
		<th>More Info</th>
		</tr>
		<?php
		
			$sql="SELECT * FROM big_giftshop.products WHERE products.category1 LIKE '$categorysearch' or products.category2 like '$categorysearch' order by products.category1 asc, products.price asc limit 0,12";
			if(isset($_GET["pagenumber"]))
			{
				$p=$_GET["pagenumber"];
				$sql="SELECT * FROM big_giftshop.products where products.category1 like '$categorysearch' or products.category2 like '$categorysearch' order by products.category1 asc, products.price asc limit $p,12";
				
			}
			$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			// output data of each row
			while($row = $result->fetch_assoc()) 
			{
				$product_id2=$row['product_id'];
				echo "
				<tr>
					<td class='pid'>".$row['product_id'];
					$star=$row["star"];
					if($star==1)
						echo "<i class='material-icons star' style='color:yellow;'>star</i>";
					echo "</td>";
					echo "<td><a href='/giftshop/images/".$row['product_id']."/1.jpg' data-fancybox>";
					echo "<img class='prodimage2' src='/giftshop/images/".$row['product_id']."/1.jpg'/></a></td>";
					echo "<td class='name'>".$row['name'] ."</td>
					<td class='quantity'>".$row['quantity'] ."</td>
					<td class='quantity'>".$row['quantity2'] ."</td>
					<td class='price'>".$row['price']."</td>
					<td class='category'>".$row['category1']."</td>
					<td class='edit'><button type=\"submit\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2\" name=\"id\" value=\"$product_id2\" form=\"sendproduct\">
							View/Edit
							</button></div></td>
				</tr>	
					";
			}
			echo "</table><br>";
			echo "<div id='pagenos'>";
			echo "<input type='hidden' form='page' value='$categorysearch' name='categoryname'/>";
			echo "<input type='hidden' form='cart' value='$categorysearch' name='categoryname'/>";
			if($k!=0)
			{
				echo "<button type='submit' name='pagenumber' value='$k1' form='page' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Previous</button>";
			}
			echo "&nbsp";
			if($k!=$k3-12)
			{
				echo "<button type='submit' name='pagenumber' value='$k2' form='page' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Next</button>";
			}
			echo "</div>";
		}
		else 
		{
			echo "0 results";
		}
		$conn->close();
		?>
		</div>
		
	</div>
  </main>
</div>
</body>



</html>