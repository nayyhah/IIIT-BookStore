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
                $status = $row["price"];
                $quantity = $row["quantity"];
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

    
    <!-- Icon -->
    <link rel="icon" href="Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    <!-- CSS Linked -->
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="stylesheet" href="CSS/navbar.css"/>

    <title>IIIT Book-Shop</title>

</head>
<body class="view-book">


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
                    <span class="iiitbookstore">IIIT Book-Shop</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="AHome.php">Home</a></li>
                <li><a href="Book-Details.php">Book-Details <i class="fa fa-bookmark-o" style="color: rgb(160, 159, 158)" aria-hidden="true"></i> </a></li>
                <li><a href="User-Details.php">User-Details <i class="fa fa-address-book-o" style="color: rgb(160, 159, 158)" aria-hidden="true"></i> </a> </li>
                <li><a class="logout" href="Admin-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Book</h1>
                    </div>
                    <div class="form-group">
                        <label>Book's Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Book's Author</label>
                        <p class="form-control-static"><?php echo $row["author"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Edition</label>
                        <p class="form-control-static"><?php echo $row["edition"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Book's Price (in Rs.)</label>
                        <p class="form-control-static"><?php echo $row["price"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Quantity Available</label>
                        <p class="form-control-static"><?php echo $row["quantity"]; ?></p>
                    </div>
                    <p><a href="Book-Details.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>


    <!-- Footer  -->
    <footer id="footer" class="footer">
      <p class="text-center">
        Email: library@iiit-bh.ac.in
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