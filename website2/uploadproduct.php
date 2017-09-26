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
	<!--header-->
	<!--form-->
	<form id="sendproduct" method="get" action="product.php">
	</form>
	<form id="sendcategory" method="get" action="category.php">
	</form>
	<form id="updatedata" method="post" action="upload.php" enctype="multipart/form-data">
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
    <div class="page-content"><!-- Your content goes here -->
			<div id="prodinfo">
			<div id='updatevalues'>
			<b>Product ID: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv' id='div1'>
			<input type='text' name='product_id' id='product_id' class='updatebox mdl-textfield__input' required='required' form='updatedata' 
			value='<?php
			$pidcount="select products.product_id from big_giftshop.products order by product_id DESC limit 1";
			$pidcountres=$conn->query($pidcount);
			$pidcountarr=$pidcountres->fetch_assoc();
			$pidcount=$pidcountarr["product_id"];
			echo $pidcount+1;
			?>'></input>
			</div>
			<br>
			<b>Name: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<input type='text' name='name' id='name' class='updatebox mdl-textfield__input' form='updatedata' required='required'></input>
			</div>

			<br><b>Description: </b><br>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<textarea name='description' class="mdl-textfield__input" type="text" rows= "3" form='updatedata' required='required'></textarea>
			</div>
			
			
			<br><b>Seller Description: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<textarea name='description2' class="mdl-textfield__input" type="text" rows= "3" form='updatedata' required='required'></textarea>
			</div>
			
			<br><b>Quantity: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<input type='text' name='quantity' id='quantity' class='updatebox mdl-textfield__input' form='updatedata' pattern='-?[0-9]*(\.[0-9]+)?' required='required'></input>
			<span class='mdl-textfield__error'>Input is not a number!</span>
			</div>
			
			<br><b>Quantity BW: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<input type='text' name='quantity2' id='quantity2' class='updatebox mdl-textfield__input' form='updatedata' pattern='-?[0-9]*(\.[0-9]+)?' required='required'></input>
			<span class='mdl-textfield__error'>Input is not a number!</span>
			</div>
			
			<br><b>Price: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<input type='text' name='price' id='price' class='updatebox mdl-textfield__input' form='updatedata'  pattern='-?[0-9]*(\.[0-9]+)?' required='required'></input>
			<span class='mdl-textfield__error'>Input is not a number!</span>
			</div>
		
			<br><b>Category 1: </b>
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<!--<input type='text' name='category1' id='category1' class='updatebox mdl-textfield__input' form='updatedata' required='required'></input>-->
			<select name="category1">
			<?php
			$cat="select categoryname from big_giftshop.products_categories";
			$result= $conn->query($cat);
			while($rowcat = $result->fetch_assoc())
			{
				echo "<option value='";
				echo $rowcat["categoryname"];
				echo "'>".$rowcat["categoryname"]."</option>";
			}
		
			?>
			</select>
			</div>
			
			<br><b>Category 2: </b>
			<div class='mdl-textfield mdl-js-textfield update div'>
			<!--<input type='text' name='category2' id='category2' class='mdl-textfield__input updatebox' form='updatedata'></input>-->
			<select name="category2">
			<option value="None">None</option>
			<?php
			$cat="select categoryname from big_giftshop.products_categories";
			$result= $conn->query($cat);
			while($rowcat = $result->fetch_assoc())
			{
				echo "<option value='";
				echo $rowcat["categoryname"];
				echo "'>".$rowcat["categoryname"]."</option>";
			}
		
			?>
			</select>
			</div>
			</div>
			<br><b>Images: </b>
			<input name="upload[]" type="file" multiple="multiple" form='updatedata'/>
			<br><br>
			<div id="addbutton">
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" form="updatedata">Add Product</button> 
			</div>
			</div>
		
	</div>
  </main>
</div>
</body>



</html>