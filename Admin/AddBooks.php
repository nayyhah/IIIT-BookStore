<?php
// Include connectserver file
require_once "../connectserver.php";
 
// Define variables and initialize with empty values
$name = $author = $edition = $status = $image = $price = $quantity =  "";
$name_err = $author_err = $edition_err = $status_err  = $image_err = $price_err = $quantity_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate Book's Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please Enter Book's Name.";
    }else{
        $name = $input_name;
    }

    // Validate Author's Name
    $input_author = trim($_POST["author"]);
    if(empty($input_author)){
        $author_err = "Please Enter Author's Name.";
    }else{
        $author = $input_author;
    }
    
    // Validate Edition
    $input_edition = trim($_POST["edition"]);
    if(empty($input_edition)){
        $edition_err = "Please Enter Book's Edition.";     
    } else{
        $edition = $input_edition;
    }

    // Validate Book's Price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please Enter Price of Book.";     
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }
    
    // Validate Quantity
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Please Enter Quantity of Book.";     
    } elseif(!ctype_digit($input_quantity)){
        $quantity_err = "Please enter a positive integer value.";
    } else{
        $quantity = $input_quantity;
    }

    // Validate Book's Image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter Book's Image.";     
    } else{
        $image = $input_image;
    }

    // Validate Availability Status
    if( $input_quantity < 1 ){
        $status="Not Available";
    }
    else{
        $status="Available";
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($author_err) && empty($edition_err) && empty($status_err) && empty($image_err) && empty($price_err) && empty($quantity_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO books (name, author, edition,image, status, price, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssii", $param_name, $param_author, $param_edition, $param_image, $param_status, $param_price, $param_quantity);
            
            // Set parameters
            $param_name = $name;
            $param_author = $author;
            $param_edition = $edition;
            $param_image = $image;
            $param_status = $status;
            $param_price = $price;
            $param_quantity = $quantity;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: Book-Details.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
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
                <li><a href="Admin-AHome.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li><a href="Book-Details.php">Books <i class="fa fa-bookmark-o" aria-hidden="true"></i> </a></li>
                <li><a href="User-Details.php">Users <i class="fa fa-address-book-o" aria-hidden="true"></i> </a> </li>
                <li><a href="Orders.php">Orders <i class="fa fa-shopping-bag" aria-hidden="true"></i> </a> </li>
                <li><a class="logout" href="Admin-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a> </li>
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
                        <h2 style="color:rgb(157, 115, 255); ">Add Book</h2>
                    </div>
                    <p style="color:rgb(211, 198, 241);">Please fill this form and submit to add book record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Name</label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>Author's Name</label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                            <span class="help-block"><?php echo $author_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($edition_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Edition</label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="edition" class="form-control" value="<?php echo $edition; ?>">
                            <span class="help-block"><?php echo $edition_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Price (in Rs.)</label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                            <label>Quantity</label>
                            <input style="background-color:rgb(12, 12, 12); border-color:rgb(53, 51, 51);" type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Image</label>
                            <input type="file" name="image" class="form-control-file" value="<?php echo $image; ?>">
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Book-Details.php" class="btn btn-default">Cancel</a>
                    </form>
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
