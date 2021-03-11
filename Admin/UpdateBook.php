<?php
// Include config file
require_once "../connectserver.php";
 
// Define variables and initialize with empty values
$name = $author = $edition = $status =$image = $price = $quantity = "";
$name_err = $author_err = $edition_err = $status_err = $image_err= $price_err = $quantity_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["bookid"]) && !empty($_POST["bookid"])){
    // Get hidden input value
    $bookid = $_POST["bookid"];
    
    // Validate Book's Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter Book's name.";
    }else{
        $name = $input_name;
    }
    
    // Validate Book's Author
    $input_author = trim($_POST["author"]);
    if(empty($input_author)){
        $author_err = "Please enter Author's Name.";     
    } else{
        $author = $input_author;
    }

    // Validate Book's Edition
    $input_edition = trim($_POST["edition"]);
    if(empty($input_edition)){
        $edition_err = "Please enter Book's Edition.";     
    } else{
        $edition = $input_edition;
    }

    // Validate Book's Price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";     
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }
    
    // Validate Quantity
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Please enter the quantity amount.";     
    } elseif(!ctype_digit($input_quantity)){
        $quantity_err = "Please enter a positive integer value.";
    } else{
        $quantity = $input_quantity;
    }

    // Validate Book's Image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter Book's Image.";     
    }else{
        $image = $input_image;
    }

    // Validate Book's Status
    if( $input_quantity < 1 ){
        $status="Not Available";
    }
    else{
        $status="Available";
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($author_err) && empty($edition_err && empty($status_err) && empty($image_err)&& empty($price_err) && empty($quantity_err) )){
        // Prepare an update statement
        $sql = "UPDATE books SET name=?, author=?, edition=?, status=?,image=?, price=?, quantity=? WHERE bookid=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_name, $param_author, $param_edition, $param_status, $param_image, $param_price, $param_quantity, $param_bookid);
            
            // Set parameters
            $param_name = $name;
            $param_author = $author;
            $param_edition = $edition;
            $param_status = $status;
            $param_price = $price;
            $param_image = $image;
            $param_quantity = $quantity;
            $param_bookid = $bookid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["bookid"]) && !empty(trim($_GET["bookid"]))){
        // Get URL parameter
        $bookid =  trim($_GET["bookid"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM books WHERE bookid = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_bookid);
            
            // Set parameters
            $param_bookid = $bookid;
            
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
                    $image = $row["image"];
                    $price = $row["price"];
                    $quantity = $row["quantity"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ErrorMessage.php");
        exit();
    }
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

    <!-- CSS Linked -->
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="stylesheet" href="CSS/navbar.css"/>

    <title>IIIT Book-Shop</title>
</head>

<body class="update-book">

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
                <li><a href="AHome.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li><a href="Book-Details.php">Book-Details <i class="fa fa-bookmark-o" style="color: rgb(160, 159, 158)" aria-hidden="true"></i> </a></li>
                <li><a href="User-Details.php">User-Details <i class="fa fa-address-book-o" style="color: rgb(160, 159, 158)" aria-hidden="true"></i> </a> </li>
                <li><a class="logout" href="Admin-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>

    <!-- Update Book Content -->
    <div class="wrapper" style="margin-bottom: 50px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Book Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>Author's Name</label>
                            <textarea name="author" class="form-control"><?php echo $author; ?></textarea>
                            <span class="help-block"><?php echo $author_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($edition_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Edition</label>
                            <textarea name="edition" class="form-control"><?php echo $edition; ?></textarea>
                            <span class="help-block"><?php echo $edition_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Price (in Rs.)</label>
                            <textarea name="price" class="form-control"><?php echo $price; ?></textarea>
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                            <label>Quantity</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Image</label>
                            <textarea name="image" class="form-control"><?php echo $image; ?></textarea>
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>

                        <input type="hidden" name="bookid" value="<?php echo $bookid; ?>"/>
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
