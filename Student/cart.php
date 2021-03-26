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

	<!-- Additional CSS for Search Box -->
    <style type="text/css">

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
    </style>

</head>
<body class="mycart" style="background-color:rgb(12, 12, 12);">

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
                <li class="active"><a href="cart.php">BookCart <i class="fa fa-shopping-cart"  aria-hidden="true"></i> </a></li>
                <li><a class="logout" href="Student-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>

	<!-- Cart Content -->
	<div class="wrapper" style="margin: 0px 45px 30px 45px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left" style='color:rgb(157, 115, 255);'>Shopping Cart <i class="fa fa-shopping-cart"  aria-hidden="true"></i></h2>
                    </div>

	                <?php
	    	            session_start();
	    	            require_once "./functions/database_functions.php";
	    	            require_once "./functions/cart_functions.php";

	    	            // bookid got from form post method, change this place later.
	                    if(isset($_POST['bookisbn']))
		                {
	    	                $bookid = $_POST['bookisbn'];
	    	            }
	    	               if(isset($bookid))
			            {
		    	            // new iem selected
		                    if(!isset($_SESSION['cart']))
			                {
		    	                // $_SESSION['cart'] is associative array that bookisbn => qty
		    	                $_SESSION['cart'] = array();
			   	                $_SESSION['total_items'] = 0;
			    	            $_SESSION['total_price'] = '0.00';
		    	            }
		    	            if(!isset($_SESSION['cart'][$bookid]))
		    	            {
			   	                $_SESSION['cart'][$bookid] = 1;
		    	            } 

		    	            elseif(isset($_POST['cart']))
		    	            {
				                $_SESSION['cart'][$bookid]++;
				                unset($_POST);
		                    }
	                    }
	    	            // if save change button is clicked , change the qty of each bookisbn
	    	            if(isset($_POST['save_change']))
	    	            {
		                    foreach($_SESSION['cart'] as $isbn =>$qty)
			                {
		    	                if($_POST[$isbn] == '0')
		    	                {
				    	            unset($_SESSION['cart']["$isbn"]);
			    	            } 
					            else 
			    	            {
				                    $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			                    }
		                    }
	                    }

	    	            // print out header here
	    	            $title = "Your shopping cart";

	    	            if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))
			            {
		    	            $_SESSION['total_price'] = total_price($_SESSION['cart']);
		                    $_SESSION['total_items'] = total_items($_SESSION['cart']);
                        ?>

   	    	            <form action="cart.php" method="post">
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
				    	                <td style='border-color:rgb(53, 51, 51);'><input type="text" style=" background-color: #ffffff; color:#211a1a; border-color: #ccc; " value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
				    	                <td style='border-color:rgb(53, 51, 51);'><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> " . $qty * $book['price']; ?></td>
			    	                </tr>

			    	                <?php } ?>

		        	                <tr>
		        		                <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); '>&nbsp;</th>
						                <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); '>&nbsp;</th>
		    	    	                <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); '>TOTAL :</th>
		        		                <th style='border-color:rgb(53, 51, 51); color:rgb(211, 198, 241); '><?php echo $_SESSION['total_items']; ?></th>
		    	    	                <th style='border-color:rgb(53, 51, 51); color:#f08888; '><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> " . $_SESSION['total_price']; ?></th>
		        	                </tr>
						        </tbody>
	   	                    </table>

	   	                    <input type="submit" class="btn btn-primary pull-right" name="save_change" value="Save Changes">

	                    </form>
	                    <br/><br/>
						<br/>

						<a href="books.php" class="btn btn-default" style="background-color: rgb(77, 74, 74); color:#ffffff; border:none;">Back </a> 
	                    <a href="checkout.php" class="btn btn-success pull-right">Go To Checkout</a> 

                        <?php
	                    } else 
		                {
		                    echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	                    }
	                    if(isset($conn)){ mysqli_close($conn); }
                        ?>
	            </div>
            </div>        
        </div>
    </div>

	<!-- Footer  -->
    <footer id="footer" class="footer" style="position: fixed">
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

