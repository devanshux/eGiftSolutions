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
<?php
include("session.php");
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
		$category="select distinct products_categories.categoryname from big_giftshop.products_categories";
		$categoryres=$conn->query($category);
		while($categoryarray = $categoryres->fetch_assoc())
		{
			$currentcategory=$categoryarray["categoryname"];
			
			echo "<a class='mdl-menu__item' href='category.php?categoryname=$currentcategory'>$currentcategory</a>";
		}
		?>
	</ul>
  </div>
  <form id="sendproduct" method="get" action="product.php">
	</form>
  <main class="mdl-layout__content">
  <div class="page-content">
	<?php
	
	//print_r($_FILES);
	$loop=count($_FILES["upload"]["name"]);
	//printf($loop);
	$pid=$_POST["product_id"];
	$name=$_POST["name"];
	$desc=$conn->real_escape_string($_POST["description"]);
	$desc2=$conn->real_escape_string($_POST["description2"]);
	$quantity=$_POST["quantity"];
	$quantity2=$_POST["quantity2"];
	$price=$_POST["price"];
	$cat1=$_POST["category1"];
	$cat2=$_POST["category2"];
	$uploadcount=0;
if(file_exists("incyberia.com/images/$pid"))
{
	echo "TEST";
	goto unsuccessful;
}
else{
	mkdir("../images/$pid");
	//echo "Dir Created\n";
	chmod("../images/$pid",0777);
	echo "<br>";
}

for($i=0;$i<$loop;$i++)
{
$target_dir = "../images/$pid/";
//$target_file = $target_dir . basename($_FILES["upload"]["name"][$i]);
$j=$i+1;
$target_file = $target_dir .$j . ".jpg";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image


if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["upload"]["tmp_name"][$i]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
else
{
	//echo "file doesnt exist<br>";
	
}
// Check file size
$imagesize=$_FILES["upload"]["size"][$i];
if ($_FILES["upload"]["size"][$i] > 500000) {
   // echo "Sorry, your file is too large.";
    //$uploadOk = 0;
	
}
else
{
	//echo "size is fine<br>";
	
}
// Allow certain file formats
if($imageFileType != "jpg") {
    echo "Sorry, only JPG files are allowed.";
    $uploadOk = 0;
}
else
{
	//echo "file is jpg<br>";
	
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"][$i], $target_file)) {
        echo "The file ". basename( $_FILES["upload"]["name"][$i]). " has been uploaded.";
		$uploadcount++;
         chmod($target_file,0777);
    } 
	else {
        echo "Sorry, there was an error uploading your file.";
    }
	if($imagesize>400000)
	{
		echo "<br>";
		//echo $target_file;
		echo "<br>";
		$gdimage=imagecreatefromjpeg($target_file);
		if($imagesize>3000000)
			imagejpeg($gdimage,$target_file,20);
		else if($imagesize>2000000)
			imagejpeg($gdimage,$target_file,30);
		if($imagesize>1000000)
			imagejpeg($gdimage,$target_file,40);
		else
			imagejpeg($gdimage,$target_file,50);
			
		imagedestroy($gdimage);
	}
}
}
if ($uploadcount>=$loop)
{
	
	//$sql="insert into big_giftshop.products(product_id,name,description,quantity,price,category1,category2) values($pid,'$name','$desc',$quantity,$price,'$cat1','$cat2')";
	$sql="insert into big_giftshop.products(product_id,name,description,description2,quantity,quantity2,price,category1,category2) values($pid,'$name','$desc','$desc2',$quantity,$quantity2,$price,'$cat1','$cat2')";

	for($i=1;$i<=$loop;$i++)
	{
		$sql2="insert into big_giftshop.products_images(product_id,image_id) values($pid,$i)";
		$conn->query($sql2);
	}
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		Echo "Uploading Successful";
	} else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}
else
{
	unsuccessful:
	echo "Uploading Unsuccessful";
	for($i=1;$i<=$loop;$i++)
	{
		//unlink("../images/$pid/$i.jpg");
	}
}	
echo "<br><br>";
if($uploadcount>=$loop)
	echo "<button type='submit' form='sendproduct' name='id' value=$pid class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go back to Product</button>";
echo "    <a href='home.php' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2'>Go Home</a>";
?>
</div>	
</main>
</div>
</body>
</html>