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
	<form id="user" method="get" action="edituser.php"></form>
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
			
			echo "<li class=\"mdl-menu__item\"><button class=\"mdl-menu__item linknostyle\" type=\"submit\" name=\"categoryname\" value=\"$currentcategory\" form=\"sendcategory\">";
			echo $currentcategory . "</button></li>";
		}
		?>
	</ul>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
	<div id="edituser">
		<form action="adduser.php" method="post" id="adduser">
		Username: 
		<div class="mdl-textfield mdl-js-textfield">
			<input class="mdl-textfield__input" type="text" pattern=".{6,}" name='username' required='required'>
			<label class="mdl-textfield__label" for="sample1" >Username</label>
			<span class="mdl-textfield__error">Username should be 6 or more characters!</span>
		</div>
		<br>
		Password: 
		<div class="mdl-textfield mdl-js-textfield">
			<input class="mdl-textfield__input" type="password" pattern=".{6,}" name='password' required='required'>
			<label class="mdl-textfield__label" for="sample1" >Password</label>
			<span class="mdl-textfield__error">Password should be 6 or more characters!</span>
		</div>
		<br>
		<button type="submit" form="adduser" name="adduser" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Add User</button>
		</form>
		<?php
		if(isset($_POST["adduser"]))
		{
			$user=$_POST["username"];
			$pass=$_POST["password"];
			$addsql="insert into big_giftshop.users(username,password) values('$user','$pass')";
			$conn->query($addsql);
			echo "User Added";
			
		}
		?>
		</div>
	</div>	
	</div>
  </main>
</div>
</body>
</html>