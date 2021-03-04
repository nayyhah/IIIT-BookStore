<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />

    <!-- Icon -->
    <link rel="icon" href="../Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>


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
                    <span class="iiitbookstore">IIIT Book-Shop</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="Books.php">Books</a></li>
                <li><a href="Admin-Login.php">Admin <i class="fa fa-user" style="color: rgb(160, 159, 158)" aria-hidden="true"></i> </a> </li>
                <li><a class="logout" href="Student-Signup.php">Student-Signup <i class="fa fa-sign-in" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>
    

    <!-- Login-Content-->
    <div class="login-content">
        <h2>Student Login</h2>
        <div class="lform">
            <div class="form-field">
                <div class="icon"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <input class="form-input" type="text" name="email" placeholder="Email" required="">
            </div>
            <div class="form-field">
                <div class="icon"> <i class="fa fa-lock" aria-hidden="true"></i> </div>
                <input class="form-input" type="password" name="password" placeholder="Password" required="">
            </div>
            <input class="submit-button" type="submit" name="submit" value="Login"> 
            <p class="signupnow">Don't have an account yet? <a href="Student-Signup.php" style="color:white" >Sign up now</a>
                <span class="arrow"><i class="fa fa-arrow-right" style="font-size: 13px" aria-hidden="true"></i></span>
            </p>
        </div>
    </div>


    <!-- Footer -->
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
    <script src="../Javascript/navbar.js"></script>

</body>
</html>