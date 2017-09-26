<!doctype html>

<?php
include('session.php');


if (isset($_POST["addtocart"]))
{
	$pid=strval($_POST["addtocart"]);
	$q=$_POST["quantity"];
	$formset=0; //shows which product's quantity was set
	foreach($q as $value)
	{
		if($value!=NULL)
			break;
		$formset++;
	}	
	
	@$qval=$q[$formset];
	if($qval==0)
		$qval=1;
	
	if(isset($_COOKIE["cartarray"])==FALSE)
	{
		$array=array($pid=>$qval);
		$send=json_encode($array);
		setcookie("cartarray",$send,time()+(86400*7),"/");
		echo "<script type='text/javascript'>alert('Product Added to Cart')</script>";
	}
	else
	{
		$receive=$_COOKIE["cartarray"];
		$array=json_decode($receive);
		$array2 = json_decode(json_encode($array), True);
		if(array_key_exists($pid,$array2)==1)
		{
			echo "<script type='text/javascript'>alert('Product Already in Cart')</script>";
			
		}
		else
		{
			$temparray=array($pid=>$qval);
			$array2=array_merge($array2,$temparray);
			$send=json_encode($array2);
			setcookie("cartarray",$send,time()+(86400*7),"/");
			echo "<script type='text/javascript'>alert('Product Added to Cart')</script>";
		}
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
	<form id="page" method="post" action="home.php">
	</form>
	<?php
	$servername = "localhost";
			$username = "admin";
			$password = "admin";

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
							<input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp-2" >
							
						</div>
					</div>
				</nav>
			</div>
		</header>
  <div class="mdl-layout__drawer">
	<span class="mdl-layout-title">Gift Shop</span>
	<nav class="mdl-navigation">
      <a class="mdl-navigation__link hamfont" href="home.php"><i class="material-icons iconspacing">home</i>Home</a>
	  <a class="mdl-navigation__link hamfont" href="#" id="submenu"><i class="material-icons iconspacing">toc</i>Categories
              <i class="material-icons arrow" role="presentation">arrow_drop_down</i>
	  </a>
	  <a class="mdl-navigation__link hamfont" href="cart.php"><i class="material-icons iconspacing">shopping_cart</i>Cart</a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">email</i>Contact Us</a>
	  <a class="mdl-navigation__link hamfont" href="feedback.php"><i class="material-icons iconspacing">comment</i>Feedback</a>
	  <a class="mdl-navigation__link hamfont" href="logout.php"><i class="material-icons iconspacing">info</i>Logout</a>
	  
	 
    </nav>
	<!-- sub menu only visible when clicked on the link above -->
	<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect " for="submenu">
		<?php
		$category="select distinct products.category1 from giftshop.products";
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
		<div class="productform">
		<form name="productfeedback" method="post" class="feedbackform" action="insertfeedback.php">
		<h5><u>Product Feedback</u></h5><br>
		Product ID:
		<select name="pid">
		<?php
		$sql="select product_id from giftshop.products";
		$result= $conn->query($sql);
		while($row = $result->fetch_assoc())
		{
			  echo "<option value='";
			  echo $row["product_id"];
			  echo "'>".$row["product_id"]."</option>";
		}
		
		?>
		</select>
		<br>
		
		Rate:
		<br>
		<fieldset class="rating">
				<input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
				<input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
				<input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
				<input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
				<input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Very bad">1 star</label>
		</fieldset>
		<br>
		<br>
			<div class="mdl-textfield mdl-js-textfield">
				<textarea class="mdl-textfield__input" type="text" rows= "3" id="comments" name="comments"></textarea>
				<label class="mdl-textfield__label" for="comments">Enter Feedback here...</label>
			</div>
			<input type="hidden" value="<?php echo $login_session;?>"/ name="username">
			<br>
			<button type="submit" name="productfeedback" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" value="productfeedback" >Submit Feedback</button>
			
		</form>
		</div>
		<br>
		<?php
		$conn->close();
		?>
	</div>
  </main>
</div>
</body>



</html>