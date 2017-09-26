<!doctype html>
<html>


<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-orange.min.css" />
	<link rel="stylesheet" href="styles.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.min.css">
	<script src="jquery.fancybox.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A catalogue">
	
<?php
        include('session.php');
	if(isset($_SESSION['reloadPage'])) {
        unset($_SESSION['reloadPage']);
           //no outputting code above header
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header("Location: http://www.mypage.com/");
    }
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>	
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
	<form id="deleteproduct" method="post" action="delete.php">
	</form>
	<form id="reviews" method="get" action="productreviews.php">
	</form>
	<form id="rotateimage" method="post" action="rotateimage.php">
	</form>
	<form id="sendsearch" method="get" action="home.php">
	</form>
	<form id="sendsearch2" method="get" action="home.php">
	</form>
	<form id="addimage" method="post" action="addimage.php"></form>
	<form id="star" method="get" action="product.php"></form>
	<form id="hidden" method="get" action="product.php"></form>
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
		$category="select products_categories.categoryname from big_giftshop.products_categories order by products_categories.categoryname asc";
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
		
			<?php
			$prod_id=$_GET['id'];
			if(isset($_GET["tostar"]))
			{
				$s=$_GET["tostar"];
				if($s)
				{
					$starsql="update big_giftshop.products set star=1 where product_id=$prod_id";
				}
				else
				{
					$starsql="update big_giftshop.products set star=0 where product_id=$prod_id";
				}
				$conn->query($starsql);
			}
			
			if(isset($_GET["tohide"]))
			{
				$s=$_GET["tohide"];
				if($s)
				{
					$starsql="update big_giftshop.products set hidden=1 where product_id=$prod_id";
				}
				else
				{
					$starsql="update big_giftshop.products set hidden=0 where product_id=$prod_id";
				}
				$conn->query($starsql);
			}
			
			$countsql="select count(products_images.product_id) AS count from big_giftshop.products_images where products_images.product_id=$prod_id";
			$prodsql= "Select * from big_giftshop.products where product_id=$prod_id";
			$countres=$conn->query($countsql);
			$countarr= $countres ->fetch_assoc();
			$prodres=$conn->query($prodsql);
			$prodarr=$prodres->fetch_assoc();
			
			
			?>
			<div id="wrapper">
			<div class="slideshow" style="max-width:300px">
			
			<?php
			$noofimages=$countarr["count"];
			for($i=1;$i<=$countarr["count"];$i++)
			{
				echo "<a href='/giftshop/images/$prod_id/$i.jpg' data-fancybox='group'>";
				echo "<img class=\"mySlides\" id=\"img$i\" src=\"/giftshop/images/$prod_id/$i.jpg\" style=\"width:100%;\">
				";
				echo "</a>";
				
				
			}
			
			?>
			<script>
			document.getElementById('img1').style.display = "block";

			$("[data-fancybox]").fancybox({
			// Options will go here
			});
			</script>
				
			</div>
			
			<div class="mycenter">
				<div class="w3-section">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" onclick="plusDivs(-1)">&#10094; Prev</button>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" onclick="plusDivs(1)">Next &#10095;</button>
				</div>
				<?php
			for($i=1;$i<=$countarr["count"];$i++)
			{
				
				echo "<button class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybuttonnumber demo\" id=\"btn$i\" onclick=\"currentDiv($i)\">$i</button>";
				
			}
			?>
			<br>
			<input type="hidden" name="productid" value="<?php echo $prod_id;?>" form="rotateimage">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2 rotate" name="rotate" value="<?php echo '../images/'.$prod_id.'/1.jpg';?>" form="rotateimage">Rotate 90 Degrees Clockwise</button>
			
			<script>
			document.getElementById('btn1').className="mdl-button mdl-js-button mdl-button--raised mybuttonnumber demo";
			</script>
			
				
			</div>
			</div>
			<div id="prodinfo">
			<?php
			
			$p=$prodarr['product_id'];
			$n=$prodarr['name'];
			$d=$prodarr['description'];
			$d2=$prodarr['description2'];
			$q=$prodarr['quantity'];
			$q2=$prodarr['quantity2'];
			$pr=$prodarr['price'];
			$c1=$prodarr['category1'];
			$c2=$prodarr['category2'];
			
			echo "<br><b>Product ID: </b>".$prodarr['product_id'];
			echo "<br><b>Name: </b>". $prodarr['name'];
			echo "<br><b>Description: </b><p>" .$prodarr['description']."</p>";
			echo "<br><b>Description 2: </b>";
			if(!isset($prodarr['description2']))
				echo '-  ';
			else
				echo "<p>". $prodarr['description2']."</p>";
			echo "";
			
			echo "<br><b>Quantity: </b>" .$prodarr['quantity'];
			echo "<br><b>Quantity BW: </b>" .$prodarr['quantity2'];
			echo "<br><b>Price: </b>" .$prodarr['price'];
			echo "<br><b>Category 1: </b>" .$prodarr['category1'];
			echo "<br><b>Category 2: </b>";
			
			if(!isset($prodarr['category2']))
				echo '-  ';
			else
				echo $prodarr['category2'];

			echo "<input type='hidden' name='id' form='star' value='$p'><br>";
			echo "<input type='hidden' name='id' form='hidden' value='$p'><br>";
			$star=$prodarr["star"];
			if($star==1)
			{
				echo "<b>Click to unstar:</b>";
				echo "<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2' type='submit' name='tostar' value='0' form='star'><i class='material-icons star'>star_border</i></button>";
			}
			else if($star==0)
			{
				echo "<b>Click to star:</b>";
				echo "<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2' type='submit' name='tostar' value='1' form='star'><i class='material-icons star'>star</i></button>";
			}
			echo "<br>";
			$hidden=$prodarr["hidden"];
			if($hidden==1)
			{
				echo "<b>Click to unhide:</b><br>";
				echo "<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2' type='submit' name='tohide' value='0' form='hidden'><i class='material-icons star'>check_circle</i></button>";
			}
			else if($hidden==0)
			{
				echo "<b>Click to hide:</b><br>";
				echo "<button class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2' type='submit' name='tohide' value='1' form='hidden'><i class='material-icons star'>done</i></button>";
			}
			echo "</div>";
			?>
			
			<?php
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><div id='updatevalues'>";
			echo "<b>Product ID: </b>";
			echo "<div class='mdl-textfield mdl-js-textfield updatediv' id='div1'>";
			echo "<input type='text' name='product_id' id='product_id' class='updatebox mdl-textfield__input' form='updatedata' value=$p size='2'></input>";
			echo "</div>";
			
			echo "<br><b>Name: </b>";
			echo "<div class='mdl-textfield mdl-js-textfield updatediv'>";
			echo "<input type='text' name='name' id='name' class='updatebox mdl-textfield__input' form='updatedata' value='$n'></input>";
			echo "</div>";
			
			echo "<br><b>Description: </b><br>";
			echo "
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<textarea name='description' id='description' class='mdl-textfield__input' type='text' rows= '3' form='updatedata'>$d</textarea>
			</div>";
			
			echo "<br><b>Seller Description: </b><br>";
			echo "
			<div class='mdl-textfield mdl-js-textfield updatediv'>
			<textarea name='description2' id='description' class='mdl-textfield__input' type='text' rows= '3' form='updatedata'>$d2</textarea>
			</div>";
			
			echo "<br><b>Quantity: </b>";
			echo "<div class='mdl-textfield mdl-js-textfield updatediv'>";
			echo "<input type='text' name='quantity' id='quantity' class='updatebox mdl-textfield__input' form='updatedata' value=$q  pattern='-?[0-9]*(\.[0-9]+)?'></input>";
			echo "<span class='mdl-textfield__error'>Input is not a number!</span>";
			echo "</div>";
			
			echo "<br><b>Quantity BW: </b>";
			echo "<div class='mdl-textfield mdl-js-textfield updatediv'>";
		
			echo "<input type='text' name='quantity2' id='quantity2' class='updatebox mdl-textfield__input' form='updatedata' value=$q2 pattern='-?[0-9]*(\.[0-9]+)?'></input>";
			echo "<span class='mdl-textfield__error'>Input is not a number!</span>";
			echo "</div>";
			
			echo "<br><b>Price: </b>";
			echo "<div class='mdl-textfield mdl-js-textfield updatediv'>";
			echo "<input type='text' name='price' id='price' class='updatebox mdl-textfield__input' form='updatedata' value=$pr  pattern='-?[0-9]*(\.[0-9]+)?'></input>";
			echo "<span class='mdl-textfield__error'>Input is not a number!</span>";
			echo "</div>";
			
			echo "<br><b>Category 1: </b>";
			$cat="select categoryname from big_giftshop.products_categories";
			$result= $conn->query($cat);
			 echo "<select name='category1' form='updatedata'>";
			
			while($rowcat = $result->fetch_assoc())
			{
			echo "<option value='" . $rowcat["categoryname"] . "'";
			if($rowcat["categoryname"]==$c1)
				{
					echo " selected='selected'";
				}
			echo ">" . $rowcat["categoryname"] . "</option>";
			}
			echo "</select>";
			
			echo "<br><b>Category 2: </b>";
			$cat="select categoryname from big_giftshop.products_categories";
			$result= $conn->query($cat);
			 echo "<select name='category2' form='updatedata'>";
			echo "<option value='None'>None</option>";
			while($rowcat = $result->fetch_assoc())
			{

				echo "<option value='";
				echo $rowcat["categoryname"];
				echo "'";
				if($rowcat["categoryname"]==$c2)
				{
					echo " selected='selected'>";
				}
				else
				{
					echo ">";
				}
				echo  $rowcat["categoryname"]. "</option>";
				
			}
			echo "</select>";
			
			?>
			
			<div id="updatebuttons">
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" form="updatedata">Update Values</button> 
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" name="product_id" form="deleteproduct" value="<?php echo $prod_id?>">Delete Product</button>
<input type="hidden" name="category" value="<?php echo $c1;?>" form="updatedata">
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" form="addimage" value="<?php echo $prod_id?>" name="pid">Add Image</button>
			<input type="hidden" form="addimage" name="lastimageid" value="<?php echo $noofimages;?>">
			</div>
			</div>
			<br>
			</div>
	
  </main>
</div>
</body>



</html>			