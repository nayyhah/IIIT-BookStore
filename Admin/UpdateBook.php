<?php
// Include config file
require_once "../connectserver.php";
 
// Define variables and initialize with empty values
$name = $author = $edition = $status = $quantity =  "";
$name_err = $author_err = $edition_err = $status_err = $quantity_err =  "";
 
// Processing form data when form is submitted
if(isset($_POST["bookid"]) && !empty($_POST["bookid"])){
    // Get hidden input value
    $bookid = $_POST["bookid"];
    
    // Validate Book's Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter Book's name.";
    } else{
        $name = $input_name;
    }

    // Validate Author's Name
    $input_author = trim($_POST["author"]);
    if(empty($input_author)){
        $author_err = "Please Enter Author's Name.";
    } else{
        $author = $input_author;
    }
    
    // Validate Edition
    $input_edition = trim($_POST["edition"]);
    if(empty($input_edition)){
        $edition_err = "Please Enter Book's Edition.";     
    } else{
        $edition = $input_edition;
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

    // Validate Availability Status
    if( $input_quantity < 1 ){
        $status="Not Available";
    }
    else{
        $status="Available";
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($author_err) && empty($edition_err) && empty($status_err) && empty($quantity_err)){
        // Prepare an update statement
        $sql = "UPDATE books SET name=?, author=?, edition=?, status=?, quantity=? WHERE id=?";
    
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_author, $param_edition, $param_status, $param_quantity);
            
            // Set parameters
            $param_name = $name;
            $param_author = $author;
            $param_edition = $edition;
            $param_status = $status;
            $param_quantity = $quantity;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location:  Book-Details.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
                    $status = $row["status"];
                    $quantity = $row["quantity"];

                } else{
                    // URL doesn't contain valid bookid. Redirect to error page
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
        // URL doesn't contain bookid parameter. Redirect to error page
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
                        <h2>Edit Book Details</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                            <span class="help-block"><?php echo $author_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($edition_err)) ? 'has-error' : ''; ?>">
                            <label>Book's Edition</label>
                            <input type="text" name="edition" class="form-control" value="<?php echo $edition; ?>">
                            <span class="help-block"><?php echo $edition_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($status)) ? 'has-error' : ''; ?>">
                            <label>Availability Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block"><?php echo $status_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($quantity)) ? 'has-error' : ''; ?>">
                            <label>Quantity Available</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
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