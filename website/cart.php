<!doctype html>
<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'giftshoporderdetails@gmail.com';                 // SMTP username
$mail->Password = 'harshildevanshu';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('giftshoporderdetails@gmail.com', 'GiftShop');
$mail->addAddress('giftshoporderdetails@gmail.com', 'Big Shot');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('giftshoporderdetails@gmail.com', 'GiftShop');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);


include('session.php');if(isset($_POST["deletecart"])){	setcookie("cartarray","",time()-3600,"/");}
if(isset($_COOKIE["cartarray"]))
{
	$receive=$_COOKIE["cartarray"];
	$array=json_decode($receive);
	$array2 = json_decode(json_encode($array), True);
	if(isset($_POST["editq"]))
	{
		//$pidarray=$_POST["sendindex"];
		$qarray=$_POST["quantityvalue"];
		$currentpid=0;
		//echo $_POST["editq"];
		//print_r($pidarray);
		//echo "<br>";
		
		//echo "button pressed ". $_POST["editq"] . "<br>";
		//echo "quantity: ". $qarray[$currentpid] . "<br>";
		foreach($qarray as $data)
		{
			if($data>0)
				break;
			$currentpid++;
		}
		//echo "current index: ". $currentpid. "<br>";
		foreach($array2 as $index=>&$quantity)
		{
			if($index==$_POST["editq"])
			{
				//echo $_POST["editq"];
				@$quantity=$qarray[$currentpid];
				break;
				//echo $quantity;
				//echo "<br>";
			}
		}
		echo $quantity;
		$send=json_encode($array2);
		setcookie("cartarray",$send,time()+(86400*7),"/");
		print_r($array2);
	}
	if(isset($_POST["removefromcart"]))
	{
		echo "button pressed";
		echo $_POST["removefromcart"];
		$receive=$_COOKIE["cartarray"];
		$array=json_decode($receive);
		$array2 = json_decode(json_encode($array), True);
		foreach($array2 as $index=>&$quantity)
		{
			if($index==$_POST["removefromcart"])
			{
				echo $index;
				$del = $index;
				echo "<script type='text/javascript'>alert('Product removed from Cart')</script>";
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
	<form id="sendemail" method="post" action="cart.php">
	</form>	<form id="deletecart" method="post" action="cart.php">	</form>
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
		<div class="mdl-grid">
			<?php
			error_reporting(0);
			$mail->Subject = 'Order Details';
			$emailbody="";
			foreach($array2 as $index=>$quantity)
			{
				$pid=str_replace("p","",$index);
				$pid=intval($pid);
				$sql="SELECT * FROM big_giftshop.products where products.product_id=$pid";
				$result = $conn->query($sql);
				if ($result->num_rows > 0)
				{
					$row = $result->fetch_assoc();
					
						echo "<div class=\"mdl-cell mdl-cell--5-col\">
						";
						
						$sqlimage="select distinct products_images.product_id,products_images.image_id from big_giftshop.products_images,big_giftshop.products  where products_images.product_id=$pid AND products_images.image_id=1"; //SQL query to retrieve product ID and image ID
						$result2= $conn->query($sqlimage);
						$row2=$result2->fetch_assoc();
						$qid=$row["product_id"];
						echo "<img class=\"prodimage2\" src=\"/giftshop/images/$row2[product_id]/$row2[image_id].jpg\">
						";
						echo "<b>Product ID: </b>". $row["product_id"]."<br>";
						echo "<b>Product Name: </b>". $row["name"]."<br>";
						echo "<b>Description: </b>" . $row["description"];
						echo "<br><b>Quantity: </b>". $quantity;
						if($_SESSION["pricetoggle"]==1){
						$newprice=$row["price"]/10;
						$printprice=number_format($newprice,1);
						echo "<br><b>Price: </b>" . $printprice;
						}
						$emailbody=$emailbody . "<b>Product ID: </b>". $row["product_id"]."<br>" . "<b>Product Name: </b>". $row["name"]."<br>" . "<b>Quantity: </b>". $quantity .  "<br><b>Price: </b>". $row["price"]. "<br><br>";
						echo "<br>
						<div class='mdl-textfield mdl-js-textfield qtextbox'>
								<input class='mdl-textfield__input' type='text' pattern='-?[0-9]*(\.[0-9]+)?' name='quantityvalue[]' form='editquantity' size='2'/>
								<label class='mdl-textfield__label' for='sample2'>Number...</label>
								<span class='mdl-textfield__error'>Input is not a number!</span>
							</div>";
						//echo "<input type='hidden' value='$index' name='sendindex[]' form='editquantity'/>";
						echo "<button type='submit' value='$index'  name='editq' form='editquantity' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Change</button>    ";
						echo "<button type='submit' value='$index'  name='removefromcart' form='removecart' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Remove From Cart</button>";
						
						echo "</div>
							";

					
				}
				else 
				{
					echo "No Products in cart.";
				}
			}
			?>
			
			<div>
			<br><br><br>
			Name: 
			<div class='mdl-textfield mdl-js-textfield qtextbox'>
				<input class='mdl-textfield__input' type='text' name='address' form='sendemail' size='2' required/>
				<label class='mdl-textfield__label' for='sample2'>Name...</label>
			</div><br>
			Phone No.: 
			<div class='mdl-textfield mdl-js-textfield qtextbox'>
				<input class='mdl-textfield__input' type='text' name='phoneno' form='sendemail' size='2' required pattern='-?[0-9]*(\.[0-9]+)?'/>
				<label class='mdl-textfield__label' for='sample2'>Phone No....</label>
			</div>
			<button form="sendemail" type="submit" value="submit" name="sendbutton" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Send email to the shop</button>			<button form="deletecart" type="submit" value="submit" name="deletecart" class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Empty Cart</button>
			</div>
			<?php
			if(isset($_POST["sendbutton"]))
			{
				$mail->Body=$emailbody."<br><br>User's Name: " . $_POST["address"] ."<br>User's Phone Number:". $_POST["phoneno"] ."<br>" ;;
				if(!$mail->send()) {
					echo 'Email could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo '<br><br><br>Email has been sent';
				}								
			}
			
			$conn->close();
			?>
		</div>
		
	</div>
  </main>
</div>
</body>



</html>