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
if($_POST["turnoff"]==1)
{
	$_SESSION["tog"]=0;
}
if($_POST["turnon"]==1)
{
	$_SESSION["tog"]=1;
}
if($_SESSION["tog"]==0)
{
	$_SESSION["pricetoggle"]=0;
}
else
{
	$_SESSION["pricetoggle"]=1;
}
?>
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
	<form id="sendsearch2" method="get" action="home.php">
	</form>
	<form id="cart" method="post" action="home.php">
	</form>
	<form id="page" method="get" action="home.php">
	</form>
	<?php
	$servername = "localhost";
			$username = "big_giftshop";
			$password ="Milind@1610";

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
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
						mdl-textfield--floating-label mdl-textfield">
						 <label class="mdl-textfield__label field" for="sample1">Search</label>
							<input class="mdl-textfield__input" type="text" name="search" id="fixed-header-drawer-exp-2" form="sendsearch" >
							<button type="submit" form="sendsearch" id="searchbutton">asd</button>
							
						
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
      <a class="mdl-navigation__link hamfont" href="categoryhome.php"><i class="material-icons iconspacing">home</i>Home</a>
	  <a class="mdl-navigation__link hamfont" href="home.php"><i class="material-icons iconspacing">fast_forward</i>All Products</a>
	  <a class="mdl-navigation__link hamfont" href="#" id="submenu"><i class="material-icons iconspacing">toc</i>Categories
              <i class="material-icons arrow" role="presentation">arrow_drop_down</i>
	  </a>
	  <a class="mdl-navigation__link hamfont" href="cart.php"><i class="material-icons iconspacing">shopping_cart</i>Cart</a>
	  <a class="mdl-navigation__link hamfont" href="logout.php"><i class="material-icons iconspacing">info</i>Logout</a>
	  <a class="mdl-navigation__link hamfont" href='hideprice.php'><i class="material-icons iconspacing">attach_money</i>Price</a>
	 
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
  <main class="mdl-layout__content"  id="website1body">
    <div class="page-content"><!-- Your content goes here -->
		<div class="sortbuttons">
		<a class="mdl-navigation__link" href="#" id="categories">Sort by
              <i class="material-icons" role="presentation">arrow_drop_down</i>
	  </a>
	  <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect " for="categories">
	  <li class="mdl-menu__item"><button type="submit" name="sortselect" form="sendsort" class="mdl-menu__item linknostyle" value="Price Ascending" >Price Ascending</button></li>
	  <li class="mdl-menu__item"><button type="submit" name="sortselect" form="sendsort" class="mdl-menu__item linknostyle" value="Name Ascending" >Name Ascending</button></li>
	  <li class="mdl-menu__item"><button type="submit" name="sortselect" form="sendsort" class="mdl-menu__item linknostyle" value="Price Descending" >Price Descending</button></li>
	  <li class="mdl-menu__item"><button type="submit" name="sortselect" form="sendsort" class="mdl-menu__item linknostyle" value="Name Descending" >Name Descending</button></li>
	  <li class="mdl-menu__item"><button type="submit" name="sortselect" form="sendsort" class="mdl-menu__item linknostyle" value="ID Ascending" >ID Ascending</button></li>
	  </ul>
		<?php
		if (isset($_GET["sortselect"]))
		{
			echo "Currently Sorted by: " . $_GET["sortselect"];
		}
		else 
			echo "Currently Sorted by ID";
		
		$sqlpage="SELECT count(*) AS pagecount from big_giftshop.products where hidden=0";
		$pageresult= $conn->query($sqlpage);
		$countarray=$pageresult->fetch_assoc();
		$k=0;
		$k3=0;
		if(isset($_GET["pagenumber"]))
		{
			$k=$_GET["pagenumber"];
		}
		if(isset($_POST["pagenumber"]))
		{
			$k=$_POST["pagenumber"];
		}
		for($k3;$k3<$countarray["pagecount"];$k3=$k3+12)
		{
		}
			
		$k1=$k-12;
		$k2=$k+12;
		echo "&nbsp;&nbsp; Page ";
		echo floor($k/12)+1;
		echo " of ";
		echo floor($k3/12);
		?>
		</div>
		<div class="mdl-grid" >
			<?php
			/*
			0 - by id asc
			1 - by price asc
			2 - by name asc
			3 - by price desc
			4 - by name desc
			*/
			
			$sortsel=0;
			//$sql="SELECT * FROM big_giftshop.products order by products.category1, products.price limit 0,12";
			$sql="SELECT * FROM big_giftshop.products where hidden=0 order by category1 asc, price asc limit 0,12";

			if (isset($_GET["search"]))
			{
				$keyword=$_GET["search"];
				$sql="SELECT * FROM big_giftshop.products where products.name like '%$keyword%' or products.category1 like '%$keyword%' or products.category2 like '%$keyword%' or products.description like '%$keyword%' and hidden=0";
				
			}
			if(isset($_GET["pagenumber"]))
			{
				$p=$_GET["pagenumber"];
				//$sql="SELECT * FROM big_giftshop.products order by products.category1, products.price limit $p,12";
				$sql="SELECT * FROM big_giftshop.products where hidden=0 order by products.category1 asc, price asc limit $p,12";
				
			}
			if(isset($_POST["pagenumber"]))
			{
				$p=$_POST["pagenumber"];
				if($p<=0)
				{
					$p=0;
				}
				$sql="SELECT * FROM big_giftshop.products where hidden=0 order by products.category1 asc, price asc limit $p,12";			}
			if (isset($_GET["sortselect"]))
			{
				$sortsel=$_GET["sortselect"];
				if ($sortsel == "Price Ascending")
					$sql="SELECT * FROM big_giftshop.products order by products.price asc";
				else if ($sortsel== "Name Ascending")
					$sql="SELECT * FROM big_giftshop.products order by products.name asc";
				else if ($sortsel== "Price Descending")
					$sql="SELECT * FROM big_giftshop.products order by products.price desc";
				else if($sortsel== "Name Descending")
					$sql="SELECT * FROM big_giftshop.products order by products.name desc";
				else if($sortsel== "ID Ascending")
					$sql="SELECT * FROM big_giftshop.products order by products.product_id asc";
			}
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0)
			{
				// output data of each row
				while($row = $result->fetch_assoc()) 
				{
					
					$product_id2= $row["product_id"]; //Fetches current product ID being traversed
					$sql2="select products_images.product_id,image_id from big_giftshop.products_images,big_giftshop.products  where products_images.product_id=$product_id2"; //SQL query to retrieve product ID and image ID
					$result2=$conn->query($sql2); //stores the result in result2
					$row2 = $result2->fetch_assoc(); //puts it in row2 while creating an associative array
					
					echo "<div class=\"mdl-cell mdl-cell--4-col\">
					"; 
					echo "<a href='/giftshop/images/$row2[product_id]/$row2[image_id].jpg' data-fancybox>";
					echo "<img class=\"prodimage\" src=\"/giftshop/images/$row2[product_id]/$row2[image_id].jpg\">
					";
					echo "</a>";
					echo "<br><b>Name:</b> " . $row["name"];
					if($_SESSION["pricetoggle"]==1){
					$newprice=$row["price"]/10;
					$printprice=number_format($newprice,1);
					echo "<br><b>Price: </b>" . $printprice;
					}
					echo "<br><b>Category: </b>". $row["category1"] . "<br>" ;
					echo "<br><b>Description: </b>" . $row["description"] . "<br>";
					echo "<div class=\"buttonspacing\">
					";
					
					echo "<button type=\"submit\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2\" name=\"id\" value=\"$product_id2\" form=\"sendproduct\">
							<i class=\"material-icons\">forward</i>
							</button></div>	";
					echo "<div>";
					echo "<button type=\"submit\"  class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2\" name=\"addtocart\" value=\"p$product_id2\" form=\"cart\">
							Add to Cart
							</button>";
					echo "
							<div class='mdl-textfield mdl-js-textfield textbox'>
								<input class='mdl-textfield__input' type='text' pattern='-?[0-9]*(\.[0-9]+)?' name='quantity[]' form='cart'>
								<label class='mdl-textfield__label' for='sample2'>Quantity</label>
								<span class='mdl-textfield__error'>Input is not a number!</span>
							</div></div>";
					echo "</div>";
					
				}
				$pagecount=0;
				$sqlpage="SELECT count(*) AS pagecount from big_giftshop.products";
				$pageresult= $conn->query($sqlpage);
				$countarray=$pageresult->fetch_assoc();
				echo "<input type='hidden' form='cart' value='$p' name='pagenumber'/>";
				$k;
				$n=1;
				echo "<div id='pagenos'>";
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