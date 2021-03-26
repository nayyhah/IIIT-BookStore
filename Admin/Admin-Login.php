<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Admin-AHome.php");
    exit;
}
 
// Include connectserver file
require_once "../connectserver.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM adminn WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: Admin-AHome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html>
<head>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta name="author" content="Neha Jha">
    <meta name="description" content="RDBMS Project">

    <!-- Icon -->
    <link rel="icon" href="Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Linked -->
    <link rel="stylesheet" href="CSS/navbar.css">
    <link rel="stylesheet" href="CSS/LoginSignup.css">

    <title>IIIT Book-Shop</title>
</head>
<body>
        
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
                <li><a href="../index.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li class="active"><a href="Admin-Login.php">Admin <i class="fa fa-user" aria-hidden="true"></i> </a> </li>
                <li><a href="../Student/Student-Signup.php">Student-SignUp <i class="fa fa-sign-in" style="color: blue" aria-hidden="true"></i></a></li>
                <li><a href="../Student/Student-Login.php">Student-Login <i class="fa fa-sign-in" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>

    <!-- Admin Login Content -->
    <div class="login-content">
        <h2>Admin Login</h2>
        <div class="lform">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <div class="icon"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                    <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <div class="icon"> <i class="fa fa-lock" aria-hidden="true"></i> </div>
                    <input class="form-control" type="password" name="password" placeholder="Password" >
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <input class="btn btn-primary submit-button" type="submit" value="Login">
            </form>
        </div>
    </div> 

    <!-- Footer -->
    <footer id="footer" class="footer" style="position: fixed">
      <p class="text-center">
        Email: bookshop@iiit-bh.ac.in
        <br />Mobile: 0674-2653-321
      </p>
    </footer>

    <!-- Bootsrtap JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- JavaScript Linked-->
    <script src="../Javascript/navbar.js"></script>
</body>
</html>
