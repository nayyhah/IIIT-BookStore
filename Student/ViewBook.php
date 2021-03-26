<?php
// Check existence of bookid parameter before processing further
if(isset($_GET["bookid"]) && !empty(trim($_GET["bookid"]))){
    // Include config file
    require_once "../connectserver.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE bookid = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_bookid);
        
        // Set parameters
        $param_bookid = trim($_GET["bookid"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $author = $row["author"];
                $edition = $row["edition"];
                $status = $row["status"];
                $quantity = $row["price"];
                $bookid = $row["bookid"];
            } else{
                // URL doesn't contain valid bookid parameter. Redirect to error page
                header("location: ErrorMessage.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain bookid parameter. Redirect to error page
    header("location: ErrorMessage.php");
    exit();
}
?>

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
    </style>

    <title>IIIT Book-Shop</title>

</head>
<body class="view-book" style="background-color:rgb(12, 12, 12); color:rgb(202, 199, 199);">

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
                <li ><a href="Books.php">Books <i class="fa fa-bookmark-o" aria-hidden="true"></i> </a></li>
                <li><a href="cart.php">BookCart <i class="fa fa-shopping-cart"  aria-hidden="true"></i> </a></li>
                <li><a class="logout" href="Student-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>

    <!-- View Book Content -->
    <div class="wrapper" style=" margin: 0 auto; background-color:#222121; margin-top:30px; border-radius:4px; width:650px; margin-bottom:50px; padding:0px 60px 35px 40px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header" style="border-color:rgb(53, 51, 51);">
                        <h2 style="color:rgb(157, 115, 255);" >Book Details</h2>
                    </div>
                    <div class="form-group">
                        <label>Book's Name :</label>
                        <p class="form-control-static" style="color:rgb(211, 198, 241); font-size:16px;"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Book's Author :</label>
                        <p class="form-control-static" style="color:rgb(211, 198, 241); font-size:16px;"><?php echo $row["author"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Edition :</label>
                        <p class="form-control-static" style="color:rgb(211, 198, 241); font-size:16px;"><?php echo $row["edition"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Book's Price (in Rs.) :</label>
                        <p class="form-control-static" style="color:rgb(211, 198, 241); font-size:16px;"><?php echo $row["price"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Availibility Status :</label>
                        <p class="form-control-static" style="color:rgb(211, 198, 241); font-size:16px;"><?php echo $row["status"]; ?></p>
                    </div>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="bookisbn" value="<?php echo $row["bookid"];?>">
                        <input type="submit" name="cart" class="btn btn-success" value="Add to Cart">
                        <a href="Books.php" class="btn btn-default">Back</a>
                    </form>
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