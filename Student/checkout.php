
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="author" content="Neha Jha">
    <meta name="description" content="RDBMS Project">

    <!-- Icon -->
    <link rel="icon" href="Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Linked -->
    <link rel="stylesheet" href="CSS/navbar.css"/>

    <title>IIIT Book-Shop</title>

</head>
<body class="add-books" style="background-color:rgb(12, 12, 12); color:rgb(218, 214, 214);">
    
    <!-- Navigation -->
    <nav class="navbar-sticky navbar navbar-inverse navbar-static-top navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar6" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> 
                    <img style="width: 64px" src="Images/iiit-logo.png"alt="iiit logo"/>
                    <span class="iiitbookstore" style="font-family: 'Open Sans', sans-serif; font-weight:600; font-size: 21px;">IIIT Book-Shop</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="Student-AHome.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li><a href="Books.php">Books <i class="fa fa-bookmark-o" aria-hidden="true"></i></a></li>
                <li><a href="cart.php">BookCart <i class="fa fa-shopping-cart"  aria-hidden="true"></i> </a></li>
                <li><a class="logout" href="Student-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>

    <!-- Add Books Content -->
	<div class="wrapper" style=" margin: 0 auto; background-color:#222121; margin-top:50px; border-radius:4px; width:650px; margin-bottom:50px; padding:0px 60px 40px 40px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header" style="border-color:rgb(53, 51, 51);">
                        <h2 style="color:rgb(157, 115, 255); ">Checkout</h2>
                    </div>
                    <p style="color:rgb(211, 198, 241);">Please fill your details and purchase to order the books.</p>

					<?php
	
						session_start();
	                    require_once "./functions/database_functions.php";
	                    // print out header here
	                    $title = "Checking out";

	                    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
                    ?>
                    <form method="post" action="purchase.php">
                        <?php if(isset($_SESSION['err']) && $_SESSION['err'] == 1){ ?>
								
								<?php } ?>
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label >Full Name <span style="color:red">*</span></label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="name" class="form-control">
                            <!-- <span class="help-block"><?php echo $name_err;?></span> -->
                        </div>

                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Street Address <span style="color:red">*</span></label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="address" class="form-control">
                            <!-- <span class="help-block"><?php echo $name_err;?></span> -->
                        </div>

                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>Town/City <span style="color:red">*</span></label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="city" class="form-control">
                            <!-- <span class="help-block"><?php echo $author_err;?></span> -->
                        </div>

                        <div class="form-group <?php echo (!empty($edition_err)) ? 'has-error' : ''; ?>">
                            <label>State <span style="color:red">*</span></label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="state" class="form-control">
                            <!-- <span class="help-block"><?php echo $edition_err;?></span> -->
                        </div>
                        
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Postal Code <span style="color:red">*</span></label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="zip_code" class="form-control">
                            <!-- <span class="help-block"><?php echo $price_err;?></span> -->
                        </div>

						<div class="form-group">
              				<a href="cart.php" class="btn btn-primary" style="background-color: rgb(77, 74, 74); color:#ffffff; margin-right:3px; border:none;">Back</a>
              				<input type="submit" name="submit" value="Continue" class="btn btn-primary" style="border:none;">
        				</div>
					</form>
    				<?php
					}
					else {
						echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
					}
					if(isset($conn)){ mysqli_close($conn); }
    				?>
				</div>
            </div>        
        </div>
    </div>          

    <!-- Footer  -->
    <footer id="footer" class="footer">
      <p class="text-center">
        Email: bookstore@iiit-bh.ac.in
        <br />Mobile: 0674-2653-321
      </p>
    </footer>

    <!-- Bootsrtap JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- JavaScript Linked-->
    <script src="Javascript/navbar.js"></script>

</body>
</html>
