<!doctype html>
<html>


<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-orange.min.css" />
	<link rel="stylesheet" href="stylestest.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A catalogue">
	
<?php
	if(isset($_SESSION['reloadPage'])) {
        unset($_SESSION['reloadPage']);
           //no outputting code above header
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header("Location: http://www.mypage.com/");
    }
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
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
		['Browser', 'Visits'],
         <?php
			$chartpid=$_GET["id"];
			$chart="SELECT rating,count(rating) as ratingcount from inc_giftshop.products_feedback where product_id=$chartpid group by rating";
			$chartresult=$conn->query($chart);
			  while($row = $chartresult->fetch_assoc())
			{
			 echo "['".$row['rating']." Stars',".$row['ratingcount']."],";
			}
			?>
        ]);

        var options = {
          title: 'Product Ratings (Stars)',
		  is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
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
	<form id="deleteproduct" method="post" action="delete.php">
	</form>
	<form id="reviews" method="get" action="productreviews.php">
	</form>
	<form id="rotateimage" method="post" action="rotateimage.php">
	</form>
	
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
	  <a class="mdl-navigation__link hamfont" href="#" id="submenu"><i class="material-icons iconspacing">toc</i>Categories
              <i class="material-icons arrow" role="presentation">arrow_drop_down</i>
 
	  </a>
	  <a class="mdl-navigation__link hamfont" href="uploadproduct.php"><i class="material-icons iconspacing">add</i>Add Product</a>
	  <a class="mdl-navigation__link hamfont" href="logout.php"><i class="material-icons iconspacing">info</i>Logout</a>
    </nav>
	<!-- sub menu only visible when clicked on the link above -->
	<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect " for="submenu">
		<?php
		$category="select distinct products.category1 from inc_giftshop.products";
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
			

			
			
			$prod_id=$_GET['id'];
			$countsql="select count(products_images.product_id) AS count from inc_giftshop.products_images where products_images.product_id=$prod_id";
			$prodsql= "Select * from inc_giftshop.products where product_id=$prod_id";
			$countres=$conn->query($countsql);
			$countarr= $countres ->fetch_assoc();
			$prodres=$conn->query($prodsql);
			$prodarr=$prodres->fetch_assoc();
			
			
			?>
			<div id="wrapper">
			<div class="slideshow" style="max-width:300px">
			
			<?php
			
			for($i=1;$i<=$countarr["count"];$i++)
			{
				echo "<img class=\"mySlides\" id=\"img$i\" src=\"/giftshop/images/$prod_id/$i.jpg\" style=\"width:100%;\">
				";
				
				
			}
			
			?>
			<script>
			document.getElementById('img1').style.display = "block";
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
			echo "<div class='mdl-textfield mdl-js-textfield updatediv'>";
			echo "<input type='text' name='category1' id='category1' class='updatebox mdl-textfield__input' form='updatedata' value='$c1'></input>";
			echo "</div>";
			
			echo "<br><b>Category 2: </b>";
			echo "<div class='mdl-textfield mdl-js-textfield update div'>";
			echo "<input type='text' name='category2' id='category2' class='mdl-textfield__input updatebox' form='updatedata' value='$c2'></input>";
			echo "</div>";
			echo "<input type='hidden' value=$p form='deleteproduct' name='product_id'/>";
			
			?>
			
			<div id="updatebuttons">
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" form="updatedata">Update Values</button> 
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" form="deleteproduct">Delete Product</button>
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" form="reviews" value="<?php echo $prod_id?>" name="pid">Read Reviews</button>
			</div>
			<div id="piechart" style="width: 400px; height: 400px;"></div>
			</div>
			<br>
			</div>
	
  </main>
</div>
</body>



</html>