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
    
    <!-- Additional CSS for Search Box -->
    <style type="text/css">
        .wrapper .row a{
            background-color:rgb(87, 85, 85); 
            color:white; 
            border:none;
        }
        .wrapper .row a:hover{
            background-color:rgb(75, 74, 74); 
            color:white; 
            border:none;
        }
		.wrapper table{
            background-color:#222121; 
            border-color:rgb(53, 51, 51); 
            font-size: 15px;
        }
        .wrapper table thead tr{
            color:rgb(211, 198, 241); 
            background-color:#1b1b1b; 
        }
        .wrapper table tbody tr{
            color:rgb(202, 199, 199);
            border-color:rgb(53, 51, 51);
        }
        .dot {
            height: 9.5px;
            width: 9.5px;
            background-color: blue;
            border-radius: 50%;
            border:1.5px solid red;    
            display: inline-block;
            border-color:rgb(211, 198, 241);
        }

    </style>

	<!-- Aditional JS -->
	<script>
        function goBack() {
            window.history.back();
        }
    </script>

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
	<div class="wrapper" style="margin: 0px 45px 30px 45px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left" style='color:rgb(157, 115, 255);'>Order Summary <i class="fa fa-shopping-bag" aria-hidden="true"></i></h2>
                    </div>
    
					<?php
						session_start();
	                    $_SESSION['err'] = 1;
	                    foreach($_POST as $key => $value){
		                    if(trim($value) == ''){
			                $_SESSION['err'] = 0;
		                    }
		                    break;
	                    }
	                    if($_SESSION['err'] == 0){
		                    header("Location: checkout.php");
	                    } else {
		                    unset($_SESSION['err']);
	                    }

	                    $_SESSION['ship'] = array();
	                    foreach($_POST as $key => $value){
		                    if($key != "submit"){
			                    $_SESSION['ship'][$key] = $value;
		                    }
	                    }
	                    require_once "./functions/database_functions.php";
	                    // print out header here
	                    $title = "Purchase";
	
	                    // connect database
	                    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
                    ?>

				    <table class='table'>
				        <thead style='font-size: 17px;'>
	   			            <tr>
	   		    	            <th style='border-color:rgb(53, 51, 51);'>Book Name</th>
					            <th style='border-color:rgb(53, 51, 51);'>Author</th>
   			    	            <th style='border-color:rgb(53, 51, 51);'>Unit Price</th>
	  			    	        <th style='border-color:rgb(53, 51, 51);'>Quantity</th>
	   			    	        <th style='border-color:rgb(53, 51, 51);'>Total</th>
	   		                </tr>
		   	            </thead>
			            <tbody>
	   		    	        <?php
		    	    	        foreach($_SESSION['cart'] as $isbn => $qty){
				    	            $conn = db_connect();
				    	            $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			    	        ?>
			    	            <tr>
				    	            <td style='border-color:rgb(53, 51, 51);'><?php echo $book['name']; ?></td>
						            <td style='border-color:rgb(53, 51, 51);'><?php echo $book['author']; ?></td>
				    	            <td style='border-color:rgb(53, 51, 51);'><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> " . $book['price']; ?></td>
									<td style='border-color:rgb(53, 51, 51);' ><?php echo $qty; ?></td>
				    	            <td style='border-color:rgb(53, 51, 51);'><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> " . $qty * $book['price']; ?></td>
			    	            </tr>

			    	            <?php } ?>
		        	            <tr>
									<th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); background-color:rgb(12, 12, 12); '>ORDER TOTAL :</th>
		        		            <th style='border-color:rgb(53, 51, 51); background-color:rgb(12, 12, 12); '>&nbsp;</th>
						            <th style='border-color:rgb(53, 51, 51); background-color:rgb(12, 12, 12); '>&nbsp;</th>
		        		            <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); background-color:rgb(12, 12, 12); '><?php echo $_SESSION['total_items']; ?></th>
		    	    	            <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); background-color:rgb(12, 12, 12); '><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> " . $_SESSION['total_price']; ?></th>
		        	            </tr>

								<tr>
			                        <td style='border-color:rgb(53, 51, 51);'>Shipping Charges</td>
			                        <td style='border-color:rgb(53, 51, 51);'>&nbsp;</td>
			                        <td style='border-color:rgb(53, 51, 51);'>&nbsp;</td>
			                        <td style='border-color:rgb(53, 51, 51);'>&nbsp;</td>
			                        <td style='border-color:rgb(53, 51, 51);'><i class='fa fa-inr' aria-hidden='true'></i> 20.00</td>
		                        </tr>

		                        <tr>
			                        <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); background-color:rgb(12, 12, 12); '>TOTAL PAYABLE :</th>
			                        <th style='border-color:rgb(53, 51, 51); background-color:rgb(12, 12, 12);'>&nbsp;</th>
			                        <th style='border-color:rgb(53, 51, 51); background-color:rgb(12, 12, 12); '>&nbsp;</th>
			                        <td style='border-color:rgb(53, 51, 51); background-color:rgb(12, 12, 12);'>&nbsp;</td>
			                        <th style='border-color:rgb(53, 51, 51); color:#f08888; background-color:rgb(12, 12, 12);'><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> " . ($_SESSION['total_price'] + 20); ?></th>
		                        </tr>
					   </tbody>
	                </table>

					<div class="page-header clearfix">
                        <h3 class="pull-left" style='color:rgb(157, 115, 255);'>Payment Option :</h3>
                    </div>

                    <span class="dot"> </span>
					<p style="color:rgb(211, 198, 241); display: inline-block;">Cash on Delivery</p>
					<br/><br/><br/>

                    <form method="post" action="process.php" class="form-horizontal">
                        <a onclick="goBack()" class="btn btn-primary" style="background-color: rgb(77, 74, 74); color:#ffffff; margin-right:3px; border:none;">Back</a>
                        <button type="submit" class="btn btn-success pull-right" >Place Order</button> 
                    </form>
                    
					<?php
	                    } else {
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
