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
    
    <!-- Additional CSS -->
    <style type="text/css">
        .content {
            font-family: 'Helvetica Neue';
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
            font-size: 30px;
			margin-top:110px;
        }
        .title { 
            font-weight: bold;
            color: #5c5c5c;
        }
        .symbol {
            -webkit-text-stroke: 13px rgb(12, 12, 12);
            font-size: 150px;
            color: #37b20a;
        }
        .text { 
            margin-top: 15px;
            font-size: 25px;
            color: #e07202;
            text-align: center; 
            font-family: 'avenir';
            font-weight: lighter;
        }
    </style>

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

	<?php
	    session_start();
		require_once "./functions/database_functions.php";
		// print out header here
		$title = "Purchase Process";

		// connect database
		$conn = db_connect();
		extract($_SESSION['ship']);


		// find customer
		$customerid = getCustomerId($name, $address, $city, $state, $zip_code);
		if($customerid == null) {
			// insert customer into database and return customerid
			$customerid = setCustomerId($name, $address, $city,$state, $zip_code);
		}
		$date = date("Y-m-d H:i:s");
		insertIntoOrder($conn, $customerid, $_SESSION['total_price'], $date, $name, $address, $city, $state, $zip_code);

		// take orderid from order to insert order items
		$orderid = getOrderId($conn, $customerid);
	
		foreach($_SESSION['cart'] as $isbn => $qty)
		{
			$bookprice = getbookprice($isbn);
			$query = "INSERT INTO order_items VALUES 
			('$orderid', '$isbn', '$bookprice', '$qty')";
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Insert value false!" . mysqli_error($conn2);
				exit;
			}
		}
		session_unset();
	?>

	<div class='content'>
        <div class='fa fa-check-circle-o symbol'></div>
        <div class='title'>Thank you!</div>
        <div class='text'>Your Order has been received!</div>
    </div>

	<?php
	    if(isset($conn))
	    {
			mysqli_close($conn);
		}
    ?>
       
                
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
